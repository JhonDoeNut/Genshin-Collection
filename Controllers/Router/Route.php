<?php
namespace Controllers\Router;

use Exception;

abstract class Route
{
    protected $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function action($params = [], $method = 'GET'): void
    {
        if (strtoupper($method) === 'POST') {
            $this->post($params);
        } else {
            $this->get($params);
        }
    }

    protected function get($params = []): void
    {

    }

    protected function post($params = []): void
    {

    }

    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true): string
    {
        if (!isset($array[$paramName])) {
            throw new \Exception("Paramètre '$paramName' absent");
        }

        $value = (string)$array[$paramName];

        if (!$canBeEmpty && trim($value) === '') {
            throw new \Exception("Paramètre '$paramName' vide");
        }

        return $value;
    }

}
