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

    /**
     * @param $length
     * @return string
     */
    private function generateRandomPassword($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomPassword = '';
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomPassword;
    }

    /**
     * @param $username
     * @return void
     */
    public function resetPassword($username)
    {
        // Generate a new random password
        $newPassword = $this->generateRandomPassword();

        // Update the user's password in the database
        $this->userModel->updatePassword($username, $newPassword);

        // Send the new password to the user via email or any other method
        $this->sendPasswordResetEmail($username, $newPassword);
    }

    private function sendPasswordResetEmail($username, $newPassword)
    {
        // Send the password reset email to the user
        // You can implement your own email sending logic here
        $subject = 'Password Reset';
        $message = "Your new password is: $newPassword";
        $headers = 'From: your-email@example.com';

        // Useing the built-in mail() function to send the email
        mail($username, $subject, $message, $headers);
    }
}