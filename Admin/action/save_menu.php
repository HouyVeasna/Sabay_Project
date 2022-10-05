<?php
    include_once("db/db.php");
    $db = new Db;
    $id = $_POST['txt_id'];
    $editID = $_POST['txt_edit_id'];
    $name = trim($_POST['txt_name']);
    $name = $db->realStr($name);   //protect sql injection
    $img = $_POST['txt_photo'];
    $od = $_POST['txt_od'];
    $status = $_POST['txt_status'];
    //check duplicate name
    $dpl = $db->dplData("tbl_menu","name='$name' && id !='$id'");
    $msg['dpl']=true;
    $msg['edit']=false;
    if($dpl==false){
        if($editID==0){
            $db->saveData("tbl_menu","null,'$name','$img','$od','$status'");
            $msg['id']=$db->lastID;   // catch last id
        }else{
            $db->updateData("tbl_menu","name='$name', img='$img', od='$od', status='$status'","id=$editID");
            $msg['edit']=true;
        }
        $msg['dpl']=false;
    }
    echo json_encode($msg);
?>