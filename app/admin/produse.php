<?php

include 'header.php';

?>
    <style>
        div.formwrapper
        {
            margin-top: 15px;
            display: none;
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
        div.formwrapper form div:not(:first-of-type),
        div.popupwrapper form div:not(:first-of-type)
        {
            margin-top: 15px;
        }
        div.formwrapper form p,
        div.popupwrapper form p
        {
            margin:0;
            padding: 0;
        }
        div.formwrapper form input,
        div.popupwrapper form input,
        input,
        div.formwrapper form select,
        select,
        div.formwrapper form textarea,
        div.popupwrapper form textarea
        {
            display: block;
            width: 100%;
            padding: 5px 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: all 0.3s ease-out;
        }
        div.formwrapper form input:hover,
        div.popupwrapper form input:hover,
        input:hover,
        div.formwrapper form select:hover,,
        select:hover,
        div.formwrapper form textarea:hover,
        div.popupwrapper form textarea:hover
        {
            border: 1px solid #7aacfa;   
        }
        div.formwrapper form input:focus,
        div.popupwrapper form input:focus,
        input:focus,
        div.formwrapper form select:focus,
        select:focus,
        div.formwrapper form textarea:focus,
        div.popupwrapper form textarea:focus
        {
            border: 1px solid #4287f5;
            outline: 0;
        }
        div.parteneriwrapper
        {
            padding-top: 15px;
        }
        div.searchwrapper
        {
            display: flex;
        }
        div.searchwrapper input
        {
            border-radius: 0px 5px 5px 0px !important;
            outline: 0;
        }
        div.searchwrapper > div
        {
            display: flex;
            align-items: center;
            padding-left: 10px;
            padding-right: 10px;
            border-top: 1px solid #ddd;
            border-left: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            border-radius: 5px 0px 0px 5px;
        }
        div.searchwrapper .fa
        {
            color: #454545;
        }
    </style>
    <div class="row">
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" style="padding-top: 15px;">
            <p><a href="/">Acasa</a> > Produse</p>
            <div style="display: flex; flex-wrap: wrap; align-items: flex-end;">
                <div style="width: 7%;">
                    <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i> Inapoi</button></a>
                </div>
                <div style="width: 30%;" class="searchwrapper">
                    <div>
                        <i class="fa fa-search"></i>
                    </div>
                    <input type="text" id="cautare" placeholder="Cautare dupa nume produs..." />
                </div>
                <div style="width: 63%; text-align: right;" class="add">
                    <button type="button" class="btn btn-success adaugapartener" style="margin-right: 10px;"><i class="fas fa-plus"></i> Adauga Produs</button>
                    <a href="categorii.php"><button type="button" class="btn btn-primary"><i class="fas fa-sitemap"></i> Categorii</button></a>
                </div>
            </div>
            <div class="formwrapper">
                <form id="adaugaprodus">
                    <div>
                        <p>Denumire</p>
                        <input type="text" name="nume" required>
                    </div>
                    <div>
                        <p>Categorie</p>
                        <select name="id_cat" required>
                            <option value="">Selecteaza</option>
                            <?php
                            try {
                                $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                                
                                $cats = $dbh -> query("SELECT * FROM categorii ORDER BY nume ASC");
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
                        <p>Pret (RON)</p>
                        <input type="number" name="pret" min="0" step="0.01" required placeholder="Exemplu: 25.15">
                    </div>
                    <div>
                        <p>Stoc</p>
                        <input type="number" name="stoc" min="0" step="1" required>
                    </div>
                    <div>
                        <p>Descriere</p>
                        <textarea name="descriere"></textarea>
                    </div>
                    <div style="text-align: right;">
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Adauga</button>
                    </div>
                </form>
            </div>
            <style>
                form#filtru
                {
                    display: flex;
                    align-items: flex-end;
                    margin-top: 15px;
                    margin-bottom: 15px;
                }
                form#filtru div
                {
                    width: 100%;
                    padding-right: 15px;
                }
                form#filtru div p
                {
                    margin:0;
                }
                form#filtru div input,
                form#filtru div select
                {
                    padding: 5px 15px;
                    border: 1px solid #ddd;
                    display: block;
                    width: 100%;
                    border-radius: 5px;
                }
            </style>
            <div class="produse"></div>
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
    <script>
        $(document).ready(function(){
            $("div.produse").load("afisareproduse.php");
            $("div.add > button").on("click", function(){
                $("div.formwrapper").slideToggle();
            });
            $("form#adaugaprodus").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: 'adaugaprodus.php',
                    data: $(this).serialize(),                         
                    type: 'post',
                    success: function(d){
                        alert(d);
                        $("form#adaugaprodus")[0].reset();
                        $("div.produse").load("afisareproduse.php");
                    }
                });
            });
            $("input#cautare").on("keyup", function(){
                var cautare = $(this).val();
                $.ajax({
                    url: 'afisareproduse.php',
                    type: 'post',
                    data: {cautare:cautare},
                    success: function(d)
                    {
                        $("div.produse").html(d);
                    }
                });
            });
        });
    </script>
<?php

include 'footer.php';

?>