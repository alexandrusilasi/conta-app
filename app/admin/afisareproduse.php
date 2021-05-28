<table class="table table-striped" style="margin-top: 15px;">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">#</th>
      <th scope="col" style="width: 10%;">Categorie</th>
      <th scope="col" style="width: 20%;">Produs</th>
      <th scope="col" style="width: 10%;">Pret (RON)</th>
      <th scope="col" style="width: 10%;">Stoc</th>
      <th scope="col" style="width: 25%;">Descriere</th>
      <th scope="col" style="width: 20%;">Actiune</th>
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
            $produse = $dbh -> query("SELECT * FROM produse ORDER BY nume ASC");   
        }
        elseif($cautare != '')
        {
            $produse = $dbh -> query("SELECT * FROM produse WHERE nume LIKE '%$cautare%' ORDER BY nume ASC");
        }
        foreach($produse as $row)
        {
            ?>
            <tr>
                <td>
                    <?php echo $nrcrt; ?>
                </td>
                <td>
                    <?php 
                    
                    $id_cat = $row['id_cat']; 
                    $nume_cat = $dbh -> query("SELECT * FROM categorii WHERE ID = '$id_cat'");
                    foreach($nume_cat as $rownume_cat)
                    {
                        echo $rownume_cat['nume'];
                    }
                    
                    ?>
                </td>
                <td>
                    <?php echo $row['nume']; ?>
                </td>
                <td>
                    <?php echo $row['pret']; ?>
                </td>
                <td>
                    <?php
                    if($row['stoc'] == 0)
                    {
                        ?>
                        <span style="color: #dc3545;"><?php echo $row['stoc']; ?></span>
                        <?php
                    }
                    else
                    {
                        echo $row['stoc'];
                    }
                    ?>
                </td>
                <td>
                    <?php echo $row['descriere']; ?>
                </td>
                <td data-id="<?php echo $row['ID']; ?>">
                    <button type="button" class="btn btn-primary editprodus"><i class="fas fa-pencil-alt"></i> Editeaza</button>
                    <button type="button" class="btn btn-danger deleteprodus"><i class="fas fa-trash"></i> Sterge</button>
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
                        $("div.produse").load("afisareproduse.php");
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