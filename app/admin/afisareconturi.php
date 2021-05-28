<table class="table table-striped" style="margin-top: 15px;">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">#</th>
      <th scope="col" style="width: 15%;">Nume</th>
      <th scope="col" style="width: 15%;">Email</th>
      <th scope="col" style="width: 15%;">Parola</th>
      <th scope="col" style="width: 15%;">Tip Cont</th>
      <th scope="col">Actiune</th>
    </tr>
  </thead>
  <tbody>
      <?php
      
      include 'db.php';
      try {
        $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        $crt = 1;
        $mijloc = $dbh -> query("SELECT * FROM conturi");
        foreach($mijloc as $row)
        {
            ?>
            <tr>
                <td><?php echo $crt; ?></td>
                <td><?php echo $row['nume']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>*****</td>
                <td>
                    <?php
                    
                    if($row['tip'] == 0)
                    {
                        echo "Administrator";
                    }
                    elseif($row['tip'] == 1)
                    {
                        echo "Agent";
                    }
                    
                    ?>
                </td>
                <td data-id="<?php echo $row['ID']; ?>"><button type="button" class="btn btn-primary edit"><i class="fas fa-pencil-alt"></i> Editeaza</button> <?php if($row['ID'] != $_COOKIE['id_admin']) {?><button type="button" class="btn btn-danger delete"><i class="fas fa-trash"></i> Sterge</button><?php } ?></td>
            </tr>
            <?php
            $crt++;
        }
        
        $admin = $dbh -> query("SELECT * FROM admin");
        foreach($admin as $row2)
        {
            ?>
            <tr style="display: none;">
                <td><?php echo $crt; ?></td>
                <td><?php echo $row2['nume']; ?></td>
                <td><?php echo $row2['email']; ?></td>
                <td>*****</td>
                <td>Administrator</td>
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
            url: 'editcont.php',
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
        if(confirm("Sigur stergeti contul?"))
        {
            $.ajax({
                url: 'stergecont.php',
                type: 'post',
                data: {id_cont:id_cont},
                success: function(d)
                {
                    alert(d);
                    $("div.conturi").load("afisareconturi.php");
                }
            });   
        }
    });
});
</script>