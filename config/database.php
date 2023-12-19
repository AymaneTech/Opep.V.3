<?php
require_once 'config.php';
class Database
{
    public static function connect()
    {
        try {
            $pdo = new PDO (HOST . DBNAME, USERNAME, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "error homie again !!! " . $e->getMessage();
        }
    }
}

