<?php
    session_start();
    if(!isset($_SESSION["user"]))
    {
        include "../includes/session.php";
    }
    else
    {
        include "../includes/Auth.php";
        $db= new Auth();
        if(isset($_SESSION["user"])&&$db->Login($_SESSION["user"])==NULL)
        {
            unset($_SESSION["user"]);
            setcookie("email",' ',1,"/");
            header("Location:../includes/session.php");
        }
        else
        {  
            $server=$_SERVER["SERVER_NAME"];
            $url=$_SERVER["PHP_SELF"];// empty/projects/archit-task/Admin/action.php
            $arr=explode("/Admin",$url);
            $root=$arr[0];
            $root=trim($root);
            $data=$db->Login($_SESSION["user"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <!--required meta-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--title for this document-->
    <title>Soccer Spotlight</title>
    <!--favicon for this document-->
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <!--keywords for this  document-->
    <meta name="keywords" content="Soccer Spotlight">
    <!--description for this document-->
    <meta name="description" content="Soccer Spotlight">
    <!--author of this document-->
    <meta name="author" content="Soccer Spotlight">

    <!--bootstrap 5 minified css source-->
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
    <!--fontawesome 5 minified css source-->
    <link rel="stylesheet" href="../assets/icons/font_awesome/css/all.min.css">
    <!--flaticon css source-->
    <link rel="stylesheet" href="../assets/icons/flat_icon/flaticon.css">
    <!--owl carousel-2.3.4 minified css source-->
    <link rel="stylesheet" href="../assets/css/vendor/owl.carousel.min.css">
    <!--owl carousel-2.3.4 theme default minified css source-->
    <link rel="stylesheet" href="../assets/css/vendor/owl.theme.default.min.css">

    <!--animate css source-->
    <link rel="stylesheet" href="../assets/css/vendor/animate.css">
    <!--custom css start-->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .dnone{
            display:none;
        }
    </style>
</head>

<body class="dark">


    <!--====header navbar start====-->
    <header>
        <nav class="navbar fixed-top navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="../assets/images/Logo-dark-n.png" alt="Soccer Spotlight Logo" id="logo">
                </a>
                <div class="d-flex flex-row order-2 order-lg-3 user_info">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDefault"
                        aria-controls="navDefault" aria-expanded="false" aria-label="Toggle navigation" id="toggleIcon">
                        <span class="bar_one"></span>
                        <span class="bar_two"></span>
                        <span class="bar_three"></span>
                    </button>
                    <div class="profile">
                        <div class="avatar">
                            <div class="avatar-content">
                            <a href="#" style="text-decoration:none">
                      
                            <?php

                                    $path=$db->FileExists($data["email"])==NULL?"../assets/images/dp.png":"../".$db->FileExists($data["email"]);
                                    echo"<img src='$path' alt='' id='profile_logo'>";
                            ?>
                                    <span id="upd-user">
                                        <?php
                                            
                                             if(isset($_SESSION["user"]))
                                             {
                                               
                                        ?>
                                            <?=$data["first_name"]." ".$data["last_name"]?>
                                        <?php
                                             }
                                             else
                                             {
                                        ?>
                                             <?='Guest'?>
                                        <?php  
                                             }
                                        ?>
                                        </span></a>
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                            <div class="dropdown">
                                <ul>
                                    <li>
                                        <a href='http://<?=$server?>/<?=$root?>/my-matches.php'><img src="../assets/images/stadium.svg" alt="stadium">My
                                            Matches</a>
                                    </li>
                                    <li>
                                        <a href='http://<?=$server?>/<?=$root?>/Admin/logout.php'><img src="../assets/images/logout.svg" alt="logout">log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse justify-content-end order-3 order-lg-2" id="navDefault">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href='http://<?=$server?>/<?=$root?>/index.php'>
                                HOME
                            </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='http://<?=$server?>/<?=$root?>/about.php'>ABOUT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='http://<?=$server?>/<?=$root?>/how-to-play.php'>HOW TO PLAY</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pd_right" href='http://<?=$server?>/<?=$root?>/contact.php'>CONTACT US</a>
                        </li>
                        <li class="nav-item d-block d-sm-none">
                            <a class="nav-link registration" href="login.php">LOG IN</a>
                        </li>
                        <li class="nav-item d-block d-sm-none">
                            <a class="nav-link registration " href="signup.php">SIGN UP</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--====header navbar end====-->