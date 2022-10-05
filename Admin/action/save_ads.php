<?php
    include_once("db/db.php");
    $db = new Db;
    $id = $_POST['txt_id'];
    $editID = $_POST['txt_edit_id'];
    $url = trim($_POST['txt_url']);
    $url = $db->realStr($url);
    $location = $_POST['txt_location'];
    $type = $_POST['txt_type_ads'];
    $img = $_POST['txt_photo'];
    $od = $_POST['txt_od'];
    $status = $_POST['txt_status'];
    $msg['edit']=false;
    if($editID==0){
        $db->saveData("tbl_ads","null,'$url','$img','$location','$od','$type','$status'");
        $msg['id']=$db->lastID;    // catch last id
    }else{
        $db->updateData("tbl_ads","url='$url',location='$location', img='$img', od='$od',type_ads='$type',status='$status'","id=$editID");
        $msg['edit']=true;
    }
    echo json_encode($msg);
?>