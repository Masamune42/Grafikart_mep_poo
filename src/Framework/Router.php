<?php

namespace Framework;

use Framework\Router\Route;
use Psr\Http\Message\RequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;

/**
 * Enregistre et match les routes
 */
class Router
{
    /**
     * @var FastRouteRouter
     */
    private $router;

    public function __construct() {
        $this->router = new FastRouteRouter();
    }

    /**
     * Undocumented function
     *
     * @param string $path
     * @param $callable
     * @param string $name
     * @return void
     */
    public function get(string $path, $callable, string $name)
    {
        $this->router->addRoute(new ZendRoute($path, $callable, ['GET'], $name));
    }

    /**
     * Undocumented function
     *
     * @param RequestInterface $request
     * @return Route|null
     */
    public function match(RequestInterface $request): ?Route
    {
        $result = $this->router->match($request);
        if($result->isSuccess()) {
            return new Route($result->getMatchedRouteName(), $result->getMatchedMiddleware(), $result->getMatchedParams());
        }
        return null;
    }
}
