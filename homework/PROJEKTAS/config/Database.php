<?php

class Database
{

    private $host     = 'localhost';
    private $database = 'math_games';
    private $userName = 'root';
    private $password = '';
    public  $connection;

    public function getConnection()
    {
        $this->connection = null;

        try 
        {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->userName, $this->password );
        }
        catch(PDOException $e) 
        {
            echo 'Connection error: ' . $e->getMessage();
        }

        return $this->connection;
    }
    
}