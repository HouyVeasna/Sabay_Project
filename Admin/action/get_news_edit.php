<?php
    include_once("db/db.php");
    $db = new Db;
    $id = $_POST['id'];
    $post_data= $db->selectCurrentData("tbl_news","*","id=$id");
    if($post_data != '0'){
        $row = $post_data;
    }
    $res['mid']=$row[2];
    $res['title']=$row[3];
    $res['des']=$row[4];
    $res['img']=$row[5];
    $res['location']=$row[6];
    $res['od']=$row[7];
    $res['status']=$row[10];
    echo json_encode($res);
?>