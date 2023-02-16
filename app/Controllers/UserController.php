<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\DatabaseService;
use App\Repository\UserRepository;
use App\Validation\UserValidation;

class UserController
{
    private $db;
    private $userRepository;
    public function __construct(DatabaseService $db,UserRepository $userRepository)
    {
        $this->db = $db;
        $this->userRepository = $userRepository;
    }
    public function listUsers($currentPage = 1, $perPage = 10)
    {
        $totalUsers = $this->userRepository->countUsers();
        $totalPages = ceil($totalUsers / $perPage);
        if ($currentPage < 1 || $currentPage > $totalPages) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }
        $users = $this->userRepository->getUsers($currentPage, $perPage);
        include(__DIR__ . '/../Views/list_users.php');
    }

    public function addUser()
    {
        $nameError = $emailError = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];

            $nameError = UserValidation::validateName($name);
            $emailError = UserValidation::validateEmail($email);

            if (!$nameError && !$emailError) {
                $this->userRepository->addUser($name,$email);
            }
        }
        include(__DIR__ . '/../Views/add_user.php');
    }

    public function editUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $nameError = UserValidation::validateName($name);
            $emailError = UserValidation::validateEmail($email);
            $stmt = $this->db->executeQuery('UPDATE users SET name = ?, email = ? WHERE id = ?', [$name, $email, $id]);
            header('Location: /');
            exit;
        } else {
            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            $id = $uri_segments[2];
            $stmt = $this->db->executeQuery('SELECT * FROM users WHERE id = ?', [$id]);
            $row = $stmt->fetch();
            $user = new User($row['id'], $row['name'], $row['email']);
            include(__DIR__ . '/../Views/edit_user.php');
        }
    }

    public function deleteUser()
    {
        $id = $_POST['id'];
        $stmt = $this->db->executeQuery('DELETE FROM users WHERE id = ?', [$id]);
        header('Location: /');
        exit;
    }
}