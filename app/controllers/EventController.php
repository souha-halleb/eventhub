<?php
require_once APP_PATH . '/app/models/Event.php';
class EventController {
    private $eventModel;

    public function __construct(PDO $pdo) {
        $this->eventModel = new Event($pdo);
    }
    public function index(): array {
        return $this->eventModel->all();
    }

    public function show(int $id): ?array {
        return $this->eventModel->find($id);
    }
}
