<?php

$id_partener = $_POST['partener'];
$sumaincasata = $_POST['sumaincasata'];
$sumaplatita = $_POST['sumaplatita'];
$imagine = $_FILES['imagine']['name'];
date_default_timezone_set("Europe/Bucharest");
$date_time = strtotime(date("d.m.Y H:i:s"));
$allowed =  array('pdf','png' ,'jpg');
$filename = $_FILES['imagine']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if(!in_array($ext,$allowed) ) {
    echo "Tip de fisier neacceptat!";
    exit;
}

if($_FILES['imagine']['size'] > 2000000)
{
    echo "Fisierul este prea mare!";
    exit;
}

$actual_name = pathinfo($imagine,PATHINFO_FILENAME);
$original_name = $actual_name;
$extension = pathinfo($imagine, PATHINFO_EXTENSION);

$i = 1;
while(file_exists('docs/'.$actual_name.".".$extension))
{           
    $actual_name = (string)$original_name.$i;
    $imagine = $actual_name.".".$extension;
    $i++;
}

include 'db.php';

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $uploads_dir = 'docs';
  $tmp_name = $_FILES['imagine']['tmp_name'];
  $move =  move_uploaded_file($tmp_name, "$uploads_dir/$imagine");
  if($move == true)
  {
      $adauga = $dbh -> exec("INSERT INTO facturi_chitante(partener , chitanta_factura , data_ora , incasat , platit) VALUES('$id_partener' , '$imagine' , '$date_time' , '$sumaincasata' , '$sumaplatita')");
      if($adauga == true)
      {
          echo "Chitanta/Factura adaugata!";
      }
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>