<?php

class Query
{

    private $connection;
    private $username;
    private $userIpAddr;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function addUserToDb($tableName, $username)
    {
        $query = "INSERT INTO {$tableName}
                SET username=:username, ip_address=:ip_address";
        $stmt = $this->connection->prepare($query);

        $this->getUserIpAddr();
        $this->username = $this->cleanString($username);
        $this->userIpAddr = $this->cleanString($this->userIpAddr);

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":ip_address", $this->userIpAddr);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addNewScore($score)
    {
        $userId = $this->getUserId();

        if ($userId)
        {
            $query = "INSERT INTO scores
                    SET user_id=:user_id, score=:score";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":user_id", $userId);
            $stmt->bindParam(":score", $score);

            if ($stmt->execute()):
                return true;
            else:
                return false;
            endif;
        }

        // unable to get user_id
        return false;
    }

    public function checkIfScoreExistsForUser($score, $username)
    {
        if (!$this->username)
            $this->username = $this->cleanString($username);

        $query = "SELECT scr.user_id, scr.score
                FROM users usr
                INNER JOIN scores scr ON usr.id = scr.user_id
                WHERE usr.username = '{$this->username}'
                LIMIT 1;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['score'];
        } 

        return false;
    }

    public function updateNewScore($score)
    {
        $userId = $this->getUserId();

        if ($userId)
        {
            $query = "UPDATE scores
            SET score = {$score}
            WHERE user_id = {$userId};";

            $stmt = $this->connection->prepare($query);

            if ($stmt->execute()):
                return true;
            else:
                return false;
            endif;
        }

        // unable to get user_id
        return false;
    }

    public function getTopScores($limit)
    {
        $query = "SELECT usr.username, scr.score
                FROM users usr
                INNER JOIN scores scr on usr.id = scr.user_id
                LIMIT {$limit};";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
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

    private function getUserId()
    {
        $query = "SELECT id
                FROM users
                WHERE username = '{$this->username}'
                LIMIT 1;";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['id'];
        } 

        return false;
    }

}
