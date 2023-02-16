<?php

namespace App\Repository;

use App\Services\DatabaseService;
use App\Models\User;

class UserRepository
{
    private $db;

    public function __construct(DatabaseService $db)
    {
        $this->db = $db;
    }

    public function countUsers(): int
    {
        $countStmt = $this->db->executeQuery('SELECT COUNT(*) FROM users');
        return (int) $countStmt->fetchColumn();
    }

    public function getUsers(int $currentPage, int $perPage): array
    {
        $offset = ($currentPage - 1) * $perPage;
        $stmt = $this->db->executeQuery("SELECT * FROM users ORDER BY id DESC LIMIT $perPage OFFSET $offset");

        $users = [];
        while ($row = $stmt->fetch()) {
            $user = new User($row['id'], $row['name'], $row['email']);
            $users[] = $user;
        }
        return $users;
    }

    public function addUser($name,$email){
        $stmt = $this->db->executeQuery('INSERT INTO users (name, email) VALUES (?, ?)', [$name, $email]);
        $id = $this->db->getLastInsertId();
        header('Location: /');
        exit;
    }
}