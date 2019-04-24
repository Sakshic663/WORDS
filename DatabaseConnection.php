<?php

class DatabaseConnection{

    private static $instance = null;
    private $connection = null;
    
    //mysql://b8a2f772c3256e:764d8db6@us-cdbr-iron-east-02.cleardb.net/heroku_ebead2fda490cab?reconnect=true
    private $host = 'us-cdbr-iron-east-02.cleardb.net';
    private $username = 'b8a2f772c3256e';
    private $password = '764d8db6';
    private $database = 'heroku_ebead2fda490cab';

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
