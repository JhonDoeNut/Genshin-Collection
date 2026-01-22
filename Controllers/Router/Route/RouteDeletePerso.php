<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

class RouteDeletePerso extends Route
{
    public function __construct(PersoController $controller)
    {
        parent::__construct($controller);
    }

    protected function get($params = []): void
    {
        try {
            // id obligatoire
            $id = $this->getParam($params, 'idPerso', false);
            $this->controller->deletePersoAndIndex($id);

        } catch (\Exception $e) {
            // 3) en cas d'erreur (id absent / vide) => appeler sans param
            $this->controller->deletePersoAndIndex();
        }
    }

    protected function post($params = []): void
    {
        // pas utilisé pour l’instant
    }
}
