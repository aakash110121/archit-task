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


   

    <!--====Reset section start====-->
    <section class="form_bg">
        <div class="container">
            <div class="form_container">
                <div class="form_header">
                    <a href="index.php" class="registration_logo">
                        <img src="assets/images/logo.png" alt="Spovest Logo">
                    </a>
                </div>
                <div id="Reset-response">
                <?php
                        if(isset($_GET["flag"])&&$_GET["flag"]==1)
                        {    
                            include "includes/Auth.php";
                            $msg=$db->flag1();
                            echo $msg;
                        }
                    ?>                     
                </div>
                <form action="#" method="POST" class="mt-60" id="Pass-Reset">
               
                    <h1 class="form_title">Reset Password</h1>
                    <input type="hidden" name="token" value="<?=$_GET['token']?>">
                    <div class="mb-3">
                        <input  name="pass" placeholder="New password" class="form-control para"  required="required">
                    </div>
                    <div class="mb-3">
                        <div class="show_password">
                            <input type="password" name="cpass" placeholder="Confirm Password" class="form-control para" id="password-field" required="required">
                            <i class="fas fa-eye toggle-password"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="Reset-btn">Reset Password</button>
                </form>
            </div>
        </div>
    </section>
    <!--====Reset section end====-->


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
            $("#Reset-btn").click(function(e){
            e.preventDefault();
            if($("#Pass-Reset")[0].checkValidity())
            {
                $("#Reset-btn").html("...please wait")
                $.ajax({
                    url:"includes/action.php",
                    method:"post",
                    data:$("#Pass-Reset").serialize()+"&action=PassReset",
                    dataType:"json",
                    success:function(response){
                        console.log("yes");
                       if(response.status=="success")
                       {
                            $("#Reset-response").html(response.msg);
                            $("#Reset-btn").html("Reset Password")
                            console.log(response.msg);
                            setTimeout(() => {
                                window.close();  
                            }, 5000);
                       }
                       else if(response.status=="failed")
                       {
                        $("#Reset-response").html(response.msg);
                            setTimeout(() => {
                                $("#Reset-btn").html("Reset Password")  
                            },2000);
                           
                            console.log("failed");
                           
                       }
                    }
                });
            }
        });
    });
    </script>
</body>

</html>