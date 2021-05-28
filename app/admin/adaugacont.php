<?php

include 'db.php';

$nume = $_POST['nume'];
$email = $_POST['email'];
$pass = md5($_POST['pass']);
$tip = $_POST['tip_cont'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $check = $dbh -> query("SELECT * FROM conturi WHERE email = '$email'");
  $count = $check -> rowCount();
  if($count > 0)
  {
      echo "Acesta adresa de email exista deja";
      exit;
  }
  
  $insert = $dbh -> exec("INSERT INTO conturi(nume , email , pass , tip) VALUES('$nume' , '$email' , '$pass' , '$tip')");
  if($insert == true)
  {
      echo "Cont adaugat";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>