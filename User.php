<?php

class User
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param $username
     * @param $password
     * @return void
     */
    public function createUser($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $hashedPassword);
        $statement->execute();
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function verifyUser($username, $password):bool
    {
        $query = "SELECT password FROM users WHERE username = :username";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify($password, $row['password'])) {
            return true;
        }

        return false;
    }
}