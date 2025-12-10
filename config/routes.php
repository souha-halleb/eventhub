<?php
return [
    'list'    => '?page=list',
    'details' => '?page=details&id=',
    'home'    => '?page=home',
];
require APP_PATH . '/config/database.php';
require_once APP_PATH . '/app/controllers/EventController.php';
$page = $_GET['page'] ?? 'list';
$id   = isset($_GET['id']) ? (int)$_GET['id'] : null;
$controller = new EventController($pdo);
include APP_PATH . '/app/views/partials/header.php';
switch ($page) {
    case 'details':
        if ($id) {
            $event = $controller->show($id); 
            include APP_PATH . '/app/views/events/details.php';
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
