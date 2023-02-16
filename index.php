<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\UserController;
use App\Services\DatabaseService;
use App\Repository\UserRepository;

// $db = new DatabaseService("localhost", "pollution_measurement", "root", "root");
$host = 'localhost';
$db   = 'pollution_measurement';
$user = 'root';
$pass = 'root';
$port = "3306";
$charset = 'utf8mb4';

$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
$db = new DatabaseService($dsn, $user, $pass, $options);

$uri = $_SERVER['REQUEST_URI'];
// print_r($_SERVER['REQUEST_URI']);

if ($uri == '/') {
    $controller = new UserController($db, new UserRepository($db));
    $controller->listUsers();
}elseif ($uri == '/add_user') { 
    $controller = new UserController($db, new UserRepository($db));
    $controller->addUser();
}elseif (preg_match('/^\/edit_user\/(\d+)\/?$/', $uri, $matches)) { 
    $id = $matches[1];
    $controller = new UserController($db, new UserRepository($db));
    $controller->editUser($id,);
} elseif ($uri == '/delete_user') {
    $controller = new UserController($db, new UserRepository($db));
    $controller->deleteUser();
} elseif (preg_match('/^\/list_users\/(\d+)$/', $uri, $matches)) {
    $currentPage = $matches[1];
    $controller = new UserController($db, new UserRepository($db));
    $controller->listUsers($currentPage);
}
else {
    http_response_code(404);
    echo '404 Not Founds';
}