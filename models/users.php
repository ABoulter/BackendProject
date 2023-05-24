<?php
require_once("base.php");

class Users extends Base
{
    private $errorArray = array();

    public function register($data)
    {
        $this->validateData($data, [
            'firstName' => ['validateFirstName'],
            'lastName' => ['validateLastName'],
            'username' => ['validateUsername'],
            'email' => ['validateEmails'],
            'confirmEmail' => [],
            'password' => ['validatePasswords'],
            'confirmPassword' => [],
        ]);

        if (empty($this->errorArray)) {
            return $this->insertUserDetails($data);
        }

        return false;
    }

    public function login($data)
    {
        $query = $this->db->prepare("SELECT username, password FROM users WHERE username = ?");
        $query->execute([$data['username']]);

        if ($query->rowCount() == 1) {
            $row = $query->fetch();
            $hashedPassword = $row['password'];

            if (password_verify($data['password'], $hashedPassword)) {
                return true;
            }
        }

        array_push($this->errorArray, Errors::$loginFailed);
        return false;
    }

    private function insertUserDetails($data)
    {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $query = $this->db->prepare("INSERT INTO users (firstName, lastName, username, email, password) VALUES (?, ?, ?, ?, ?)");
        return $query->execute([$data['firstName'], $data['lastName'], $data['username'], $data['email'], $password]);
    }

    private function validateData($data, $rules)
    {
        foreach ($rules as $field => $validators) {
            foreach ($validators as $validator) {
                if (method_exists($this, $validator)) {
                    $this->$validator($data[$field], $data);
                }
            }
        }
    }

    private function validateFirstName($firstName)
    {
        if (strlen($firstName) < 3 || strlen($firstName) > 65) {
            array_push($this->errorArray, Errors::$firstNameCharacters);
        }
    }

    private function validateLastName($lastName)
    {
        if (strlen($lastName) < 3 || strlen($lastName) > 65) {
            array_push($this->errorArray, Errors::$lastNameCharacters);
        }
    }

    private function validateUsername($username)
    {
        if (strlen($username) < 3 || strlen($username) > 65) {
            array_push($this->errorArray, Errors::$usernameCharacters);
            return;
        }

        $query = $this->db->prepare("SELECT username FROM users WHERE username = ?");
        $query->execute([$username]);


        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Errors::$usernameTaken);
        }
    }

    private function validateEmails($email, $data)
    {
        $confirmEmail = $data['confirmEmail'];

        if ($email != $confirmEmail) {
            array_push($this->errorArray, Errors::$emailsDontMatch);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Errors::$invalidEmail);
        }

        $query = $this->db->prepare("SELECT email FROM users WHERE email = ?");
        $query->execute([$email]);

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Errors::$emailTaken);
        }
    }

    private function validatePasswords($password, $data)
    {
        $confirmPassword = $data['confirmPassword'];

        if ($password != $confirmPassword) {
            array_push($this->errorArray, Errors::$passwordsDontMatch);
            return;
        }

        if (strlen($password) < 6 || strlen($password) > 1000) {
            array_push($this->errorArray, Errors::$passwordLength);
        }
    }

    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }
}
?>