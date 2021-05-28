<?php

include 'db.php';

$nume = $_POST['nume'];
$persoana_contact = $_POST['persoana_contact'];
$cui = $_POST['cui'];
$telefon = $_POST['telefon'];
$rc = $_POST['rc'];
$email = $_POST['email'];
$adresa = $_POST['adresa'];
$oras = $_POST['oras'];
$judet = $_POST['judet'];
$banca = $_POST['banca'];
$cont_bancar = $_POST['cont_bancar'];
$id_partener = $_POST['id_partener'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $update = $dbh -> exec("UPDATE parteneri SET nume = '$nume' , email = '$email' , telefon = '$telefon' , oras = '$oras' , judet = '$judet' , adresa = '$adresa' , cui = '$cui' , rc = '$rc' , banca = '$banca' , cont_bancar = '$cont_bancar' , persoana_contact = '$persoana_contact' WHERE ID = '$id_partener'");
  if($update == true)
  {
      echo "Date actualizate";
  }
  else
  {
      print_r($dbh->errorInfo());
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>