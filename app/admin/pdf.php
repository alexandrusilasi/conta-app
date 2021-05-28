<!DOCTYPE html>
<html>
<head>
<title>Factura #<?php echo $_GET['id_comanda']; ?></title>
<style>
body
{
    font-family: sans-serif;
    font-size: 10px;
}
header div
{
    text-align: right;
    margin-bottom: 50px;
}
div.top
{
    display: block;
}
div.top > div
{
    display: inline-block;
    width: 33%;
    vertical-align: top;
}
div.top p
{
    margin:0;
}
div.top div.wrapper
{
    border: 1px solid #000;
    margin: 5px;
    padding: 5px;
}
div.top h1
{
    margin-top: 0;
    text-align: center;
}
table {
  border-collapse: collapse;
  width: 100%;
}
table tr
{
    text-align: center;
}
table, th {
  border: 1px solid #000;
}
table td
{
    border-right: 1px solid #000;
}
ta.height
{
    height: 350px;
}
</style>
</head>
<body>
<div>
	<header>
		<div>
		    Seria MP nr. <strong><?php echo $_GET['id_comanda']; ?></strong>
		</div>
	</header>
	<div class="top">
	    <div class="left">
	        <?php
	        include 'db.php';
	        try {
                $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                
                $date = $dbh -> query("SELECT * FROM datefirma");
                foreach($date as $row)
                {
                    ?>
                    <p>Furnizor: <strong><?php echo $row['nume']; ?></strong></p>
                    <p>Nr. ord. com./an: <strong><?php echo $row['rc']; ?></strong></p>
                    <p>CIF: <strong><?php echo $row['cui']; ?></strong></p>
                    <p>Capital Social: <strong><?php echo $row['capital_social']; ?></strong></p>
                    <p>Sediu: <strong><?php echo $row['adresa']." ".$row['oras']; ?></strong></p>
                    <p>Judet: <strong><?php echo $row['judet']; ?></strong></p>
                    <p>IBAN: <strong><?php echo $row['cont1']; ?></strong></p>
                    <p>Banca: <strong><?php echo $row['banca']; ?></strong></p>
                    <?php
                }
                
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
	        
	        ?>
	    </div>
	    <div class="center">
	        <h1>FACTURA</h1>
	        <div class="wrapper">
	            <p>Nr. Factura: <strong><?php echo $_GET['id_comanda']; ?></strong></p>
	            <p>Data(ziua, luna, anul): <strong><?php date_default_timezone_set("Europe/Bucharest"); echo date("d.m.Y"); ?></strong></p>
	        </div>
	    </div>
	    <div class="right">
	        <?php
	        include 'db.php';
	        try {
                $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                
                $id_comanda = $_GET['id_comanda'];
                
                $date2 = $dbh -> query("SELECT * FROM comenzi WHERE ID = '$id_comanda'");
                foreach($date2 as $row2)
                {
                    $id_partener = $row2['partener'];
                    $date_partener = $dbh -> query("SELECT * FROM parteneri WHERE ID = '$id_partener'");
                    foreach($date_partener as $partener)
                    ?>
                    <p>Cumparator: <strong><?php echo $partener['nume']; ?></strong></p>
                    <p>Nr. ord. com./an: <strong><?php echo $partener['rc']; ?></strong></p>
                    <p>CIF: <strong><?php echo $partener['cui']; ?></strong></p>
                    <p>Capital Social: <strong><?php echo $partener['capital_social']; ?></strong></p>
                    <p>Sediu: <strong><?php echo $partener['adresa']." ".$partener['oras']; ?></strong></p>
                    <p>Judet: <strong><?php echo $partener['judet']; ?></strong></p>
                    <p>IBAN: <strong><?php echo $partener['cont_bancar']; ?></strong></p>
                    <p>Banca: <strong><?php echo $partener['banca']; ?></strong></p>
                    <?php
                }
                
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
	        
	        ?>
	    </div>
	</div>
	<table>
        <tr>
            <th>Nr. Crt.</th>
            <th>Denumire produselor sau a serviciilor</th>
            <th>U.M.</th>
            <th>Cantitate</th>
            <th>Pret unitare<br/>(fara T.V.A.)<br/>-lei-</th>
            <th>Valoare<br/>-lei-</th>
            <th>Valoare T.V.A.<br/>-lei-</th>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #000;">0</td>
            <td style="border-bottom: 1px solid #000;">1</td>
            <td style="border-bottom: 1px solid #000;">2</td>
            <td style="border-bottom: 1px solid #000;">3</td>
            <td style="border-bottom: 1px solid #000;">4</td>
            <td style="border-bottom: 1px solid #000;">5</td>
            <td style="border-bottom: 1px solid #000;">6</td>
        </tr>
        <?php
	        include 'db.php';
	        try {
                $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                
                
                $produse = $dbh -> query("SELECT * FROM produse_comenzi WHERE id_comanda = '$id_comanda'");
                $crt = 1;
                $total = 0;
                $pret_total2 = 0;
                $tva_total = 0;
                $count = $produse -> rowCount();
                if($count < 50)
                {
                    $height = 50 - $count;
                }
                $height = 14 * $height;
                foreach($produse as $produs)
                {
                    $id_produs = $produs['id_produs'];
                    $pret = $dbh -> query("SELECT * FROM produse WHERE ID = '$id_produs'");
                    foreach($pret as $rowpret)
                    {
                        $pret_produs = $rowpret['pret'];
                        $nume_produs = $rowpret['nume'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $crt; ?></td>
                        <td style="text-align: left;"><?php echo $nume_produs; ?></td>
                        <td>Buc</td>
                        <td><?php echo $produs['cantitate']; ?></td>
                        <td><?php echo $pret_produs; ?></td>
                        <td>
                            <?php
                            
                            $pret_total = $produs['cantitate']*$pret_produs;
                            $pret_total2 = $pret_total2 + $pret_total;
                            $tva = 19/100*$pret_total;
                            $tva_total = $tva_total + $tva;
                            echo number_format((float)$pret_total, 2, '.', '');
                            $total = $total + $pret_total + $tva;
                            ?>
                        </td>
                        <td>
                            <?php
                            
                            echo number_format((float)$tva, 2, '.', '');
                            
                            ?>
                        </td>
                    </tr>
                    <?php
                    $crt++;
                }
                
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
	        
	        ?>
	        <tr>
	            <td style="height:<?php echo $height; ?>px;"></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	        </tr>
	        <tr>
	            <td colspan="2" style="border-top: 1px solid #000; text-align: left;">Semnatura si stampila furnizorului</td>
	            <td style="border-top: 1px solid #000; text-align: left;"></td>
	            <td colspan="2" style="border-top: 1px solid #000; text-align: left;">Semnatura de primire</td>
	            <td style="border-top: 1px solid #000;">
	                <?php
	                echo number_format((float)$pret_total2, 2, '.', '');
	                ?>
	            </td>
	            <td style="border-top: 1px solid #000;">
	                <?php
	                echo number_format((float)$tva_total, 2, '.', '');
	                ?>
	            </td>
	        </tr>
	        <tr>
	            <td colspan="2"></td>
	            <td></td>
	            <td colspan="2"></td>
	            <td colspan="2" style="border-top: 1px solid #000;">
	                Pret total (col. 5 + 6)
	                <h3><?php
	                echo number_format((float)$total, 2, '.', '');
	                ?></h3>
	            </td>
	        </tr>
    </table>
</div>
</body>
</html>