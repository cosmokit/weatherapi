<?php


namespace App\Infrastructure\Http;


use Psr\Http\Message\ResponseInterface;

interface HttpQueryClientInterface
{
    public function query(string $uri): ResponseInterface;
}