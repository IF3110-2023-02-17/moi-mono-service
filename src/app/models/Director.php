<?php

class Director {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDirectors()
    {
        $this->db->query("SELECT * FROM director ORDER BY name");
        return $this->db->resultSet();
    }

    public function getDirectorByID($id)
    {
        $this->db->query("SELECT * FROM director WHERE director_id = :id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function getDirectorByName($name)
    {
        $this->db->query("SELECT * FROM director WHERE name = :name");
        $this->db->bind("name", $name);
        return $this->db->single();
    }

    public function getMovieByDirectorID($id)
    {
        $this->db->query("SELECT * FROM movie_director WHERE director_id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultSet();
    }

    public function getMovieByDirectorIDWithLimit($id, $begin, $total)
    {
        $this->db->query("SELECT * FROM movie_director WHERE director_id = :id LIMIT :begin, :total");
        $this->db->bind("id", $id);
        $this->db->bind("begin", $begin);
        $this->db->bind("total", $total);
        return $this->db->resultSet();
    }

    public function getCountMovieByDirectorID($id)
    {
        $this->db->query("SELECT COUNT(*) count FROM movie_director WHERE director_id = :id");
        $this->db->bind("id", $id);
        $count = $this->db->single();
        return $count['count'];
    }

    public function getPaginate($page = 1){
        $sql = "SELECT * FROM director LIMIT :limit OFFSET :offset";

        $this->db->query($sql);
        $this->db->bind('limit', LIMIT_PAGE);
        $this->db->bind('offset', ($page - 1) * LIMIT_PAGE);
        
        return $this->db->resultSet();
    }

    public function getCountAllPage() {
        $sql = "SELECT COUNT(*) count from director";
        
        $this->db->query($sql);
        $count = $this->db->single();
        
        return ceil($count['count']/LIMIT_PAGE);
    }

    public function addDirector($data, $photo_name)
    {
        // echo 'okey';
        // var_dump($data);
        $query = "INSERT INTO director(name, birth_date,description, img_path)
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

    public function updateDirector($data, $photo_name = "") {
        $sql = "UPDATE director d SET ";

        if ($photo_name) {
            $sql .= " d.img_path = :img_path , ";
        }

        $sql .= " d.name = :name, d.birth_date = :birth_date, d.description = :description WHERE d.director_id = :director_id";

        $this->db->query($sql);
        $this->db->bind('director_id', $data['director_id']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('birth_date', $data['birthdate']);
        $this->db->bind('name', $data['name']);
        if ($photo_name) {
            $this->db->bind('img_path', $photo_name);
        }

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function uploadDirectorImg() {
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

        move_uploaded_file($fileTmp, '../public/media/img/director/' . $fileName);

        return $pictureName;
    }

    public function getMovieDirectorByMovieID($id)  {
        $this->db->query("SELECT * FROM movie_director md INNER JOIN director d ON md.director_id = d.director_id WHERE md.movie_id = :id");
        $this->db->bind("id", $id);
        return $this->db->resultSet();
    }
    
    public function deleteDirector($directorID) {
        $sql = "DELETE FROM director d WHERE d.director_id = :director_id";

        $this->db->query($sql);
        $this->db->bind("director_id", $directorID);

        $this->db->execute();

        return $this->db->rowCount();
    }
}