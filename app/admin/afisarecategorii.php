<table class="table table-striped" style="margin-top: 15px;">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">#</th>
      <th scope="col" style="width: 75%;">Nume Categorie</th>
      <th scope="col" style="width: 20%;">Actiune</th>
    </tr>
  </thead>
  <tbody>
      <?php
      
      include 'db.php';
      try {
        $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        $crt = 1;
        $mijloc = $dbh -> query("SELECT * FROM categorii ORDER BY nume ASC");
        foreach($mijloc as $row)
        {
            ?>
            <tr>
                <td><?php echo $crt; ?></td>
                <td><?php echo $row['nume']; ?></td>
                <td data-id="<?php echo $row['ID']; ?>"><button type="button" class="btn btn-primary edit"><i class="fas fa-pencil-alt"></i> Editeaza</button> <button type="button" class="btn btn-danger delete"><i class="fas fa-trash"></i> Sterge</button></td>
            </tr>
            <?php
            $crt++;
        }
        
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
      
      ?>
  </tbody>
</table>
<style>
    div.editmijlocformwrapper
    {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: none;
    }
    div.editmijlocformwrapper div.editformwrapper
    {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    div.editmijlocformwrapper div.editformwrapper div.formedit
    {
        padding: 15px;
        background: #f5f5f5;
        border-radius: 15px;
    }
</style>
<div class="editmijlocformwrapper">
    <div class="editformwrapper">
        <div class="formedit">
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
   $("button.edit").on("click", function(){
        var id_mijloc = $(this).parent().data("id");
        $.ajax({
            url: 'editcat.php',
            type: 'post',
            data:{id_mijloc:id_mijloc},
            success: function(d)
            {
                $("div.editmijlocformwrapper div.formedit").html(d);
                $("div.editmijlocformwrapper").fadeIn();
            }
        });
    });
    $("button.delete").on("click", function(){
        var id_cont = $(this).parent().data("id");
        if(confirm("Sigur stergeti categoria?"))
        {
            $.ajax({
                url: 'stergecat.php',
                type: 'post',
                data: {id_cont:id_cont},
                success: function(d)
                {
                    alert(d);
                    $("div.categorii").load("afisarecategorii.php");
                }
            });   
        }
    });
});
</script>