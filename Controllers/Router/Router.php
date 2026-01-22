<?php
namespace Controllers\Router;

use Controllers\MainController;
use Controllers\PersoController;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteAddAttribute;
use Controllers\Router\Route\RouteEditPerso;
use Controllers\Router\Route\RouteDeletePerso;


class Router
{
    private array $ctrlList = [];
    private array $routeList = [];
    private $templates;

    public function __construct($templates)
    {
        $this->templates = $templates;
        $this->createControllerList();
        $this->createRouteList();
    }

    private function createControllerList(): void
    {
        $this->ctrlList = [
            'main' => new MainController($this->templates),
            'perso' => new PersoController($this->templates),
        ];
    }

    private function createRouteList(): void
    {
        $this->routeList = [
            'index' => new RouteIndex($this->ctrlList['main']),
            'add-perso' => new RouteAddPerso($this->ctrlList['perso']),
            'logs' => new RouteLogs($this->ctrlList['main']),
            'add-perso-attribute' => new RouteAddAttribute($this->ctrlList['perso']),
            'edit-perso' => new RouteEditPerso($this->ctrlList['perso']),
            'del-perso' => new RouteDeletePerso($this->ctrlList['perso']),
            'login' => new RouteLogin($this->ctrlList['main'])
        ];

    }

    public function routing(): void
    {
        $action = $_GET['action'] ?? 'index';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $params = ($method === 'POST') ? $_POST : $_GET;

        if (!isset($this->routeList[$action])) {
            $action = 'index';
        }

        $this->routeList[$action]->action($params, $method);
    }
}
