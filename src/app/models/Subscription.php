<?php

class Subscription {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getNameSubscriber($studioID, $status) {
        $sql = "SELECT DISTINCT s.subscriber_id, U.username
        FROM subscription s INNER JOIN User U on s.subscriber_id = U.user_id
        WHERE s.studio_id = :studio_id AND s.status = :status ";

        $this->db->query($sql);
        $this->db->bind("studio_id", $studioID);
        $this->db->bind("status", $status);

        return $this->db->resultSet();
    }

    public function getSubscription($studioID, $subscriberID, $status) { 
        $sql = 'SELECT * FROM subscription WHERE studio_id = :studio_id AND subscriber_id = :subscriber_id AND status = :status LIMIT 1';
        
        $this->db->query($sql);
        $this->db->bind("studio_id", $studioID);
        $this->db->bind("subscriber_id", $subscriberID);
        $this->db->bind("status", $status);

        return $this->db->single();
    }

    public function change($studio_id, $subscriber_id, $status) {
        $sql = "INSERT INTO subscription (subscriber_id, studio_id, status)
            VALUES (:subscriber_id, :studio_id, :status)
            ON DUPLICATE KEY UPDATE
            status = VALUES(status)";

        $this->db->query($sql);
        $this->db->bind("subscriber_id", $subscriber_id);
        $this->db->bind("studio_id", $studio_id);
        $this->db->bind("status", $status);

        $this->db->execute();

        if ($this->db->rowCount() < 1) {
            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
        }
    }
}