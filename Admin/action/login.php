<?php
    session_start();
    include_once("db/db.php");
    $db = new Db;

    $email = trim($_POST['txt_email']);
    $email = $db->realStr($email);

    $pass = trim($_POST['txt_password']);
    $pass = $db->realStr($pass);

    $pass = md5($pass);

    $res['dpl'] = false;
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $_SESSION['login'] = false;

    //$_SESSION['uid'] = 0;

    $dpl = $db->dplData("tbl_user","u_email='$email'");    //check email

    if( $dpl == true){
        $post_data = $db->selectCurrentData("tbl_user","*","u_email='$email'");
        if( password_verify( $pass , $post_data[3] )){
            $db->updateData("tbl_user","u_ip='$ip'","u_email='$email'");
            $res['dpl'] = true;
            $_SESSION['login'] = true;
            $_SESSION['uid'] = $post_data[0];
            $_SESSION['uname'] = $post_data[1];
            $_SESSION['uemail'] = $email;
            $_SESSION['utype'] = $post_data[4];
        }
    }
    echo json_encode($res);

?>