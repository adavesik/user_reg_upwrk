<?php
require_once 'User.php';
class UserController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function registerUser($username, $password)
    {
        $this->userModel->createUser($username, $password);
    }
}