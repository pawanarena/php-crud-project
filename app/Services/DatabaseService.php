<?php

namespace App\Services;

class DatabaseService
{
    private $dsn;
    private $user;
    private $pass;
    private $options;
    private $pdo;

    public function __construct($dsn, $user, $pass, $options)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->pass = $pass;
        $this->options = $options;
        try {
            $this->pdo = new \PDO($this->dsn, $this->user, $this->pass, $this->options);
       } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
       }
    }

    public function executeQuery($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}