<?php

include 'db.php';

$id_cont = $_POST['id_cont'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $check = $dbh -> query("SELECT * FROM produse WHERE id_cat = '$id_cont'");
  $count = $check -> rowCOunt();
  if($count > 0)
  {
      echo "Exista produse in categorie";
      exit;
  }
  
  $delete = $dbh -> exec("DELETE FROM categorii WHERE ID = '$id_cont'");
  if($delete == true)
  {
      echo "Categorie stearsa";
  }
  
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>