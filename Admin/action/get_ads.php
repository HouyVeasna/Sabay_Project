<?php
    include_once("db/db.php");
    $db = new Db;
    $s = $_POST['s'];
    $e = $_POST['e'];
    $find = $_POST['find'];
    $text_search = $_POST['txtSearch'];
    $searchFld = $_POST['searchFld'];
    if($find == 0){
        $post_data = $db->selectData("tbl_ads","*","id>0","id DESC",$s,$e);
        $total_data = $db->countData("tbl_ads","id>0");
    }else{
       $con = "$searchFld LIKE '$text_search%'";
       $post_data = $db->selectData("tbl_ads","*","$con","id DESC",$s,$e);
       $total_data = $db->countData("tbl_ads",$con);
    }
    $data = array();
    if($post_data != '0'){
        foreach($post_data as $row){
            $data[] = array(
                "id"=>$row[0],
                "url"=>$url = substr($row[1],15),
                "img"=>$row[2],
                "location"=>$row[3],
                "od"=>$row[4],
                "type"=>$row[5],
                "status"=>$row[6],
                "total_item"=>$total_data,
            );
        }
    }
    echo json_encode($data);
?>