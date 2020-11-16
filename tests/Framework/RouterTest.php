<?php

namespace Test\Framework;

use Framework\Router;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /** @var Router */
    private $router;

    public function setUp(): void
    {
        $this->router = new Router();
    }


    public function testGetMethod()
    {
        // On crée une fausse requête
        $request = new ServerRequest('GET', '/blog');
        // On crée une nouvelle URL pour le router et dès qu'il détecte '/blog' (param1), retourne 'hello' (param2), en assignant le nom de l'url (param3)
        $this->router->get('/blog', function () {
            return 'hello';
        }, 'blog');
        // Permet de vérifier si la requête match une des URL rentrée, renvoie un objet
        $route = $this->router->match($request);
        // On récupère le nom de l'objet qui a matché et on vérifie qu'il est égal à 'blog'
        $this->assertEquals('blog', $route->getName());
        // On récupère la fonction qui a été appelée
        $this->assertEquals('hello', call_user_func_array($route->getCallBack(), [$request]));
    }

    public function testGetMethodIfURLDoesNotExists()
    {
        // On crée une fausse requête
        $request = new ServerRequest('GET', '/blog');
        // On crée une nouvelle URL pour le router et dès qu'il détecte '/blog' (param1), retourne 'hello' (param2), en assignant le nom de l'url (param3)
        $this->router->get('/blogaze', function () {
            return 'hello';
        }, 'blog');
        // Permet de vérifier si la requête match une des URL rentrée, renvoie un objet
        $route = $this->router->match($request);
        // On récupère le nom de l'objet qui a matché et on vérifie qu'il est égal à 'blog'
        $this->assertEquals(null, $route);
    }

    public function testGetMethodWithParameters()
    {
        // On crée une fausse requête
        $request = new ServerRequest('GET', '/blog/mon-slug-8');
        // On crée une nouvelle URL pour le router et dès qu'il détecte '/blog' (param1), retourne 'hello' (param2), en assignant le nom de l'url (param3)
        $this->router->get('/blog', function () {
            return 'zezae';
        }, 'posts');
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function () {
            return 'hello';
        }, 'post.show');
        // Permet de vérifier si la requête match une des URL rentrée, renvoie un objet
        $route = $this->router->match($request);
        // On récupère le nom de l'objet qui a matché et on vérifie qu'il est égal à 'blog'
        $this->assertEquals('post.show', $route->getName());
        // On récupère la fonction qui a été appelée
        $this->assertEquals('hello', call_user_func_array($route->getCallBack(), [$request]));
        $this->assertEquals(['slug' => 'mon-slug', 'id' => '8'], $route->getParams());
    }
}
