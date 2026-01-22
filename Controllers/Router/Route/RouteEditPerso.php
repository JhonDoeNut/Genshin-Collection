<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

class RouteEditPerso extends Route
{
    public function __construct(PersoController $controller)
    {
        parent::__construct($controller);
    }

    protected function get($params = []): void
    {
        try {
            $id = $this->getParam($params, 'idPerso', false);
            $this->controller->displayEditPerso($id);
        } catch (\Exception $e) {
            $this->controller->displayAddPerso([], "id not found");
        }
    }

    protected function post($params = []): void
    {
        try {
            $data = [
                'idPerso' => $this->getParam($params, 'idPerso', false),
                'name' => $this->getParam($params, 'name', false),

                'element' => intval($this->getParam($params, 'element', false)),
                'unitclass' => intval($this->getParam($params, 'unitclass', false)),

                'origin' => ($this->getParam($params, 'origin', true) === '')
                    ? null
                    : intval($this->getParam($params, 'origin', true)),

                'rarity' => intval($this->getParam($params, 'rarity', false)),
                'url_img' => $this->getParam($params, 'url_img', false),
            ];

            $this->controller->editPersoAndIndex($data);

        } catch (\Exception $e) {
            // réafficher le form edit avec message
            $this->controller->displayAddPerso($params, $e->getMessage());
        }
    }
}
