<?php

include 'db.php';

$id_partener = $_POST['id_partener'];

try {
  $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  
  $date = $dbh -> query("SELECT * FROM parteneri WHERE ID = '$id_partener'");
  foreach($date as $row)
  {
      $nume = $row['nume'];
      $email = $row['email'];
      $tel = $row['telefon'];
      $oras = $row['oras'];
      $judet = $row['judet'];
      $adresa = $row['adresa'];
      $cui = $row['cui'];
      $rc = $row['rc'];
      $banca = $row['banca'];
      $telefon = $row['telefon'];
      $cont_bancar = $row['cont_bancar'];
      $persoana_contact = $row['persoana_contact'];
  }
  
}
catch(PDOException $e) {
  echo $e->getMessage();
}

?>
<style>
    form#updatepartener
    {
        display: flex;
        flex-wrap: wrap;
        width: 500px;
        max-width: 100%;
    }
    form#updatepartener h6
    {
        text-align: center;
        margin-bottom: 15px;
    }
    form#updatepartener div
    {
        width:50%;
    }
    form#updatepartener div:nth-of-type(2n)
    {
        padding-left: 10px;
    }
    form#updatepartener div:nth-of-type(2n+1)
    {
        padding-right: 10px;
    }
    form#updatepartener p
    {
        margin:0;
    }
    form#updatepartener input
    {
        display: block;
        width: 100%;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
</style>
<div style="text-align: right;" class="editclose">
    <button type="button" class="btn btn-primary"><i class="fas fa-times"></i></button>
</div>
<form id="updatepartener">
    <div><h6>DATE FIRMA</h6></div>
    <div><h6>DATE CONTACT</h6></div>
    <div>
        <p>Denumire Firma<sup>*</sup></p>
        <input type="text" name="nume" required value="<?php echo $nume; ?>" autocomplete="off" >
    </div>
    <div>
        <p>Persoana contact</p>
        <input type="text" name="persoana_contact" value="<?php echo $persoana_contact; ?>" autocomplete="off">
    </div>
    <div>
        <p>CUI<sup>*</sup></p>
        <input type="text" name="cui" required value="<?php echo $cui; ?>" autocomplete="off">
    </div>
    <div>
        <p>Telefon</p>
        <input type="text" name="telefon" value="<?php echo $telefon; ?>" autocomplete="off">
    </div>
    <div>
        <p>RC (J)</p>
        <input type="text" name="rc" value="<?php echo $rc; ?>" autocomplete="off">
    </div>
    <div>
        <p>Email</p>
        <input type="email" name="email" value="<?php echo $email; ?>" autocomplete="off">
    </div>
    <div>
        <p>Adresa</p>
        <input type="text" name="adresa" value="<?php echo $adresa; ?>" autocomplete="off">
    </div>
    <div></div>
    <div>
        <p>Oras</p>
        <input type="text" name="oras" value="<?php echo $oras; ?>" autocomplete="off">
    </div>
    <div></div>
    <div>
        <p>Judet</p>
        <input type="text" name="judet" value="<?php echo $judet; ?>" autocomplete="off">
    </div>
    <div></div>
    <div>
        <p>Banca</p>
        <input type="text" name="banca" value="<?php echo $banca; ?>" autocomplete="off">
    </div>
    <div></div>
    <div>
        <p>Cont Bancar</p>
        <input type="text" name="cont_bancar" value="<?php echo $cont_bancar; ?>" autocomplete="off">
    </div>
    <div style="display: flex; align-items: flex-end; justify-content: flex-end;">
        <input type="hidden" name="id_partener" value="<?php echo $id_partener; ?>" />
        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i> Salveaza Modificarile</button>
    </div>
</form>
<script>
    $(document).ready(function(){
        $("form#updatepartener").on("submit", function(e){
            e.preventDefault();
            $.ajax({
url: 'updatepartener.php',
type: 'post',
data: $(this).serialize(),
success: function(d)
{
    if(d == 'Date actualizate')
    {
        alert(d);
        $("div.editformwrapper").fadeOut();
        $("div.parteneriwrapper").load("afisareparteneri.php");
    }
    else
    {
        alert(d);
    }
}
            });
        });
        $("div.editclose button").on("click", function(){
            $("div.editformwrapper").fadeOut();
        });
    });
</script>