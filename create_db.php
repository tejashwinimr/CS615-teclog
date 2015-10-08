<?php
    // DB connection info
    $host = "us-cdbr-azure-west-c.cloudapp.net";
    $user = "bcfde92a608269";
    $pwd = "815873fb";
    $db = "acsm_8cd991cf173de96";
    try{
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $sql = "CREATE TABLE IF NOT EXISTS notes (
                   id INT(11) AUTO INCREMENT,
                   last_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                   content text,
                   PRIMARY KEY(id)
                );";
        $conn->query($sql);
    }
    catch(Exception $e){
        die(print_r($e));
    }
    echo "<h3>Table created.</h3>";
?>