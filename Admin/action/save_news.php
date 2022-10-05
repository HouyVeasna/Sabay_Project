<?php
    session_start();
    date_default_timezone_set('Asia/Phnom_Penh');
    include_once("db/db.php");
    $db = new Db;
    $id = $_POST['txt_id'];
    $editID = $_POST['txt_edit_id'];
    $post_date = date("Y/m/d h:i:sa");
    $mid = $_POST['txt_menu'];
    $title = trim($_POST['txt_title']);
    $title = $db->realStr($title); 
    $des = trim($_POST['txt_des']);
    $des = $db->realStr($des);
    $location = $_POST['txt_location'];
    $view = 0;
    $uid = $_SESSION['uid'];
    $img = $_POST['txt_photo'];
    $od = $_POST['txt_od'];
    $status = $_POST['txt_status'];
    $msg['edit']=false;
    if($editID==0){
        $db->saveData("tbl_news","null,'$post_date','$mid','$title','$des','$img','$location','$od','$view','$uid','$status'");
        $msg['id']=$db->lastID;
    }else{
       // $sql = "UPDATE tbl_news SET mid='$mid',title='$title',des='$des',img='$img',location='$location',od='$od',status='$status' WHERE id=$editID";
        $db->updateData("tbl_news","mid='$mid',title='$title',des='$des',img='$img',location='$location',od='$od',status='$status'","id=$editID");
        $msg['edit']=true;
    }
    echo json_encode($msg);
?>