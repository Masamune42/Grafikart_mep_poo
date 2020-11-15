<?php

namespace Test\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    
    // Ancienne fonction => ne fonctionne et renvoie l'erreur suivante :
    // Impossible de modifier les header car ils ont déjà été envoyés
    // public function testRedirectTrailingSlash()
    // {
    //     $app = new App();
    //     $request = new Request('/azezae');
    //     $response = $app->run($request);
    //     $this->assertEquals('/azezae', $response->getHeader('Location'));
    //     $this->assertEquals(301, $response->getStatus());
    // }

    public function testRedirectTrailingSlash()
    {
        $app = new App();
        // On utilise GuzzleHttp\Psr7 qui permet de récupérer les informations HTTP quand on effectue des tests
        // param 1 => méthode, 2 => uri
        $request = new ServerRequest('GET', '/demoslash/');
        // On lance l'application avec la requête HTTP créée avant qui va renvoyer une réponse
        $response = $app->run($request);
        // On vérifie que l'on récupère bien un lien avec le slash retiré
        $this->assertContains('/demoslash', $response->getHeader('Location'));
        // On vérifie que l'on récupère bien un code 301
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testBlog()
    {
        $app = new App();
        // On utilise GuzzleHttp\Psr7 qui permet de récupérer les informations HTTP quand on effectue des tests
        // param 1 => méthode, 2 => uri
        $request = new ServerRequest('GET', '/blog');
        // On lance l'application avec la requête HTTP créée avant qui va renvoyer une réponse
        $response = $app->run($request);
        // On vérifie que l'on récupère bien un lien avec le slash retiré
        $this->assertContains('<h1>Bienvenue sur le blog</h1>', [(string) $response->getBody()]);
        // On vérifie que l'on récupère bien un code 301
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testError404()
    {
        $app = new App();
        // On utilise GuzzleHttp\Psr7 qui permet de récupérer les informations HTTP quand on effectue des tests
        // param 1 => méthode, 2 => uri
        $request = new ServerRequest('GET', '/aze');
        // On lance l'application avec la requête HTTP créée avant qui va renvoyer une réponse
        $response = $app->run($request);
        // On vérifie que l'on récupère bien un lien avec le slash retiré
        $this->assertContains('<h1>Erreur 404</h1>', [(string) $response->getBody()]);
        // On vérifie que l'on récupère bien un code 301
        $this->assertEquals(404, $response->getStatusCode());
    }

}
