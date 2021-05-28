<?php

include 'db.php';

$nume = $_POST['nume'];
$cantitate = $_POST['cantitate'];
$nr_inventar = $_POST['nr_inventar'];
$id_mijloc = $_POST['id_mijloc'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $update = $dbh -> exec("UPDATE mijloace SET nume = '$nume' , cantitate = '$cantitate' , numar_inventar = '$nr_inventar' WHERE ID = '$id_mijloc'");
  if($update == true)
  {
      echo "Mijloc actualizat";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>