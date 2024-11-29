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
      <title>How To Play</title>
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
                  if(!isset($_SESSION["user"])){
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
                              <?php
                              if(isset($_SESSION["user"]))
                              {
                              ?>
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                              <?php
                              }
                              ?>
                            </div>
                            <div class="dropdown">
                                <ul>
                                    <li><a href="Admin/my-profile.php"><img src="assets/images/user.svg" alt="user">My Profile</a>
                                    </li>
                                    <li>
                                        <a href="my-matches.php"><img src="assets/images/stadium.svg" alt="stadium">My Matches</a>
                                    </li>
                                    <li>
                                        <a href="Admin/logout.php"><img src="assets/images/logout.svg" alt="logout">log Out</a>
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
                        <a class="nav-link" href="#">HOW TO PLAY</a>
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
     <section class="how-to-play">
        <div class="container">
            <h1>How to play</h1>
            <div class="how-to-play-banner">
                <div class="how-to-play-banner-content">
                    <img src="assets/images/how-to-play.png" alt="how-to-play">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="88px" viewBox="0 -960 960 960" width="88px" fill="#fff"><path d="M480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-155.5t86-127Q252-817 325-848.5T480-880q83 0 155.5 31.5t127 86q54.5 54.5 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm205-493 69-24 18-64q-34-53-84-90.5T575-809l-65 43v70l175 123Zm-409 0 174-123v-70l-64-43q-63 20-113 57.5T189-661l22 64 65 24Zm-54 320 60-7 39-65-62-191-71-24-48 39q0 72 16 131.5T222-253Zm258 113q27 0 54.5-5t57.5-13l33-72-32-55H368l-32 55 33 72q26 8 55 13t56 5ZM374-345h208l61-183-163-117-166 117 60 183Zm365 92q49-57 65-116.5T820-501l-48-33-70 18-62 191 38 65 61 7Z"/></svg>
                    </span>
                    <h2>Football</h2>
                </div>
                <div class="how-to-play_content">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Creating Your Team
                            </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <img src="assets/images/how-play-1.png" alt="how-play-1">
                                <p>
                                    Every football team you build on fantasy league has to have 11 players, of which a <strong>maximun of 7 players </strong>
                                    can be from any one team playing the real-life match 
                                </p>
                                <table class="table table-light table-striped table-hover">
                                    <tr>
                                        <th>Player Type</th>
                                        <th>Min</th>
                                        <th>Max</th>
                                    </tr>
                                    <tr>
                                        <td>GoalKeeper</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>Defender</td>
                                        <td>3</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>MidFielder</td>
                                        <td>3</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>Forward</td>
                                        <td>1</td>
                                        <td>3</td>
                                    </tr>
                                </table>
                                <h4>Captian and Vice-Captain Points</h4>
                                <img src="assets/images/how-play-1.png" alt="how-play-1">
                                <p>once you have seleccted your 11 players, you will have to assign a captain and vice-captain for your team.</p>
                                <p>The captain willl give you <strong>2x points</strong>  scrored by them in the actual match.</p>
                                <p>the vice-captain will give you <strong>1.5x points</strong> scored by them in the actual match.</p>
                                <div class="box">
                                    <p>the captained by (% C by) and Vice-Captained By (% VC By ) Stats help you understand how other players have chosen their teams</p>
                                    <p>choose a popular pick as captain, or find a differential to score big againts your competition.</p>
                                </div>
                                <p>For a detailed points system, check below:</p>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                             Fantasy Points System
                            </button>
                          </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="accordion accordion-flush inner-accordion" id="accordionFlushExample">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                          attack
                                        </button>
                                      </h2>
                                      <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                          <img src="assets/images/fb-bg.svg" alt="fb-bg">
                                          <table class="table table-light table-striped table-hover">
                                            <tr>
                                              <td colspan="2">
                                                <h6>Goal</h6>
                                              </td>
                                              
                                            </tr>
                                            <tr>
                                              <td>
                                               <h6>Scored by a striker</h6> 
                                              </td>
                                              <td><span>+40</span> </td>
                                            </tr>
                                            <tr>
                                              <td><h6>Scored by a mid-fielder</h6> </td>
                                              <td> <span> +50</span></td>
                                            </tr>
                                            <tr>
                                              <td><h6>Scored by a defender or goalkeeper</h6></td>
                                              <td><span>+60</span></td>
                                            </tr>
                                            <tr>
                                              <td><h6>Assist</h6></td>
                                              <td><span>+20</span></td>
                                            </tr>
                                            <tr>
                                              <td><h6>Assist</h6>
                                              <p>The final pass leading to a shot (on target including goals, blocked or off target)</p>
                                              </td>
                                              <td><span>+3</span></td>
                                            </tr>
                                            <tr>
                                              <td><h6>Shot on Target</h6>
                                              <p>Includes Goals</p>
                                              </td>
                                              <td><span>+6</span></td>
                                            </tr>
                                            <tr>
                                              <td><h6>5 Passes Completed</h6>
                                              </td>
                                              <td><span>+1</span></td>
                                            </tr>
                                          </table>
                                          <ul>
                                            <li>
                                              <ul>
                                                <li>A  <strong>Direct Assist</strong>  is the final touch (pass, cross or any other touch) leading to the recipient of the ball scoring a goal.</li>
                                              
                                              </ul>
                                            </li>
                                            <li>In addition to normal assists, the following types of Fantasy Assists will be awarded to a player:
                                              <ul>
                                                <li>When a shot is saved by goalkeeper, blocked by the opposition player or hits the goal post, and is scored on the rebound</li>
                                                <li>When a player wins a penalty or a direct free-kick that is scored</li>
                                                <li>When an opposition player scores an own goal off a cross, pass or shot</li>
                                              </ul>
                                            </li>
                                            <li>A <strong>Chance Created</strong>, also known as a 'key pass', is the final touch (pass, cross or any other touch) leading to a shot, regardless of whether it is on target (including goals), blocked or off target.</li>
                                            <li>
                                              <strong>Note:</strong>  If a player gets points for a Fantasy Assist, they will <strong>not be awarded</strong>   points for a Chance Created. For example, if a player's shot is saved by a goalkeeper and is scored on the rebound, the player will get points for a Shot on Target and Fantasy Assist, but won't earn points for Chance Created.
                                            </li>
                                            <li>A <strong>Shot on Target</strong>  is any goal attempt that:</li>
                                            <li>
                                              <ul>
                                                <li>Is a goal</li>
                                                <li>Would have been a goal but was saved by the goalkeeper or was stopped by an opposition player who is the last-man (with the goalkeeper having no chance of preventing the goal)</li>
                                              </ul>
                                            </li>
                                            <li>shot on target in NOT awarded when:
                                              <ul>
                                                <li>The shot hits the goal post (unless the ball goes in and is a goal)</li>
                                                <li>The shot is blocked by another player, who is not the last-man</li>
                                              </ul>
                                            </li>
                                            <li>If player A passes the ball to player B, who then scores, then player B is awarded a Goal and a Shot on Target, while player A is awarded an Assist and Chance Created</li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                          Defence
                                        </button>
                                      </h2>
                                      <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                          <img src="assets/images/fb-bg.svg" alt="fb-bg">
                                          <table class="table table-light table-striped table-hover">
                                            <tr>
                                              <td>
                                               <h6>tackle Won</h6> 
                                              </td>
                                              <td><span>+4</span> </td>
                                            </tr>
                                            <tr>
                                              <td><h6>interception</h6> </td>
                                              <td> <span> +4</span></td>
                                            </tr>
                                            <tr>
                                              <td><h6>saves</h6>
                                              <p>gk</p></td>
                                              <td><span>+6</span></td>
                                            </tr>
                                            <tr>
                                              <td><h6>penality saved</h6>
                                              <p>gk</p></td>
                                              <td><span>+50</span></td>
                                            </tr>
                                            <tr>
                                              <td><h6>clean sheet</h6>
                                              <p>gk/def (played more then 54 minutes)</p>
                                              </td>
                                              <td><span>+20</span></td>
                                            </tr>
                                          </table>
                                          <ul>
                                            <li>A <strong>Tackle Won</strong>  is a tackle where the player successfully takes the ball away from the player in possession, by either winning possession or putting the ball out of play</li>
                                            <li>An <strong>Interception Won</strong>  is where a player intentionally intercepts a pass, by moving into the line of the intended ball, and retains possession of the ball</li>
                                            <li>A <strong>Save</strong>  is where a goalkeeper prevents the ball from entering the goal with any part of his body</li>
                                            <li>A <strong>Clean Sheet</strong>  is awarded for not conceding a goal whilst on the field for more than 54 minutes</li>
                                            <li>If a player gets substituted before a goal is conceded but has played more than 54 minutes, they will still get the Clean Sheet bonus.</li>
                                            <li>If a player misses a penalty kick but the goalkeeper hasn't touched the ball, the goalkeeper will NOT get any points for saving the penalty, while the penalty taker will get -20 points for the miss</li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                         other Points
                                        </button>
                                      </h2>
                                      <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                          <img src="assets/images/fb-bg.svg" alt="fb-bg">
                                          <table class="table table-light table-striped table-hover">
                                            <tr>
                                              <td>
                                               <h6>captain</h6> 
                                              </td>
                                              <td><span>2x</span> </td>
                                            </tr>
                                            <tr>
                                              <td><h6>vice-captain</h6> </td>
                                              <td> <span> 1.5x</span></td>
                                            </tr>
                                            <tr>
                                              <td><h6>in starting 11</h6>
                                              <td><span>+4</span></td>
                                            </tr>
                                            <tr>
                                              <td><h6>coming on as a substitute </h6>
                                              <td><span>+2</span></td>
                                            </tr>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapseThree">
                                            Cards And Other Penalties
                                          </button>
                                        </h2>
                                        <div id="flush-collapsefour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                          <div class="accordion-body">
                                            <img src="assets/images/fb-bg.svg" alt="fb-bg">
                                            <table class="table table-light table-striped table-hover">
                                              <tr>
                                                <td>
                                                 <h6>yellow card</h6> 
                                                </td>
                                                <td><span>-4</span> </td>
                                              </tr>
                                              <tr>
                                                <td><h6>red card</h6> </td>
                                                <td> <span> -10</span></td>
                                              </tr>
                                              <tr>
                                                <td><h6>own goal</h6>
                                                <td><span>+8</span></td>
                                              </tr>
                                              <tr>
                                                <td><h6>goals conceded 
                                                  <p>gk/def/(on the feild when the gaol is scored)</p>
                                                </h6>
                                                <td><span>-2</span></td>
                                              </tr>
                                              <tr>
                                                <td><h6>penalty missed</h6>
                                                <td><span>-20</span></td>
                                              </tr>
                                            </table>
                                            <ul>
                                              <li>Goals conceded will be counted for the players playing on the field at the time of the goal irrespective of player's total playing time</li>
                                              <li>
                                                If a player receives a red card, he will continue to be penalised for goals conceded by his/her team. i.e for the goals conceded after he leaves the field
                                              </li>
                                              <li>If a player gets a yellow card and then a second yellow (or even straight red), he only gets negative points for the red card</li>
                                              <li>If a player receives a yellow or red card for an off-field activity, the Fantasy Points will come into effect if:
                                                <ul>
                                                  <li>He already played the match and was substituted.</li>
                                                  <li>He comes onto the field as a substitute after receiving a yellow card.</li>
                                                </ul>
                                              </li>
                                              
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                             Other Important Points
                            </button>
                          </h2>
                          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <ul>
                                <li>
                                    we get all our stats from Opta, the world's leading football data provider. however, in case there is a clear error from our provider's end,we may modify the stats.
                                </li>
                                <li>
                                    the player you choose to be your team's captain will receive <strong>2 times </strong> the points for his/her performance 
                                </li>
                                <li>
                                    the players you choose to be your team's  Vice-Captain will received <strong>1.5 times</strong> the points for his/her performance
                                </li>
                                <li>
                                    54 minutes and 1 second onwards (54'1") will be considered as 55 minutes for the purpose of points calculation
                                </li>
                                <li>once a match has been marked as <strong>completed</strong> and winners have been <strong>declared,</strong> on further adjustments will be made to the points awarded. Points awarded for a LIVE game will be subject to change only when the match status is <strong>"in Progress" or </strong> <strong>"in Review".</strong></li>
                                <li>Any events during extra time will be considered for awarding points </li>
                                <li>
                                    Starting points are assigned to any player on the basis of announcement of his/her inclusion in the team. However, in case the player is unable to start the match after being included in the team sheet, he/she will not score any points. Points shall however, be applicable (including starting points) to any player who plays as a replacement of such player to whom starting points were initially assigned.
                                </li>
                                <li>
                                    In case a player is transferred/reassigned to a different team between two scheduled updates, for any reason whatsoever, such transfer/reassignment (by whatever name called) shall not be reflected in the roster of players until the next scheduled update. It is clarified that during the intervening period of two scheduled updates, while such player will be available for selection in the team to which the player originally belong, no points will be attributable to such player during the course of such contest.

                                </li>
                                <li>
                                    A player who has not participated in the game as part of the starting 11 or as a substitute, will not be awarded negative points for receiving a yellow or red card for off field activity
                                </li>
                                <li>
                                    If a goal is scored from a penalty or direct free-kick, the player earning the foul is awarded an assist only if someone else from their team scores the goal. If the player earning the penalty or free-kick scores the goal themselves, they will only earn points for the goal and NOT the assist.
                                </li>
                                <li>
                                    In case the player does not play the match at all, no points will be given.
                                </li>
                                <li>If a player received a yellow or red card for an off-field activity, the Fantasy Points will come into effect if</li>
                                <li>
                                    <ul>
                                        <li>He already played the match and was subbed off</li>
                                        <li>He comes on the field as substitute after receiving a yellow card and plays the match</li>
                                    </ul>
                                </li>
                                
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                </div>
            </div>
        </div>
     </section>
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
		  
      <!-- preview popup start  -->
      <div class="modal fade preview" id="exampleModalToggle" aria-labelledby="exampleModalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                    
                    <div class="preview-content">
                     <img src="assets/images/preview.png" alt="preview">
                    </div>
                 </div>
             </div>
         </div>
     </div>
<!-- preview popup end  -->
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