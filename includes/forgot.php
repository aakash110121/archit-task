<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception; 
    $host=$_SERVER["SERVER_NAME"];
    $url=$_SERVER["PHP_SELF"];
    $arr=explode("/",$url);
    $root=$arr[1];
    $email=$db->test_input($_POST["email"]);
    $str=uniqid();
    $token=str_shuffle($str);
    $db->Password_reset($email,$token);
    require "../vendor/autoload.php";
    $mail = new PHPMailer(true);
         try {
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST']; 
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['Username']; 
            $mail->Password =$_ENV['Password'];  
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $_ENV['MAIL_PORT'];  
        
           
            $mail->setFrom( $_ENV['Username']); 
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];
            
           
            $mail->addAddress($email); 
            $mail->addReplyTo( $_ENV['Username'], 'Add reply');
          
            $mail->isHTML(true);
            $mail->Subject = "OTP request";
           
            $mail->Body = "
            <div>
                <h1>Dear User </h1><br><br>
                <p>Please visit <a href='http://".$host."/".$root."/forgot.php?token=".$token."'>Reset Password</a></span> for password reset</p>  
            </div>";
            
            if($mail->send())
            {
                $msg=["status"=>"success","msg"=>$db->msg('success', "Password reset Link send to email"),"email"=>$email];
                $json=json_encode($msg);
                echo $json;
            }
            else
            {
                $msg=["status"=>"failed","msg"=>$db->msg("danger","reset Link failed to send")];
                $json=json_encode($msg);
                echo $json;
            }
          }  
         catch (Exception $e) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
?>