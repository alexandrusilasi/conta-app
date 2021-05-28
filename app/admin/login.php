<?php

$email = $_POST['email'];
$parola = md5($_POST['parola']);

$hostdb = 'localhost';
$namedb = 'medical_conta';
$userdb = 'medical_conta';
$passdb = '{@conta@}@2019';

// Afiseaza mesaj daca s-a reusit conectarea, altfel, retine eventuala eroare
try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $check = $dbh -> query("SELECT * FROM conturi WHERE email = '$email' AND pass = '$parola'");
  $count = $check -> rowCount();
  if($count == 1)
  {
     foreach($check as $row)
     {
         $id_admin = $row['ID'];
         setcookie('id_admin', $id_admin, time() + (86400 * 30), "/");
     }
     echo  "Date corecte!";
  }
  if($count == 0)
  {
      echo "Date incorecte!";
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>