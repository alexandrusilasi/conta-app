<?php

include 'db.php';

$nume = $_POST['nume'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$oras = $_POST['oras'];
$judet = $_POST['judet'];
$adresa = $_POST['adresa'];
$cui = $_POST['cui'];
$rc = $_POST['rc'];
$cont_bancar = $_POST['cont_bancar'];
$banca = $_POST['banca'];
$persoana_contact = $_POST['persoana_contact'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $check = $dbh -> query("SELECT * FROM parteneri WHERE email = '$email'");
  $count = $check -> rowCount();
  if($count > 0)
  {
      echo "Adresa de email exista deja!";
      exit;
  }
  else
  {
      $insert = $dbh -> exec("INSERT INTO parteneri(nume, email, telefon , oras , judet , adresa , cui , rc , banca , cont_bancar , persoana_contact) VALUES('$nume' , '$email' , '$telefon' , '$oras' , '$judet' , '$adresa' , '$cui' , '$rc' , '$banca' , '$cont_bancar' , '$persoana_contact')");
      if($insert == true)
      {
          echo "Firma adaugata!";
      }
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>