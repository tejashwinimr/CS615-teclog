<?php

class Db {
    
    protected $con;
    private $host = "us-cdbr-azure-west-c.cloudapp.net";
    private $user = "bcfde92a608269";
    private $pwd = "815873fb";
    private $db = "acsm_8cd991cf173de96";
    
    //Creates a PDO conection & sets error mode to exceptions
    public function __construct(){
    
        try { 
            $this->con = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pwd); 
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $this->con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } 
        catch(PDOException $e) { 
            echo $e->getMessage();
        }
        
    }
    
    //sets the datab to null
    public function disconect() {
        
        $this->con = null;
        
    }

    public function createTable() {
        try {
            $sql = "CREATE TABLE registration_tbl(
                        id INT NOT NULL AUTO_INCREMENT, 
                        PRIMARY KEY(id),
                        name VARCHAR(30),
                        email VARCHAR(30),
                        date DATE)";
            $this->con->query($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function dropTable() {
        try {
            $sql = "DROP TABLE notes;";
            $this->con->query($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createNote($content) {
        try {
            $query = $this->con->prepare("INSERT INTO notes (content) VALUES (:content);");
            $query->bindParam(':content', $content);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getNotes() {
        try{
            $query = $this->con->prepare("SELECT * FROM notes ORDER BY last_modified DESC;");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getMinId() {
        try{
            $query = $this->con->prepare("SELECT min(id) FROM notes;");
            $query->execute();
            return $query->fetch()[0];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getMaxId() {
        try{       
            $query = $this->con->prepare("SELECT max(id) FROM notes;");
            $query->execute();
            return $query->fetch()[0];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isValid($id) {
        try{
            $query = $this->con->prepare("SELECT * FROM notes WHERE id = :id;");
            $query->bindParam(':id', $id);
            $query->execute();
            return count($query->fetchAll()) > 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteNote($id) {
        try{          
            $query = $this->con->prepare("DELETE FROM notes WHERE id = :id;");
            $query->bindParam(':id', $id);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateNote($id, $newContent) {
        try{
            $query = $this->con->prepare("UPDATE notes
                                           SET content = :content,
                                               last_modified = CURRENT_TIMESTAMP
                                           WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->bindParam(':content', $newContent);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}
?>