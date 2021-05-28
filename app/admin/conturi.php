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
            <p><a href="/">Acasa</a> > Conturi</p>
            <div style="display: flex; flex-wrap: wrap;">
                <div style="width: 50%;">
                    <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i> Inapoi</button></a>
                </div>
                <div style="width: 50%; text-align: right;" class="add">
                    <button type="button" class="btn btn-success"><i class="fas fa-plus"></i> Adauga Cont</button>
                </div>
            </div>
            <div class="formwrapper">
                <form id="adaugaprodus">
                    <div>
                        <p>Nume<sup>*</sup></p>
                        <input type="text" name="nume" required>
                    </div>
                    <div>
                        <p>Email<sup>*</sup></p>
                        <input type="email" name="email" required>
                    </div>
                    <div>
                        <p>Parola<sup>*</sup></p>
                        <input type="text" name="pass" required>
                    </div>
                    <div>
                        <p>Tip Cont<sup>*</sup></p>
                        <select name="tip_cont">
                            <option value="">Selectati</option>
                            <option value="0">Administrator</option>
                            <option value="1">Agent</option>
                        </select>
                    </div>
                    <div style="text-align: right;">
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
            <div class="conturi"></div>
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div>
    </div>
    <script>
        $(document).ready(function(){
            $("div.conturi").load("afisareconturi.php");
            $("div.add button").on("click", function(){
                $("div.formwrapper").slideToggle();
            });
            $("form#adaugaprodus").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: 'adaugacont.php',
                    data: $(this).serialize(),                         
                    type: 'post',
                    success: function(d){
                        alert(d);
                        $("form#adaugaprodus")[0].reset();
                        $("div.conturi").load("afisareconturi.php");
                    }
                });
            });
        });
    </script>
<?php

include 'footer.php';

?>