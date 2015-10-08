<?php

function createNote($content) {
    $host = "us-cdbr-azure-west-c.cloudapp.net";
    $user = "bcfde92a608269";
    $pwd = "815873fb";
    $db = "acsm_8cd991cf173de96";
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $query = $conn->prepare("INSERT INTO notes (content) VALUES (:content);");
        $query->bindParam(':content', $content);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getNotes() {
    $host = "us-cdbr-azure-west-c.cloudapp.net";
    $user = "bcfde92a608269";
    $pwd = "815873fb";
    $db = "acsm_8cd991cf173de96";
    try{
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $query = $conn->prepare("SELECT * FROM notes ORDER BY last_modified DESC;");
        $query->execute();

        return $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getMinId() {
    $host = "us-cdbr-azure-west-c.cloudapp.net";
    $user = "bcfde92a608269";
    $pwd = "815873fb";
    $db = "acsm_8cd991cf173de96";
    try{
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $query = $conn->prepare("SELECT min(id) FROM notes;");
        $query->execute();

        return $query->fetch()[0];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getMaxId() {
    $host = "us-cdbr-azure-west-c.cloudapp.net";
    $user = "bcfde92a608269";
    $pwd = "815873fb";
    $db = "acsm_8cd991cf173de96";
    try{
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $query = $conn->prepare("SELECT max(id) FROM notes;");
        $query->execute();

        return $query->fetch()[0];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function isValid($id) {
    $host = "us-cdbr-azure-west-c.cloudapp.net";
    $user = "bcfde92a608269";
    $pwd = "815873fb";
    $db = "acsm_8cd991cf173de96";
    try{
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $query = $conn->prepare("SELECT * FROM notes WHERE id = :id;");
        $query->bindParam(':id', $id);
        $query->execute();

        return count($query->fetchAll()) > 0;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function deleteNote($id) {
    $host = "us-cdbr-azure-west-c.cloudapp.net";
    $user = "bcfde92a608269";
    $pwd = "815873fb";
    $db = "acsm_8cd991cf173de96";
    try{
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $query = $conn->prepare("DELETE FROM notes WHERE id = :id;");
        $query->bindParam(':id', $id);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function updateNote($id, $newContent) {
    $host = "us-cdbr-azure-west-c.cloudapp.net";
    $user = "bcfde92a608269";
    $pwd = "815873fb";
    $db = "acsm_8cd991cf173de96";
    try{
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $query = $conn->prepare("UPDATE notes
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

?>
