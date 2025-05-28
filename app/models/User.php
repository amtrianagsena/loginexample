<?php
require_once __DIR__ . '/../core/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function findOrCreate($google_id, $name, $email, $picture) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE google_id = ?");
        $stmt->execute([$google_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $stmt = $this->db->prepare("INSERT INTO users (google_id, name, email, picture) VALUES (?, ?, ?, ?)");
            $stmt->execute([$google_id, $name, $email, $picture]);
            return $this->findByGoogleId($google_id);
        }

        return $user;
    }

    public function findByGoogleId($google_id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE google_id = ?");
        $stmt->execute([$google_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>