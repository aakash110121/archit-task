<?php
    $url=$_SERVER["PHP_SELF"];
    $location=explode("/includes",$url);
    $path=$location[0];
    $path=trim($path);
   if (isset($_FILES['file'])) {
        // echo '<pre>';
        //  print_r($_FILES);  
        // echo '</pre>';
        $count=0;
        $is_exists=false;
        $email=$db->test_input($_POST["email"]);
        $file_name=$_FILES['file']['name'];
        $dir_name="assets/uploads/";
        $allowed_paths=["jpg","jpeg","png","PNG","JPEG","JPG"];
        $file_extension=pathinfo($file_name,PATHINFO_EXTENSION);
        function scan()
        {
                $arr=scandir("../assets/uploads");//scanning directory
                // print_r($arr);
                // echo count($arr);
                if($arr!=NULL)
                {
                foreach($arr as $index=>$values)//trasversing through each file
                {   global $file_name;
                    global $count;
                    global $is_exists;
                    $row=explode(".",$values);//check if duplicate file already exists
                    // echo "inside          ";
                    if($row[0]==pathinfo($file_name,PATHINFO_FILENAME))
                    {
                        // echo $row[0]."           ";
                        if(preg_match("/\((\d+)\)\.(jpg|jpeg|png|PNG|JPEG|JPG)$/",pathinfo($file_name,PATHINFO_FILENAME)))
                        {
                            $pattern='/\((\d+)\)\.(jpg|jpeg|png|PNG|JPEG|JPG)$/';
                            $res=preg_split($pattern,$values);
                            print_r($res);
                            if($res[0]==pathinfo($file_name,PATHINFO_FILENAME))
                            {
                                $count++;
                            }
                            $is_exists=true;
                        }
                        else
                        {
                            
                                foreach($arr as $index=>$values)
                                {
                                    $pattern='/\((\d+)\)\.(jpg|jpeg|png|PNG|JPEG|JPG)$/';
                                    $res=preg_split($pattern,$values);
                                    if($res[0]==pathinfo($file_name,PATHINFO_FILENAME))
                                    {
                                        $count++;
                                    }
                                    $is_exists=true;
                                }
                        } 
                        
                    }
                  
                    if($is_exists==true)
                    {
                        break;
                    }  
                }
            }
            return $is_exists;
        }



        if(file_exists("../".$dir_name))
        {       
            if(in_array($file_extension,$allowed_paths))
            {    $result=scan();
                if($result==true)
                {
                    $file=$dir_name.pathinfo($file_name,PATHINFO_FILENAME)."(".$count.")".".".pathinfo($file_name,PATHINFO_EXTENSION);
                }
                else
                {
                    $file=$dir_name.$file_name;
                }
                move_uploaded_file($_FILES["file"]["tmp_name"],"../".$file);
                $arr=["status"=>"success","file_path"=>$file];
                $res=json_encode($arr);
                echo $res;
            }
            else
            {
                $arr=["status"=>"failed","msg"=>$db->msg("danger","Not a valid file type")];
                $res=json_encode($arr);
                echo $res;
            }
        }
        else
        {
                 mkdir("../".$dir_name);
                if(in_array($file_extension,$allowed_paths))
                {    $result=scan();
                    if($result==true)
                    {
                        $file=$dir_name.pathinfo($file_name,PATHINFO_FILENAME)."(".$count.")".pathinfo($file_name,PATHINFO_EXTENSION);
                    }
                    else
                    {
                        $file=$dir_name.$file_name;
                    }
                    move_uploaded_file($_FILES["file"]["tmp_name"],"../".$file);
                    $arr=["status"=>"success","file_path"=>$file];
                    $res=json_encode($arr);
                    echo $res;
                }
                else
                {
                    $arr=["status"=>"failed","msg"=>$db->msg("danger","Not a valid file type")];
                    $res=json_encode($arr);
                    echo $res;
                }
        }

        
    }
?>