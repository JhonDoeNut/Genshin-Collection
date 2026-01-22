<?php
namespace Controllers\Router\Route;

use Controllers\MainController;
use Controllers\Router\Route;

class RouteLogin extends Route
{
    public function __construct(MainController $controller)
    {
        parent::__construct($controller);
    }

    protected function get($params = []): void{
        $this->controller->displayLogin();
    }

    protected function post($params = []): void{
        $this->controller->displayLogin();
    }
}