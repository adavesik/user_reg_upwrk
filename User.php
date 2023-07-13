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

        // Check if successful
        if($hashedPassword == false)
        {
            throw new Exception('Password hashing failed. So sorry.');
        }

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

    /**
     * @throws Exception
     */
    public function updatePassword($username, string $newPassword)
    {
        // Generate a hashed password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Check if the password hashing was successful
        if (!$hashedPassword) {
            throw new Exception('Password hashing failed.');
        }

        // Update the user's password in the database
        $query = "UPDATE users SET password = :password WHERE username = :username";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $hashedPassword);
        $statement->execute();
    }
}