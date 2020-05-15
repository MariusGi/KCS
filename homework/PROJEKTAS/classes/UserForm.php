<?php

class UserForm {

    private $connection;
    private $tableName = 'users';
    private $username;
    private $userIpAddr;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function validate($username)
    {
        $this->username = $this->cleanString($username);

        // empty username after cleanString method
        if (!$this->username) return false;

        $this->getUserIpAddr();
        $this->userIpAddr = $this->cleanString($this->userIpAddr);

        // unable to detect user ip
        if (!$this->userIpAddr) return false;

        return true;
    }

    public function returnQueryDataIfExistsInDb()
    {
        $stmt = $this->getUserOrIpInDb();

        // there are no ip or username matches in db
        // new username can be created
        if ($stmt->rowCount() === 0) return false;

        $queryResult = $stmt->fetch(PDO::FETCH_ASSOC);

        return $queryResult;
    }

    public function checkIfUsernameLinkedToIp(array $queryData)
    {
        return ($queryData['ip_address'] === $this->userIpAddr)
            ? true
            : false;
    }

    private function cleanString($string)
    {
        $string = htmlspecialchars($string);
        $string = trim($string);

        return $string;
    }

    private function getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])):
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else:
            $ip = $_SERVER['REMOTE_ADDR'];
        endif;

        $this->userIpAddr = $ip;
    }

    private function getUserOrIpInDb()
    {
        $query = "SELECT username, ip_address
                FROM $this->tableName
                WHERE username = '{$this->username}'
                OR ip_address = '{$this->userIpAddr}'
                LIMIT 1;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}
