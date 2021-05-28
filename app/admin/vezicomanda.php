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
            <div style="display: flex; flex-wrap: wrap; align-items: flex-end;">
                <div style="width: 7%;">
                    <a href="listacomenzi.php"><button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i> Inapoi</button></a>
                </div>
            </div>
            <br/>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nume Produs</th>
                        <th scope="col">Cantitate</th>
                        <th scope="col">Pret/Bucata</th>
                        <th scope="col">Pret Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $id_comanda = $_GET['id_comanda'];
                    $crt = 1;
                    try {
                        $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                            
                        $produse = $dbh -> query("SELECT * FROM produse_comenzi WHERE id_comanda = '$id_comanda'");
                        foreach($produse as $row)
                        {
                            ?>
                            <tr>
                                <td><?php echo $crt; ?></td>
                                <td>
                                    <?php 
                                    
                                    $id_produs = $row['id_produs'];
                                    
                                    $date_produs = $dbh -> query("SELECT * FROM produse WHERE ID = '$id_produs'");
                                    foreach($date_produs as $rowdate)
                                    {
                                        echo $rowdate['nume'];
                                    }
                                    
                                    ?>
                                </td>
                                <td><?php echo $row['cantitate']; ?></td>
                                <td><?php echo $rowdate['pret']; ?></td>
                                <td><?php echo $rowdate['pret'] * $row['cantitate']; ?></td>
                            </tr>
                            <?php
                            $crt ++;
                        }
                    }
                    catch(PDOException $e) {
                        echo $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
<?php

include 'footer.php';

?>