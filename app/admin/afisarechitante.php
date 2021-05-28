<table class="table table-striped" style="margin-top: 15px;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Partener</th>
      <th scope="col">Suma incasata</th>
      <th scope="col">Suma platita</th>
      <th scope="col">Tip Document</th>
      <th scope="col">Data</th>
      <th scope="col">Actiune</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
    include 'db.php';
    $id_partener = $_POST['partener'];
    $data1 = strtotime($_POST['data1']);
    $data2 = strtotime($_POST['data2']);
    $doc = $_POST['doc'];
    try {
        $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        $nrcrt = 1;
        $ti = 0;
        $tp = 0;
        if($id_partener == '' && $data1 == '' && $data2 == '' && $doc == '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante ORDER BY ID DESC");   
        }
        
        if($id_partener != '' && $data1 == '' && $data2 == '' && $doc == '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE partener = '$id_partener'");   
        }
        
        if($id_partener != '' && $data1 != '' && $data2 == '' && $doc == '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE partener = '$id_partener' AND '$data1' <= data_ora");   
        }
        
        if($id_partener != '' && $data1 != '' && $data2 != '' && $doc == '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE partener = '$id_partener' AND '$data1' <= data_ora AND data_ora <= '$data2'");   
        }
        
        if($id_partener == '' && $data1 != '' && $data2 != '' && $doc == '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE '$data1' <= data_ora AND data_ora <= '$data2'");   
        }
        
        if($id_partener == '' && $data1 == '' && $data2 == '' && $doc != '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE tip = '$doc' ORDER BY ID DESC");   
        }
        
        if($id_partener != '' && $data1 == '' && $data2 == '' && $doc != '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE partener = '$id_partener' AND tip = '$doc'");   
        }
        
        if($id_partener != '' && $data1 != '' && $data2 == '' && $doc != '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE partener = '$id_partener' AND '$data1' <= data_ora AND tip = '$doc'");   
        }
        
        if($id_partener != '' && $data1 != '' && $data2 != '' && $doc != '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE partener = '$id_partener' AND '$data1' <= data_ora AND data_ora <= '$data2' AND tip = '$doc'");   
        }
        
        if($id_partener == '' && $data1 != '' && $data2 == '' && $doc != '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE '$data1' <= data_ora AND tip = '$doc'");   
        }
        
        if($id_partener == '' && $data1 == '' && $data2 != '' && $doc != '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE data_ora <= '$data2' AND tip = '$doc'");   
        }
        
        if($id_partener == '' && $data1 != '' && $data2 != '' && $doc != '')
        {
            $docs = $dbh -> query("SELECT * FROM facturi_chitante WHERE '$data1' <= data_ora AND data_ora <= '$data2' AND tip = '$doc'");   
        }
        foreach($docs as $row)
        {
            $ti = $ti + $row['incasat'];
            $tp = $tp + $row['platit'];
            ?>
            <tr>
                <td>
                    <?php echo $nrcrt; ?>
                </td>
                <td>
                    <?php $id_partener = $row['partener']; 
                    
                    $nume = $dbh -> query("SELECT * FROM parteneri WHERE ID = '$id_partener'");
                    foreach($nume as $rownume)
                    {
                        echo $rownume['nume'];
                    }
                    
                    ?>
                </td>
                <td>
                    <span style="color: green;"><?php echo $row['incasat']; ?></span>
                </td>
                <td>
                    <span style="color: #dc3545;"><?php echo $row['platit']; ?></span>
                </td>
                <td>
                    <?php echo date("d.m.Y H:i:s", $row['data_ora']); ?>
                </td>
                <td>
                    <?php echo ucfirst($row['tip']); ?>                
                </td>
                <td>
                    <a href="docs/<?php echo $row['chitanta_factura']; ?>" target="_blank"><button type="button" class="btn btn-success"><i class="fas fa-eye"></i> Vezi documentul</button></a>
                </td>
            </tr>
            <?php
            $nrcrt++;
        }
        
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    
    ?>
    <tr>
        <td></td>
        <td></td>
        <td><strong style="color: green;">Total incasat: <?php echo $ti; ?></strong></td>
        <td><strong style="color: #dc3545;">Total platit: <?php echo $tp; ?></strong></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
  </tbody>
</table>