<?php
    include_once("db/db.php");
    $db = new Db;
    $data = array();
    $s = $_POST['s'];
    $e = $_POST['e'];
    $find = $_POST['find'];
    $text_search = $_POST['txtSearch'];
    $searchFld = $_POST['searchFld'];

    if($find == 0){
        $post_data = $db->selectData("tbl_menu","*","id>0","id DESC",$s,$e);
        $total_data = $db->countData("tbl_menu","id>0");
    }else{
       // $sql = "SELECT * FROM tbl_menu WHERE $searchFld LIKE '$text_search%' ORDER BY id DESC LIMIT $s,$e ";
       $con = "$searchFld LIKE '$text_search%'";
       $post_data = $db->selectData("tbl_menu","*","$con","id DESC",$s,$e);
       $total_data = $db->countData("tbl_menu",$con);
    }
    if($post_data != '0'){
        foreach($post_data as $row){
            $data[] = array(
                "id"=>$row[0],
                "name"=>$row[1],
                "img"=>$row[2],
                "od"=>$row[3],
                "status"=>$row[4],
                "total_item"=>$total_data,
            );
        }
    }
    echo json_encode($data);
?>