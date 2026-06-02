<?php
session_start();
require_once 'config/database.php';
require_once 'helpers/functions.php';
require_once 'middleware/auth.php';

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = filter_var($url, FILTER_SANITIZE_URL);
$parts = explode('/', $url);

$page = !empty($parts[0]) ? $parts[0] : 'login';
$action = $parts[1] ?? 'index';
$id = $parts[2] ?? null;

// Route ke controller yang sesuai
switch ($page) {
    case 'login':
    case 'logout':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController($pdo);
        if ($page === 'login') $controller->login();
        if ($page === 'logout') $controller->logout();
        break;
    case 'admin':
        requireLogin('admin');
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($pdo);
        if (method_exists($controller, $action)) {
            $controller->$action($id);
        } else {
            echo "404 Not Found";
        }
        break;
    case 'dokter':
        requireLogin('dokter');
        require_once 'controllers/DokterController.php';
        $controller = new DokterController($pdo);
        if (method_exists($controller, $action)) {
            $controller->$action($id);
        } else {
            echo "404 Not Found";
        }
        break;
    case 'owner':
        requireLogin('owner');
        require_once 'controllers/OwnerController.php';
        $controller = new OwnerController($pdo);
        if (method_exists($controller, $action)) {
            $controller->$action($id);
        } else {
            echo "404 Not Found";
        }
        break;
    default:
        header('Location: /clinicv2/login');
        break;
}
