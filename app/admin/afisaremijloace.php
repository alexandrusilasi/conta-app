<table class="table table-striped" style="margin-top: 15px;">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">#</th>
      <th scope="col" style="width: 25%;">Nume mijloc</th>
      <th scope="col" style="width: 10%;">Cantitate</th>
      <th scope="col" style="width: 10%;">Nr. Inventar</th>
      <th scope="col" style="width: 10%;">Data adaugarii</th>
      <th scope="col">Actiune</th>
    </tr>
  </thead>
  <tbody>
      <?php
      
      include 'db.php';
      try {
        $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        $crt = 1;
        
        $cautare = $_POST['cautare'];
        if($cautare == '')
        {
            $mijloc = $dbh -> query("SELECT * FROM mijloace");
        }
        elseif($cautare != '')
        {
            $mijloc = $dbh -> query("SELECT * FROM mijloace WHERE nume LIKE '%$cautare%' OR cantitate LIKE '%$cautare%' OR numar_inventar LIKE '%$cautare%' OR data_adaugarii LIKE '%$cautare%'");
        }
        
        foreach($mijloc as $row)
        {
            ?>
            <tr>
                <td><?php echo $crt; ?></td>
                <td><?php echo $row['nume']; ?></td>
                <td><?php echo $row['cantitate']; ?></td>
                <td><?php echo $row['numar_inventar']; ?></td>
                <td><?php echo date("d.m.Y", $row['data_adaugarii']); ?></td>
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
    $("button.edit").on("click", function(){
        var id_mijloc = $(this).parent().data("id");
        $.ajax({
            url: 'editmijloc.php',
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
        if(confirm("Sigur stergeti mijlocul?"))
        {
            var id_mijloc = $(this).parent().data("id");
            $.ajax({
                url: 'stergemijloc.php',
                type: 'post',
                data:{id_mijloc:id_mijloc},
                success: function(d)
                {
                    alert(d);
                    $("div.mijloace").load("afisaremijloace.php");
                }
            });   
        }
    });
</script>