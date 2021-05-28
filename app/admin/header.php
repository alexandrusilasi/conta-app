<?php
$id_admin = $_COOKIE['id_admin'];
if(!$id_admin)
{
    header ("Location: /");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CONTA - ADMIN</title>
        <style>
            header
            {
                padding-top: 15px;
                padding-bottom: 15px;
                display: flex;
                align-items: center;
                background: #51c9e4;
                color: #fff;
            }
            div.logowrapper
            {
                text-align: center;
                padding-top: 10px;
            }
            div.logowrapper img
            {
                max-width: 300px;
                padding-top: 15px;
                padding-bottom: 15px;
            }
            table th,
            table td
            {
                padding: 5px !important;
                vertical-align: middle !important;
            }
            table,
            table button
            {
                font-size: 14px !important;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            
        <header class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                Bine ai venit, 
                <?php
                
                include 'db.php';
                try {
                    $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                    
                    $nume = $dbh -> query("SELECT * FROM conturi WHERE ID = '$id_admin'");
                    foreach($nume as $row)
                    {
                        echo $row['nume'];
                    }
                }
                catch(PDOException $e) {
                    echo $e->getMessage();
                }
                ?>!
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="text-align: right">
                <a href="logout.php"><button type="button" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</button></a>
            </div>
        </header>
        <div class="row logowrapper">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php
                
                try {
                    $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                    
                    $logo = $dbh -> query("SELECT * FROM datefirma");
                    foreach($logo as $row)
                    {
                        if($row['logo'] != '')
                        {
                            ?>
                            <img src="imgs/<?php echo $row['logo']; ?>" alt="logo firma" />
                            <?php
                        }
                        else
                        {
                            ?>
                            <img src="placeholder.png" alt="logo firma" />
                            <?php
                        }
                    }
                }
                catch(PDOException $e) {
                    echo $e->getMessage();
                }
                
                ?>
            </div>
        </div>