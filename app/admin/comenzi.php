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
        div.formwrapper form div:not(:first-of-type)
        {
            margin-top: 15px;
        }
        div.formwrapper form p
        {
            margin:0;
            padding: 0;
        }
        div.formwrapper form input,
        input,
        select,
        div.formwrapper form select,
        div.formwrapper form textarea
        {
            display: block;
            width: 100%;
            padding: 5px 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: all 0.3s ease-out;
        }
        div.formwrapper form input:hover,
        input:hover,
        select:hover,
        div.formwrapper form select:hover,
        div.formwrapper form textarea:hover
        {
            border: 1px solid #7aacfa;   
        }
        div.formwrapper form input:focus,
        div.formwrapper form select:focus,
        input:focus,
        select:focus,
        div.formwrapper form textarea:focus
        {
            border: 1px solid #4287f5;
        }
        div.parteneriwrapper
        {
            padding-top: 15px;
        }
        div.filtrewrapper
        {
            display: flex;
            align-items: flex-start;
        }
        div.filtrewrapper > *
        {
            width: 100%;
            max-width: 300px;
        }
        div.filtrewrapper div.filtre
        {
            margin-right: 15px;
        }
        div.filtrewrapper div.filtre select:not(:first-of-type)
        {
            margin-top: 15px;
        }
        div.filtrewrapper div.produse
        {
            width: 80%;
            padding-left: 15px;
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
            <p><a href="/">Acasa</a> > Comenzi</p>
            <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i> Inapoi</button></a>
            <br/><br/>
            <strong>Pentru a dauga un produs in cos, va rog tastati mai jos, numele prodsului!</strong>
            <div class="filtrewrapper">
                <div class="filtre">
                    <select id="categorie">
                        <option value="">Selecteaza categoria</option>
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
                <div class="searchwrapper">
                    <div>
                        <i class="fa fa-search"></i>
                    </div>
                    <input type="text" id="numeprodus" placeholder="Cautare dupa nume produs..." />
                </div>
            </div>
            <div class="produse"></div>
            <div class="comanda"></div>
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
    <script>
        $(document).ready(function(){
            $("div.produse").load("crearecomanda.php");
            $("div.comanda").load("comandaactiva.php");
            $("input#numeprodus").on("keyup", function(){
                var nume = $(this).val();
                var id_cat = $("select#categorie").val();
                $.ajax({
                    url: 'crearecomanda.php',
                    type: 'post',
                    data: {nume:nume , id_cat:id_cat},
                    success: function(d)
                    {
                        $("div.produse").html(d);            
                    }
                });
            });
            $("select#categorie").on("change", function(){
                var nume = $("input#numeprodus").val();
                var id_cat = $(this).val();
                $.ajax({
                    url: 'crearecomanda.php',
                    type: 'post',
                    data: {nume:nume , id_cat:id_cat},
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