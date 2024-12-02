<?php
    session_start();
    require "Auth.php";
    require __DIR__ . '/../vendor/autoload.php';
    use Dotenv\Dotenv;
    $dotenv = Dotenv::createImmutable(__DIR__ .'/../');
    $dotenv->load();

    if(isset($_POST["action"]))
    {
        if($_POST["action"]=="Register")
        { 
   
            require "register.php";   
        }
       
        else if(($_POST["action"]=="Login"))
        {    
            require "login.php";

        }
        else if($_POST["action"]=="otp")
        {    
            require "otp.php";

        }
        else if($_POST["action"]=="update")
        {    
            require "update.php";

        }
        else if ($_POST["action"] == "contact"){
                
            require "contact.php";
        }
        else if ($_POST["action"] == "forgot"){
                
            require "forgot.php";
        }
        else if ($_POST["action"] == "PassReset"){
                
            require "PassReset.php";
        }
        else if ($_POST["action"] == "editProfile"){
                
            require "editProfile.php";
        }
        else if ($_POST["action"] == "profile-pic"){
                
            require "profile-pic.php";
        }
        else if($_POST["action"]=="Edit_profile"){
            require "Edit_profile.php";
        }
    }
    else if(isset($_GET["action"]))
    {
        if($_GET["action"]=="registerlink")
        {    
            include "registerlink.php";
        }
        if($_GET["action"]=="Login")
        {    
            require "login.php";
        }
    }
  

?>