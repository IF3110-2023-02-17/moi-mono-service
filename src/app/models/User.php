<?php

// NOTE : UBAH JADI HASH PASSWORD
class User {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($username, $password) {
        $sql = 'SELECT user_id, password_h FROM user WHERE username = :username';

        $this->db->query($sql);
        $this->db->bind('username', $username);

        $user_from_db = $this->db->single();

        if ($user_from_db && password_verify($password, $user_from_db['password_h'])) {
            return $user_from_db['user_id'];
        } else {
            throw new Exception();
        }
    }

    public function register($email, $username, $password) {
        $sql = "INSERT INTO user(username, email, password_h, role)
        VALUES (:username, :email, :password, 'user')";

        $this->db->query($sql);
        // TODO : username harus unik
        $this->db->bind('username', $username);
        $this->db->bind('email', $email);
        $this->db->bind('password', password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]));
        // $this->db->bind('password', $password);

        $this->db->execute();
        // TODO : 
        // validasi row count (?)
    }

    public function getUserByID($id) {
        $sql = 'SELECT * FROM user WHERE user_id = :id';

        $this->db->query($sql);
        $this->db->bind('id', $id);

        return $this->db->single();
    }

    public function getAllUsers($page) {
        $sql = "SELECT * FROM user LIMIT :limit OFFSET :offset";

        $this->db->query($sql);
        $this->db->bind('limit', LIMIT_PAGE);
        $this->db->bind('offset', ($page - 1) * LIMIT_PAGE);
        
        return $this->db->resultSet();
    }
}