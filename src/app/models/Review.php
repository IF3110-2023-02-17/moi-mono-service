<?php

class Review {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllReviews()
    {
        $this->db->query("SELECT * FROM review");
        return $this->db->resultSet();
    }

    public function getReviewByReviewID($id)
    {
        $this->db->query("SELECT * FROM review r
        INNER JOIN user_review ur ON ur.review_id = r.review_id
        INNER JOIN movie_review mr ON mr.review_id = r.review_id 
        WHERE r.review_id = :id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function getReviewByID($userID, $page)
    {
        $sql = 'SELECT m.movie_id, m.title, m.img_path, r.comment, r.rate, r.review_id, r.created_at, r.update_at
        FROM movie m INNER JOIN movie_review mr ON m.movie_id = mr.movie_id
        INNER JOIN review r ON mr.review_id = r.review_id
        INNER JOIN user_review ur ON r.review_id = ur.review_id
        WHERE ur.user_id = :user_id ORDER BY r.update_at DESC LIMIT :limit OFFSET :offset';

        $this->db->query($sql);

        $this->db->bind('user_id', $userID);
        $this->db->bind('limit', LIMIT_PAGE);
        $this->db->bind('offset', ($page - 1) * LIMIT_PAGE);

        return $this->db->resultSet();
    }


    public function getReviewAndUserNameByReviewID($id)
    {
        $sql = 'SELECT r.review_id as review_id, r.comment as comment, r.rate as rate, r.created_at as created_at, r.update_at as update_at, u.name as name
        FROM review AS r INNER JOIN user_review AS ur ON r.review_id = ur.review_id
        INNER JOIN user AS u ON ur.user_id = u.user_id
        WHERE r.review_id = :review_id';

        $this->db->query($sql);

        $this->db->bind('review_id', $id);

        return $this->db->single();
    }
    
    public function getAllReview($page)
    {
        $sql = 'SELECT m.movie_id, m.title, m.img_path, r.comment, r.rate, r.review_id, r.created_at, r.update_at, u.username
        FROM movie m INNER JOIN movie_review mr ON m.movie_id = mr.movie_id
        INNER JOIN review r ON mr.review_id = r.review_id
        INNER JOIN user_review ur ON r.review_id = ur.review_id
        INNER JOIN user u ON ur.user_id = u.user_id
        ORDER BY r.update_at DESC LIMIT :limit OFFSET :offset';

        $this->db->query($sql);
        $this->db->bind('limit', LIMIT_PAGE);
        $this->db->bind('offset', ($page - 1) * LIMIT_PAGE);

        return $this->db->resultSet();
    }

    public function getCountPage($userID = 'admin')
    {
        $sql = 'SELECT COUNT(*) count FROM movie m 
        INNER JOIN movie_review mr ON m.movie_id = mr.movie_id
        INNER JOIN review r ON mr.review_id = r.review_id
        INNER JOIN user_review ur ON r.review_id = ur.review_id ';

        if ($userID !== 'admin') {
            $sql .= 'WHERE ur.user_id = :user_id';
        }

        $this->db->query($sql);

        if ($userID !== 'admin') {
            $this->db->bind('user_id', $userID);
        }

        $count = $this->db->single();
        return ceil($count['count']/LIMIT_PAGE);
    }

    public function deleteReviewByID($reviewID) 
    {
        $sql = 'DELETE FROM review r WHERE r.review_id = :review_id';

        $this->db->query($sql);
        $this->db->bind('review_id', $reviewID);
        $this->db->execute();
        
        if ($this->db->rowCount() < 1)
        {
            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
        }
    }  
    
    public function insertReview($rate, $comment, $blur, $movieID, $userID)
    {
        $sql = "INSERT INTO review (rate, comment, created_at, is_blur_name, update_at)
        VALUES ( :rate , :comment , :created_at , :blur , :update_at )";

        $this->db->query($sql);
        $this->db->bind("rate", (int)$rate);
        $this->db->bind("comment", $comment);
        $this->db->bind("blur", (int)$blur);
        $today = date('Y-m-d');
        $this->db->bind("created_at", $today);
        $this->db->bind("update_at", $today);

        $this->db->execute();
        
        $reviewID = $this->db->lastInsertID();
        
        if ($reviewID)
        {
            $sql = "INSERT INTO user_review (review_id, user_id) VALUES ( :review_id, :user_id )";
            
            $this->db->query($sql);
            $this->db->bind("review_id", $reviewID);
            $this->db->bind("user_id", $userID);
            $this->db->execute();

            $sql = "INSERT INTO movie_review (review_id, movie_id) VALUES ( :review_id, :movie_id )";
            
            $this->db->query($sql);
            $this->db->bind("review_id", $reviewID);
            $this->db->bind("movie_id", $movieID);
            $this->db->execute();
        }
        else 
        {
            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
        }

    }

    public function updateReview($rate, $comment, $blur, $reviewID)
    {
        $sql = "UPDATE review r SET r.rate = :rate , r.comment = :comment , r.is_blur_name = :blur , r.update_at = :update_at WHERE r.review_id = :review_id ";
        
        $this->db->query($sql);
        $this->db->bind("rate", (int)$rate);
        $this->db->bind("comment", $comment);
        $this->db->bind("blur", (int)$blur);
        
        $today = date('Y-m-d');
        $this->db->bind("update_at", $today);
        $this->db->bind("review_id", $reviewID);
        
        $this->db->execute();
    }
}