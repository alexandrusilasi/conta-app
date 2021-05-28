<?php

$id_mijloc = $_POST['id_mijloc'];

include 'db.php';

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $delete = $dbh -> exec("DELETE FROM mijloace WHERE ID = '$id_mijloc'");
  if($delete == true)
  {
      echo "Mijloc sters";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>