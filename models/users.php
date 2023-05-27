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




}