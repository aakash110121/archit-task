<?php
  
    // print_r($_POST);
    $email=$db->test_input($_POST["email"]);
    $path=$db->test_input($_POST["path"]);
    $arr=explode("../",$path);
    $path=$arr[1];
    if($db->UploadFile($email,$path))
    {
      
        $arr=["status"=>"success","msg"=>$db->msg('success', "Profile updated")];
        $res=json_encode($arr);
        echo $res;
    }
    else
    {
      
        $arr=["status"=>"failed","msg"=>$db->msg('failed', "Profile not updated")];
        $res=json_encode($arr);
        echo $res;
    }

?>