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
        margin-bottom: 0;
    }
    form#updatepartener div
    {
        width:50%;
        margin-bottom: 15px;
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
        font-weight: bold;
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
        <p>Denumire Firma</p>
        <span><?php echo $nume; ?></span>
    </div>
    <div>
        <p>Persoana contact</p>
        <span><?php echo $persoana_contact; ?></span>
    </div>
    <div>
        <p>CUI</p>
        <span><?php echo $cui; ?></span>
    </div>
    <div>
        <p>Telefon</p>
        <span><?php echo $telefon; ?></span>
    </div>
    <div>
        <p>RC (J)</p>
        <span><?php echo $rc; ?></span>
    </div>
    <div>
        <p>Email</p>
        <span><?php echo $email; ?></span>
    </div>
    <div>
        <p>Adresa</p>
        <span><?php echo $adresa; ?></span>
    </div>
    <div></div>
    <div>
        <p>Oras</p>
        <span><?php echo $oras; ?></span>
    </div>
    <div></div>
    <div>
        <p>Judet</p>
        <span><?php echo $judet; ?></span>
    </div>
    <div></div>
    <div>
        <p>Banca</p>
        <span><?php echo $banca; ?></span>
    </div>
    <div></div>
    <div>
        <p>Cont Bancar</p>
        <span><?php echo $cont_bancar; ?></span>
    </div>
    <div style="display: flex; align-items: flex-end;">
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