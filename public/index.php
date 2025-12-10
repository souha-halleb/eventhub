<?php
define('APP_PATH', dirname(__DIR__));
ini_set('display_errors', 1);
error_reporting(E_ALL);
require APP_PATH . '/config/database.php';
require APP_PATH . '/app/controllers/EventController.php';
$routes = require APP_PATH . '/config/routes.php';
$page = $_GET['page'] ?? 'list';
$id   = isset($_GET['id']) ? (int)$_GET['id'] : null;
$controller = new EventController($pdo);
include APP_PATH . '/app/views/partials/header.php';
switch ($page) {

    case 'details':
        if ($id) {
            $event = $controller->show($id);
            if (!$event) {
                echo "<p>Event not found.</p>";
            } else {
                $backUrl = $routes['list'];
                include APP_PATH . '/app/views/events/details.php';
            }
        } else {
            $events = $controller->index();
            include APP_PATH . '/app/views/events/list.php';
        }
        break;

    case 'list':
    default:
        $events = $controller->index();
        include APP_PATH . '/app/views/events/list.php';
        break;
}
include APP_PATH . '/app/views/partials/footer.php';
