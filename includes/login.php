<?php
      // print_r($_POST);
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;   
      $email=$db->test_input($_POST["email"]);
      $password=$db->test_input($_POST["password"]);
      if($LoggedUser=$db->LoginUser($email)){
            
          if(password_verify($password,$LoggedUser["password"]))//password verify
          {   
              $user_ban=$db->wrong_pass_check_user_ban($email);
              if($user_ban==NULL)
              {
              $result=$db->check_user_authenticated($email);//isAuthenticated=0 initially it should be 1 returns null if not 1
              if($result!=NULL)
              {
                  if(isset($_COOKIE["emailRemember"])&&$email==$_COOKIE["emailRemember"])
                  {
                      $res=$email;
                      $_SESSION["user"]=$res;
                      setcookie("email",$res,time()+60*60*24*30,"/");
                      $msg=["status"=>"success","msg"=>$db->msg("success","Successfully logged in")];
                      $json=json_encode($msg);
                      echo $json;
                  }
                  else
                  {
                      $otp=mt_rand(10000000,99999999);//otp creation
                      if($db->otp_create($email,$otp))//otp send
                      {
                          
                        $otp=mt_rand(10000000,99999999);//otp creation
                        if($db->otp_create($email,$otp))//otp send
                        {
                          
                          // Load Composer's autoloader
                          require "../vendor/autoload.php";
                          $mail = new PHPMailer(true);
                               try {
                                  $mail->isSMTP();
                                  $mail->Host = $_ENV['MAIL_HOST']; // Correct SMTP server
                                  $mail->SMTPAuth = true;
                                  // "pqtdzjvjkxneyhaq" "vaac tjgt irxs ckmw"
                                  // Use your own Gmail account credentials to authenticate
                                  $mail->Username = $_ENV['Username'];  // Your Gmail address
                                  $mail->Password =$_ENV['Password'];  // Your Gmail address
                                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption method
                                  $mail->Port = $_ENV['MAIL_PORT'];  // TLS port is 587
                              
                                  // Set the sender email (user's email address)
                                  $mail->setFrom( $_ENV['Admin']);  // $email is user input
                                  $mail->SMTPOptions = [
                                      'ssl' => [
                                          'verify_peer' => false,
                                          'verify_peer_name' => false,
                                          'allow_self_signed' => true,
                                      ],
                                  ];
                                  
                                  // Add the recipient email (admin or destination email)
                                  $mail->addAddress($email); 
                                  $mail->addReplyTo( $_ENV['Admin'], 'Add reply');
                                  // Set email format to HTML
                                  $mail->isHTML(true);
                                  $mail->Subject = "OTP request";
                                  // .date("l jS \of F Y h:i:s A").
                                  $mail->Body = '
                                  <div>
                                      <h1>Dear ' . $LoggedUser["first_name"] . ' ' . $LoggedUser["last_name"] . '</h1><br><br>
                                      <p>Your verification code is <span style="color:red;">' . $otp . '</span>. It is valid for 5 minutes. Do not share this code with anyone.</p>  
                                  </div>';
                                  
                                 
                                 
                                
                                  if($mail->send())
                                  {
                                      $msg=["status"=>"otp-send","msg"=>$db->msg('success', "OTP SEND "),"email"=>$email];
                                      $json=json_encode($msg);
                                      echo $json;
                                  }
                                  else
                                  {
                                      $msg=["status"=>"failed","msg"=>$db->msg("danger","Mail didnt send")];
                                      $json=json_encode($msg);
                                      echo $json;
                                  }
                                }  
                               catch (Exception $e) {
                                  // Output detailed error message
                                  echo 'Mailer Error: ' . $mail->ErrorInfo;
                              }
                        }
                        else
                        {
                            $msg=["status"=>"failed","msg"=>$db->msg("danger","OTP not send")];
                            $json=json_encode($msg);
                            echo $json;
                        } 
                      }
                      else
                      {
                          $msg=["status"=>"failed","msg"=>$db->msg("danger","OTP not send")];
                          $json=json_encode($msg);
                          echo $json;
                      } 
                  }
              }
              else
              {
                  $msg=["status"=>"failed","msg"=>$db->msg("danger","User Not Authenticated")];
                  $json=json_encode($msg);
                  echo $json;
              }
            }
            else
            {
                $time=$db->wrong_pass_log($email); 
                $res=$db->ban_exists($email);
                $amt=$res["ban_count"];
                echo "uSER BANNED CORRECT PASSWORD";
                // $type=$amt!=2?"Minutes":"Hours";
                // $msg=["status"=>"failed","msg"=>$db->msg("danger","User banned"),"flag"=>"banned","time"=>$db->msg("danger","Banned for"." ".$time." ".$type)];
                // $json=json_encode($msg);
                // echo $json;
            } 
          }
          else
          {
                  $time=$db->wrong_pass_log($email);
                  if($time==NULL)
                  {
                        echo "null value means useer is not blocked yet";
                        // $msg=["status"=>"failed","msg"=>$db->msg("danger","Password doesnt match"),"flag"=>"forgot","attempts"=>$db->msg("danger","Attempts Left"." ".$db->attempts." "."of 3")];
                        // $json=json_encode($msg);
                        // echo $json;
                                                                                                                                   // attempts"=>$db->attempts                         
                  }
                  else if($time==404)
                  {     echo "null value means USER WAL BLOCKED PREVIOUSLY NOW BAN LIFTED THAT LIFTER BAN 1 CLICK NO RESPONSE";
                    // $msg=["status"=>"failed","msg"=>$db->msg("danger","Password doesnt match"),"flag"=>"forgot","attempts"=>$db->msg("danger","Attempts Left"." ".$db->attempts." "."of 3")];
                    // $json=json_encode($msg);
                    // echo $json;
                  }
                  else
                  { echo "null value means useer is blocked ";
                    // $res=$db->ban_exists($email);
                    // $amt=$res["ban_count"];
                    // $type=$amt!=2?"Minutes":"Hours";
                    // $msg=["status"=>"failed","msg"=>$db->msg("danger","User banned"),"flag"=>"banned","time"=>$db->msg("danger","Banned for"." ".$time." ".$type)];
                    // $json=json_encode($msg);
                    // echo $json;
                  }   
          }
      }
      else
      {
           
          $msg=["status"=>"failed","msg"=>$db->msg("danger","User does not exists")];
          $json=json_encode($msg);
          echo $json;
      }
 

?>