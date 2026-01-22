<?php
namespace Controllers\Router\Route;

use Controllers\MainController;
use Controllers\Router\Route;

class RouteLogs extends Route
{
    public function __construct(MainController $controller)
    {
        parent::__construct($controller);
    }

    protected function get($params = []): void
    {
        $this->controller->logs();

    }

    protected function post($params = []): void
    {
        // vide pour l’instant
    }
}
