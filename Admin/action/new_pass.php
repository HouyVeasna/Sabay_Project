<?php
    session_start();
    include_once("db/db.php");
    $db = new Db;
    $res['dpl'] = false;

    $email = $_POST['txt_email'];
    $db->realStr($email);

    $pass = mt_rand(100000,999999);
    $verify_code = mt_rand(100000,999999);

    $dpl = $db->dplData("tbl_user","u_email='".$email."'");

    if($dpl == true){

        $db->updateData("tbl_user","code='".$verify_code."'","u_email='".$email."'");

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: Rean Web noreplay@reanweb.com' . "\r\n";
        $smg = '<html><body><p>Dear: User</p>'.
                '<p>We have received a request your system password.</p>'.
                '<h4>New Password: '.$pass.'</h4>'.
                '<p>Click link below to verify your new password:</p>'.
                '<p><a href="http://houyveasna.lovestoblog.com/Admin/?email='.$email.'&newpass='.$pass.'&code='.$verify_code.'"> Click here to verify password</a></p></body></html>';
        $subject = $pass .' is your new password.';
        if(mail($email , $subject ,$smg ,$headers,"-f noreplay@reanweb.com")){
            $res['send'] = true;
        }else{
            $res['send'] = false;
        }
        $res['dpl'] = true;
    }
    echo json_encode($res);
?>