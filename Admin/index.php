<?php 
    session_start();
    session_destroy();
    include_once("action/db/db.php");
    $db = new Db;
    if( isset($_GET['email']) && isset($_GET['newpass']) && $_GET['code'] ){
        $email = $_GET['email'];
        $code = $_GET['code'];
        $new_pass = $_GET['newpass'];
        $dpl = $db->dplData("tbl_user","u_email='".$email."' && code = $code");
        if($dpl == true){
            $new_pass = md5($new_pass);
            //bbc
            $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $db->updateData("tbl_user","u_pass='$new_pass'","u_email='".$email."'");
            echo "<h1> Reset new password is completed </h1>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="icon/fontawesome-5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="Js/jquery-3.2.1.min.js"></script>
</head>
<style>
    #btn-new-pass{
      color: blue;
      margin: 10px;
      cursor: pointer;
      float: left;
    }
    #btn-new-pass:hover{
        color: green;
    }
</style>
<body>
    <div class="frm" style="border: 1px solid #333; margin-top: 40px;">
        <div class="header">
            <span>
                Login
            </span>
        </div>
        <form class="upl" enctype="multipart/form-data">
            <div class="body">
                <label for="" class="lable">User Email:</label>
                <input type="text" name="txt_email" id="txt_email" class="frm-control" autocomplete="off">

                <label for="" class="lable">User Password:</label>
                <input type="password" name="txt_password" id="txt_password" class="frm-control">
            </div>
            <div class="footer">
                <a id="btn-new-pass">Forgot Password</a>
                <a class="btn btn-2" id="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </div>
        </form>
    </div>
</body>
    <script>
        $(document).ready(function(){
            var uEmail = $('#txt_email');
            var uPass = $('#txt_password');

            //reset new password
            $('#btn-new-pass').click(function(){
                if(uEmail.val() == ''){
                    alert("Please input email");
                    uEmail.focus();
                    return;
                }
                var eThis = $(this);
                var frm = eThis.closest('form.upl');
                var frm_data = new FormData(frm[0]);
                $.ajax({
                    // url:'action/sava-menu.php',
                    url:'action/new_pass.php',
                    type:'POST',
                    data:frm_data,
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType:"json",
                    // beforeSend:function(){
                        
                    // },
                    success:function(data){
                        if(data.dpl == false){
                            alert("Please input email or password again");
                            return
                        }else{
                            alert("New password is sent to your email.");
                            return;
                        }
                    },
                });
            });

            $('#btn-login').click(function(){
                if(uEmail.val()==''){
                    alert("Please input email");
                    uEmail.focus();
                    return;
                }
                else if(uPass.val()==''){
                    alert("Please input password");
                    uPass.focus();
                    return;
                }
                var eThis = $(this);
                var frm = eThis.closest('form.upl');
                var frm_data = new FormData(frm[0]);
                $.ajax({
                    url:'action/login.php',
                    type:'POST',
                    data:frm_data,
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType:"json",
                    beforeSend:function(){
                        
                    },
                    success:function(data){
                        if(data.dpl == false){
                            alert("Please input your E-mail & Password again!");
                            return;
                        }else{
                            window.location.href="admin.php";
                        }
                    },
                });

            });
        });
    </script>
</html>