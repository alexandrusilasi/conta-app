<?php

$nume = $_POST['nume'];
$pret = $_POST['pret'];
$stoc = $_POST['stoc'];
$descriere = $_POST['descriere'];
$id_cat = $_POST['id_cat'];

include 'db.php';

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $insert = $dbh -> query("INSERT INTO produse(nume, pret, stoc, descriere, id_cat) VALUES('$nume' , '$pret' , '$stoc' , '$descriere' , '$id_cat')");
  if($insert == true)
  {
      echo "Produs adaugat";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>