<?php
class Event {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM events ORDER BY event_date ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM events WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
