<?php

include 'db.php';

$nume = $_POST['nume'];
$adresa = $_POST['adresa'];
$oras = $_POST['oras'];
$judet = $_POST['judet'];
$email = $_POST['email'];
$cui = $_POST['cui'];
$rc = $_POST['rc'];
$banca = $_POST['banca'];
$cont1 = $_POST['cont1'];
$cont2 = $_POST['cont2'];
$cont3 = $_POST['cont3'];
$capital_social = $_POST['capital_social'];
$telefon = $_POST['telefon'];
$logocompanie = $_FILES['logocompanie']['name'];

if(isset($_POST['sterge']) && $_POST['sterge'] == 1)
{
    try {
        $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        
        $sterge_logo = $dbh -> query("SELECT * FROM datefirma WHERE ID = 1");
        foreach($sterge_logo as $row)
        {
            $unlink = unlink("imgs/".$row['logo']);
            if($unlink == true)
            {
                $uplogo = $dbh -> exec("UPDATE datefirma SET logo = '' WHERE ID = 1");
                if($uplogo == true)
                {
                    echo "Logo sters";
                }
            }
        }
        $dbh = null;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    exit;
}

if($logocompanie != '')
{
    $allowed =  array('pdf','png' ,'jpg');
    $filename = $_FILES['logocompanie']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!in_array($ext,$allowed) ) {
        echo "Tip de fisier neacceptat!";
        exit;
    }
    
    if($_FILES['logocompanie']['size'] > 2000000)
    {
        echo "Fisierul este prea mare!";
        exit;
    }   
    $actual_name = pathinfo($logocompanie,PATHINFO_FILENAME);
    $original_name = $actual_name;
    $extension = pathinfo($logocompanie, PATHINFO_EXTENSION);
    $i = 1;
    while(file_exists("imgs/".$actual_name.".".$extension))
    {               
        $actual_name = (string)$original_name.$i;
        $logocompanie = $actual_name.".".$extension;
        $i++;
    }
}


try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $uploads_dir = "imgs/";
  $tmp_name = $_FILES['logocompanie']['tmp_name'];
  $move =  move_uploaded_file($tmp_name, "$uploads_dir/$logocompanie");
  $update = $dbh -> exec("UPDATE datefirma SET nume = '$nume' , adresa = '$adresa' , oras = '$oras' , judet = '$judet' , email = '$email' , cui = '$cui' , rc = '$rc' , banca = '$banca' , cont1 = '$cont1' , cont2 = '$cont2' , cont3 = '$cont3' , capital_social = '$capital_social' , telefon = '$telefon' , logo = '$logocompanie' WHERE ID = '1'");
  if($update == true)
  {
    echo "Date actualizate!";
  }
  else
  {
    print_r($dbh -> errorInfo());
  }
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>