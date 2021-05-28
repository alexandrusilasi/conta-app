<?php

include 'db.php';

$nume = $_POST['nume'];
$cantitate = $_POST['cantitate'];
$nr_inventar = $_POST['nr_inventar'];
$data = $_POST['data'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $insert = $dbh -> exec("INSERT INTO mijloace(nume, cantitate, numar_inventar , data_adaugarii) VALUES('$nume' , '$cantitate' , '$nr_inventar' , '$data')");
  if($insert == true)
  {
      echo "Mijloc adaugat";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>