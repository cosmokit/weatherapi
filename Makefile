.DEFAULT_GOAL := help

env=dev
docker-os=
COMPOSE=docker-compose -f docker-compose.yml
export COMPOSE env

bold := $(shell tput bold)
bg := $(shell tput setab 4)
txt := $(shell tput setaf 0)
sgr0 := $(shell tput sgr0)
UID:= $(shell id -u)
GID:= $(shell id -g)
USER := $(UID):$(GID)
PHP := $(COMPOSE) exec -u $(USER) php php

export compose
export env
export docker-os
export user
export UID
export GID


.PHONY: build
build: ## build and up docker environment
		$(COMPOSE) up -d --build --force-recreate --remove-orphans

.PHONY: up
up: ## up docker environment
		$(COMPOSE) up -d

.PHONY: stop
stop: ## stop docker environment
		$(COMPOSE) stop

.PHONY: down
down: ## down docker environment
		$(COMPOSE) down

.PHONY: erase
erase: ## stop containers, delete containers and clean volumes.
		@echo "$(UID)"
		@echo "$(GID)"
		$(COMPOSE) exec php-fpm rm -rf vendor
		$(COMPOSE) exec php-fpm rm -rf var
		$(COMPOSE) exec php-fpm rm -rf composer.lock
		$(COMPOSE) exec php-fpm rm -rf symfony.lock
		$(COMPOSE) down -v --rmi local

.PHONY: db-dev
db-dev: ## recreate dev database and load fixtures
		@echo "$(UID)"
		@echo "$(GID)"
		@echo "$(bold)$(bg)$(txt)[dev]Doctrine database DROP & CREATE$(sgr0)"
		$(PHP) bin/console doctrine:database:drop --force --env=dev
		$(PHP) bin/console doctrine:database:create --env=dev

		@echo "$(bold)$(bg)$(txt)[dev]Doctrine schema create$(sgr0)"
		$(PHP) bin/console doctrine:schema:drop
		$(PHP) bin/console doctrine:cache:clear-metadata
		$(PHP) bin/console doctrine:schema:create

		@echo "$(bold)$(bg)$(txt)[dev]Doctrine schema VALIDATE$(sgr0)"
		$(PHP) bin/console d:s:v


.PHONY: composer-install
composer-install: ## install composer dependencies
		@echo "$(UID)"
		@echo "$(GID)"
		$(COMPOSE) exec php-fpm composer install

.PHONY: composer
composer: ## run composer [o=command], e.g. make composer o=update
		export UID=$(id -u)
		export GID=$(id -g)
		$(COMPOSE) exec php-fpm composer $(o)

.PHONY: console
console: ## run symfony console ([o=command]), e.g. make console o=list
		@echo "$(UID)"
		@echo "$(GID)"
		$(PHP) bin/console $(o)

.PHONY: logs
logs: ## docker-compose logs
		@echo "$(UID)"
		@echo "$(GID)"
		$(COMPOSE) logs

.PHONY: help
help: ## this help
		@echo "$(UID)"
		@echo "$(GID)"
		@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
