<?php

include 'header.php';

?>
    <style>
        div.formwrapper
        {
            margin-top: 15px;
        }
        div.formwrapper form
        {
            width: 600px;
            max-width: 100%;
            margin: auto;
            background: #f5f5f5;
            padding: 15px;
            border-radius: 15px;
        }
        div.formwrapper form div:not(:first-of-type)
        {
            margin-top: 15px;
        }
        div.formwrapper form p
        {
            margin:0;
            padding: 0;
        }
        div.formwrapper form input
        {
            display: block;
            width: 100%;
            padding: 5px 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: all 0.3s ease-out;
        }
        div.formwrapper form input:hover
        {
            border: 1px solid #7aacfa;   
        }
        div.formwrapper form input:focus
        {
            border: 1px solid #4287f5;
        }
        div.parteneriwrapper
        {
            padding-top: 15px;
        }
    </style>
    <div class="row">
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" style="padding-top: 15px;">
            <p><a href="/">Acasa</a> > Setari Companie</p>
            <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i> Inapoi</button></a>
            <?php
            
            include 'db.php';
            
            try {
                $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                
                $date = $dbh -> query("SELECT * FROM datefirma");
                foreach($date as $row)
                {
                    $nume = $row['nume'];
                    $adresa = $row['adresa'];
                    $oras = $row['oras'];
                    $judet = $row['judet'];
                    $email = $row['email'];
                    $cui = $row['cui'];
                    $rc = $row['rc'];
                    $banca = $row['banca'];
                    $cont1 = $row['cont1'];
                    $cont2 = $row['cont2'];
                    $cont3 = $row['cont3'];
                    $logo = $row['logo'];
                    $capital_social = $row['capital_social'];
                    $telefon = $row['telefon'];
                }
                
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            
            ?>
            <div class="formwrapper">
                <form id="adaugapartener">
                    <div>
                        <p>Denumire Companie<sup>*</sup></p>
                        <input type="text" name="nume" value="<?php echo $nume; ?>" required >
                    </div>
                    <div>
                        <p>CUI<sup>*</sup></p>
                        <input type="text" name="cui" value="<?php echo $cui; ?>" required>
                    </div>
                    <div>
                        <p>Registrul Comertului<sup>*</sup></p>
                        <input type="text" name="rc" value="<?php echo $rc; ?>" required>
                    </div>
                    <div>
                        <p>Adresa<sup>*</sup></p>
                        <input type="text" name="adresa" value="<?php echo $adresa; ?>" required>
                    </div>
                    <div>
                        <p>Oras<sup>*</sup></p>
                        <input type="text" name="oras" value="<?php echo $oras; ?>" required>
                    </div>
                    <div>
                        <p>Judet<sup>*</sup></p>
                        <input type="text" name="judet" value="<?php echo $judet; ?>" required>
                    </div>
                    <div>
                        <p>Banca<sup>*</sup></p>
                        <input type="text" name="banca" value="<?php echo $banca; ?>" required>
                    </div>
                    <div>
                        <p>Cont bancar 1<sup>*</sup></p>
                        <input type="text" name="cont1" value="<?php echo $cont1; ?>" required>
                    </div>
                    <div>
                        <p>Cont bancar 2</p>
                        <input type="text" name="cont2" value="<?php echo $cont2; ?>" >
                    </div>
                    <div>
                        <p>Cont bancar 3</p>
                        <input type="text" name="cont3" value="<?php echo $cont3; ?>" >
                    </div>
                    <div>
                        <p>Capital Social<sup>*</sup></p>
                        <input type="text" name="capital_social" value="<?php echo $capital_social; ?>" placeholder="Exemplu: 200.00 RON" required >
                    </div>
                    <div>
                        <p>Telefon</p>
                        <input type="text" name="telefon" value="<?php echo $telefon; ?>" >
                    </div>
                    <div>
                        <p>Email</p>
                        <input type="email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div>
                        <p>Logo</p>
                        <?php
                        if($logo != '')
                        {
                            ?>
                            <img src="imgs/<?php echo $logo; ?>" alt="logo companie" class="logocompanie" style="max-width: 300px; display: block;" />
                            <button type="button" class="btn btn-danger stergeimaginea" style="margin-top: 15px; margin-bottom: 15px;"><i class="fas fa-trash"></i> Sterge imaginea</button>
                            <input type="file" name="logocompanie" />
                            <?php
                        }
                        else
                        {
                            ?>
                            <img src="placeholder.png" alt="logo companie" class="logocompanie" style="max-width: 300px; display: block;" />
                            <input type="file" name="logocompanie" />
                            <?php
                        }
                        ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i> Actualizare date</button>
                    </div>
                </form>
            </div>
            <div class="parteneriwrapper"></div>
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
    <script>
        $(document).ready(function(){
            $("form#adaugapartener").on("submit", function(e){
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'datefirmado.php',
                    type: 'post',
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(d)
                    {
                        alert(d);
                        location.reload(true);
                    }
                });
            });
            $("button.stergeimaginea").on("click", function(){
                var sterge = 1;
                $.ajax({
                    url: 'datefirmado.php',
                    type: 'post',
                    data:{sterge:sterge},
                    success: function(d)
                    {
                        $("button.stergeimaginea").hide();
                        $("img.logocompanie").attr('src', 'placeholder.png');
                        $("div.logowrapper img").attr('src', 'placeholder.png');
                        alert(d);
                    }
                });
            });
        });
    </script>
<?php

include 'footer.php';

?>