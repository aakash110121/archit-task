<!--====footer navbar start-->
<footer>
        <div class="container">
            <div class="row footer_nav d-flex align-items-center">
                <div class="col-lg-12">
                    <ul class="nav justify-content-center ">
                        <li class="nav-item">
                            <a class="nav-link ml-0" href="contact.php">CONTACT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">TERMS OF USE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">PRIVACY POLICY</a>
                        </li>
                    </ul>
                </div>

            </div>
            <hr>
            <div class="row footer_copyright d-flex align-items-center">
                <div class="col-lg-7 text-center text-sm-start">
                    <p class="para">Copyright &#169; Soccer Spotlight 2024.</p>
                </div>
                <div class="col-lg-5 text-center text-sm-start text-lg-end">
                    <p class="para">All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>
    <!--====footer navbar end====-->
     <!--===scroll bottom to top===-->
     <a href="#" class="scrollToTop"><i class="flaticon-up-chevron"></i></a>
    <!--===scroll bottom to top===-->


    <!--====js scripts start====-->
    <!--jquery-3.6.0 minified source-->
    <script src="../assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!--bootstrap 5 minified bundle js source-->
    <script src="../assets/js/vendor/bootstrap.bundle.min.js"></script>

    <!--owl carousel-2.3.4 minified js source-->
    <script src="../assets/js/vendor/owl.carousel.min.js"></script>

    <!--wow-1.1.3 minified js source-->
    <script src="../assets/js/vendor/wow.min.js"></script>
    <!--custom js source-->
    <script src="../assets/js/main.js"></script>

    <!--====js scripts end====-->
<script>
    $(document).ready(function(){
        $("#update-btn").click(function(e){
            e.preventDefault();
            $("#update-error").html(" ");
            $.ajax({
                url:"../includes/action.php",
                method:"post",
                data:$("#update-form").serialize()+"&action=update",
                dataType:"json",
                success:function(response){
                    if(response.status=="success")
                    {  
                        $("#update-msg").html(response.msg);
                    }
                    else if(response.status=="failed")
                    {   
                        console.log(response.msg);
                        $("#update-msg").html(response.msg);
                    }
                }
            });
        });
        $("#profile-pic").click(function(){
            $("#trigger-file").trigger('click');
        });
        $("#trigger-file").on('change',function(){
            $email=$("#email").val();
            var fd=new FormData();
            var files=$("#trigger-file")[0].files[0];
            console.log(files);
            fd.append("file",files);
            fd.append("action","profile-pic");
            fd.append("email",$email);
              fetch('../includes/action.php',{
                method:'POST',
                body:fd,
              }).then((response)=>response.text()).then((data)=>{
                    console.log(data);
              })
            });
        $("#edit-profile").on('click',function(){
            // path=$("#profile-pic").attr("src");
            // // console.log($img);
            // email=$("#email").val();
            // const formdata=new FormData();
            // formdata.append("email",email);
            // formdata.append("path",path);
            // formdata.append("action","editProfile")
            // fetch('../includes/action.php',{
            //     method:'POST',
            //     body:formdata,
            // }) .then((response)=>response.json()).then((data)=>{
            //    if(data.status=="success")
            //    {
            //         $("#profile-update").html(data.msg);
            //    }
            // })
        });
    });
</script>

</body>

</html>