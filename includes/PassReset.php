<?php

    $pass=$db->test_input($_POST["pass"]);
    $cpass=$db->test_input($_POST["cpass"]);
    $token=$db->test_input($_POST["token"]);
    if($pass===$cpass)
    {
        if($res=$db->get_email($token))
        {
           $email=$res["email"];
           $res=$db->pass_reset_verify($token,$email);
           if($res!=NULL)
           {
                $pass=password_hash($pass,PASSWORD_DEFAULT);
                if($db->PasswordReset($pass,$email))
                {
                    $arr=["status"=>"success","msg"=>$db->msg("success","Password Changed successfully")];
                    $res=json_encode($arr);
                    echo $res;
                }
                else
                {
                    $arr=["status"=>"failed","msg"=>$db->msg("danger","error occured")];
                    $res=json_encode($arr);
                    echo $res;
                }
           }
        }
    }
    else
    {  
        $arr=["status"=>"failed","msg"=>$db->msg("danger","Password not matched")];
        $res=json_encode($arr);
       echo $res;
    }
?>