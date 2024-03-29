<?php

class Database
{
    public $username;
    public $pass;
    public $hostname;
    public $dbname;
    public $pdo;

    public function __construct()
    {
        $this->username = "root";
        $this->hostname = "localhost";
        $this->dbname = 'intranet';
        $this->connexionDb();
    }

    public function connexionDb()
    {
        try {
            $this->pdo = new pdo("mysql:dbname=intranet;host=localhost;charset=UTF8", 'root', '');
        } catch (Exception $e) {
            echo $e . "<br>";
        }
    }

    public function closeDb()
    {
        $this->pdo = null;
    }

    public function selectAll($table)
    {
        $query = $this->pdo->prepare("SELECT * from ". $table);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findById($table, $id){
        $query = $this->pdo->prepare("SELECT * from ". $table ." WHERE id = ? ");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}