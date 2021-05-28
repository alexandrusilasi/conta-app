<?php

include 'header.php';

?>
    <style>
        div.btnswrapper
        {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding-left: 5%;
            padding-right: 5%;
        }
        div.btnswrapper a
        {
            width: calc(20% - 40px);
            display: inline-block;
            text-align: center;
            padding: 35px 20px;
            margin: 20px;
            border-radius: 15px;
            background: #51c9e4;
            color: #fff;
            font-size: 20px;
            text-decoration: none;
            transition: all 0.3s ease-out;
        }
        @media (max-width: 768px)
        {
            div.btnswrapper a
            {
                width: calc(100% - 40px);
            }
        }
        div.btnswrapper a .fas
        {
            display: block;
            font-size: 40px;
        }
        div.btnswrapper a:hover
        {
            transform: scale(1.1);
        }
    </style>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="btnswrapper">
                <a href="parteneri.php">
                    <i class="fas fa-users"></i> Parteneri
                </a>
                <a href="documenteintrare.php">
                    <i class="fas fa-sign-in-alt"></i> Facturi Emise
                </a>
                <a href="documenteiesire.php">
                    <i class="fas fa-sign-out-alt"></i> Facturi Cheltuieli
                </a>
                <a href="istoric.php">
                    <i class="fas fa-history"></i> Jurnal Operatiuni
                </a>
                <a href="comenzi.php">
                    <i class="fas fa-money-check-alt"></i> Operatiuni
                </a>
                <a href="produse.php">
                    <i class="fas fa-box"></i> Produse
                </a>
                <a href="listacomenzi.php">
                    <i class="fas fa-box"></i> Comenzi
                </a>
                <a href="inventar.php">
                    <i class="fas fa-boxes"></i> Verificare Inventar
                </a>
                <a href="mijloace.php">
                    <i class="fas fa-chair"></i> Mijloace Fixe
                </a>
                <a href="datefirma.php">
                    <i class="fas fa-cogs"></i> Setari Companie
                </a>
                <a href="conturi.php">
                    <i class="fas fa-users-cog"></i> Conturi
                </a>
            </div>
        </div>
    </div>

<?php

include 'footer.php';

?>