<?php
  /*-------Contact Form spam filter code-----------*/
  Trait mail{
  
    public function mail_user_add($name,$email){
        $res=$this->mail_user_exists($email);
        if($res==NULL)
        {
            $sql="INSERT INTO mail_subscribers(Name,email,createdAt) VALUES(:name,:email,NOW())";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["name"=>$name,"email"=>$email]);
        }
        $this->spam_logs($email);
    }

    public function mail_user_exists($email){
        $sql="SELECT email from mail_subscribers where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return($result);
    }

    public function spam_count($email){
        $sql="SELECT COUNT(*) as count  FROM spam_logs where email=:email AND submit_time > NOW()-INTERVAL 5 MINUTE";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        $count=$res["count"];
        return($count);
       }
       public function banned_user($email)
       {
           $sql="SELECT email from banned_user where email=:email";
           $stmt=$this->conn->prepare($sql);
           $stmt->execute(["email"=>$email]);
           $result=$stmt->fetch(PDO::FETCH_ASSOC);
           return $result;
       }
   
    public function spam_logs($email){
        if($this->spam_count($email)<5)
        {
        $sql="INSERT INTO  spam_logs(email,submit_time) VALUES(:email,NOW())";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        }
        else
        {
            if($this->banned_user($email)==NULL)
            {
                
                    $sql="INSERT INTO  banned_user(email,createdAt) VALUES(:email,NOW())";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute(["email"=>$email]);
            }
            else
            {
                $sql="SELECT email from banned_user where createdAt < NOW()-INTERVAL 24 HOUR  AND email=:email";
                $stmt=$this->conn->prepare($sql);
                $stmt->execute(["email"=>$email]);
                $result=$stmt->fetch(PDO::FETCH_ASSOC); 
                if($result!=NULL)
                {
                    $this->del_ban_user($result["email"]);
                    $this->del_ban_user_log($result["email"]);
                }
                return $result;
            }
        }
    }

    public function del_ban_user($email){
        $sql="DELETE FROM banned_user where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
    }
    public function del_ban_user_log($email){
        $sql="DELETE FROM spam_logs where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
    }
    public function User_ban_time($email){
        $sql="SELECT 24-TIMESTAMPDIFF(HOUR,createdAt,Now()) AS remaining_hours FROM banned_user WHERE email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        $time_left=$result["remaining_hours"];
        return($time_left);
    }
 
}
  /*-------Contact Form spam filter code ends-----------*/
  Trait responsemsg{
    public function msg($type,$msg){
        $msg = '<div class="alert alert-' . $type . ' fade show">
        <button id="btn-success" class="btn btn-lg fs-5"  style="
    background-image: none;margin:0 20px 0 0;padding:0;color:rgba(0,0,0,0.6);display:inline-block;background-color:none;width:0;padding:0;
">&times;</button>
        <span><strong>' . $msg . '</strong></span>
    </div>';

        return $msg;
    }
  }
  Trait PassReset{
    public function Password_reset($email,$token){
        $sql="INSERT INTO password_reset(email,token) VALUES(:email,:token)";
        $smtp=$this->conn->prepare($sql);
        $smtp->execute(["email"=>$email,"token"=>$token]);
    }
    public function get_email($token){
        $sql="SELECT email from password_reset where token=:token";
        $smtp=$this->conn->prepare($sql);
        $smtp->execute(["token"=>$token]);
        $res=$smtp->fetch(PDO::FETCH_ASSOC);
        return $res;
    } 
    public function pass_reset_verify($token,$email)
    { 
        $sql="SELECT email from password_reset where token=:token AND email=:email";
        $smtp=$this->conn->prepare($sql);
        $smtp->execute(["email"=>$email,"token"=>$token]);
        $res=$smtp->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    public function PasswordReset($pass,$email)
    {
        $sql="UPDATE db_user SET password=:password WHERE email=:email";
        $smtp=$this->conn->prepare($sql);
        $smtp->execute(["email"=>$email,"password"=>$pass]);
        return true;
    }
  }
  ?>

