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
                                            <a href="http://<?=$server?>/<?=$root?>/Admin/logout.php" ><img src="assets/images/logout.svg" alt="logout">log Out</a>
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
    <section class="home_banner_wrapper">
        <div class="container">
            <div class="row home_banner_row d-flex align-items-center">
                <div class="col-lg-12">
                    <div class="inner">
                        <h1 class="hero_title">The New Way to Invest in Sports</h1>
                        <p class="section_info">Best fantasy sports stock exchange where users can buy/sell shares of professional athletes as if they
                        were stocks.</p>
                        <div class="btn_wrapper d-flex align-items-center">
                            <div class="trade_btn">
                                <a href="premier-league.html" class="btn btn-primary">Sign Up Today!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="inner text-center">
                        <img src="assets/images/home_banner/players.png" alt="Home Banner Illustration">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====banner section end====-->
		<!--====partner section start====-->
    <section class="partner_section">
        <div class="container">
			<div class="row">
				<div class="col-12">
					<div class="part-logo">
						<img src="assets/images/partnersologo.png" alt="img">
					</div>
				</div>
			</div>
		</div>
	</section>

<!--====partner section logo====-->
	<!--====slider section start====-->
    <section class="slider_wrapper">
        <div class="container">
            <div class="slider_row owl-carousel owl-theme">
                <div class="slider_items d-flex align-items-center">
                    <div class="left_col">
                        <div class="img_wrapper d-flex align-items-center justify-content-center">
                            <a href="player-profile.html" class="bg_pink">
                                <img src="assets/images/slider/trader_1.png" alt="Trader One">
                            </a>
                            <span class="bg_pink d-inline-flex align-items-center justify-content-center">NBA</span>
                        </div>
                    </div>
                    <div class="right_col flex-grow-1">
                        <h5>
                            <a href="player-profile.html">Don Doyle</a>
                        </h5>
                        <p>Los Angeles Lakers</p>
                        <div class="price_line d-flex align-items-center">
                            <div class="price">
                                <p><i class="fas fa-dollar-sign"></i> 3.91</p>
                            </div>
                            <div class="rate">
                                <p>+8.12 <i class="fas fa-caret-up"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_items d-flex align-items-center">
                    <div class="left_col">
                        <div class="img_wrapper img_bg_two d-flex align-items-center justify-content-center">
                            <a href="player-profile.html" class="bg_purple">
                                <img src="assets/images/slider/trader_2.png" alt="Trader Two">
                            </a>
                            <span class="bg_purple d-inline-flex align-items-center justify-content-center">NFL</span>
                        </div>
                    </div>
                    <div class="right_col flex-grow-1">
                        <h5>
                            <a href="player-profile.html">Lynn Green</a>
                        </h5>
                        <p>Washington Football Team</p>
                        <div class="price_line d-flex align-items-center">
                            <div class="price">
                                <p><i class="fas fa-dollar-sign"></i> 3.91</p>
                            </div>
                            <div class="rate">
                                <p>+8.12 <i class="fas fa-caret-up"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_items d-flex align-items-center">
                    <div class="left_col">
                        <div class="img_wrapper img_bg_three d-flex align-items-center justify-content-center">
                            <a href="player-profile.html" class="bg_cyan">
                                <img src="assets/images/slider/trader_3.png" alt="Trader Three">
                            </a>
                            <span class="bg_cyan d-inline-flex align-items-center justify-content-center">MLB</span>
                        </div>
                    </div>
                    <div class="right_col flex-grow-1">
                        <h5>
                            <a href="player-profile.html">Ricky Scott</a>
                        </h5>
                        <p>Los Angeles Lakers</p>
                        <div class="price_line d-flex align-items-center">
                            <div class="price">
                                <p><i class="fas fa-dollar-sign"></i> 3.91</p>
                            </div>
                            <div class="rate">
                                <p>+8.12 <i class="fas fa-caret-up"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_items d-flex align-items-center">
                    <div class="left_col">
                        <div class="img_wrapper d-flex align-items-center justify-content-center">
                            <a href="player-profile.html" class="bg_pink">
                                <img src="assets/images/slider/trader_1.png" alt="Trader One">
                            </a>
                            <span class="bg_pink d-inline-flex align-items-center justify-content-center">NBA</span>
                        </div>
                    </div>
                    <div class="right_col flex-grow-1">
                        <h5>
                            <a href="player-profile.html">Don Doyle</a>
                        </h5>
                        <p>Los Angeles Lakers</p>
                        <div class="price_line d-flex align-items-center">
                            <div class="price">
                                <p><i class="fas fa-dollar-sign"></i> 3.91</p>
                            </div>
                            <div class="rate">
                                <p>+8.12 <i class="fas fa-caret-up"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_items d-flex align-items-center">
                    <div class="left_col">
                        <div class="img_wrapper img_bg_two d-flex align-items-center justify-content-center">
                            <a href="player-profile.html" class="bg_purple">
                                <img src="assets/images/slider/trader_2.png" alt="Trader Two">
                            </a>
                            <span class="bg_purple d-inline-flex align-items-center justify-content-center">NFL</span>
                        </div>
                    </div>
                    <div class="right_col flex-grow-1">
                        <h5>
                            <a href="player-profile.html">Lynn Green</a>
                        </h5>
                        <p>Washington Football Team</p>
                        <div class="price_line d-flex align-items-center">
                            <div class="price">
                                <p><i class="fas fa-dollar-sign"></i> 3.91</p>
                            </div>
                            <div class="rate">
                                <p>+8.12 <i class="fas fa-caret-up"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_items d-flex align-items-center">
                    <div class="left_col">
                        <div class="img_wrapper img_bg_three d-flex align-items-center justify-content-center">
                            <a href="player-profile.html" class="bg_cyan">
                                <img src="assets/images/slider/trader_3.png" alt="Trader Three">
                            </a>
                            <span class="bg_cyan d-inline-flex align-items-center justify-content-center">MLB</span>
                        </div>
                    </div>
                    <div class="right_col flex-grow-1">
                        <h5>
                            <a href="player-profile.html">Ricky Scott</a>
                        </h5>
                        <p>Los Angeles Lakers</p>
                        <div class="price_line d-flex align-items-center">
                            <div class="price">
                                <p><i class="fas fa-dollar-sign"></i> 3.91</p>
                            </div>
                            <div class="rate">
                                <p>+8.12 <i class="fas fa-caret-up"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====slider section end====-->


    <!--====work section start====-->
    <section class="work_section">
        <div class="container">
            <div class="work_wrapper text-center">
                <h1 class="section_title">How does it work?</h1>
                <p class="section_info">It's easier than you think. Follow 3 simple easy steps</p>
            </div>
            <div class="row work_row d-flex ">
                <div class="col-md-6 col-lg-4">
                    <div class="inner text-center">
                        <div class="content_wrapper d-flex align-items-center justify-content-center">
                            <div class="content d-flex align-items-center justify-content-center">
                                <img src="assets/images/work/deposit.png" alt="Deposit Funds">
                            </div>
                        </div>
						<div class="cont-db">
							<h4 class="secondary">Join or Create a league with Friends</h4>
							<p>Select from a variety of leagues ranging from private or public, or head to head or classic.</p>
						</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="inner text-center">
                        <div class="content_wrapper arrow_container d-flex align-items-center justify-content-center">
                            <div class="content d-flex align-items-center justify-content-center">
                                <img src="assets/images/work/market.png" alt="Watch the market">
                            </div>
                        </div>
						<div class="cont-db">
							<h4 class="secondary">Draft Your Team</h4>
							<p>Take your turn drafting your team. Follow standard formations and select players one by one.</p>
						</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="inner text-center">
                        <div class="content_wrapper d-flex align-items-center justify-content-center">
                            <div class="content d-flex align-items-center justify-content-center">
                                <img src="assets/images/work/trade.png" alt="Make a Trade">
                            </div>
                        </div>
						<div class="cont-db">
							<h4 class="secondary">Manage Your Team</h4>
							<p>Each week select your optimal starting 11.</p>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====work section end====-->

    <!--====buy section start====-->
    <section>
        <div class="container">
            <div class="buy_wrapper">
                <div class="row buy_row d-flex align-items-center">
                    <div class="col-lg-6 order-last order-lg-first">
                        <div class="left_inner text-center text-lg-left">
                            <img src="assets/images/buy/buy_illustration.png" alt="Buy Illustration">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right_inner">
                            <h1 class="section_title">Buy Low, Sell High</h1>
                            <p class="section_info">Changes in Players Share prices provide a valuable opportunity to profit from trading either long or short term. The concept is simple: buy low and sell high.
                            </p>
                            <div class="inner_row d-flex align-items-center">
                                <div class="left_col">
                                    <div class="inner">
                                        <span class="no-c">1</span>
                                    </div>
                                </div>
                                <div class="right_col">
                                    <div class="inner">
                                        <p class="para">Players who beat projections raise in value</p>
                                    </div>
                                </div>
                            </div>
                            <div class="inner_row d-flex align-items-center">
                                <div class="left_col">
                                    <div class="inner">
                                       <span class="no-c">2</span>
                                    </div>
                                </div>
                                <div class="right_col">
                                    <div class="inner">
                                        <p class="para">Invest in the value of a player</p>
                                    </div>
                                </div>
                            </div>
                            <div class="inner_row d-flex align-items-center">
                                <div class="left_col">
                                    <div class="inner">
                                       <span class="no-c">3</span>
                                    </div>
                                </div>
                                <div class="right_col">
                                    <div class="inner">
                                        <p class="para">Trade from Anywhere, Anytime</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====buy section end====-->

    <!--====play section start====-->
    <section>
        <div class="container">
            <div class="row play_row d-flex align-items-center">
                <div class="col-lg-6">
                    <div class="inner">
                        <h1 class="section_title">Play all the sports you love, all in one place!</h1>
                        <p class="section_info">Buy, sell or trade your favourite athletes just like stocks on a stock market.</p>
                        <div class="inner_row d-flex align-items-center">
                            <div class="inner_col">
                                <div class="left_col">
                                    <span class="n-main">1</span>
                                </div>
                            </div>
                            <div class="inner_col">
                                <div class="right_col">
                                    <h5>Secure Payments</h5>
                                </div>
                            </div>
                        </div>
                        <div class="inner_row d-flex align-items-center">
                            <div class="inner_col">
                                <div class="left_col">
                                    <span class="n-main">2</span>
                                </div>
                            </div>
                            <div class="inner_col">
                                <div class="right_col">
                                    <h5>Transparent</h5>
                                </div>
                            </div>
                        </div>
                        <div class="inner_row d-flex align-items-center">
                            <div class="inner_col">
                                <div class="left_col">
                                   <span class="n-main">3</span>
                                </div>
                            </div>
                            <div class="inner_col">
                                <div class="right_col">
                                    <h5>Multi-Sports</h5>
                                </div>
                            </div>
                        </div>
                        <div class="inner_row d-flex align-items-center">
                            <div class="inner_col">
                                <div class="left_col">
                                    <span class="n-main">4</span>
                                </div>
                            </div>
                            <div class="inner_col">
                                <div class="right_col">
                                    <h5>24/7 Support</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="inner text-center text-lg-end img-mob">
                        <img src="assets/images/play/illustration.png" alt="Play Illustration">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====play section end====-->

    <!--====invite section start====-->
    <section>
        <div class="container">
            <div class="invite_wrapper">
                <div class="row invite_row d-flex align-items-center">
                    <div class="col-lg-8">
                        <div class="inner">
                            <h1>Have what it takes to <br>
                             become a champion?</h1>
                            <p class="section_info">Get Started Quickly with Soccer Spotlight</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="inner text-left text-lg-center">
                            <a href="#" class="btn btn-primary">Sign Up Today!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====invite section end====-->

    <!--====testimonial section start====-->
    <section class="testimonial_section">
        <div class="container">
            <div class="testimonial_title_wrapper text-center">
                <h1 class="section_title">What do you like most about the stock market of sports?</h1>
            </div>
			
			<div class="game_slider_row owl-carousel owl-theme">          
                
                <div class="slider_items testimonial_row">
                    <div class="inner ">
                        <p class="para">
                      Brilliant site guys, we'll be moving our fantasy league
                      over to you next season, we tried it this year on a small
                      scale and we're very impressed.
                    </p>
                        <div class="members_info d-flex align-items-center">
                            <div class="avatar">
                                <a href="#">
                                    <img src="assets/images/testimonial/ava_1.png" alt="Mike Tucker">
                                </a>
                            </div>
                            <div class="name flex-grow-1">
                                <h6>
                                    <a href="#">- Kris Chambers</a>
                                </h6>
                                <span>New York</span>
                            </div>
                            <div class="twitter_account">
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_items testimonial_row">
                   <div class="inner">
                        <p class="para">
                      It’s really fun. Really competitive...
                      I think it’s a lot better than normal fantasy football...
                      I invited my mates to do it. We enjoyed it so we made a
                      video out of it... I think it’s a cool football thing you
                      should check out. Enjoy.
                    </p>
                        <div class="members_info d-flex align-items-center">
                            <div class="avatar">
                                <a href="#">
                                    <img src="assets/images/testimonial/ava_2.png" alt="Mike Tucker">
                                </a>
                            </div>
                            <div class="name flex-grow-1">
                                <h6>
                                    <a href="#">- Spencer Owen</a>
                                </h6>
                                <span>Washington, DC</span>
                            </div>
                            <div class="twitter_account">
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_items testimonial_row">
                  <div class="inner">
                        <p class="para">
                      Undoubtedly the best Fantasy football format. Every year
                      in regular Fantasy leagues folk lose interest after 6 weeks,
                      not with @DraftFantasy.
                    </p>
                        <div class="members_info d-flex align-items-center">
                            <div class="avatar">
                                <a href="#">
                                    <img src="assets/images/testimonial/ava_3.png" alt="Mike Tucker">
                                </a>
                            </div>
                            <div class="name flex-grow-1">
                                <h6>
                                    <a href="#">- TheFish @fraserforrest</a>
                                </h6>
                                <span>Chicago, IL</span>
                            </div>
                            <div class="twitter_account">
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
			
			
            <div class="row testimonial_row">
                <div class="col-md-6 col-lg-4">
                    
                </div>
                <div class="col-md-6 col-lg-4">
                   
                </div>
                <div class="col-md-6 col-lg-4">
                    
                </div>
            </div>
        </div>
    </section>
    <!--====testimonial section end====-->

   

    <!--====experience section start====-->
    <section>
        <div class="container">
            <div class="experience">
                <div class="experience_content text-center">
                    <h1 class="section_title">Experience the future of fantasy sports</h1>
                    <p class="section_info">Buy & Sell Shares in Favourite Players</p>
                    <a href="#" class="btn btn-primary">Sign Up Today!</a>
                </div>
            </div>
        </div>
    </section>
    <!--====experience section end====-->

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
</body>

</html>