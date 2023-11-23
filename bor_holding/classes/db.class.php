<?php
    require_once(__DIR__ . "/../config.php");
    class Database {

        public $db = NULL;

        public function __construct() {

            try {
                $this->db = new PDO("mysql:host=" . SERVERNAME . ":" . PORT . ";dbname=" . DBNAME . ";charset=utf8", USERNAME, PASSWORD);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                exit();
            }

        }

        public function __destruct() {
            $this->db = NULL;
        }

    }
?>