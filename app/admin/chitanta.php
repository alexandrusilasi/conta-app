<?php
date_default_timezone_set("Europe/Bucharest");
include 'db.php';

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $chitante = $dbh -> query("SELECT * FROM facturi_chitante WHERE tip = 'chitanta'");
  $count = $chitante -> rowCount();
  $count ++;
  
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Chitanta #<?php echo $count; ?></title>
<style>
body
{
    font-family: sans-serif;
    font-size: 10px;
    margin:0;
}
div.wrapper
{
    border: 2px solid #000;
    padding: 15px;
    height: auto;
}
p
{
    margin:0;
    padding:0;
    font-weight: bold;
}
div.wrapper header
{
    display: flex;
}
div.wrapper header div
{
    width: 100%;
}
div.wrapper header div span
{
    font-size: 14px;
}
div.wrapper header div span.val
{
    width: 150px;
    display: inline-block;
    text-align: center;
    border-bottom: 2px solid #000;
    margin-left: 10px;
    float: right;
}
div.cnt
{
    width: 100%;
    max-width: 500px;
    margin: auto;
    margin-top: 100px;
}
div.cnt p
{
    font-size: 12px;
    margin-bottom: 10px;
}
div.cnt p span
{
    min-width: 300px;
    border-bottom: 2px solid #000;
    display: inline-block;
    text-align: center;
}
</style>
</head>
<body>
    <div class="wrapper">
        <header>
            <?php
            try {
                $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                
                $date = $dbh -> query("SELECT * FROM datefirma");
                foreach($date as $row)
                {
                    
                }
                
                
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            ?>
            <div>
                <p>Furnizor: <?php echo $row['nume']; ?></p>
                <p>C.U.I./C.I.F.: <?php echo $row['cui']; ?></p>
                <p>Sediu: <?php echo $row['adresa']; ?></p>
                <p>Judet: <?php echo $row['judet']; ?></p>
            </div>
            <div style="text-align: right;">
                <p><span>Chitanta nr.</span><span class="val"><?php echo $count; ?></span></p>
                <br/>
                <p><span>Data</span><span class="val"><?php echo date("d.m.Y"); ?></span></p>
            </div>
        </header>
        <?php
        
        $id_partener = $_GET['id_partener'];
        $id_comanda = $_GET['id_comanda'];
        try {
                $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                
                $partener = $dbh -> query("SELECT * FROM parteneri WHERE ID = '$id_partener'");
                foreach($partener as $row2)
                {
                    
                }
                
                $suma = $dbh -> query("SELECT * FROM facturi_chitante WHERE id_comanda = '$id_comanda'");
                foreach($suma as $rows)
                {
                    
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        ?>
        <div class="cnt">
            <div>
                <p>Am primit de la <span><?php echo $row2['nume']; ?></span></p>
            </div>
            <div>
                <p style="display: inline-block;">Adresa <span><?php echo $row2['adresa']; ?></span></p>
                <p style="display: inline-block;">Judetul <span><?php echo $row2['judet']; ?></span></p>
            </div>
            <div>
                <p style="display: inline-block;">C.U.I. <span><?php echo $row2['cui']; ?></span></p>
                <p style="display: inline-block;">Registrul Comertului <span><?php echo $row2['rc']; ?></span></p>
            </div>
            <div>
                <p style="display: inline-block;">Suma de <span><?php echo $rows['incasat']; ?></span></p>
                <p style="display: inline-block;">adica(in litere) <span><?php echo $rows['incasat']; ?></span></p>
            </div>
            <div>
                <p style="display: inline-block;">Reprezentand c/v factura nr. <span><?php echo $id_comanda; ?></span></p>
                <p style="display: inline-block;">din data <span><?php echo date("d.m.Y" , $rows['data_ora']); ?></span></p>
            </div>
        </div>
    </div>
</body>
</html>