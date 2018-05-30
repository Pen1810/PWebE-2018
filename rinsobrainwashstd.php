<?php
require_once("config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet">
    <title>Sample Shopping</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/main.css">


    <script src="js/jquery.min.js"></script>
    <script src="js/Chart.js"></script>
    <!--script src="js/modernizr.custom.js"></script-->


    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
        table
        {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin: 25px 50px;
        }

        td, th
        {
            border: 1px solid grey;
            text-align: left;
            padding: 8px;
            margin: 25px 50px;
        }

        tr:nth-child(odd)
        {
            background-color: #797D7F;
        }
        img
        {
            max-width: 100%;
            max-height: 100%;
            margin-top: 100px
        }
        .Price
        {
            max-width: 100%;
            max-height: 100%;
            width:500px;
            height:auto;
            border:5px solid grey;
            text-align: center;
            margin: 25px 50px;
        }
        h2,h3
        {
            text-align:center;
            margin: 25px 50px;
        }
    </style>
</head>

<body data-spy="scroll" data-offset="0" data-target="#theMenu">
<?php include ("navbar.php"); ?>

<!-- Main source -->
<div class="Main">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <br>
            <img src="img/brainwashstd.jpg">
        </div>
        <div class="col-sm-4">
            <br>
            <h3>Informasi produk</h3>
            <br>
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <table>
                    <tr>
                        <td>Tipe</td>
                        <td>Rinso BrainWash</td>
                    </tr>
                    <tr>
                        <td>Berat</td>
                        <td>20kg</td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Kondisi</td>
                        <td>New</td>
                    </tr>
                    <tr>
                        <td>Distributor</td>
                        <td>Honesta Swandaru</td>
                    </tr>
                    <tr>
                        <td>Garansi</td>
                        <td>Tidak terjamin</td>
                    </tr>
                    <tr>
                        <td>Kurir</td>
                        <td>JN*, J&E, Haruna, Pos BrainWash</td>
                    </tr>
                </table>
                <br>
                <br>
                <h3>Otak anda sudah diberi propaganda oleh orang lain? Cucilah dengan Rinso BrainWash. Dijamin tidak lama kemudian propaganda yang diberikan itu akan HILANG, HA HA HA</h3>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="col-sm-3">
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="Price">
                <h4><strike>Rp300.000</strike></h4>
                <h2>Rp210.000</h2>
                <h3>30% OFF!</h3>
                <h3>Beli sekarang!</h3>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>

<!-- ========== FOOTER SECTION ========== -->
<section id="contact" name="contact"></section>
<div id="f" style="background-color:#333">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="text-center"><b>CONTACT US</b></h3>
            </div>
            <div class="col-sm-6">
                <h3><b>Send Us A Message:</b></h3>
                <h3 class="text-foot">turanwash@gmail.com</h3>
                <br>
            </div>

            <div class="col-sm-6">
                <h3><b>Call Us:</b></h3>
                <h3 class="text-foot">+6281234567890</h3>
                <br>
            </div>
        </div>
    </div>
</div><!-- /container -->
</div><!-- /f -->


<!-- script of dialog -->
<script>
    let counter = 2;
    let whitebg = document.getElementById("white-background");
    let sizebox = document.getElementById("size-box");
    let dsgn = document.getElementById("design-con");
    let dlg = document.getElementById("dlgbox");
    let tblsize = document.getElementById("tablesize");
    let button = document.getElementById("buttonDsgn");
    let pertama = document.getElementsByTagName("p");
    let kedua = document.getElementsByTagName("p");
    let DetailButton = document.getElementsByTagName("button");
    let availArray = [0, 2, 4, 6, 8, 10, 12, 14, 16];
    let sizeArray = [1, 3, 5, 7, 9, 11, 13, 15, 17];
    let availableStock;
    let footerh3 = document.getElementsByTagName("h3");

    function showTable() {
        sizebox.style.display = "none";
        tblsize.style.display = "block";
        tblsize.style.left = "410px";
        tblsize.style.top = "90px";
    }

    function closeButton() {
        sizebox.style.display = "none";
        whitebg.style.display = "none";
        tablesize.style.display = "none";
    }

    function dlgOKDetail() {
        whitebg.style.display = "none";
        dlg.style.display = "none";
    }

    function dlgOKDes() {
        whitebg.style.display = "none";
        dsgn.style.display = "none";
        dlg.style.display = "none";
    }

    function showDesign() {
        whitebg.style.display = "block";
        dsgn.style.display = "block";
        dlg.style.display = "none";

        let winWidth = window.innerWidth;
        let winHeight = window.innerHeight;

        dsgn.style.left = "350px";
        dsgn.style.top = "40px";
    }

    function dlgOK() {
        whitebg.style.display = "none";
        dlg.style.display = "none";
    }

    function showDialog() {
        whitebg.style.display = "block";
        dlg.style.display = "block";
        button.style.display = "block";
        counter += 1;

        if (counter === 12) {
            counter = 2;
        }

        let test = document.getElementsByTagName("img")[counter].getAttribute("src");
        document.getElementById("photo").src = test;

        let winWidth = window.innerWidth;
        let winHeight = window.innerHeight;

        dlg.style.left = (winWidth / 2) - 480 / 2 + "px";
        dlg.style.top = "50px";
    }
</script>
</body>
</html>
