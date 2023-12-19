<?php
require_once '../models/UserModel.php';
class SignupController
{
    private $UserModel;

    public function __construct($firstName, $lastName, $email, $password, $passwordConfirm, $userType)
    {
        $this->UserModel = new User();
        $this->UserModel->__set("firstName", $firstName);
        $this->UserModel->__set("firstName", $firstName);
        $this->UserModel->__set("lastName", $lastName);
        $this->UserModel->__set("email", $email);
        $this->UserModel->__set("password", $password);
        $this->UserModel->__set("passwordConfirm", $passwordConfirm);
        $this->UserModel->__set("userType", $userType);
    }

    public function signupUser()
    {
        if (!$this->emptyInput()) {
            header('Location: ../public/authentication/signup.php?error=empty Input');
            exit();
        }
        if (!$this->invalidName()) {
            header('Location: ../public/authentication/signup.php?error=invalid Name');
            exit();
        }
        if (!$this->invalidEmail()) {
            header('Location: ../public/authentication/signup.php?error=invalid Email');
            exit();
        }
        if (!$this->pwdMatch()) {
            header('Location: ../public/authentication/signup.php?error=password Mismatch');
            exit();
        }
        $hashedPassword = password_hash($this->UserModel->__get("password"), PASSWORD_DEFAULT);
        return $this->UserModel->signup($this->UserModel->__get("firstName"), $this->UserModel->__get("lastName"), $this->UserModel->__get("email"), $hashedPassword, $this->UserModel->__get("userType"));

    }
    public function emptyInput()
    {
        if (empty($this->UserModel->__get("firstName")) || empty($this->UserModel->__get("lastName")) || empty($this->UserModel->__get("email")) || empty($this->UserModel->__get("passwordConfirm"))) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function invalidName()
    {
        if (!preg_match('/^[a-zA-Z0-9]*$/', $this->UserModel->__get("firstName")) || !preg_match('/^[a-zA-Z0-9]*$/', $this->UserModel->__get("lastName"))) {
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
    public function pwdMatch()
    {
        if ($this->UserModel->__get("password") !== $this->UserModel->__get("passwordConfirm")) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}


