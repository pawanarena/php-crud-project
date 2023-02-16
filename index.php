<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\UserController;
use App\Repository\UserRepository;

require_once __DIR__ . '/app/Config/database.php';

$uri = $_SERVER['REQUEST_URI'];

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