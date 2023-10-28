<?php
// NOT FINAL
class Actor
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllActor()
    {
        $this->db->query("SELECT * FROM actor ORDER BY name");
        return $this->db->resultSet();
    }

    public function getActorByID($id)
    {
        $this->db->query("SELECT * FROM actor WHERE actor_id = :id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function getActorByName($name)
    {
        $this->db->query("SELECT * FROM actor WHERE name = :name");
        $this->db->bind("name", $name);
        return $this->db->single();
    }

    public function getMovieByActorID($id)
    {
        $this->db->query("SELECT * FROM movie_actor WHERE actor_id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultSet();
    }

    public function getMovieByActorIDWithLimit($id, $begin, $total)
    {
        $this->db->query("SELECT * FROM movie_actor WHERE actor_id = :id LIMIT :begin, :total");
        $this->db->bind("id", $id);
        $this->db->bind("begin", $begin);
        $this->db->bind("total", $total);
        return $this->db->resultSet();
    }

    public function getCountMovieByActorID($id)
    {
        $this->db->query("SELECT COUNT(*) count FROM movie_actor WHERE actor_id = :id");
        $this->db->bind("id", $id);
        $count = $this->db->single();
        return $count['count'];
    }


    public function addActor($data, $photo_name)
    {
        // echo 'okey';
        // var_dump($data);
        $query = "INSERT INTO actor(name, birth_date,description, img_path)
                    VALUES
                    (:name, :birth_date, :description, :img_path)";

        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('birth_date', $data['birthdate']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('img_path', $photo_name);

        // echo $query;

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateActor($data, $photo_name = "") {
        $sql = "UPDATE actor a SET ";

        if ($photo_name) {
            $sql .= " a.img_path = :img_path , ";
        }

        $sql .= " a.name = :name, a.birth_date = :birth_date, a.description = :description WHERE a.actor_id = :actor_id";

        $this->db->query($sql);
        $this->db->bind('actor_id', $data['actor_id']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('birth_date', $data['birthdate']);
        $this->db->bind('name', $data['name']);
        if ($photo_name) {
            $this->db->bind('img_path', $photo_name);
        }

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function uploadActorImg() {
        $fileName = $_FILES['imageInput']['name'];
        $fileTmp = $_FILES['imageInput']['tmp_name'];

        $validPictureExtension = ['jpg', 'jpeg', 'png'];
        $pictureExtension = explode('.', $fileName);
        $pictureExtension = strtolower(end($pictureExtension));
        $pictureName = explode('.', $fileName);
        $pictureName = strtolower($pictureName[0]);

        if (!in_array($pictureExtension, $validPictureExtension)) {
            echo "<script>
                    alert('Please upload a picture!');
                </script>";
            return false;
        }

        move_uploaded_file($fileTmp, '../public/media/img/actor/' . $fileName);

        return $pictureName;

    }

    public function getMovieActorbyMovieID ($id)
    {
        $this->db->query("SELECT * FROM movie_actor ma INNER JOIN actor a ON ma.actor_id = a.actor_id WHERE ma.movie_id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultSet();
    }

    public function getPaginate ($page) {
        $sql = "SELECT * FROM actor LIMIT :limit OFFSET :offset";

        $this->db->query($sql);
        $this->db->bind('limit', LIMIT_PAGE);
        $this->db->bind('offset', ($page - 1) * LIMIT_PAGE);
        
        return $this->db->resultSet();
    }

    public function getCountAllPage() {
        $sql = "SELECT COUNT(*) count from actor";
        
        $this->db->query($sql);
        $count = $this->db->single();
        
        return ceil($count['count']/LIMIT_PAGE);
    }
    
    public function deleteActor($actorID) {
        $sql = "DELETE FROM actor a WHERE a.actor_id = :actor_id";

        $this->db->query($sql);
        $this->db->bind("actor_id", $actorID);

        $this->db->execute();

        return $this->db->rowCount();
    }
}