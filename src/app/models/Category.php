<?php

class Category {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllCategory() {
        $sql = 'SELECT DISTINCT category_id, name FROM category';
        $this->db->query($sql);

        return $this->db->resultSet();
    }

    public function getCategoryByMovieID($id) {
        $sql = "SELECT DISTINCT c.category_id, c.name 
        FROM category c INNER JOIN movie_category mc ON c.category_id = mc.category_id
        WHERE mc.movie_id = :id";

        $this->db->query($sql);
        $this->db->bind("id", $id);

        return $this->db->resultSet();
    }
}