<?php

namespace Models;

class PersonnageDAO extends BasePDODAO
{
    /**
     * @return Personnage[]
     */
    public function getAll(): array
    {
        $sql = "SELECT id, name, element, unitclass, rarity, origin, url_img FROM PERSONNAGE";
        $stmt = $this->execRequest($sql);
        $rows = $stmt->fetchAll();

        $list = [];
        foreach ($rows as $row) {
            $list[] = $this->mapRowToPersonnage($row);
        }
        return $list;
    }

    public function getByID(string $idPersonnage): ?Personnage
    {
        $sql = "SELECT id, name, element, unitclass, rarity, origin, url_img
                FROM PERSONNAGE
                WHERE id = ?";
        $stmt = $this->execRequest($sql, [$idPersonnage]);
        $row = $stmt->fetch();

        if ($row === false) return null;
        return $this->mapRowToPersonnage($row);
    }

    private function mapRowToPersonnage(array $row): Personnage
    {
        $p = new Personnage();
        $p->setId($row['id']);
        $p->setName($row['name']);
        $p->setElement($row['element']);
        $p->setUnitclass($row['unitclass']);
        $p->setRarity((int)$row['rarity']);
        $p->setOrigin($row['origin'] ?? null);
        $p->setUrlImg($row['url_img']);
        return $p;
    }

    public function createPersonnage(Personnage $p): bool
    {
        $sql = "INSERT INTO PERSONNAGE (id, name, element, unitclass, origin, rarity, url_img)
                VALUES (:id, :name, :element, :unitclass, :origin, :rarity, :url_img)";

        $params = [
            ':id' => $p->getId(),
            ':name' => $p->getName(),
            ':element' => $p->getElement(),
            ':unitclass' => $p->getUnitclass(),
            ':origin' => $p->getOrigin(),
            ':rarity' => $p->getRarity(),
            ':url_img' => $p->getUrlImg(),
        ];

        $this->execRequest($sql, $params);
        return true;
    }

    public function deletePerso(string $idPerso = ''): int
    {
        if ($idPerso === '') {
            return 0;
        }

        $sql = "DELETE FROM PERSONNAGE WHERE id = :id";
        $stmt = $this->execRequest($sql, [':id' => $idPerso]);

        return $stmt->rowCount(); // >0 si suppression OK
    }

    public function updatePerso(Personnage $p): int
    {
        $sql = "UPDATE PERSONNAGE
            SET name = :name,
                element = :element,
                unitclass = :unitclass,
                origin = :origin,
                rarity = :rarity,
                url_img = :url_img
            WHERE id = :id";

        $params = [
            ':id' => $p->getId(),
            ':name' => $p->getName(),
            ':element' => $p->getElement(),
            ':unitclass' => $p->getUnitclass(),
            ':origin' => $p->getOrigin(),
            ':rarity' => $p->getRarity(),
            ':url_img' => $p->getUrlImg(),
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt->rowCount(); // > 0 si update OK (ou 0 si rien n'a changé)
    }

    public function getAllRaw(): array
    {
        $sql = "SELECT * FROM PERSONNAGE ORDER BY name";
        return $this->execRequest($sql)->fetchAll();
    }

    public function getByIdRaw(string $id): ?array
    {
        $sql = "SELECT * FROM PERSONNAGE WHERE id = :id";
        $row = $this->execRequest($sql, [':id'=>$id])->fetch();
        return $row ?: null;
    }

    public function createRaw(array $d): bool
    {
        $sql = "INSERT INTO PERSONNAGE (id, name, element, unitclass, origin, rarity, url_img)
            VALUES (:id, :name, :element, :unitclass, :origin, :rarity, :url_img)";

        $stmt = $this->execRequest($sql, [
            ':id' => $d['id'],
            ':name' => $d['name'],
            ':element' => $d['element'],
            ':unitclass' => $d['unitclass'],
            ':origin' => $d['origin'],
            ':rarity' => $d['rarity'],
            ':url_img' => $d['url_img'],
        ]);

        return $stmt->rowCount() > 0;
    }

    public function updateRaw(array $d): int
    {
        $sql = "UPDATE PERSONNAGE
            SET name = :name,
                element = :element,
                unitclass = :unitclass,
                origin = :origin,
                rarity = :rarity,
                url_img = :url_img
            WHERE id = :id";

        $stmt = $this->execRequest($sql, [
            ':id' => $d['id'],
            ':name' => $d['name'],
            ':element' => $d['element'],
            ':unitclass' => $d['unitclass'],
            ':origin' => $d['origin'],
            ':rarity' => $d['rarity'],
            ':url_img' => $d['url_img'],
        ]);

        return $stmt->rowCount();
    }


}