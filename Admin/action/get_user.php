<?php
    include_once("db/db.php");
    $db = new Db;
    $data = array();
    $s = $_POST['s'];
    $e = $_POST['e'];
    $find = $_POST['find'];
    $text_search = $_POST['txtSearch'];
  //  $searchFld = $_POST['searchFld'];
    $searchFld = explode( " ",trim($_POST['searchFld']));
    if($find == 0){
        $post_data = $db->selectData("tbl_user","*","id>0","id DESC",$s,$e);
        $total_data = $db->countData("tbl_user","id>0");
    }else{
        if($searchFld[1] == 0){
            $con = "$searchFld[0] = '$text_search%'";
            $post_data = $db->selectData("tbl_user","*","$con","id DESC",$s,$e);
            $total_data = $db->countData("tbl_user",$con);
        }else{
            $con = "$searchFld[0] LIKE '$text_search%'";
            $post_data = $db->selectData("tbl_user","*","$con","id DESC",$s,$e);
            $total_data = $db->countData("tbl_user",$con);
        }
    }
    if($post_data != '0'){
        foreach($post_data as $row){
            $data[] = array(
                "id"=>$row[0],
                "uname"=>$row[1],
                "uemail"=>$row[2],
                "utype"=>$row[4],
                "ip"=>$row[5],
                "code"=>$row[6],
                "status"=>$row[7],
                "total_item"=>$total_data,
            );
        }
    }
    echo json_encode($data);
?>