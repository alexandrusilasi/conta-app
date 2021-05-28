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
        div.formwrapper form select:hover,
        div.formwrapper form textarea:hover,
        div.popupwrapper form textarea:hover
        {
            border: 1px solid #7aacfa;   
        }
        div.formwrapper form input:focus,
        div.popupwrapper form input:focus,
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
    </style>
    <div class="row">
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" style="padding-top: 15px;">
            <p><a href="/">Acasa</a> > Documente Intrare</p>
            <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i> Inapoi</button></a>
            <table class="table table-striped" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Partener</th>
                        <th scope="col">Data</th>
                        <th scope="col">Incasat</th>
                        <th scope="col">Factura</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            
            include 'db.php';
            
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE platit = '0'");
            $doc = 1;
            foreach($docs as $row)
            {
                ?>
                <tr>
                    <td><?php echo $doc; ?></td>
                    <td><?php
                        $id_partener = $row['partener']; 
                        
                        $nume_partener = $dbh -> query("SELECT * FROM parteneri WHERE ID = '$id_partener'");
                        foreach($nume_partener as $rowp)
                        {
                            echo $rowp['nume'];
                        }
                        
                        ?>
                    </td>
                    <td><?php echo date("d.m.Y H:i:s", $row['data_ora']); ?></td>
                    <td><span style="color: green;"><?php echo number_format($row['incasat'],2,",","."); ?> lei</span></td>
                    <td><a href="docs/<?php echo $row['chitanta_factura']; ?>" download><button type="button" class="btn btn-primary"><i class="fas fa-download"></i> Descarca documentul</button></a></td>
                </tr>
                <?php
                $doc++;
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