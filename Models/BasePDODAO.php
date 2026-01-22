<?php
namespace Models;

use PDO;
use Config\Config;

abstract class BasePDODAO
{
    private ?PDO $db = null;

    protected function getDB(): PDO
    {
        if ($this->db === null) {
            $this->db = new PDO(
                Config::get('DB.dsn'),
                Config::get('DB.user'),
                Config::get('DB.pass'),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }
        return $this->db;
    }

    protected function execRequest(string $sql, ?array $params = null)
    {
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute($params ?? []);
        return $stmt;
    }
}

