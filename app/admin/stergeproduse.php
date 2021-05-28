<?php

include 'db.php';
$id_produs = $_POST['id_produs'];
try {
    $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
    $delete = $dbh -> exec("DELETE FROM produse WHERE ID = '$id_produs'");
    if($delete == true)
    {
        echo "Produs sters";
    }
    $dbh = null;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
?>