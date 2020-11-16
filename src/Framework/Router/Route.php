<?php

namespace Framework\Router;

/**
 * Représente un routing à matcher
 */
class Route
{
    private $name;

    private $callback;

    private $parameters;


    public function __construct($name, $callback, array $parameters)
    {
        $this->name = $name;
        $this->callback =$callback;
        $this->parameters =$parameters;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    /**
     * Récupère les paramètres de l'URL
     *
     * @return string[]
     */
    public function getParams(): array
    {
        return $this->parameters;
    }
}
