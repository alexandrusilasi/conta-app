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
        div.formwrapper form select
        {
            display: block;
            width: 100%;
            padding: 5px 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: all 0.3s ease-out;
        }
        div.formwrapper form input:hover,
        div.formwrapper form select:hover
        {
            border: 1px solid #7aacfa;   
        }
        div.formwrapper form input:focus,
        div.formwrapper form select:focus
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
            <p><a href="/">Acasa</a> > Jurnal Operatiuni</p>
            <div style="display: flex; flex-wrap: wrap;">
                <div style="width: 50%;">
                    <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i> Inapoi</button></a>
                </div>
                <div style="width: 50%; text-align: right;" class="add">
                    <button type="button" class="btn btn-success"><i class="fas fa-plus"></i> Adauga factura/chitanta</button>
                </div>
            </div>
            <div class="formwrapper">
                <form id="adaugachitanta">
                    <div>
                        <p>Partener<sup>*</sup></p>
                        <select name="partener" required id="partener">
                            <option value="">Selectati pertenerul</option>
                        <?php
                        include 'db.php';
                        try {
                            $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                            
                            $partener = $dbh -> query("SELECT * FROM parteneri");
                            foreach($partener as $row)
                            {
                                ?>
                                <option value="<?php echo $row['ID']; ?>"><?php echo $row['nume']; ?></option>
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
                        <p>Selecteaza tipul operatiuni</p>
                        <select>
                            <option>Incasare</option>
                            <option>Plata</option>
                        </select>
                    </div>
                    <div>
                        <p>Suma</p>
                        <input type="number" name="sumaincasata" id="sumaincasata" min="0" step="1">
                    </div>
                    <div>
                        <p>Chitanta/Factura</p>
                        <input type="file" name="chitantafactura" id="chitantafactura">
                    </div>
                    <div>
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
                    width: 100%;
                    max-width: 1000px;
                }
                @media (max-width: 768px)
                {
                    form#filtru
                    {
                        flex-wrap: wrap;
                    }
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
            <form id="filtru">
                <div>
                    <p>Partener</p>
                    <select name="partener">
                        <option value="">Selectati partener</option>
                        <?php
                        try {
                            $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                            
                            $partener2 = $dbh -> query("SELECT * FROM parteneri");
                            foreach($partener2 as $row2)
                            {
                                ?>
                                <option value="<?php echo $row2['ID']; ?>"><?php echo $row2['nume']; ?></option>
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
                    <p>Tip document</p>
                    <select name="doc">
                        <option value="">Selectati tipul de document</option>
                        <option value="proforma">Proforma</option>
                        <option value="factrura">Factura</option>
                        <option value="chitanta">Chitanta</option>
                    </select>
                </div>
                <div>
                    <p>Incepand cu data de</p>
                    <input type="date" name="data1" />
                </div>
                <div>
                    <p>Pana la data de</p>
                    <input type="date" name="data2" />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i> Vezi rezultate</button>
                </div>
            </form>
            <div class="istoric"></div>
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
    <script>
        $(document).ready(function(){
            $("div.istoric").load("afisarechitante.php");
            $("div.add button").on("click", function(){
                $("div.formwrapper").slideToggle();
            });
            $("form#adaugachitanta").on("submit", function(e){
                e.preventDefault();
                var file_data = $('#chitantafactura').prop('files')[0];   
                var form_data = new FormData();                  
                form_data.append('imagine', file_data);
                form_data.append('partener', $("#partener").val());
                form_data.append('sumaincasata', $("#sumaincasata").val());
                form_data.append('sumaplatita', $("#sumaplatita").val());
                $.ajax({
                    url: 'adaugachitanta.php',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(d){
                        alert(d);
                        $("form#adaugachitanta")[0].reset();
                        $("div.istoric").load("afisarechitante.php");
                    }
                });
            });
            $("form#filtru").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: 'afisarechitante.php',
                    type: 'post',
                    data: $(this).serialize(),
                    success: function(d)
                    {
                        $("div.istoric").html(d);
                    }
                });
            });
        });
    </script>
<?php

include 'footer.php';

?>