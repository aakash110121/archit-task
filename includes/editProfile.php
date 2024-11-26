<?php
    $email=$_POST["email"];
    $url=$_POST["path"];
    if($db->url_insert($email,$url))
    {
        $arr=["status"=>"success","msg"=>$db->msg("success","profile picture updated succesfully")];
        $msg=json_encode($arr);
        echo $msg;
    }
    
?>