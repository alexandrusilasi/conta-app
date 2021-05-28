<?php

$nume_produs = $_POST['nume'];
$id_cat = $_POST['id_cat'];
if($nume_produs == '' && $id_cat == '')
{
    exit;
}

?>
<style>
    table input
    {
        width: auto !important;
    }
</style>
<table class="table table-striped" style="margin-top: 15px;">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">#</th>
      <th scope="col" style="width: 20%;">Produs</th>
      <th scope="col" style="width: 10%;">Pret</th>
      <th scope="col" style="width: 10%;">Stoc</th>
      <th scope="col" style="width: 30%;">Cantitate</th>
      <th scope="col">Actiune</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
    include 'db.php';
    try {
        $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        $nrcrt = 1;
        if($nume_produs != '' && $id_cat == '')
        {
            $produse = $dbh -> query("SELECT * FROM produse WHERE nume LIKE '%$nume_produs%'");   
        }
        if($nume_produs == '' && $id_cat != '')
        {
            $produse = $dbh -> query("SELECT * FROM produse WHERE id_cat = '$id_cat'");   
        }
        if($id_cat != '' && $nume_produs != '')
        {
            $produse = $dbh -> query("SELECT * FROM produse WHERE id_cat = '$id_cat' AND nume LIKE '%$nume_produs%'");   
        }
        foreach($produse as $row)
        {
            ?>
            <tr>
                <td>
                    <?php echo $nrcrt; ?>
                </td>
                <td>
                    <?php echo $row['nume']; ?>
                </td>
                <td>
                    <?php echo $row['pret']; ?>
                </td>
                <td id="<?php echo $row['ID']; ?>">
                    <?php
                    if($row['stoc'] == 0)
                    {
                        ?>
                        <span style="color: #dc3545;"><?php echo $row['stoc']; ?></span>
                        <?php
                    }
                    else
                    {
                        $id_produs = $row['ID'];
                        $qty = $dbh -> query("SELECT * FROM crearecomenzi WHERE id_produs = '$id_produs'");
                        $count = $qty -> rowCount();
                        if($count > 0)
                        {
                            foreach($qty as $rowqty)
                            {
                                echo $row['stoc'] - $rowqty['cantitate'];
                            }
                        }
                        else
                        {
                            echo $row['stoc'];
                        }
                    }
                    ?>
                </td>
                <td>
                    <input type="number" id="cantitate" min="0" step="1" required />
                </td>
                <td data-id="<?php echo $row['ID']; ?>">
                    <button type="button" class="btn btn-success adaugaincos"><i class="fas fa-shopping-cart"></i> Adauga in cos</button>
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
<script>
    $(document).ready(function(){
        $("button.adaugaincos").on("click", function(){
            var id_produs = parseInt($(this).parent().data("id"));
            var cantitate = parseInt($(this).parents("tr").find("input#cantitate").val());
            var max_qty = parseInt($("td#"+id_produs).text());
            var cur_qty = parseInt($("td#"+id_produs).text());
            if(cantitate <= max_qty)
            {
                cur_qty = cur_qty - cantitate;
                $("td#"+id_produs).text(cur_qty);
                $.ajax({
                    url: 'crearecomanda2.php',
                    type: 'post',
                    data: {id_produs:id_produs , cantitate:cantitate},
                    success: function(d)
                    {
                        alert(d);
                        $("div.comanda").load("comandaactiva.php");
                    }
                });
            }
            else
            {
                alert("S-a depasit stocul!");
            }
        });
    });
</script>