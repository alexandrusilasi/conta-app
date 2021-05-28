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
            display: inline-block;
            width: auto;
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
            border: 1px solid #4287f5;
        }
        div.parteneriwrapper
        {
            padding-top: 15px;
        }
        span.stocreal.green
        {
            color: green;
        }
        span.stocreal.red
        {
            color: #b30202;
        }
    </style>
    <div class="row">
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" style="padding-top: 15px;">
            <p><a href="/">Acasa</a> > Inventar</p>
            <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i> Inapoi</button></a>
            <table class="table table-striped" id="stoc" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 15%;">Categorie</th>
                        <th scope="col" style="width: 20%;">Produs</th>
                        <th scope="col" style="width: 25%;">Cantitate</th>
                        <th scope="col">Rezultat</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            
            include 'db.php';
            
            $categorii = $dbh -> query("SELECT * FROM categorii ORDER BY nume ASC");
            $crt = 1;
            foreach($categorii as $row)
            {
                $id_categorie = $row['ID'];
                $produse = $dbh -> query("SELECT * FROM produse WHERE id_cat = '$id_categorie' ORDER BY nume ASC");
                foreach($produse as $rowproduse)
                {
                    ?>
                    <tr>
                        <td><?php echo $crt; ?></td>
                        <td><?php echo $row['nume']; ?></td>
                        <td><?php echo $rowproduse['nume']; ?></td>
                        <td data-id="<?php echo $rowproduse['ID']; ?>"><input type="number" class="stoc" /></td>
                        <td id="<?php echo $rowproduse['ID']; ?>"><span class="stocreal"></span></td>
                    </tr>
                    <?php
                    $crt++;
                }
            }
            
            ?>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary print"><i class="fas fa-print"></i> Print Inventar</button>
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
    <script>
        $(document).ready(function(){
            $("input.stoc").on("blur", function(){
                var stoc = $(this).val();
                var id_produs = $(this).parent().data("id");
                $.ajax({
                    url: 'inventardo.php',
                    type: 'post',
                    data: {stoc:stoc , id_produs:id_produs},
                    success: function(d)
                    {
                        if(d > 0 || d == 0)
                        {
                            $("td#"+id_produs).find("span.stocreal").addClass("green");
                            $("td#"+id_produs).find("span.stocreal").text("+ "+d+" Bucati");
                        }
                        if(d < 0)
                        {
                            $("td#"+id_produs).find("span.stocreal").addClass("red");
                            $("td#"+id_produs).find("span.stocreal").text(d+" Bucati");
                        }
                    }
                });
            });
            $("button.print").on("click", function(){
                window.print();
            });
        });
    </script>
<?php

include 'footer.php';

?>