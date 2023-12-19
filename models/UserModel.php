<?php

class User
{
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $userType;
    public function __set($property, $value)
    {
        $this->$property = $value;
    }
    public function __get($property)
    {
        return $this->$property;
    }
    public function signup($firstName, $lastName, $email, $password, $userType)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->userType = $userType;

        if (!$this->checkAccountExisting($email)) {
            header('Location: ../public/authentication/signup.php?error=account already exists');
            exit();
        }
        $stmt = Connection->prepare("INSERT INTO users (firstName, lastName, email, password, userType) VALUES (:firstName, :lastName, :email, :password, :userType)");
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':userType', $userType);

        $stmt->execute();
        return Connection->lastInsertId();
    }

    public function checkAccountExisting($email)
    {
        $stmt = Connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    public function logIn($email, $password)
    {
        $stmt = Connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Passwords match, user is authenticated
            return $user;
        } else {
            // Invalid login credentials
            return false;
        }
    }
    public function showAllUsers()
    {
        $stmt = Connection->query("SELECT * FROM users;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function showAdmins()
    {
        $stmt = Connection->prepare("SELECT * FROM users where userType = 1;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function showClients()
    {
        $stmt = Connection->prepare("SELECT * FROM users where userType = 2;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function statistics()
    {
        $adminCount = Connection->prepare("select count(userId) as t from users where userType = 1;");
        $adminCount->execute();
        $adminResult = $adminCount->fetch(PDO::FETCH_ASSOC);

        $clientCount = Connection->prepare("select count(userId) as t from users where userType = 2;");
        $clientCount->execute();
        $clientResult = $clientCount->fetch(PDO::FETCH_ASSOC);

        $allCount = Connection->prepare("select count(userId) as t from users;");
        $allCount->execute();
        $allResult = $allCount->fetch(PDO::FETCH_ASSOC);
        return [
            "adminResult" => $adminResult["t"],
            "clientResult" => $clientResult["t"],
            "allResult" => $allResult["t"]
        ];
    }
}
