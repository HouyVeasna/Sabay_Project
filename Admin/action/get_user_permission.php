<?php
    include("db/db.php");
    $db = new Db;
    $data = array();
    $uid = $_POST['uid'];//1
    $s=0;
    $e=10;
    $postData = $db->selectData("tbl_permission","*","uid=$uid","id DESC",$s,$e);
    if($postData != '0'){
        foreach($postData as $row){
            $data[] = array(
                "mid" => $row[2],
                "aid" => $row[3],
            );
        }
    }
    echo json_encode($data);
?>