<?php
$id_admin = $_COOKIE['id_admin'];
if($id_admin == '')
{
    header("Location: /admin/");
}
$id_comanda = $_GET['id_comanda'];
$id_partener = $_GET['id_partener'];

require_once "pdf/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = file_get_contents("https://app.medicalpubit.ro/admin/proforma.php?id_comanda=".$id_comanda."&id_partener=".$id_partener);

$dompdf -> loadHtml($html);

$dompdf -> setPaper('A4' , 'portrait');

$dompdf -> render();


$dompdf -> stream("Proforma #".$id_comanda, array("Attachment" => 0));

$output = $dompdf->output();
$nume_factura = "Proforma$id_comanda.pdf";
file_put_contents("docs/$nume_factura", $output);

include 'db.php';

date_default_timezone_set("Europe/Bucharest");
 
$data_ora = strtotime(date("d.m.Y H:i:s"));
$total = '';
if(isset($_POST['total']))
{
    $total = $_POST['total'];
}

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $check = $dbh -> query("SELECT * FROM facturi_chitante WHERE id_comanda = '$id_comanda' AND partener = '$id_partener' AND chitanta_factura = '$nume_factura'");
  $count = $check -> rowCount();
  if($count == 1)
  {
      $dbh = null;
      exit;
  }
  elseif($count == 0)
  {
      $produse = $dbh -> query("SELECT * FROM produse_comenzi WHERE id_comanda = '$id_comanda'");
      $total = 0;
      foreach($produse as $produs)
      {
          $id_produs = $produs['id_produs'];
          $cantitate = $produs['cantitate'];
          $pret_produs = $dbh -> query("SELECT * FROM produse WHERE ID = '$id_produs'");
          foreach($pret_produs as $row)
          {
              $pret = $row['pret'];
          }
          $total = $total + $cantitate*$pret;
      }
      $total_final = $total + 19/100*$total;
      $total_final = number_format((float)$total_final, 2, '.', '');
      $dbh -> exec("INSERT INTO facturi_chitante(id_comanda , partener , chitanta_factura , data_ora , incasat , platit , tip) VALUES('$id_comanda' , '$id_partener' , '$nume_factura' , '$data_ora' , '$total_final' , '0' , 'proforma')");
  }
  
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>