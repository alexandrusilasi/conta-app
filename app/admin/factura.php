<?php

$id_partener = $_POST['id_partener'];
if($id_partener == '')
{
    exit;
}
include 'db.php';


try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $email_partener = $dbh -> query("SELECT * FROM parteneri WHERE ID = '$id_partener'");
  foreach($email_partener as $rowemail)
  {
      $emailpartener = $rowemail['email'];
  }
  
  $insert = $dbh -> exec("INSERT INTO comenzi(partener, factura) VALUES('$id_partener' , '')");
  if($insert == true)
  {
      $id = $dbh -> query("SELECT * FROM comenzi WHERE partener = '$id_partener' ORDER BY ID DESC LIMIT 0, 1");
      foreach($id as $row)
      {
          $id_comanda = $row['ID'];
      }
      $produse = $dbh -> query("SELECT * FROM crearecomenzi");
      foreach($produse as $rowproduse)
      {
          $id_produs = $rowproduse['id_produs'];
          $cantitate = $rowproduse['cantitate'];
          $dbh -> exec("INSERT INTO produse_comenzi(id_comanda , id_produs , cantitate) VALUES('$id_comanda' , '$id_produs' , '$cantitate')");
          $dbh -> exec("UPDATE produse SET stoc = stoc - $cantitate WHERE ID = '$id_produs'");
      }
      $dbh -> exec("DELETE FROM crearecomenzi");
  }
  
}
catch(PDOException $e) {
  echo $e->getMessage();
}

$nume_factura = 'Factura'.$id_comanda.'.pdf';

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $dbh -> exec("UPDATE comenzi SET factura = '$nume_factura' WHERE ID = '$id_comanda'");
  $dbh -> exec("UPDATE facturi_chitante SET chitanta_factura = '$nume_factura' WHERE id_comanda = '$id_comanda'");
  $dbh = null;
}
catch(PDOException $e) {
  echo $e->getMessage();
}
echo "Comanda Finalizata";
?>