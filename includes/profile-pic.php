<?php
    $url=$_SERVER["PHP_SELF"];
    $location=explode("/includes",$url);
    $path=$location[0];
    $path=trim($path);
   if (isset($_FILES['file'])) {
        echo '<pre>';
         print_r($_FILES);  // Check the contents of the $_FILES array
        echo '</pre>';
        $email=$db->test_input($_POST["email"]);
        $file_name=$_FILES['file']['name'];
        $dir_name="assets/uploads/";
        $allowed_paths=["jpg","jpeg","png","PNG","JPEG","JPG"];
        $file_extension=pathinfo($file_name,PATHINFO_EXTENSION);
        if(file_exists("../".$dir_name))
        {
           if(!file_exists($dir_name.$file_name))
           {    if(in_array($file_extension,$allowed_paths))
                {
                    move_uploaded_file($_FILES["file"]["tmp_name"],"../".$dir_name.$file_name);
                    $db->UploadFile($email,$dir_name.$file_name);
                }
           }
        }
        else
        {
            mkdir("../".$dir_name);
            if(in_array($allowed_paths,$file_extension))
                {
                    move_uploaded_file($_FILES["file"]["tmp_name"],"../".$dir_name.$file_name);
                    $db->UploadFile($email,$dir_name.$file_name);
                }
        }
    }
?>