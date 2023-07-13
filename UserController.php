<?php
require_once 'User.php';
class UserController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @param $username
     * @param $password
     * @return void
     * @throws Exception
     */
    public function registerUser($username, $password)
    {
        $this->userModel->createUser($username, $password);
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function loginUser($username, $password)
    {
        if ($this->userModel->verifyUser($username, $password)) {
            return true;
        }

        return false;
    }
}