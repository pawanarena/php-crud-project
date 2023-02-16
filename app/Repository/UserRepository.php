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

    public function addUser($name,$email)
    {
        $stmt = $this->db->executeQuery('INSERT INTO users (name, email) VALUES (?, ?)', [$name, $email]);
        $id = $this->db->getLastInsertId();
        header('Location: /');
        exit;
    }

    public function getUserByID()
    {
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);
        $id = $uri_segments[2];
        $stmt = $this->db->executeQuery('SELECT * FROM users WHERE id = ?', [$id]);
        $row = $stmt->fetch();
        $user = new User($row['id'], $row['name'], $row['email']);
        return $user;
    }

    public function updateUser($id,$name,$email)
    {
        $stmt = $this->db->executeQuery('UPDATE users SET name = ?, email = ? WHERE id = ?', [$name, $email, $id]);
        header('Location: /');
        exit;
    }

    public function deleteUser()
    {
        $id = $_POST['id'];
        $stmt = $this->db->executeQuery('DELETE FROM users WHERE id = ?', [$id]);
        header('Location: /');
        exit;
    }
}