
    <?php
        include "Admin-files/Admin-header.php";
    ?>
    <!--==== my profile ====-->
    
    <section class="my-profile">
    
        <div class="container">
            <div class="profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-side">
                            <div class="profile-sec">
                                <div class="user_img">
                                <div id="profile-update" >

                                </div>
                                    <div class="update_img_user">
                                        <a href="#" style="text-decoration:none;"> 
                                        <?php
                                            
                                            $path=$db->FileExists($data["email"])==NULL?"../assets/images/dp.png":"../".$db->FileExists($data["email"]);
                                            echo"<img src='$path' id ='profile-pic' alt='invalid_image'>";
                                        ?>
                                        <span class="edit_pan"><i class="fa-solid fa-pen" style="color:black"></i> </span></a>
                                        <form enctype="multipart/form-data" >
                                            <input type="hidden" name="email" value="<?=$data["email"]?>" id="email">
                                            <input type="file" class="dnone" name="file" id="trigger-file">
                                        </form>  
                                    </div>
                                    <div class="user_name">
                                        <h3 id="upd-user-icon"><?=$data["first_name"]." ".$data["last_name"]?> </h3>
                                    </div>
                                </div>
                                <div class="edit_option_bar">
                                    <div class="content-bar">
                                        <a href="#" id="edit-profile"><span class="tabedit">Edit Profile</span></a>
                                    </div>
                                    <div class="content-bar">
                                        <span class="tabedit">Change password</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                                            <!-- col-md-4 ends-->
                    <div class="col-md-8">
                        <div class="user-content-update">
                            <div class="">
                                <div class="tab-content tab-content-1 active">
                                    <div class="user-content-box">
                                        <form action="#" method="POST" class="mt-60 row" id="update-form">
                                            <input type="hidden" name="id" value=<?=$data["id"]?>>
                                            <div id="update-msg" style="background-image:none;">

                                            </div>
                                            <div class="mb-3 col-sm-6">
                                                <input type="text" placeholder="First name" class="form-control para"
                                                    id="name" name="fname" required="required" autocomplete="off" value="<?=isset($data["first_name"])?$data["first_name"]:''?>">
                                            </div>
                                            <div class="mb-3 col-sm-6">
                                                <input type="text" placeholder="Last Name" class="form-control para"
                                                    id="last-name" name="lname" required="required" autocomplete="off" value="<?=isset($data["last_name"])?$data["last_name"]:''?>">
                                            </div>
                                            <div class="mb-3 col-sm-6">
                                                <input type="email" placeholder="Email" class="form-control para"
                                                    id="email" name="email" required="required" autocomplete="off" value="<?=isset($data["email"])?$data["email"]:''?>">
                                            </div>
                                            <div class="mb-3 col-sm-6">
                                                <input type="text" placeholder="Phone" class="form-control para"
                                                    id="Phone" name="phone" required="required" autocomplete="off" value="<?=isset($data["phone"])?$data["phone"]:''?>">
                                            </div>

                                            <div class="mb-3 col-sm-6">
                                                <div class="show_password">
                                                    <input type="password" placeholder="Password"
                                                        class="form-control para" id="password-field"
                                                        required="required" name="pass" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-sm-6">
                                                <input type="password" placeholder="Confirm Password"
                                                    class="form-control para" id="con_password" required="required" name="cpass">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="update-btn">Update</button>

                                            <div class="reset-password">
                                                <a href="#">Reset Password</a>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==== my profile ====-->


    <?php
        include "Admin-files/Admin-footer.php";
    ?>






    