<?php
require "connection.php";
include "Trait.php";
Class Auth extends Connection{
    public $attempts;
    public function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    public function user_exists($email)
    {
        $sql="SELECT email from db_user where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function Register($fname,$lname,$email,$phone,$hash)
    { 
        $sql="INSERT INTO db_user(first_name,last_name,email,phone,password) VALUES(:fname,:lname,:email,:phone,:hash)";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["fname"=>$fname,"lname"=>$lname,"email"=>$email,"phone"=>$phone,"hash"=>$hash]);
        return true;
    }
    public function update_user_authenticated($email)
    {
        $sql="UPDATE db_user SET isAuthenticated=1 where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);  
    }
    public function check_user_authenticated($email)
    {
        $sql="SELECT email from db_user where email=:email AND isAuthenticated=1";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    // public function check_user_authenticate($email)
    // {
    //     $sql="SELECT email from db_user where isAuthenticated=1 and email=:email";
    //     $stmt=$this->conn->prepare($sql);
    //     $stmt->execute(["email"=>$email]);   
    // }
    public function LoginUser($email){
        $sql="SELECT first_name,last_name,email,password from db_user where email=:email AND deleted!=0";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        return($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function Login($email){
        $sql="SELECT * from db_user where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        return($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function Update($id,$fname,$lname,$email,$phone){
        $sql="UPDATE db_user SET first_name=:fname,last_name=:lname,email=:email,phone=:phone where id=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["fname"=>$fname,"lname"=>$lname,"email"=>$email,"phone"=>$phone,"id"=>$id]);
        $stmt->close();
        return(true);
    }
    public function email_otp_exists($email)
    {
        $sql="SELECT otp FROM otp_detail WHERE email=:email";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["email"=>$email]);
            $otp=$stmt->fetch(PDO::FETCH_ASSOC);
            return $otp;   
    }
    public function otp_create($email,$otp)
    {   if($this->email_otp_exists($email))
        {
            $sql="UPDATE otp_detail SET otp=:otp,createdAt=NOW() WHERE email=:email";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["email"=>$email,"otp"=>$otp]);
            return true;  
        }
        else
        {
        $sql="INSERT INTO otp_detail(email,otp,createdAt) VALUES(:email,:otp,NOW())";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email,"otp"=>$otp]);
        return true;
        }
    }
    public function verify_otp($otp,$email)
    {
        $sql="SELECT email from otp_detail where otp=:otp AND email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["otp"=>$otp,"email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    public function otp_check_request($email)
    {
        $sql="SELECT email from otp_detail where email=:email AND createdAt>=NOW()-INTERVAL 5 MINUTE";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
   




    /*<<<<<<<<<<<<<<<<<<<<Login Form password ban>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/
    public function is_empty($email)
    {
        $sql="SELECT count(*) AS count FROM wrong_pass_logs WHERE email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        $count=$res["count"];
        return $count;  
    }
    public function req_frequency($email)
    {
        $sql="SELECT count(*) AS count FROM wrong_pass_logs WHERE email=:email AND submit_time<NOW()-INTERVAL 5 MINUTE";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        $count=$res["count"];
        return $count;  
    }
    public function count($email)
    {
        $sql="SELECT count(*) AS count FROM wrong_pass_logs WHERE email=:email AND submit_time>=NOW()-INTERVAL 5 MINUTE";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        $count=$res["count"];
        return $count;
    }
    public function wrong_pass_count($email){
        $count=$this->count($email);
        $req_freq=$this->req_frequency($email);
        if($req_freq!=0)
        {
            $sql="DELETE FROM wrong_pass_logs WHERE email=:email AND submit_time<NOW()-INTERVAL 5 MINUTE";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["email"=>$email]);
            $count=$this->wrong_pass_remove_banned_user($email);
            $count=$this->count($email);    
        }
       
        return $count;
    }
    
    public function wrong_pass_log($email)
    {
        $count=$this->wrong_pass_count($email);
        $this->attempts=3-$count;
        if(($this->attempts)>=1&&($this->attempts)<=3)
        { 
            
                $sql="INSERT INTO wrong_pass_logs(email,submit_time) VALUES(:email,NOW())"; 
                $stmt=$this->conn->prepare($sql);
                $stmt->execute(["email"=>$email]);
 
        }
        else
        {
            if($this->wrong_pass_check_user_ban($email)==NULL)//checks if user is not already banned 
            {
                $this->wrong_pass_user_ban($email);//if user not banned its banned
            }  
            $res=$this->wrong_pass_ban_left($email);//checks for user already banned
            return $res;
        }
    }
    public function wrong_pass_check_user_ban($email)
    {   
        $sql="SELECT email FROM wrong_pass_banned WHERE email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    public function wrong_pass_user_ban($email)//banning user inserting value wrong_pass_banned table
    {
        $sql="INSERT INTO wrong_pass_banned(email,createdAt) VALUES(:email,NOW())"; 
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $this->wrong_pass_ban_update($email); 
    } 
    public function wrong_pass_ban_update($email)
    {
        $res=$this->ban_exists($email);
        if($res!=NULL)
        {   $count=$res["ban_count"];
            $sql="UPDATE user_ban_count SET ban_count=:ban_count";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["ban_count"=>$count+1]);
        }
        else
        {
            $sql="INSERT INTO user_ban_count(email) VALUES(:email)";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["email"=>$email]);
        }
    }
    public function ban_exists($email)
    {
        $sql="SELECT ban_count from user_ban_count where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        return $res; 
    }
   
    public function verify_user_ban($email)
    {   
        $res=$this->ban_exists($email);//checks for how mnay time user got banned before
        $count=$res["ban_count"];
       
            if($count!=2)
            {
                $sql="SELECT email FROM wrong_pass_banned WHERE createdAt>NOW()-INTERVAL 1 HOUR and email=:email";
          
            }
            else
            {
                $sql="SELECT email FROM wrong_pass_banned WHERE createdAt>NOW()-INTERVAL 24 HOUR and email=:email";
            }
       
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    public function  wrong_pass_ban_left($email)
    {
        $res=$this->verify_user_ban($email);//checks if user is already banned or his banned time is over
        if($res==NULL)
        {
            $this->wrong_pass_remove_log($email);
            $this->wrong_pass_remove_banned_user($email);
            $db->attempts=3;
            return 404;
        }
        else
        {
            $res=$this->ban_exists($res["email"]);
            $count=$res["ban_count"];
            if($count!=2)
            {
                $sql="SELECT TIMESTAMPDIFF(MINUTE,NOW(),DATE_ADD(createdAt,INTERVAL 60 MINUTE)) AS time_left FROM wrong_pass_banned where email=:email";
              
            }
            else
            {
                $sql="SELECT TIMESTAMPDIFF(HOUR,NOW(),DATE_ADD(createdAt,INTERVAL 24 HOUR)) AS time_left FROM wrong_pass_banned where email=:email";
               
            }
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["email"=>$email]);
            $res=$stmt->fetch(PDO::FETCH_ASSOC);
            $time=$res["time_left"];
            return $time;
        }
    }
    public function wrong_pass_remove_log($email){
            $sql="DELETE FROM wrong_pass_logs where email=:email"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["email"=>$email]); 
    }
    public function wrong_pass_remove_banned_user($email){
            $sql="DELETE FROM wrong_pass_banned where email=:email"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["email"=>$email]); 
    }
   
    
     /*<<<<<<<<<<<<<<<<<<<<Login Form password ban end>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>*/
    use responsemsg;
    Use mail;
    Use PassReset;
    Use UrlReset;
    Use GetUrl;
}
$db=new Auth();
?>