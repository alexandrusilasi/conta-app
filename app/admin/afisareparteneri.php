<?php

include 'db.php';

?>
<style>
    
</style>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">Nr. crt.</th>
      <th scope="col" style="width: 16%;">Denumire</th>
      <th scope="col" style="width: 16%;">CUI</th>
      <th scope="col" style="width: 16%;">Telefon</th>
      <th scope="col" style="width: 16%;">Email</th>
      <th scope="col" style="width: 27%;">Actiune</th>
    </tr>
  </thead>
  <tbody>
    <?php
    try {
        $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        
        $cautare = $_POST['cautare'];
        if($cautare == '')
        {
            $parteneri = $dbh -> query("SELECT * FROM parteneri");   
        }
        elseif($cautare != '')
        {
            $parteneri = $dbh -> query("SELECT * FROM parteneri WHERE nume LIKE '%$cautare%' OR email LIKE '%$cautare%' OR telefon LIKE '%$cautare%' OR oras LIKE '%$cautare%' OR judet LIKE '%$cautare%' OR adresa LIKE '%$cautare%' OR cui LIKE '%$cautare%' OR rc LIKE '%$cautare%' OR banca LIKE '%$cautare%' OR cont_bancar LIKE '%$cautare%' OR persoana_contact LIKE '%$cautare%'");
        }
        $crt = 1;
        foreach($parteneri as $row)
        {
            ?>
            <tr>
                <td><?php echo $crt; ?></td>
                <td><?php echo $row['nume']; ?></td>
                <td><?php echo $row['cui']; ?></td>
                <td><?php echo $row['telefon']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td data-id="<?php echo $row['ID']; ?>"><button type="button" class="btn btn-success vizualizare"><i class="fas fa-eye"></i> Vizualizeaza</button> <button type="button" class="btn btn-primary edit"><i class="fas fa-pencil-alt"></i> Editeaza</button> <button type="button" class="btn btn-danger delete"><i class="fas fa-trash"></i> Sterge</button></td>
            </tr>
            <?php
            $crt ++;
        }
        
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    ?>
  </tbody>
</table>
<style>
    div.editformwrapper
    {
        position:fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: none;
    }
    div.editformwrapper div.prewrapper
    {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    div.editformwrapper div.form
    {
        padding: 15px;
        background: #f5f5f5;
        border-radius: 15px;
    }
</style>
<div class="editformwrapper">
    <div class="prewrapper">
        <div class="form"></div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("button.delete").on("click", function(){
            if(confirm("Sigur stergi partenerul?"))
            {
            var id = $(this).parent().data("id");
            $.ajax({
                url: 'stergepartener.php',
                type: 'post',
                data: {id:id},
                success: function(d)
                {
                    if(d == 'Partener sters')
                    {
                        alert(d);
                        $("div.parteneriwrapper").load("afisareparteneri.php");
                    }
                    else
                    {
                        alert(d);
                    }
                }
            });
            }
        });
        $("button.edit").on("click", function(){
            var id_partener = $(this).parent().data("id");
            $.ajax({
                url: 'editarepartener.php',
                type: 'post',
                data: {id_partener:id_partener},
                success: function(d)
                {
                    $("div.editformwrapper div.form").html(d);
                    $("div.editformwrapper").fadeIn();
                }
            });
        });
        $("button.vizualizare").on("click", function(){
            var id_partener = $(this).parent().data("id");
            $.ajax({
                url: 'vizualizarepartener.php',
                type: 'post',
                data: {id_partener:id_partener},
                success: function(d)
                {
                    $("div.editformwrapper div.form").html(d);
                    $("div.editformwrapper").fadeIn();
                }
            });
        });
    });
</script>