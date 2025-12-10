<?php
require_once APP_PATH . '/app/models/Event.php';

class EventController {
    private $eventModel;

    public function __construct(PDO $pdo) {
        $this->eventModel = new Event($pdo);
    }

    /**
     * Récupère tous les événements
     * @return array
     */
    public function index(): array {
        return $this->eventModel->all();
    }

    /**
     * Récupère un événement spécifique
     * @param int $id
     * @return array|null
     */
    public function show(int $id): ?array {
        return $this->eventModel->find($id);
    }
}
