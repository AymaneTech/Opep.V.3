<?php
//include '../models/UserModel.php';

class LoginController
{
   private $UserModel;

    public function __construct($email, $password)
    {
        $this->UserModel = new User();
        $this->UserModel->__set("email",  $email);
        $this->UserModel->__set("password",  $password);
    }

    public function LoginUser()
    {
        if (!$this->emptyInput()) {
            header('Location: ../public/authentication/login.php?error=empty Input');
            exit();
        }
        if (!$this->invalidEmail()) {
            header('Location: ../public/authentication/login.php?error=invalid Email');
            exit();
        }
        return $this->UserModel->logIn($this->UserModel->__get("email"), $this->UserModel->__get("password"));
    }
    public function emptyInput()
    {
        if (empty($this->UserModel->__get("email")) || empty($this->UserModel->__get("password"))) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    public function invalidEmail()
    {
        if (!filter_var($this->UserModel->__get("email"), FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}


