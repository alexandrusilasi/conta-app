<?php

include 'db.php';

$id_produs = $_POST['id_produs'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $sterge = $dbh -> exec("DELETE FROM crearecomenzi WHERE ID = '$id_produs'");
  if($sterge == true)
  {
      echo "Produs sters";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>