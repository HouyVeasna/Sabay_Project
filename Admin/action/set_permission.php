<?php
    include("db/db.php");
    $db = new Db;
    $uid = $_POST['uid']; 
    $mid = $_POST['mid'];
    $aid = $_POST['aid'];

    $dpl = $db->dplData("tbl_permission","uid=$uid  && mid=$mid");
    
    $res['edit']=false;
    
    if($dpl == false){
        $db->saveData("tbl_permission","null,$uid,$mid,$aid");
    }else{
        $fld = "aid='$aid'";
        $con = "uid=$uid  && mid=$mid";
        $db->updateData("tbl_permission", $fld, $con);
        $res['edit']=true;
    }         
    echo json_encode($res);
?>