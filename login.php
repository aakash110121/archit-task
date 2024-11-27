<?php
    if(isset($_COOKIE["email"])){
        header("Location:Admin/my-profile.php");
    }
    session_start();
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
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <!--keywords for this  document-->
    <meta name="keywords" content="Soccer Spotlight">
    <!--description for this document-->
    <meta name="description" content="Soccer Spotlight">
    <!--author of this document-->
    <meta name="author" content="Soccer Spotlight">

    <!--bootstrap 5 minified css source-->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!--fontawesome 5 minified css source-->
    <link rel="stylesheet" href="assets/icons/font_awesome/css/all.min.css">
    <!--flaticon css source-->
    <link rel="stylesheet" href="assets/icons/flat_icon/flaticon.css">
    <!--owl carousel-2.3.4 minified css source-->
    <link rel="stylesheet" href="assets/css/vendor/owl.carousel.min.css">
    <!--owl carousel-2.3.4 theme default minified css source-->
    <link rel="stylesheet" href="assets/css/vendor/owl.theme.default.min.css">

    <!--animate css source-->
    <link rel="stylesheet" href="assets/css/vendor/animate.css">
    <!--custom css start-->
    <link rel="stylesheet" href="assets/css/main.css">
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
                    <img src="assets/images/Logo-dark-n.png" alt="Soccer Spotlight Logo" id="logo">
                </a>
                <div class="d-flex flex-row order-2 order-lg-3 user_info">
                    <div class="group_btn d-none d-sm-block">
                        <a href="login.php" class="group_link log_in registration" style="background-image: linear-gradient(135deg, #15cd00 0%, #72e001 100%);">LOG IN</a>
                        <a href="signup.php" class="group_link registration ">SIGN UP</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDefault" aria-controls="navDefault" aria-expanded="false" aria-label="Toggle navigation" id="toggleIcon">
                        <span class="bar_one"></span>
                        <span class="bar_two"></span>
                        <span class="bar_three"></span>
                    </button>
                    <div class="profile">
                        <div class="avatar">
                            <div class="avatar-content">
                                <a href="#">
                                    <img src="assets/images/dp.png" alt="dp"><span>
                                        <?php
                                             if(isset($_SESSION["user"]))
                                             {
                                                 include "includes/session.php";
                                                //  print_r($data);
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
                                    <?php
                                        if(isset($_COOKIE["email"]))
                                        {
                                    ?>
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    <?php
                                        }
                                    ?>
                            </div>
                                    <?php
                                        if(isset($_COOKIE["email"]))
                                        {
                                    ?>
                                <div class="dropdown">
                                    <ul>
                                        <li><a href="my-profile.php"><img src="assets/images/user.svg" alt="user">My Profile</a>
                                        </li>
                                        <li>
                                            <a href="my-matches.html"><img src="assets/images/stadium.svg" alt="stadium">My Matches</a>
                                        </li>
                                        <li>
                                            <a href="http://<?=$server?>/<?=$root?>/Admin/logout.php"><img src="assets/images/logout.svg" alt="logout">log Out</a>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                                    }
                                ?>
                        </div>
                   </div>
                </div>
                <div class="collapse navbar-collapse justify-content-end order-3 order-lg-2" id="navDefault">
                    <ul class="navbar-nav">
                        <?php
                            if(isset($_SESSION["user"]))
                            {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" >
                                HOME
                            </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">ABOUT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">HOW TO PLAY</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pd_right" href="contact.php">CONTACT US</a>
                        </li>
                        <?php
                            }
                        ?>
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

    <!--====login section start====-->
    <section class="form_bg">
        <div class="container">
            <div class="form_container">
                <div class="form_header">
                    <a href="index.php" class="registration_logo">
                        <img src="assets/images/logo.png" alt="Spovest Logo">
                    </a>
                </div>
                <div id="Login-response">
                <?php
                        if(isset($_GET["flag"])&&$_GET["flag"]==1)
                        {    
                            include "includes/Auth.php";
                            $msg=$db->flag1();
                            echo $msg;
                        }
                    ?>                     
                </div>
                <form action="#" method="POST" class="mt-60" id="Login-form">
               
                    <h1 class="form_title">Log in</h1>
                    <div class="mb-3">
                        
                        <input type="email" name="email" placeholder="Email" class="form-control para" id="email" required="required" 
                       value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>">>
                    </div>
                    <div class="mb-3">
                        <div class="show_password">
                            <input type="password" name="password" placeholder="Password" class="form-control para" id="password-field" required="required"
                            value="<?= isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>">
                            <i class="fas fa-eye toggle-password"></i>
                        </div>
                        <a href="#" class="dnone" id="forgotpass" style="float:right;text-decoration:none;color:#72e001">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary" id="Login-btn">Login</button>
                    <div class="form_footer">
                        <span>OR</span>
                        <div class="social_container d-flex align-items-center">
                            <div class="facebook">
                                <a href="#" class="para d-flex align-items-center justify-content-evenly"><img src="assets/images/contact/facebook.png" alt="Sign Up With Facebook"> FACEBOOK</a>
                            </div>
                            <div class="google">
                                <a href="#" class="para d-flex align-items-center justify-content-evenly"><img src="assets/images/contact/google.png" alt="Sign Up With Google"> GOOGLE</a>
                            </div>
                        </div>
                        <p class="para">I don't have an account. <a href="signup.php">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--====login section end====-->

    <!--====footer navbar start-->
<footer>
        <div class="container">
            <div class="row footer_nav d-flex align-items-center">
                <div class="col-lg-12">
                    <ul class="nav justify-content-center ">
                        <li class="nav-item">
                            <a class="nav-link ml-0" href="contact.php">CONTACT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">TERMS OF USE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">PRIVACY POLICY</a>
                        </li>
                    </ul>
                </div>

            </div>
            <hr>
            <div class="row footer_copyright d-flex align-items-center">
                <div class="col-lg-7 text-center text-sm-start">
                    <p class="para">Copyright &#169; Soccer Spotlight 2024.</p>
                </div>
                <div class="col-lg-5 text-center text-sm-start text-lg-end">
                    <p class="para">All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>
    <!--====footer navbar end====-->

    <!--===scroll bottom to top===-->
    <a href="#" class="scrollToTop"><i class="flaticon-up-chevron"></i></a>
    <!--===scroll bottom to top===-->


    <!--====js scripts start====-->
    <!--jquery-3.6.0 minified source-->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!--bootstrap 5 minified bundle js source-->
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <!--waypoints-4.0.0 minified js source-->
    <script src="assets/js/vendor/jquery.waypoints.min.js"></script>
    <!--counter up-1.0.0 minified js source-->
    <script src="assets/js/vendor/jquery.counterup.min.js"></script>
    <!--owl carousel-2.3.4 minified js source-->
    <script src="assets/js/vendor/owl.carousel.min.js"></script>
    <!--magnific popup-1.1.0 js source-->
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <!--jquery nice select minified source-->
    <script src="assets/js/vendor/jquery.nice-select.min.js"></script>
    <!--wow-1.1.3 minified js source-->
    <script src="assets/js/vendor/wow.min.js"></script>
    <!--custom js source-->
    <script src="assets/js/main.js"></script>
    <!--====js scripts end====-->
    <script>
        $(document).ready(function(){
            $("#Login-btn").click(function(e){
                e.preventDefault();
                $.ajax({
                    url:"includes/action.php",
                    method:"post",
                    data:$("#Login-form").serialize()+"&action=Login",
                    // dataType:"json",
                    success:function(response){
                        console.log(response);
                    }
                });
            });
            //             if(response.status=="success"){
            //                 $("#Login-btn").html("...Please wait");
            //                 $("#Login-response").html(response.msg);
            //                 setTimeout(() => {
            //                     url="Admin/my-profile.php";
            //                     window.location.href=url;
            //                 }, 3000);
            //             }
            //             else if(response.status=="otp-send")
            //             {   
            //                 $("#Login-btn").html("...Please wait");
            //                 $("#Login-response").html(response.msg);
            //                 setTimeout(() => {
            //                 url="otp-verify.php?flag=2"+"&email="+response.email;
            //                 window.location.href=url;
            //                 },3000);
            //             }     
            //             else if(response.status=="failed")
            //             {
            //                 $("#Login-response").html(response.msg);
            //                 $(".alert button").click(function(e){
            //                     e.preventDefault();
            //                     $(this).parent().addClass("dnone");
            //                 });
            //                 if(response.flag=="forgot")
            //                 {
            //                     $("#forgotpass").removeClass("dnone");
            //                 }
            //             }
                               
            //         }
            //     });
            // });
            // $("#forgotpass").click(function(e){
            //         e.preventDefault();
            //         if($("#Login-form")[0].checkValidity())
            //         {
            //             console.log("inside forgot");
            //             $.ajax({
            //                 url:"includes/action.php",
            //                 method:"post",
            //                 data:$("#Login-form").serialize()+"&action=forgot",
            //                 dataType:"json",
            //                 success(response)
            //                 {
            //                     if(response.status="success")
            //                     {
            //                         setTimeout(()=>{
            //                             $("#Login-response").html(response.msg);
            //                             $("#forgotpass").addClass("dnone");
            //                             $(".alert button").click(function(e){
            //                             e.preventDefault();
            //                             $("#Login-response").addClass("dnone");
            //                         });
            //                         },1500)
                                   
            //                     }
            //                 }
            //             });
            //         }
            // });
            //     $(".alert button").click(function(e){
            //         e.preventDefault();
            //         $(this).parent().addClass("dnone");
            //     });
        });
    </script>
</body>

</html>