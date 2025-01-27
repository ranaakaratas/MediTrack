<?php
class Database
{
    private static $instance = null; // Holds the single instance of the class
    private $connection; // Holds the database connection
    private $host = "localhost"; // Database host
    private $username = "root"; // Database username
    private $password = ""; // Database password
    private $database = "k2109743"; // Database name

    // Private constructor to prevent creating new instances from outside
    private function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Prevent cloning of the instance
    public function __clone() {}

    // Prevent unserializing of the instance
    public function __wakeup() {}

    // Public static method to get the single instance of the class
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Method to get the PDO connection
    public function getConnection()
    {
        return $this->connection;
    }
}