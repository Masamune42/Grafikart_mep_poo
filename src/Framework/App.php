<?php

namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    /**
     * Permet de lancer l'application et de détecter l'URL + renvoyer sur la bonne page
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        // Equivalent à => $uri = $_SERVER['REQUEST_URI'];
        $uri = $request->getUri()->getPath();
        if (!empty($uri) && $uri[-1] === "/") {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }
        if ($uri === '/blog') {
            return (new Response(200, [], '<h1>Bienvenue sur le blog</h1>'));
        }
        return new Response(404, [], '<h1>Erreur 404</h1>');
    }
}
