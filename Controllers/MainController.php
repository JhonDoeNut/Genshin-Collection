<?php

namespace Controllers;
use Helpers\Message;
class MainController
{

    private $templates;


    /**
     * @param $templates
     */
    public function __construct($templates)
    {
        $this->templates = $templates;
    }


    public function index(): void
    {
        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        $message = null;
        if (is_array($flash)) {
            $message = new Message(
                $flash['text'] ?? '',
                $flash['color'] ?? Message::COLOR_INFO,
                $flash['title'] ?? 'Message'
            );
        }

        $service = new \Models\PersonnageService();
        $listPersonnage = $service->getAllPerso();

        $first = !empty($listPersonnage) ? $service->getPersoById($listPersonnage[0]->getId()) : null;

        echo $this->templates->render('home', [
            'gameName'       => 'Genshin Impact',
            'listPersonnage' => $listPersonnage,
            'first'          => $first,
            'message'        => $message
        ]);
    }


    public function getTemplates()
    {
        return $this->templates;
    }

    public function displayLogs(): void
    {
        echo $this->templates->render('logs', [
            'title' => 'Logs'
        ]);
    }
    public function logs(): void
    {
        $logger = new \Helpers\Logger();
        $months = $logger->listMonths();
        $selected = $_GET['month'] ?? ($months[0] ?? null);
        $content = $selected ? $logger->read($selected) : '';

        echo $this->templates->render('logs', [
            'title' => 'Logs',
            'available' => $months,
            'selected' => $selected,
            'content' => $content
        ]);
    }

    public function displayLogin()
    {
        echo $this->templates->render('login', [
            'title' => 'Login'
        ]);
    }





}