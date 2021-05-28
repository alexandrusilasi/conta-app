<?php

include 'db.php';
$id_produs = $_POST['id_produs'];
try {
    $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
    $date = $dbh -> query("SELECT * FROM produse WHERE ID = '$id_produs'");
    
    foreach($date as $row)
    {
        $nume = $row['nume'];
        $pret = $row['pret'];
        $stoc = $row['stoc'];
        $descriere = $row['descriere'];
        $id_cat = $row['id_cat'];
    }
    
    $dbh = null;
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>
<style>
    form#editprodus
    {
        width: 100%;
    }
</style>
<div style="text-align:right">
    <button type="button" class="btn btn-primary popupclose"><i class="fas fa-times"></i></button>
</div>
<form id="editprodus">
    <div>
        <p>Nume Produs</p>
        <input type="text" name="nume" value="<?php echo $nume; ?>" required />
    </div>
    <div>
        <p>Categorie Produs</p>
        <select name="id_cat" required>
            <?php
            try {
                $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                
                $current = $dbh -> query("SELECT * FROM categorii WHERE ID = '$id_cat'");
                foreach($current as $rowcurrent)
                {
                    ?>
                    <option value="<?php echo $id_cat; ?>"><?php echo $rowcurrent['nume']; ?></option>
                    <?php
                }
                
                $cats = $dbh -> query("SELECT * FROM categorii WHERE ID != '$id_cat'");
                foreach($cats as $rowcats)
                {
                    ?>
                    <option value="<?php echo $rowcats['ID']; ?>"><?php echo $rowcats['nume']; ?></option>
                    <?php
                }
                
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </select>
    </div>
    <div>
        <p>Pret Produs</p>
        <input type="number" name="pret" value="<?php echo $pret; ?>" min="0" step="0.01" required />
    </div>
    <div>
        <p>Stoc Produs</p>
        <input type="number" name="stoc" value="<?php echo $stoc; ?>" min="0" step="1" required />
    </div>
    <div>
        <p>Descriere Produs</p>
        <textarea name="descriere"><?php echo $descriere; ?></textarea>
    </div>
    <div style="text-align: right;">
        <input type="hidden" name="id_produs" value="<?php echo $id_produs; ?>" />
        <button type="submit" class="btn btn-primary"><i class="fas fa-sync"></i> Actualizare Produs</button>
    </div>
</form>
<script>
    $(document).ready(function(){
        $("form#editprodus").on("submit", function(e){
            e.preventDefault();
            $.ajax({
                url: 'editprodusedo.php',
                type: 'post',
                data: $(this).serialize(),
                success: function(d)
                {
                    alert(d);
                    $("div.produse").load("afisareproduse.php");
                }
            });
        });
        $("button.popupclose").on("click", function(){
            $("div.popupwrapper").fadeOut();
        });
    });
</script>