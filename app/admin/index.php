<?php
$id_admin = $_COOKIE['id_admin'];
if($id_admin)
{
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CONTA - ADMIN</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body
            {
                background: #f5f5f5;
                margin: 0;
            }
            div.loginwrapper
            {
                display: flex;
                height: 100vh;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
            }
            div.loginwrapper div.logo-wrapper
            {
                width: 100%;
                display: block;
                text-align: center;
            }
            div.loginwrapper div.logo-wrapper img
            {
                width: 100%;
                max-width: 400px;
                margin-bottom: 15px;
            }
            @media (max-width: 768px)
            {
                div.loginwrapper
                {
                    display: block !important;
                }
            }
            div.loginwrapper div.formwrapper
            {
                border: 1px solid #ddd;
                background: #fff;
                padding: 15px;
                border-radius: 15px;
            }
            div.loginwrapper div.formwrapper form
            {
                width: 500px;
                max-width: 100%;
            }
            div.loginwrapper div.formwrapper form > div
            {
                margin-top: 15px;
            }
            div.loginwrapper div.formwrapper p
            {
                margin:0;
                padding:0;
            }
            div.loginwrapper div.formwrapper input
            {
                display: block;
                width: 100%;
                padding: 5px 10px;
                border-radius: 5px;
                border: 1px solid #ddd;
            }
        </style>
    </head>
    <body>
        <div class="loginwrapper">
            <div>
            <div class="logo-wrapper">
                <?php
                
                include 'db.php';
                
                try {
                    $dbh = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
                    
                    $logo = $dbh -> query("SELECT * FROM datefirma");
                    foreach($logo as $row)
                    {
                        if($row['logo'] == '')
                        {
                            ?>
                            <img src="placeholder.png" alt="LOGO PLACE HOLDER" />
                            <?php
                        }
                        elseif($row['logo'] != '')
                        {
                            ?>
                            <img src="imgs/<?php echo $row['logo']; ?>" alt="LOGO PLACE HOLDER" />
                            <?php
                        }
                    }
                    
                }
                catch(PDOException $e) {
                    echo $e->getMessage();
                }
                
                ?>
            </div>
            <div class="formwrapper">
                <div class="form">
                    <form id="login">
                        <div>
                            <p><i class="fas fa-envelope"></i> Email</p>
                            <input type="email" name="email" />
                        </div>
                        <div>
                            <p><i class="fas fa-key"></i> Parola</p>
                            <input type="password" name="parola" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Autentificare</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $("form#login").on("submit", function(e){
                    e.preventDefault();
                    $.ajax({
                        url: 'login.php',
                        type: 'post',
                        data: $(this).serialize(),
                        success: function(d)
                        {
                            if(d == 'Date corecte!')
                            {
                                window.location.replace("dashboard.php");
                            }
                            else
                            {
                                alert(d);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>