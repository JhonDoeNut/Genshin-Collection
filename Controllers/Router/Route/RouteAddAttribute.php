<?php
namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

class RouteAddAttribute extends Route
{
    public function __construct(PersoController $controller)
    {
        parent::__construct($controller);
    }

    protected function get($params = []): void
    {
        $this->controller->displayAddAttribute();
    }

    protected function post($params = []): void
    {
        try {
            $type = $this->getParam($params, 'type', false);
            $data = [
                'type' => $type,
                'name' => $this->getParam($params, 'name', false),
                'url_img' => $this->getParam($params, 'url_img', false),
            ];

            switch ($type) {
                case 'origin':
                    $this->controller->addOriginAndIndex($data);
                    return;
                case 'element':
                    $this->controller->addElementAndIndex($data);
                    return;
                case 'unitclass':
                    $this->controller->addUnitClassAndIndex($data);
                    return;
                default:
                    throw new \Exception("Type invalide : $type");
            }

        } catch (\Exception $e) {
            $this->controller->displayAddAttribute($params, $e->getMessage());
        }
    }
}
