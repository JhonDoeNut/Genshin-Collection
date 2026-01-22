<?php
namespace Models;

class ElementDAO extends BasePDODAO
{
    public function getById(int $id): ?Element
    {
        $sql = "SELECT * FROM ELEMENT WHERE id = :id";
        $row = $this->execRequest($sql, [':id' => $id])->fetch();
        return $row ? new Element($row) : null;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM ELEMENT ORDER BY name";
        $rows = $this->execRequest($sql)->fetchAll();
        return array_map(fn($r) => new Element($r), $rows);
    }

    public function create(Element $e): int
    {
        $sql = "INSERT INTO ELEMENT (name, url_img) VALUES (:name, :url_img)";
        $stmt = $this->execRequest($sql, [
            ':name' => $e->getName(),
            ':url_img' => $e->getUrlImg(),
        ]);
        return $stmt->rowCount();
    }
}
