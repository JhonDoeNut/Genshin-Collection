<?php
namespace Models;

class PersonnageService
{
    private PersonnageDAO $persoDAO;
    private ElementDAO $elementDAO;
    private OriginDAO $originDAO;
    private UnitClassDAO $unitclassDAO;

    public function __construct()
    {
        $this->persoDAO = new PersonnageDAO();
        $this->elementDAO = new ElementDAO();
        $this->originDAO = new OriginDAO();
        $this->unitclassDAO = new UnitClassDAO();
    }

    public function getAllPerso(): array
    {
        $rows = $this->persoDAO->getAllRaw();
        $list = [];

        foreach ($rows as $r) {
            $p = $this->buildPersonnageFromRow($r);
            $list[] = $p;
        }

        return $list;
    }

    public function getPersoById(string $id): ?Personnage
    {
        $row = $this->persoDAO->getByIdRaw($id);
        return $row ? $this->buildPersonnageFromRow($row) : null;
    }

    private function buildPersonnageFromRow(array $r): Personnage
    {
        $p = new Personnage();

        $p->setId($r['id']);
        $p->setName($r['name']);
        $p->setRarity((int)$r['rarity']);
        $p->setUrlImg($r['url_img']);


        $p->setElement($this->elementDAO->getById((int)$r['element']));
        $p->setUnitclass($this->unitclassDAO->getById((int)$r['unitclass']));

        $originId = $r['origin'];
        $p->setOrigin($originId !== null ? $this->originDAO->getById((int)$originId) : null);

        return $p;
    }

    public function addPerso(array $data): bool
    {
        $id = uniqid();

        // INSERT en base avec les IDs (int)
        $sqlData = [
            'id' => $id,
            'name' => $data['name'],
            'element' => (int)$data['element'],
            'unitclass' => (int)$data['unitclass'],
            'origin' => $data['origin'] === null ? null : (int)$data['origin'],
            'rarity' => (int)$data['rarity'],
            'url_img' => $data['url_img'],
        ];

        return $this->persoDAO->createRaw($sqlData);
    }

    public function editPerso(array $data): int
    {
        return $this->persoDAO->updateRaw([
            'id' => $data['idPerso'],
            'name' => $data['name'],
            'element' => (int)$data['element'],
            'unitclass' => (int)$data['unitclass'],
            'origin' => $data['origin'] === null ? null : (int)$data['origin'],
            'rarity' => (int)$data['rarity'],
            'url_img' => $data['url_img'],
        ]);
    }
}
