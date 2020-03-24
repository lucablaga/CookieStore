<?php

session_start();
$con = mysqli_connect("localhost", 'root', '', 'userregistration');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Prajituri</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Cookie&display=swap" rel="stylesheet">
    <style>
        /* Remove the navbar's default rounded borders and increase the bottom margin */
        .navbar {
            margin-bottom: 50px;
            border-radius: 0;
        }

        /* Remove the jumbotron's default bottom margin */
        .jumbotron {
            margin-bottom: 0;

        }

        /* Add a gray background color and some padding to the footer */
        footer {
            background-color: #f2f2f2;
            padding: 25px;
        }
    </style>
</head>
<body>

<div class="jumbotron">
    <div class="container text-center">
        <h1>Prajituri</h1>
        <p>Prajituri, torturi, fursecuri</p>
    </div>
</div>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>

            </ul>

        </div>
    </div>
</nav>

<div class="container">
    <div class="row">

        <?php
        $q = "select * from produse";
        $produse = mysqli_query($con, $q);


        foreach ($produse as $produs) {
            ?>

            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading"> <?php echo $produs['nume'] ?></div>
                    <div class="panel-body"><img src="<?php echo $produs['imagine'] ?>" class="img-responsive"
                                                 style="width:100%" alt="Image"></div>
                    <div class="panel-footer"><?php echo 'Pret: ' . $produs['pret'] ?>
                        <form action="" method="get">
                            <input type="submit" value="Adauga in Cos" name="adauga_cos">
                            <input type="hidden" value="<?php echo $produs['id'] ?>" name="idprodus">
                        </form>
                    </div>
                </div>
            </div>

        <?php }
        ?>


    </div>
</div>
<br>

<div style="font-size: 18px; background-color: white; padding-top:10px; padding-left: 50px; padding-right: 30px; padding-bottom: 20px;">
    <h1 style="background-color:  darkgray; border-radius: 4px; padding: 5px; background-color: #337ab7; color:white; padding-left: 30px;">Your cart:</h1>
   <?php


    if (isset($_GET['idprodus'])) {
        $product = $_GET['idprodus'];
        $x = "select * from produse where id='{$product}'";
        $result2 = mysqli_query($con, $x);

        $cos = mysqli_fetch_array($result2);
        $_SESSION['cos'][] = $cos;

    }

    if(isset($_GET['sterge'])){
        unset($_SESSION['cos'][$_GET['sterge']]);
    }

    '<ul>';
    if (isset($_SESSION['cos'])) {
        $suma = 0;

        foreach ($_SESSION['cos'] as $key => $produs_in_cos) {
            echo '<li>'. $produs_in_cos['nume'];
         echo ' - <a href="home.php?sterge='.$key.'">Sterge</a>'.'</li>';
            echo '<br>';
            $suma = $suma + $produs_in_cos['pret'];
        }
        echo '<br>';
        echo 'Total : '.$suma;


    } else {
        echo 'cosul este gol';
    }
    '</ul>';



    ?>


</div>

<br><br>

<footer class="container-fluid text-center">
    <p>Prajituri Store Copyright</p>
</footer>

</body>
</html>
