<?php
namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;

class RouteAddPerso extends Route
{
    public function __construct(PersoController $controller)
    {
        parent::__construct($controller);
    }

    protected function get($params = []): void
    {
        $this->controller->displayAddPerso();
    }

    protected function post($params = []): void
    {
        try {
            $data = [
                'name' => $this->getParam($params, 'name', false),
                'element' => intval($this->getParam($params, 'element', false)),
                'unitclass' => intval($this->getParam($params, 'unitclass', false)),
                'origin' => ($this->getParam($params, 'origin', true) === '') ? null : intval($this->getParam($params, 'origin', true)),
                'rarity' => intval($this->getParam($params, 'rarity', false)),
                'url_img' => $this->getParam($params, 'url_img', false),
            ];

            $message = $this->controller->addPerso($data);

            $_SESSION['flash'] = [
                'text'  => $message,
                'title' => 'Ajout',
                'color' => \Helpers\Message::COLOR_SUCCESS
            ];

            header('Location: index.php');
            exit;

        } catch (\Exception $e) {
            $this->controller->displayAddPerso($params, $e->getMessage());
        }
    }



}
