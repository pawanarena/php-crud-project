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
            $nameError = UserValidation::validateName($name);
            $emailError = UserValidation::validateEmail($email);
            $this->userRepository->updateUser();
        } else {
            $user=$this->userRepository->getUserByID();
            include(__DIR__ . '/../Views/edit_user.php');
        }
    }

    public function deleteUser()
    {
        $this->userRepository->deleteUser();
    }
}