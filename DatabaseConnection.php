<?php

class DatabaseConnection{

    private static $instance = null;
    private $connection;
    
    //mysql://bf0a5ecdcdb511:ead6c1b0@us-cdbr-iron-east-02.cleardb.net/heroku_cfe18ac9d36bac2?reconnect=true
    private $host = 'us-cdbr-iron-east-02.cleardb.net';
    private $username = 'bf0a5ecdcdb511';
    private $password = 'ead6c1b0';
    private $database = 'heroku_cfe18ac9d36bac2';

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
