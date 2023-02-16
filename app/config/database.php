<?php
use App\Services\DatabaseService;

$host = 'localhost';
$db   = 'testDB';
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