<?php

include 'db.php';

$id = $_POST['id'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $delete = $dbh -> exec("DELETE FROM parteneri WHERE ID = '$id'");
  if($delete == true)
  {
      echo "Partener sters";
  }
  
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>