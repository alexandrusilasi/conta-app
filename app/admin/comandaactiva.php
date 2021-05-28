<style>
    table input,
    table select
    {
        width: auto !important;
        display: inline-block !important;
    }
    h2.cos
    {
        text-align: center;
        margin-top: 100px;
        color: green;
    }
</style>
<?php
include 'db.php';

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $comanda_activa = $dbh -> query("SELECT * FROM crearecomenzi");
  $count_comenzi = $comanda_activa -> rowCount();
  if($count_comenzi == 0)
  exit;
  
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>
<h2 class="cos">Cos cumparaturi</h2>
<table class="table table-striped" style="margin-top: 15px;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Produs</th>
      <th scope="col">Cantitate</th>
      <th scope="col">Pret final</th>
      <th scope="col">Actiune</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
    try {
        $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        $nrcrt = 1;
        $produse = $dbh -> query("SELECT * FROM crearecomenzi");
        foreach($produse as $row)
        {
            ?>
            <tr class="produs">
                <td>
                    <?php echo $nrcrt; ?>
                </td>
                <td>
                    <?php $id_produs = $row['id_produs']; 
                    
                    $nume_produs = $dbh -> query("SELECT * FROM produse WHERE ID = '$id_produs'");
                    foreach($nume_produs as $rownume_produs)
                    {
                        echo $rownume_produs['nume'];
                    }
                    
                    ?>
                </td>
                <td>
                    <?php echo $row['cantitate']; ?>
                </td>
                <td class="pret">
                    <?php
                    
                    $id_produs = $row['id_produs'];
                    $pret = $dbh -> query("SELECT * FROM produse WHERE ID = '$id_produs'");
                    foreach($pret as $rowpret)
                    {
                        $pret_produs = $rowpret['pret'];
                        $stoc_produs = $rowpret['stoc'];
                    }
                    
                    echo $row['cantitate']*$pret_produs;
                    
                    ?>
                </td>
                <td data-id="<?php echo $row['ID']; ?>">
                    <input type="hidden" id="pret" value="<?php echo $pret_produs; ?>" />
                    <input type="hidden" id="stoc_produs" value="<?php echo $stoc_produs; ?>" />
                    <button type="button" class="btn btn-danger sterge"><i class="fas fa-trash"></i> Sterge</button>
                </td>
            </tr>
            <?php
        }
        
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    
    ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td class="total"><strong style="color: red;">TOTAL: <span></span></strong></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>
            Partener:
            <select id="partenerfactura">
                <option value="">Selectati partener</option>
                <?php
                try {
                    $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
                    $parteneri = $dbh -> query("SELECT * FROM parteneri");
                    foreach($parteneri as $rowparteneri)
                    {
                        ?>
                        <option value="<?php echo $rowparteneri['ID']; ?>"><?php echo $rowparteneri['nume']; ?></option>
                        <?php
                    }
  
                    $dbh = null;
                }
                catch(PDOException $e) {
                    echo $e->getMessage();
                }
                ?>
            </select>
        </td>
        <td><button type="button" class="btn btn-primary factura" factura="<?php echo $row['ID']; ?>"><i class="fas fa-check"></i> Finalizeaza Comanda</button></td>
        <td></td>
        <td></td>
    </tr>
  </tbody>
</table>
<script>
    $(document).ready(function(){
        $("input#cantitate").on("change", function(){
            var cantitate = parseInt($(this).parents("tr").find("input#cantitate").val());
            var max_qty = parseInt($(this).parents("tr").find("input#stoc_produs").val());
            var id_produs = "<?php echo $id_produs; ?>";
            if(cantitate > max_qty)
            {
                alert("S-a depasit stocul");
            }
            if(cantitate < max_qty)
            {
                var pret_produs = parseInt($("input#pret").val());
                var pret_nou = cantitate*pret_produs;
                $(this).parents("tr").find("td.pret").html(pret_nou);
            }
        });
        $("button.sterge").on("click", function(){
            var id_produs = $(this).parent().data("id");
            if(confirm("Sigur stergi produsul?"))
            {
            $.ajax({
                url: 'stergeproduscomanda.php',
                type: 'post',
                data:{id_produs:id_produs},
                success: function(d)
                {
                    alert(d);
                    $("div.comanda").load("comandaactiva.php");
                    $("div.produse").load("crearecomanda.php");
                }
            });
            }
        });
        $("button.factura").on("click", function(){
            var id_partener = $("select#partenerfactura").val();
            if(id_partener == '')
            {
                alert("Alegeti partenerul!");
                e.stopPropagation();
            }
            $.ajax({
                url: 'factura.php',
                type: 'post',
                data: {id_partener:id_partener},
                success: function(d)
                {
                    alert(d);
                    $("div.comanda").load("comandaactiva.php");
                }
            });
        });
        var total = 0;
        $("tr.produs").each(function(){
            var suma = parseInt($(this).find("td:nth-of-type(4)").text());
            total = total + suma;
            $("td.total span").text(total);
        });
    });
</script>