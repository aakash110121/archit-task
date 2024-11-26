<?php
require "connection.php";
include "Trait.php";
Class Auth extends Connection{
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
    use responsemsg;
    Use mail;
    Use PassReset;
}
$db=new Auth();
?>