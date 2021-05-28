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
            display: flex;
            flex-wrap: wrap;
        }
        div.formwrapper form h6
        {
            text-align: center;
            margin-bottom: 15px;   
        }
        div.formwrapper form div
        {
            width: 50%;
        }
        div.formwrapper form div:nth-of-type(2n+1)
        {
            padding-right: 10px;
        }
        div.formwrapper form div:nth-of-type(2n)
        {
            padding-left: 10px;
        }
        div.formwrapper form div:last-of-type
        {
            margin-top: 15px;
        }
        div.formwrapper form p
        {
            margin:0;
            padding: 0;
        }
        div.formwrapper form input,
        input
        {
            display: block;
            width: 100%;
            padding: 5px 15px;
            border-radius: 0px 5px 5px 0px;
            border: 1px solid #ddd;
            transition: all 0.3s ease-out;
        }
        div.formwrapper form input:hover,
        input:hover
        {
            border: 1px solid #7aacfa;   
        }
        div.formwrapper form input:focus,
        input:focus
        {
            border: 1px solid #4287f5;
            outline: 0;
        }
        div.formwrapper form button
        {
            vertical-align: top;
        }
        div.parteneriwrapper
        {
            padding-top: 20px;
        }
        div.searchwrapper
        {
            display: flex;
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
            <p><a href="/">Acasa</a> > Parteneri</p>
            <div style="display: flex; flex-wrap: wrap; align-items: flex-end;">
                <div style="width: 7%;">
                    <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i> Inapoi</button></a>
                </div>
                <div style="width: 30%;" class="searchwrapper">
                    <div>
                        <i class="fa fa-search"></i>
                    </div>
                    <input type="text" id="cautare" placeholder="Cautati..." />
                </div>
                <div style="width: 63%; text-align: right;">
                    <button type="button" class="btn btn-success adaugapartener"><i class="fas fa-plus"></i> Adauga Firma</button>
                </div>
            </div>
            <div class="formwrapper">
                <form id="adaugapartener">
                    <div><h6>DATE FIRMA</h6></div>
                    <div><h6>DATE CONTACT</h6></div>
                    <div>
                        <p>Denumire Firma<sup>*</sup></p>
                        <input type="text" name="nume" required autocomplete="off" >
                    </div>
                    <div>
                        <p>Persoana contact</p>
                        <input type="text" name="persoana_contact" autocomplete="off">
                    </div>
                    <div>
                        <p>CUI<sup>*</sup></p>
                        <input type="text" name="cui" required autocomplete="off">
                    </div>
                    <div>
                        <p>Telefon</p>
                        <input type="text" name="telefon" autocomplete="off">
                    </div>
                    <div>
                        <p>RC (J)</p>
                        <input type="text" name="rc" autocomplete="off">
                    </div>
                    <div>
                        <p>Email</p>
                        <input type="email" name="email" autocomplete="off">
                    </div>
                    <div>
                        <p>Adresa</p>
                        <input type="text" name="adresa" autocomplete="off">
                    </div>
                    <div></div>
                    <div>
                        <p>Oras</p>
                        <input type="text" name="oras" autocomplete="off">
                    </div>
                    <div></div>
                    <div>
                        <p>Judet</p>
                        <input type="text" name="judet" autocomplete="off">
                    </div>
                    <div></div>
                    <div>
                        <p>Banca</p>
                        <input type="text" name="banca" autocomplete="off">
                    </div>
                    <div></div>
                    <div>
                        <p>Cont Bancar</p>
                        <input type="text" name="cont_bancar" autocomplete="off">
                    </div>
                    <div style="display: flex; align-items: flex-end; justify-content: flex-end;">
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Adauga Firma</button>
                    </div>
                </form>
            </div>
            <div class="parteneriwrapper"></div>
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
    <script>
        $(document).ready(function(){
            $("div.parteneriwrapper").load("afisareparteneri.php");
            $("button.adaugapartener").on("click", function(){
                $("div.formwrapper").slideToggle();
            });
            $("form#adaugapartener").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: 'adaugapartener.php',
                    type: 'post',
                    data: $(this).serialize(),
                    success: function(d)
                    {
                        alert(d);
                        $("form#adaugapartener")[0].reset();
                        $("div.parteneriwrapper").load("afisareparteneri.php");
                    }
                });
            });
            $("input#cautare").on("keyup", function(){
                var cautare = $(this).val();
                $.ajax({
                    url: 'afisareparteneri.php',
                    type: 'post',
                    data: {cautare:cautare},
                    success: function(d)
                    {
                        $("div.parteneriwrapper").html(d);
                    }
                });
            });
        });
    </script>
<?php

include 'footer.php';

?>