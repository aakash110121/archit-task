<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        $name = $db->test_input($_POST["name"]);
        $email = $db->test_input($_POST["email"]);
        $subject = $db->test_input($_POST["subject"]);
        $mailmsg = $db->test_input($_POST["message"]);
        
      
            // Load Composer's autoloader
            require '../vendor/autoload.php';
            $mail = new PHPMailer(true);
             try {
                        $mail->isSMTP();
                        $mail->Host = $_ENV['MAIL_HOST']; // Correct SMTP server
                        $mail->SMTPAuth = true;
                    
                        // Use your own Gmail account credentials to authenticate
                        $mail->Username = $_ENV['Username'];  // Your Gmail address
                        $mail->Password =$_ENV['Password'];  // Your Gmail address
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption method
                        $mail->Port = $_ENV['MAIL_PORT'];  // TLS port is 587
                    
                        // Set the sender email (user's email address)
                        $mail->setFrom($email);  // $email is user input
                        $mail->SMTPOptions = [
                         'ssl' => [
                             'verify_peer' => false,
                             'verify_peer_name' => false,
                             'allow_self_signed' => true,
                         ],
                     ];
                     
                        // Add the recipient email (admin or destination email)
                        $mail->addAddress($_ENV['Admin'], "Admin"); 
                        $mail->addReplyTo($email, 'Add reply');
                        // Set email format to HTML
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        // .date("l jS \of F Y h:i:s A").
                        $mail->Body = '<div>
                            <h1>Hello Sir</h1><br><br>
                            <p>You have received a new contact form submission from your website.</p><br><br<h3>Here are details:</h3><br><br>
                            <span><h4>-<strong>**Name**</strong>:'.$name.'</h4></span><br><span><h4>-<strong>**email**</strong>:'.$email.'</h4></span><br><br><br><h4>**Message</h4><p>'.$mailmsg.'</p>
                            <br>Best regards,<br>'.$name.'  
                        </div>';
                        
                        // $mail->SMTPDebug = 3; // Set to 0 in production to avoid exposing sensitive information
                       
                        // Send the email
                       
                      
                        if($mail->send())
                        {
                             $msg=["status"=>"success","msg"=>$db->msg('success', "Mail has been sent")];
                             $json=json_encode($msg);
                             echo $json;
                        }
                        else
                        {
                             $msg=["status"=>"failed","msg"=>$db->msg('danger', "Something wrong sending email")];
                             $json=json_encode($msg);
                             echo $json;
                        }
                      }  
                     catch (Exception $e) {
                        // Output detailed error message
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }
             
  

?>