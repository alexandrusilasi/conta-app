<?php

include 'db.php';

$nume = $_POST['nume'];
$pret = $_POST['pret'];
$stoc = $_POST['stoc'];
$descriere = $_POST['descriere'];
$id_produs = $_POST['id_produs'];
$id_cat = $_POST['id_cat'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $update = $dbh -> exec("UPDATE produse SET nume = '$nume' , pret = '$pret' , stoc = '$stoc' , descriere = '$descriere' , id_cat = '$id_cat' WHERE ID = '$id_produs'");
  if($update == true)
  {
      echo "Produs actualizat";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>