<?php


class Database
{
    private $dbhost = HOST;
    private $pass = PASSWORD;
    private $user = USER;
    private $port = PORT;
    private $database = DB_NAME;

    private $conn;
    private $statement;


    public function __construct()
    {
        $db_url = 'mysql:host=' . $this->dbhost . ";port=". $this->port . ";dbname=" .  $this->database;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->conn = new PDO($db_url, $this->user, $this->pass);
        } catch (PDOException) {
            throw new Exception('Bad Gateway', STATUS_BAD_GATEWAY);
        }
    }

    public function query(string $query) : void
    {
        try {
            $this->statement = $this->conn->prepare($query);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function bind($param, $value, $type = null) : void
    {
        try {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value) :
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value) :
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value) :
                        $type = PDO::PARAM_NULL;
                        break;
                    default :
                        $type = PDO::PARAM_STR;
                }
            }
            $this->statement->bindValue($param, $value, $type);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function execute() : void{
        try {
            $this->statement->execute();
        } catch (PDOException $e) {
            // throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
            var_dump($e->getMessage());
            throw new Exception($e->getMessage(), STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function resultSet()
    {
        try {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function single()
    {
        try {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function rowCount() 
    {
        return $this->statement->rowCount();
    }

    public function lastInsertID() 
    {
        try {
            return $this->conn->lastInsertId();
        } catch (PDOException) {
            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
        }
    }
}