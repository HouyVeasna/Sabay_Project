<?php
    include_once("db/db.php");
    $db = new Db;
    $tbl = array(
        "0"=>"tbl_user",
        "1"=>"tbl_menu",
        "2"=>"tbl_news",
        "3"=>"tbl_ads",
    );
    $frm=$_POST['frmId'];
    $post_data = $db->getAutoID("$tbl[$frm]","*","id DESC");
    $smg['id']= $post_data;
    echo json_encode($smg);
?>