<?php

include 'db.php';

$id_produs = $_POST['id_produs'];
$stoc = $_POST['stoc'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $check = $dbh -> query("SELECT * FROM produse WHERE ID = '$id_produs'");
  foreach($check as $row)
  {
      echo $stoc - $row['stoc'];
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>