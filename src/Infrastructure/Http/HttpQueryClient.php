<?php


namespace App\Infrastructure\Http;

use GuzzleHttp\Client as Guzzle;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpQueryClient extends Guzzle implements HttpQueryClientInterface
{
    public function query(string $uri): ResponseInterface
    {
        $response = $this->request(Request::METHOD_GET, $uri);

        return $response;
    }

    private function isValidResponse(ResponseInterface $response): bool
    {
        return Response::HTTP_OK === $response->getStatusCode();
    }

}