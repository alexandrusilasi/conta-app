<div style="text-align: right;">
    <button type="button" class="btn btn-primary editclose fa-2x"><i class="fas fa-times"></i></button>
</div>
<style>
    form#edit
    {
        width: 500px;
        max-width: 100%;
    }
    form#edit div:not(:first-of-type)
    {
        margin-top: 15px;
    }
    form#edit p
    {
        margin-bottom: 0;
    }
    form#edit input
    {
        padding: 5px 15px;
        border: 1px solid #ddd;
        display: block;
        width: 100%;
        border-radius: 5px;
    }
</style>
<form id="edit">
<?php

include 'db.php';

$id_mijloc = $_POST['id_mijloc'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $mijloc = $dbh -> query("SELECT * FROM categorii WHERE ID = '$id_mijloc'");
  foreach($mijloc as $row)
  {
    ?>
    <div>
        <p>Nume Categorie</p>
        <input type="text" name="nume_cat" value="<?php echo $row['nume']; ?>" required />
    </div>
    <div style="text-align: right;">
        <input type="hidden" name="id_cat" value="<?php echo $id_mijloc; ?>" />
        <button type="submit" class="btn btn-primary"><i class="fas fa-sync"></i> Actualizare</button>
    </div>
    <?php
  }
  
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>
</form>
<script>
    $(document).ready(function(){
        $("button.editclose").on("click", function(){
            $("div.editmijlocformwrapper").fadeOut();
        });
        $("form#edit").on("submit", function(e){
            e.preventDefault();
            $.ajax({
                url: 'editcatdo.php',
                type: 'post',
                data: $(this).serialize(),
                success: function(d)
                {
                    alert(d);
                    location.reload(true);
                }
            });
        });
    });
</script>