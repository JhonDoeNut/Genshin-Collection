<?php
namespace Models;

class UnitClassDAO extends BasePDODAO
{
    public function getById(int $id): ?UnitClass
    {
        $sql = "SELECT * FROM UNITCLASS WHERE id = :id";
        $row = $this->execRequest($sql, [':id' => $id])->fetch();
        return $row ? new UnitClass($row) : null;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM UNITCLASS ORDER BY name";
        $rows = $this->execRequest($sql)->fetchAll();
        return array_map(fn($r) => new UnitClass($r), $rows);
    }

    public function create(UnitClass $u): int
    {
        $sql = "INSERT INTO UNITCLASS (name, url_img) VALUES (:name, :url_img)";
        $stmt = $this->execRequest($sql, [
            ':name' => $u->getName(),
            ':url_img' => $u->getUrlImg(),
        ]);
        return $stmt->rowCount();
    }
}
