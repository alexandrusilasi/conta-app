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
        div.formwrapper form select:hover,
        div.formwrapper form textarea:hover,
        div.popupwrapper form textarea:hover
        {
            border: 1px solid #7aacfa;   
        }
        div.formwrapper form input:focus,
        div.popupwrapper form input:focus,
        input:focus,
        div.formwrapper form select:focus,
        div.formwrapper form textarea:focus,
        div.popupwrapper form textarea:focus
        {
            border: 1px solid #4287f5 !important;
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
            border: 1px solid #ddd;
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
            <p><a href="/">Acasa</a> > Mijloace Fixe</p>
            <div style="display: flex; flex-wrap: wrap; align-items: flex-end;">
                <div style="width: 7%;">
                    <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i> Inapoi</button></a>
                </div>
                <div style="width: 30%;" class="searchwrapper">
                    <div>
                        <i class="fa fa-search"></i>
                    </div>
                    <input type="text" id="cautare" placeholder="Cautare..." />
                </div>
                <div style="width: 63%; text-align: right;" class="add">
                    <button type="button" class="btn btn-success adaugapartener" style="margin-right: 10px;"><i class="fas fa-plus"></i> Adauga Mijloc</button>
                </div>
            </div>
            <div class="formwrapper">
                <form id="adaugaprodus">
                    <div>
                        <p>Nume Mijloc Fix</p>
                        <input type="text" name="nume" required>
                    </div>
                    <div>
                        <p>Cantitate</p>
                        <input type="number" name="cantitate" min="0" step="1" required>
                    </div>
                    <div>
                        <p>Nr. Inventar</p>
                        <input type="number" name="nr_inventar" min="0" step="1" required>
                    </div>
                    <div style="text-align: right;">
                        <?php
                        date_default_timezone_set("Europe/Bucharest");
                        $data = strtotime(date("d.m.Y H:i:s"));
                        ?>
                        <input type="hidden" name="data" value="<?php echo $data; ?>" />
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
            <div class="mijloace"></div>
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
    <script>
        $(document).ready(function(){
            $("div.mijloace").load("afisaremijloace.php");
            $("div.add > button").on("click", function(){
                $("div.formwrapper").slideToggle();
            });
            $("form#adaugaprodus").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: 'adaugamijloc.php',
                    data: $(this).serialize(),                         
                    type: 'post',
                    success: function(d){
                        alert(d);
                        $("form#adaugaprodus")[0].reset();
                        $("div.mijloace").load("afisaremijloace.php");
                    }
                });
            });
            $("input#cautare").on("keyup", function(){
                var cautare = $(this).val();
                $.ajax({
                    url: 'afisaremijloace.php',
                    type: 'post',
                    data: {cautare:cautare},
                    success: function(d)
                    {
                        $("div.mijloace").html(d);
                    }
                });
            });
        });
    </script>
<?php

include 'footer.php';

?>