<?php
    include('db/db.php');
    $db= new Db;
    $eidtId = $_POST['txt_edit_id'];
    $id = $_POST['txt_id'];

    $name=  trim($_POST['txt_name']);
    $name = $db->realStr($name);

    $email=  trim($_POST['txt_email']);
    $email = $db->realStr($email);

    $pass=  trim($_POST['txt_password']);
    $pass = $db->realStr($pass);

    $pass = md5($pass);
    $pass = password_hash($pass,PASSWORD_DEFAULT); //both function make more effective
    
    $utype = $_POST['txt_user_type'];
    $status = $_POST['txt_status'];
    $ip='000';


    $dpl = $db->dplData("tbl_user","u_email='$email' && id != '$id'");

    $res['edit']=false;

    if($dpl == false){
        if($eidtId==0){
            $db->saveData("tbl_user","null,'$name','$email','$pass','$utype','$ip','123',$status");
            $res['id'] = $db->lastID;
        }else{
            $fld = "u_name='$name',u_type='$utype',status=$status";
            $con = "id=$id";
            $db->updateData("tbl_user", $fld, $con);
            $res['edit']=true;
        }       
        $res['dpl'] = false;
    }else{
        $res['dpl'] = true;
    }
    echo json_encode($res);
?>