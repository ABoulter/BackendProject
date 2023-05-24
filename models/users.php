<?php
require_once("base.php");

class Users extends Base
{
    public function register($data)
    {
        return $this->insertUserDetails($data);
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

        return false;
    }

    private function insertUserDetails($data)
    {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $query = $this->db->prepare("INSERT INTO users (firstName, lastName, username, email, password) VALUES (?, ?, ?, ?, ?)");
        return $query->execute([$data['firstName'], $data['lastName'], $data['username'], $data['email'], $password]);
    }
}