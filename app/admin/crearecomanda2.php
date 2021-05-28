<?php

$id_produs = $_POST['id_produs'];
$cantitate = $_POST['cantitate'];

include 'db.php';

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $check = $dbh -> query("SELECT * FROM crearecomenzi WHERE id_produs = '$id_produs'");
  $count = $check ->rowCount();
  if($count > 0)
  {
      $update = $dbh -> exec("UPDATE crearecomenzi SET cantitate = cantitate + '$cantitate' WHERE id_produs = '$id_produs'");
      if($update == true)
      {
          echo "Cantitate actualizata!";
          exit;
      }
  }
  
  $insert = $dbh -> exec("INSERT INTO crearecomenzi(id_produs , cantitate) VALUES('$id_produs' , '$cantitate')");
  if($insert == true)
  {
      echo "Produs adaugat in cos";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>