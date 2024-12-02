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
      <title>My Matches</title>
      <!--favicon for this document-->
      <link rel="shortcut icon" href="assets/images/favicon.png"
         type="image/x-icon">
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
      <link rel="stylesheet"
         href="assets/css/vendor/owl.theme.default.min.css">
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
               <img src="assets/images/Logo-dark-n.png"
                  alt="Soccer Spotlight Logo" id="logo">
               </a>
               <div class="d-flex flex-row order-2 order-lg-3 user_info">
                  <?php
                     if(!isset($_SESSION["user"]))
                     {
                  ?>
                  <div class="group_btn d-none d-sm-block">
                     <a href="login.php"
                        class="group_link log_in registration">LOG
                     IN</a>
                     <a href="signup.php"
                        class="group_link registration ">SIGN UP</a>
                  </div>
                  <?php
                     }
                  ?>
                  <button class="navbar-toggler" type="button"
                     data-bs-toggle="collapse"
                     data-bs-target="#navDefault"
                     aria-controls="navDefault" aria-expanded="false"
                     aria-label="Toggle navigation" id="toggleIcon">
                  <span class="bar_one"></span>
                  <span class="bar_two"></span>
                  <span class="bar_three"></span>
                  </button>
                  <div class="profile">
                     <div class="avatar">
                        <div class="avatar-content">
                           <a href="#" style="text-decoration:none">
                           <?php

                                    $path=$db->FileExists($data["email"])==NULL?"assets/images/dp.png":$db->FileExists($data["email"]);
                                    echo"<img src='$path' alt=''>";
                            ?>
                              <span>
                                    <?php
                                       if(isset($_SESSION["user"]))
                                       {
                                          echo $data["first_name"]." ".$data["last_name"];
                                       }
                                       else
                                       {
                                          echo "Guest";
                                       }
                                    ?>
                              </span>
                           </a>
                           <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </div>
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
                     </div>
                  </div>
               </div>
               <div
                  class="collapse navbar-collapse justify-content-end order-3 order-lg-2"
                  id="navDefault">
                  <ul class="navbar-nav">
                     <li class="nav-item">
                        <a class="nav-link" href="index.php">
                        HOME
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="about.php">ABOUT
                        US</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="how-to-play.php">HOW TO PLAY</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link pd_right"
                           href="contact.php">CONTACT US</a>
                     </li>
                     <li class="nav-item d-block d-sm-none">
                        <a class="nav-link registration"
                           href="login.php">LOG IN</a>
                     </li>
                     <li class="nav-item d-block d-sm-none">
                        <a class="nav-link registration "
                           href="signup.php">SIGN UP</a>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <!--====header navbar end====-->
      <!--====sign up section start====-->
      <section class="premier_bg matches my-matches">
         <div class="container">
            <div class="leagure_container">
               <div class="flex flex-col items-center justify-center w-screen min-h-screen bg-gray-900 py-10">
                  <!-- <a href="leagues.html" class="back-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"></path></svg></a> -->
                  <!-- Component Start -->
                  <h1 class="font-medium">2023-24 Season</h1>
                  <h4>My Matches</h4>
                  <div class="flex flex-col mt-6">
                     <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                           <div class="matches-table">
                              <div class="div-tbl">
                                 <table
                                    class="table table-light table-striped table-hover table-sm">
                                    <thead
                                       class=" text-uppercase">
                                       <tr>
                                          <th scope="col">Team</th>
                                          <th scope="col">Match Info</th>
                                          <th scope="col">Team</th>
                                          <th scope="col">Score</th>
                                          <th scope="col">Status</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td class="match-team-logo">
                                             <img src="assets/images/team-logo-3.png" alt="team-logo-3">
                                             <span>SHL</span>
                                             <h6>shillong lajong fc</h6>
                                             <a href="premier-league-players.html"></a>
                                          </td>
                                          <td>
                                             <h6>Chase Stadium</h6>
                                             <p>Fort Lauderdale, Florida</p>
                                             <span>4:00 pm</span>
                                          </td>
                                          <td class="match-team-logo">
                                             <span>CNGZ</span>
                                             <img src="assets/images/team-logo-2.png" alt="team-logo-2">
                                             <h6>Cangzhou Mighty</h6>
                                          </td>
                                          <td class="match-score">
                                            
                                             <h4>2</h4>
                                             
                                          </td>
                                          <td class="match-status">
                                             <p class="win">Win </p>
                                             <p class="lose">lose</p>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="match-team-logo">
                                             <img src="assets/images/team-logo-3.png" alt="team-logo-3">
                                             <span>SHL</span>
                                             <h6>shillong lajong fc</h6>
                                             <a href="premier-league-players.html"></a>
                                          </td>
                                          <td>
                                             <h6>Chase Stadium</h6>
                                             <p>Fort Lauderdale, Florida</p>
                                             <span>4:00 pm</span>
                                          </td>
                                          <td class="match-team-logo">
                                             <span>CNGZ</span>
                                             <img src="assets/images/team-logo-2.png" alt="team-logo-2">
                                             <h6>Cangzhou Mighty</h6>
                                          </td>
                                          <td class="match-score">
                                            
                                             <h4>5</h4>
                                            
                                          </td>
                                          <td class="match-status">
                                             <p class="win">Win </p>
                                             <p class="lose">lose</p>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="match-team-logo">
                                             <img src="assets/images/team-logo-3.png" alt="team-logo-3">
                                             <span>SHL</span>
                                             <h6>shillong lajong fc</h6>
                                             <a href="premier-league-players.html"></a>
                                          </td>
                                          <td>
                                             <h6>Chase Stadium</h6>
                                             <p>Fort Lauderdale, Florida</p>
                                             <span>4:00 pm</span>
                                          </td>
                                          <td class="match-team-logo">
                                             <span>CNGZ</span>
                                             <img src="assets/images/team-logo-2.png" alt="team-logo-2">
                                             <h6>Cangzhou Mighty</h6>
                                          </td>
                                          <td class="match-score">
                                             
                                             <h4>6</h4>
                                             
                                          </td>
                                          <td class="match-status">
                                             <p class="win">Win </p>
                                             <p class="lose">lose</p>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="match-team-logo">
                                             <img src="assets/images/team-logo-3.png" alt="team-logo-3">
                                             <span>SHL</span>
                                             <h6>shillong lajong fc</h6>
                                             <a href="premier-league-players.html"></a>
                                          </td>
                                          <td>
                                             <h6>Chase Stadium</h6>
                                             <p>Fort Lauderdale, Florida</p>
                                             <span>4:00 pm</span>
                                          </td>
                                          <td class="match-team-logo">
                                             <span>CNGZ</span>
                                             <img src="assets/images/team-logo-2.png" alt="team-logo-2">
                                             <h6>Cangzhou Mighty</h6>
                                          </td>
                                          <td class="match-score">
                                            
                                             <h4>4</h4>
                                           
                                          </td>
                                          <td class="match-status">
                                             <p class="win">Win </p>
                                             <p class="lose">lose</p>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="match-team-logo">
                                             <img src="assets/images/team-logo-3.png" alt="team-logo-3">
                                             <span>SHL</span>
                                             <h6>shillong lajong fc</h6>
                                             <a href="premier-league-players.html"></a>
                                          </td>
                                          <td>
                                             <h6>Chase Stadium</h6>
                                             <p>Fort Lauderdale, Florida</p>
                                             <span>4:00 pm</span>
                                          </td>
                                          <td class="match-team-logo">
                                             <span>CNGZ</span>
                                             <img src="assets/images/team-logo-2.png" alt="team-logo-2">
                                             <h6>Cangzhou Mighty</h6>
                                          </td>
                                          <td class="match-score">
                                             
                                             <h4>3</h4>
                                            
                                          </td>
                                          <td class="match-status">
                                             <p class="win">Win </p>
                                             <p class="lose">lose</p>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="match-team-logo">
                                             <img src="assets/images/team-logo-3.png" alt="team-logo-3">
                                             <span>SHL</span>
                                             <h6>shillong lajong fc</h6>
                                             <a href="premier-league-players.html"></a>
                                          </td>
                                          <td>
                                             <h6>Chase Stadium</h6>
                                             <p>Fort Lauderdale, Florida</p>
                                             <span>4:00 pm</span>
                                          </td>
                                          <td class="match-team-logo">
                                             <span>CNGZ</span>
                                             <img src="assets/images/team-logo-2.png" alt="team-logo-2">
                                             <h6>Cangzhou Mighty</h6>
                                          </td>
                                          <td class="match-score">
                                            
                                             <h4>6</h4>
                                           
                                          </td>
                                          <td class="match-status">
                                             <p class="win">Win </p>
                                             <p class="lose">lose</p>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="match-team-logo">
                                             <img src="assets/images/team-logo-3.png" alt="team-logo-3">
                                             <span>SHL</span>
                                             <h6>shillong lajong fc</h6>
                                             <a href="premier-league-players.html"></a>
                                          </td>
                                          <td>
                                             <h6>Chase Stadium</h6>
                                             <p>Fort Lauderdale, Florida</p>
                                             <span>4:00 pm</span>
                                          </td>
                                          <td class="match-team-logo">
                                             <span>CNGZ</span>
                                             <img src="assets/images/team-logo-2.png" alt="team-logo-2">
                                             <h6>Cangzhou Mighty</h6>
                                          </td>
                                          <td class="match-score">
                                            
                                             <h4>0</h4>
                                            
                                          </td>
                                          <td class="match-status">
                                             <p class="win">Win </p>
                                             <p class="lose">lose</p>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="match-team-logo">
                                             <img src="assets/images/team-logo-3.png" alt="team-logo-3">
                                             <span>SHL</span>
                                             <h6>shillong lajong fc</h6>
                                             <a href="premier-league-players.html"></a>
                                          </td>
                                          <td>
                                             <h6>Chase Stadium</h6>
                                             <p>Fort Lauderdale, Florida</p>
                                             <span>4:00 pm</span>
                                          </td>
                                          <td class="match-team-logo">
                                             <span>CNGZ</span>
                                             <img src="assets/images/team-logo-2.png" alt="team-logo-2">
                                             <h6>Cangzhou Mighty</h6>
                                          </td>
                                          <td class="match-score">
                                           
                                             <h4>7</h4>
                                            
                                          </td>
                                          <td class="match-status">
                                             <p class="win">Win </p>
                                             <p class="lose">lose</p>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="match-team-logo">
                                             <img src="assets/images/team-logo-3.png" alt="team-logo-3">
                                             <span>SHL</span>
                                             <h6>shillong lajong fc</h6>
                                             <a href="premier-league-players.html"></a>
                                          </td>
                                          <td>
                                             <h6>Chase Stadium</h6>
                                             <p>Fort Lauderdale, Florida</p>
                                             <span>4:00 pm</span>
                                          </td>
                                          <td class="match-team-logo">
                                             <span>CNGZ</span>
                                             <img src="assets/images/team-logo-2.png" alt="team-logo-2">
                                             <h6>Cangzhou Mighty</h6>
                                          </td>
                                          <td class="match-score">
                                            
                                             <h4>4</h4>
                                             
                                          </td>
                                          <td class="match-status">
                                             <p class="win">Win </p>
                                             <p class="lose">lose</p>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="match-team-logo">
                                             <img src="assets/images/team-logo-3.png" alt="team-logo-3">
                                             <span>SHL</span>
                                             <h6>shillong lajong fc</h6>
                                             <a href="premier-league-players.html"></a>
                                          </td>
                                          <td>
                                             <h6>Chase Stadium</h6>
                                             <p>Fort Lauderdale, Florida</p>
                                             <span>4:00 pm</span>
                                          </td>
                                          <td class="match-team-logo">
                                             <span>CNGZ</span>
                                             <img src="assets/images/team-logo-2.png" alt="team-logo-2">
                                             <h6>Cangzhou Mighty</h6>
                                          </td>
                                          <td class="match-score">
                                            
                                             <h4>3</h4>
                                            
                                          </td>
                                          <td class="match-status">
                                             <p class="win">Win </p>
                                             <p class="lose">lose</p>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Component End  -->
            </div>
         </div>
         </div>
      </section>
      <!--====sign up section end====-->
      <!--====footer navbar start-->
      <footer>
         <div class="container">
            <div class="row footer_nav d-flex align-items-center">
               <div class="col-lg-12">
                  <ul class="nav justify-content-center ">
                     <li class="nav-item">
                        <a class="nav-link ml-0"
                           href="contact.php">CONTACT US</a>
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
                  <p class="para">Copyright &#169; Soccer Spotlight
                     2024.
                  </p>
               </div>
               <div class="col-lg-5 text-center text-sm-start text-lg-end">
                  <p class="para">All rights reserved</p>
               </div>
            </div>
         </div>
      </footer>
      <!--====footer navbar end====-->
      <!-- Button trigger modal -->
      <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
         Launch demo modal
         </button>
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
         Launch demo modal 2
         </button> -->
      <!-- alert-msg popup start -->
      <!-- <div class="alert-msg">
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                  <span>
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#d30f0f"><path d="M480-280q17 0 28.5-11.5T520-320q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320q0 17 11.5 28.5T480-280Zm-40-160h80v-240h-80v240Zm40 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
                  </span>
                     <h4>success</h4>
                 </div>
                 <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ok</button>
                 </div>
             </div>
             </div>
         </div>
         </div> -->
      <!-- alert-msg popup end -->
      <!-- alert-msg popup start -->
      <div class="alert-msg">
         <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#00c900">
                           <path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q65 0 123 19t107 53l-58 59q-38-24-81-37.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160q133 0 226.5-93.5T800-480q0-18-2-36t-6-35l65-65q11 32 17 66t6 70q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-56-216L254-466l56-56 114 114 400-401 56 56-456 457Z"/>
                        </svg>
                     </span>
                     <h4>error</h4>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ok</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- alert-msg popup end -->
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
   </body>
</html>