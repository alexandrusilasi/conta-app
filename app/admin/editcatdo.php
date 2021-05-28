<?php

include 'db.php';

$nume_cat = $_POST['nume_cat'];
$id_cat = $_POST['id_cat'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $update = $dbh -> exec("UPDATE categorii SET nume = '$nume_cat' WHERE ID = '$id_cat'");
  if($update == true)
  {
      echo "Catergorie actualizata!";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>