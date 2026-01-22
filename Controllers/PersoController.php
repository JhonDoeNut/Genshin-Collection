<?php
namespace Controllers;
use Helpers\Logger;
use Helpers\Message;
use Models\ElementDAO;
use Models\OriginDAO;
use Models\PersonnageDAO;
use Models\PersonnageService;
use Models\UnitClassDAO;

class PersoController
{
    private $templates;
    private MainController $mainController;

    public function __construct($templates, ?MainController $mainController = null)
    {
        $this->templates = $templates;
        $this->mainController = $mainController ?? new MainController($templates);
    }

    public function displayAddPerso(array $data = [], ?string $message = null): void
    {
        $elements = (new ElementDAO())->getAll();
        $origins = (new OriginDAO())->getAll();
        $unitclasses = (new UnitClassDAO())->getAll();

        echo $this->templates->render('add-perso', [
            'title' => 'Add Perso',
            'data' => $data,
            'message' => $message,
            'elements' => $elements,
            'origins' => $origins,
            'unitclasses' => $unitclasses,
        ]);
    }


    public function displayAddElement(): void
    {
        echo $this->templates->render('add-perso-element', [
            'title' => 'Add Element'
        ]);
    }

    public function handleAddPerso(array $data): void
    {
        $this->displayAddPerso($data, "message");
    }

    public function addPerso(array $data): string
    {
        $service = new PersonnageService();
        $ok = $service->addPerso($data);

        (new Logger())->write(
            'CREATE',
            $ok,
            "PERSONNAGE name={$data['name']} element={$data['element']} unitclass={$data['unitclass']} origin=" . ($data['origin'] ?? 'NULL')
        );


        return $ok ? "Personnage ajouté" : "Ajout impossible";
    }


    public function deletePersoAndIndex(string $idPerso = ''): void
    {
        $dao = new PersonnageDAO();
        $rowCount = $dao->deletePerso($idPerso);



        (new Logger())->write('DELETE', $rowCount > 0, "PERSONNAGE id=$idPerso (rc=$rowCount)");

        $message = ($rowCount > 0)
            ? "Suppression réussie (id=$idPerso)"
            : "Suppression impossible (id invalide ou inexistant)";

        $_SESSION['flash'] = [
            'text'  => $message,
            'title' => 'Suppression',
            'color' => ($rowCount > 0) ? Message::COLOR_SUCCESS : Message::COLOR_ERROR
        ];

        header('Location: index.php');
        exit;
    }

    public function displayEditPerso(string $idPerso): void
    {
        $service = new PersonnageService();
        $p = $service->getPersoById($idPerso);

        if ($p === null) {
            $this->displayAddPerso([], "id not found");
            return;
        }

        $data = [
            'idPerso' => $p->getId(),
            'name' => $p->getName(),
            'rarity' => $p->getRarity(),
            'url_img' => $p->getUrlImg(),
            'element' => $p->getElement()?->getId(),
            'unitclass' => $p->getUnitclass()?->getId(),
            'origin' => $p->getOrigin()?->getId(),
        ];

        echo $this->templates->render('add-perso', [
            'title' => 'Edit Perso',
            'data' => $data,
            'message' => null,
            'elements' => (new ElementDAO())->getAll(),
            'unitclasses' => (new UnitClassDAO())->getAll(),
            'origins' => (new OriginDAO())->getAll(),
        ]);
    }

    public function editPersoAndIndex(array $data): void
    {
        $service = new PersonnageService();
        $rc = $service->editPerso($data);

        (new Logger())->write('UPDATE', $rc > 0, "PERSONNAGE id={$data['idPerso']} (rc=$rc)");

        $_SESSION['flash'] = [
            'title' => 'Mise à jour',
            'text'  => ($rc > 0) ? "Mise à jour réussie (id={$data['idPerso']})"
                : "Aucune modification (id={$data['idPerso']})",
            'color' => ($rc > 0) ? Message::COLOR_SUCCESS : Message::COLOR_INFO,
        ];

        header('Location: index.php');
        exit;
    }

    public function addOriginAndIndex(array $data): void
    {
        $o = new \Models\Origin([
            'name' => $data['name'],
            'url_img' => $data['url_img'],
        ]);

        $rc = (new \Models\OriginDAO())->create($o);

        $_SESSION['flash'] = [
            'title' => 'Origin',
            'text'  => ($rc > 0) ? "Origin ajoutée" : "Ajout origin impossible",
            'color' => ($rc > 0) ? \Helpers\Message::COLOR_SUCCESS : \Helpers\Message::COLOR_ERROR
        ];

        header('Location: index.php');
        exit;
    }

    public function addElementAndIndex(array $data): void
    {
        $e = new \Models\Element([
            'name' => $data['name'],
            'url_img' => $data['url_img'],
        ]);

        $rc = (new \Models\ElementDAO())->create($e);

        $_SESSION['flash'] = [
            'title' => 'Element',
            'text'  => ($rc > 0) ? "Element ajouté" : "Ajout element impossible",
            'color' => ($rc > 0) ? \Helpers\Message::COLOR_SUCCESS : \Helpers\Message::COLOR_ERROR
        ];

        header('Location: index.php');
        exit;
    }

    public function addUnitClassAndIndex(array $data): void
    {
        $u = new \Models\UnitClass([
            'name' => $data['name'],
            'url_img' => $data['url_img'],
        ]);

        $rc = (new \Models\UnitClassDAO())->create($u);

        $_SESSION['flash'] = [
            'title' => 'UnitClass',
            'text'  => ($rc > 0) ? "UnitClass ajoutée" : "Ajout unitclass impossible",
            'color' => ($rc > 0) ? \Helpers\Message::COLOR_SUCCESS : \Helpers\Message::COLOR_ERROR
        ];

        header('Location: index.php');
        exit;
    }


    public function displayAddAttribute(array $data = [], ?string $message = null): void
    {
        echo $this->templates->render('add-perso-attribute', [
            'title' => 'Add Attribute',
            'data' => $data,
            'message' => $message
        ]);
    }


}
