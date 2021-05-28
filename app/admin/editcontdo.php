<?php

include 'db.php';

$nume = $_POST['nume'];
$email = $_POST['email'];
$pass = md5($_POST['pass']);
$id_cont = $_POST['id_cont'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $update1 = $dbh -> exec("UPDATE conturi SET email = '$email' WHERE ID = '$id_cont'");
  $update2 = $dbh -> exec("UPDATE conturi SET nume = '$nume' WHERE ID = '$id_cont'");
  if($_POST['pass'] != '')
  {
      $update3 = $dbh -> exec("UPDATE conturi SET pass = '$pass' WHERE ID = '$id_cont'");
  }
  if($update1 == true || $update2 == true || $updat3 == true)
  {
      echo "Date actualizate!";
  }
  
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>