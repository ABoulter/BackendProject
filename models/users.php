<?php
require_once("base.php");

class Users extends Base
{
    public function register($data)
    {

        $query = $this->db->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $query->execute([$data['email'], $data['username']]);

        if ($query->rowCount() > 0) {
            return false;
        }
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $query = $this->db->prepare("INSERT INTO users (firstName, lastName, username, email, password) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$data['firstName'], $data['lastName'], $data['username'], $data['email'], $password]);

        return $this->db->lastInsertId();
    }

    public function login($username)
    {
        $query = $this->db->prepare("
            SELECT id, username, email, password
            FROM users
            WHERE username = ?
        ");

        $query->execute([
            $username
        ]);

        return $query->fetch();
    }

    public function getUser($userId)
    {

        $query = $this->db->prepare("SELECT * FROM users WHERE id= ?");

        $query->execute([$userId]);

        return $query->fetch();
    }
    function updateUserDetails($userId, $data)
    {
        $query = $this->db->prepare("UPDATE users SET firstName = ?, lastName = ?, email = ? WHERE id = ?");

        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];

        $query->execute([$firstName, $lastName, $email, $userId]);


        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function updatePassword($userId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $query = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $query->execute([$hashedPassword, $userId]);

        return $query->rowCount() > 0;
    }



}