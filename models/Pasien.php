<?php
class Pasien {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll($limit = 10, $offset = 0) {
        $stmt = $this->pdo->prepare("SELECT * FROM pasien ORDER BY created_at DESC LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function count() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM pasien");
        return $stmt->fetchColumn();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pasien WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
