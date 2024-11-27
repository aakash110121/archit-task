<?php
    session_start();
    if(!isset($_SESSION["user"]))
    {
        // header("Location:Login.php");
        include "session.php";
    }
    else
    {
        include "includes/Auth.php";
        $db= new Auth();
        if(isset($_SESSION["user"])&&$db->Login($_SESSION["user"])==NULL)
        {
            unset($_SESSION["user"]);
            setcookie("email",' ',1,"/");
            header("Location:session.php");
        }
        else
        {
        $server=$_SERVER["SERVER_NAME"];
        $url=$_SERVER["PHP_SELF"];
        $arr=explode("/",$url);
        $root=$arr[1];
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
                    <?php
                        if(!isset($_SESSION["user"]))
                        {
                    ?>
                    <div class="group_btn d-none d-sm-block">
                        <a href="login.php" class="group_link log_in registration">LOG IN</a>
                        <a href="signup.php" class="group_link registration ">SIGN UP</a>
                    </div>
                    <?php
                        }
                    ?>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDefault" aria-controls="navDefault" aria-expanded="false" aria-label="Toggle navigation" id="toggleIcon">
                        <span class="bar_one"></span>
                        <span class="bar_two"></span>
                        <span class="bar_three"></span>
                    </button>
                    <div class="profile">
                        <div class="avatar">
                            <div class="avatar-content">
                                <a href="#">
                                <?php
                                $url=$db->imageUrl($data["email"]);
                                if($url==NULL)
                                {
                            ?>
                                    <img src="assets/images/dp.png" alt="dp"><span>
                            <?php
                                }
                                else
                                {
                                    $url=$url["image_blob"]
                            ?>
                                    <img src="<?=$url?>" alt="dp" id="dp-dashboard"><span id="upd-user">
                            <?php
                                }
                            ?>
                                        
                                        
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
                                        ?></span></a>
                                    <?php
                                    if(isset($_SESSION["user"]))
                                    {
                                    ?>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    <?php
                                    }
                                    ?>
                            </div>
                            <?php
                                if(isset($_SESSION["user"]))
                                {
                            ?>
                                <div class="dropdown">
                                    <ul>
                                        <li><a href="http://<?=$server?>/<?=$root?>/Admin/my-profile.php"><img src="assets/images/user.svg" alt="user">My Profile</a>
                                        </li>
                                        <li>
                                            <a href="my-matches.php"><img src="assets/images/stadium.svg" alt="stadium">My Matches</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" >
                                HOME
                            </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">ABOUT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="how-to-play.php">HOW TO PLAY</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pd_right" href="contact.php">CONTACT US</a>
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

    <!--====banner section start====-->
    <section class="contact_banner_wrapper bg-dark">
        <div class="container">
            <h1 class="hero_title">Contact Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </section>
    <!--====banner section end====-->

    <!--====contact form section start====-->
    <section class="contact_form_wrapper">
        <div class="container">
            <div class="row contact_row d-flex align-items-center">
                <div class="col-lg-4">
                    <div class="left_side_content">
                        <h1>Have questions?</h1>
                        <p class="section_info">Have questions? We have answers!</p>

                        <div class="inner_row d-flex align-items-center">
                            <div class="inner_left">
                                <img src="assets/images/contact/email.png" alt="Email Us">
                            </div>
                            <div class="inner_right">
                                <h4>Email Us</h4>
                                <p><a href="#" class="__cf_email__" data-cfemail="">youremail@gmail.com</a></p>
                            </div>
                        </div>
                        <div class="inner_row d-flex align-items-center">
                            <div class="inner_left">
                                <img src="assets/images/contact/call.png" alt="Call Us">
                            </div>
                            <div class="inner_right">
                                <h4>Call Us</h4>
                                <p>+1 (123) 456-78-90</p>
                                <p>+1 (123) 456-78-90</p>
                            </div>
                        </div>
                        <div class="inner_row d-flex align-items-center">
                            <div class="inner_left">
                                <img src="assets/images/contact/visit.png" alt="Visit Us">
                            </div>
                            <div class="inner_right">
                                <h4>Visit Us</h4>
                                <p>C-167 IT Avenue, Punjab, IN 160055</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="right_side_content d-flex justify-content-lg-end">
                        <div class="form_wrapper">
                            <h1>We'd love to hear from you</h1>
                            <div id="form-response" ><!-- on succesfull mail submittion-->
                                <div class="alert alert-danger  fade show dnone" id="form-error">
                                        <button class="btn btn-lg fs-5"  style="display:inline-block;background-color:none;width:0;padding:0;
                                        background-image: none;margin:0 20px 0 0;padding:0;color:rgba(0,0,0,0.6)">&times;
                                        </button>
                                        <span>
                                            <strong>
                                                All Fields are required
                                            </strong>
                                        </span>
                                    </div>';               
                            </div>
                            <form action="#" method="post" id="contact-form">
                                <div class="mb-3">
                                    <input type="text" class="form-control para" id="exampleName5" name="name" placeholder="Full Name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control para" id="exampleInputEmail5" name="email" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control para" id="exampleSubject5" name="subject" placeholder="Subject" required>
                                </div>
                                <div class="mb-3">
                                    <textarea name="message" id="exampleMessage5" name="text-area" class="form-control para" cols="30" rows="4" placeholder="Message" required></textarea>
                                </div>
                                <div class="mb-3 check d-flex align-items-start">
                                    <input type="checkbox" id="agree" name="agreed">
                                    <label for="agree"> I agree to receive emails, newsletters and promotional messages</label><br>
                                </div>
                                <button type="submit" class="btn btn-primary" id="mail-btn">SEND MESSAGE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====contact form section end====-->

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

    <!--owl carousel-2.3.4 minified js source-->
    <script src="assets/js/vendor/owl.carousel.min.js"></script>

    <!--wow-1.1.3 minified js source-->
    <script src="assets/js/vendor/wow.min.js"></script>
    <!--custom js source-->
    <script src="assets/js/main.js"></script>
    <!--====js scripts end====-->
    <script>
        $(document).ready(function(){
            $("#form-success").html('');
            $("#mail-btn").click(function(e){
                e.preventDefault();
                console.log("inside btn");
                if($("#contact-form")[0].checkValidity())
                {
                    $("#mail-btn").html("...Please wait");
                    $.ajax({
                        url:"includes/action.php",
                        method:"post",
                        data:$("#contact-form").serialize()+"&action=contact",
                        dataType:"json",
                        success:function(response){
                        if(response.status=="success")
                        {
                            $("#form-response").html(response.msg);
                            setTimeout(()=>{
                                $("#mail-btn").html("Submit");
                            },2000)
                        }
                        else if(response.status=="failed")
                        {
                            setTimeout(() => {
                                $("#mail-btn").html("Submit");
                            }, 2000);
                           
                            console.log(response.msg);
                            $("#form-response").html(response.msg);
                        }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>