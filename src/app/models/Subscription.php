<?php

class Subscription {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // public function updateData() {
    //     $sql = 'SELECT * FROM movie LIMIT 5';
    //     $this->db->query($sql);

    //     return $this->db->resultSet();
    // }

    public function getSubscription($studioID, $subscriberID, $status) { 
        $sql = 'SELECT * FROM subscription WHERE studio_id = :studio_id AND subscriber_id = :subscriber_id AND status = :status LIMIT 1';
        
        $this->db->query($sql);
        $this->db->bind("studio_id", $studioID);
        $this->db->bind("subscriber_id", $subscriberID);
        $this->db->bind("status", $status);

        return $this->db->single();
    }

    public function insertSubs($studio_id, $subscriber_id, $status) {
        $sql = 'INSERT INTO subscription(studio_id, subscriber_id, status) VALUES (:studio_id, :subscriber_id, :status)';

        $this->db->query($sql);
        $this->db->bind("studio_id", $studio_id); 
        $this->db->bind("subscriber_id", $subscriber_id); 
        $this->db->bind("status", $status);
        
        $this->db->execute();

        $row = $this->db->rowCount();

        if ($row != 1) {
            throw new Exception("Internal Server Error", 500);
        }
    }
}