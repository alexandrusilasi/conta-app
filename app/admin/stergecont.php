<?php

include 'db.php';

$id_cont = $_POST['id_cont'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $delete = $dbh -> exec("DELETE FROM conturi WHERE ID = '$id_cont'");
  if($delete == true)
  {
      echo "Cont sters";
  }
  
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>