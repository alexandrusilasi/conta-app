<?php

include 'db.php';

$nume_cat = $_POST['nume_cat'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $check = $dbh -> query("SELECT * FROM categorii WHERE nume = '$nume_cat'");
  $count = $check -> rowCount();
  if($count > 0)
  {
      echo "Acesta categorie exista deja";
      exit;
  }
  
  $insert = $dbh -> exec("INSERT INTO categorii(nume) VALUES('$nume_cat')");
  if($insert == true)
  {
      echo "Categorie adaugata";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>