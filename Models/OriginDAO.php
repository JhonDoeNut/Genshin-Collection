<?php
namespace Models;

class OriginDAO extends BasePDODAO
{
    public function getById(int $id): ?Origin
    {
        $sql = "SELECT * FROM ORIGIN WHERE id = :id";
        $row = $this->execRequest($sql, [':id' => $id])->fetch();
        return $row ? new Origin($row) : null;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM ORIGIN ORDER BY name";
        $rows = $this->execRequest($sql)->fetchAll();
        return array_map(fn($r) => new Origin($r), $rows);
    }

    public function create(Origin $o): int
    {
        $sql = "INSERT INTO ORIGIN (name, url_img) VALUES (:name, :url_img)";
        $stmt = $this->execRequest($sql, [
            ':name' => $o->getName(),
            ':url_img' => $o->getUrlImg(),
        ]);
        return $stmt->rowCount();
    }
}
