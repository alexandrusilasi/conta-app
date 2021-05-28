<table class="table table-striped" style="margin-top: 15px;">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">#</th>
      <th scope="col" style="width: 10%;">Partener</th>
      <th scope="col" style="width: 10%;">Total (RON)</th>
      <th scope="col" style="width: 30%;">Actiune</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
    include 'db.php';
    try {
        $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        $nrcrt = 1;
        
        $cautare = $_POST['cautare'];
        
        if($cautare == '')
        {
            $produse = $dbh -> query("SELECT * FROM comenzi ORDER BY ID DESC");   
        }
        elseif($cautare != '')
        {
            $produse = $dbh -> query("SELECT * FROM comenzi WHERE ID LIKE '%$cautare%'");
        }
        foreach($produse as $row)
        {
            ?>
            <tr>
                <td>
                    <?php echo $row['ID']; ?>
                </td>
                <td>
                    <?php 
                    
                    $id_partener = $row['partener']; 
                    $nume_partener = $dbh -> query("SELECT * FROM parteneri WHERE ID = '$id_partener'");
                    foreach($nume_partener as $rownume_cat)
                    {
                        echo $rownume_cat['nume'];
                    }
                    
                    ?>
                </td>
                <td>
                    <?php
                    $total = 0;
                    $id_comanda = $row['ID']; 
                    $produse = $dbh -> query("SELECT * FROM produse_comenzi WHERE id_comanda = '$id_comanda'");
                    foreach($produse as $rowproduse)
                    {
                        $id_produs = $rowproduse['id_produs'];
                        $cantitate = $rowproduse['cantitate'];
                        $pret = $dbh -> query("SELECT * FROM produse WHERE ID = '$id_produs'");
                        foreach($pret as $rowpret)
                        {
                            $pret_produs = $rowpret['pret'];
                        }
                        $total = $total + $cantitate * $pret_produs;
                    }
                    echo $total;
                    
                    ?>
                </td>
                <td data-id="<?php echo $row['ID']; ?>">
                    <a href="vezicomanda.php?id_comanda=<?php echo $id_comanda; ?>"><button type="button" class="btn btn-primary"><i class="fas fa-eye"></i> Vezi Comanda</button></a>
                    <?php
                    
                    $proforma = $dbh -> query("SELECT * FROM facturi_chitante WHERE id_comanda = '$id_comanda' AND tip = 'proforma'");
                    $count1 = $proforma -> rowCount();
                    $factura = $dbh -> query("SELECT * FROM facturi_chitante WHERE id_comanda = '$id_comanda' AND tip = 'factura'");
                    $chitanta = $dbh -> query("SELECT * FROM facturi_chitante WHERE id_comanda = '$id_comanda' AND tip = 'chitanta'");
                    $count1 = $proforma -> rowCount();
                    $count2 = $factura -> rowCount();
                    $count3 = $chitanta -> rowCount();
                    if($count1 > 0)
                    {
                        ?>
                        <a href="/docs/Proforma<?php echo $id_comanda; ?>.pdf" target="_blank"><button type="button" class="btn btn-primary"><i class="fas fa-eye"></i> Vezi Proforma</button></a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="genereazaproforma.php?id_partener=<?php echo $id_partener; ?>&id_comanda=<?php echo $id_comanda; ?>" target="_blank"><button type="button" class="btn btn-primary"><i class="fas fa-file"></i> Genereaza Proforma</button></a>
                        <?php
                    }
                    if($count2 > 0)
                    {
                        ?>
                        <a href="/docs/Factura<?php echo $id_comanda; ?>.pdf" target="_blank"><button type="button" class="btn btn-primary"><i class="fas fa-eye"></i> Vezi Factura</button></a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="genereazafactura.php?id_partener=<?php echo $id_partener; ?>&id_comanda=<?php echo $id_comanda; ?>" target="_blank"><button type="button" class="btn btn-primary"><i class="fas fa-file"></i> Genereaza Factura</button></a>
                        <?php
                    }
                    if($count3 > 0)
                    {
                        ?>
                        <a href="/docs/Chitanta<?php echo $id_comanda; ?>.pdf" target="_blank"><button type="button" class="btn btn-primary"><i class="fas fa-eye"></i> Vezi Chitanta</button></a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a href="genereazachitanta.php?id_partener=<?php echo $id_partener; ?>&id_comanda=<?php echo $id_comanda; ?>" target="_blank"><button type="button" class="btn btn-primary"><i class="fas fa-file"></i> Genereaza Chitanta</button></a>
                        <?php
                    }
                    
                    ?>
                </td>
            </tr>
            <?php
            $nrcrt++;
        }
        
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    
    ?>
  </tbody>
</table>
<style>
    div.popupwrapper
    {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: none;
    }
    div.popupwrapper div.wrapper
    {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    div.popupwrapper div.wrapper div.form
    {
        padding: 15px;
        border-radius: 15px;
        background: #f5f5f5;
        width: 100%;
        max-width: 500px;
    }
</style>
<div class="popupwrapper">
    <div class="wrapper">
        <div class="form">
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("button.deleteprodus").on("click", function(){
            var id_produs = $(this).parent().data("id");
            if(confirm("Sigur stergeti produsul?"))
            {
                $.ajax({
                    url: 'stergeproduse.php',
                    type: 'post',
                    data: {id_produs:id_produs},
                    success: function(d)
                    {
                        alert(d);
                        $("div.comenzi").load("afisareproduse.php");
                    }
                });   
            }
        });
        $("button.editprodus").on("click", function(){
            var id_produs = $(this).parent().data("id");
            $.ajax({
                url: 'editproduse.php',
                type: 'post',
                data: {id_produs:id_produs},
                success: function(d)
                {
                    $("div.popupwrapper div.form").html(d);
                    $("div.popupwrapper").fadeIn();
                }
            });
        });
    });
</script>