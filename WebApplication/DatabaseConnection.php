<?php

class DatabaseConnection{

    private static $instance = null;
    private $connection = null;
    
    
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'connect_me';

    private function __construct(){
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);      
    }

    public static function getInstance(){
        if(!self::$instance) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }

}
