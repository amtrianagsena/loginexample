<?php
class Database {
    private static $pdo;

    public static function connect() {
        if (!self::$pdo) {
            $dsn = "mysql:host=localhost;dbname=mipy;charset=utf8mb4";
            self::$pdo = new PDO($dsn, 'root', '');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}

?>