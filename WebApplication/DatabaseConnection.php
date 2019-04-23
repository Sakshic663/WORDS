<?php

class DatabaseConnection{

    private static $instance = null;
    private $connection;
    //mysql://b23b6b38e20261:52fc0339@us-cdbr-iron-east-02.cleardb.net/heroku_57e4adbd95c2fd5?reconnect=true
    private $host = 'us-cdbr-iron-east-02.cleardb.net';
    private $username = 'b23b6b38e20261';
    private $password = '52fc0339';
    private $database = 'heroku_57e4adbd95c2fd5';

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
