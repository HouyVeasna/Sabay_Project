<?php
    include_once("db/db.php");
    $db = new Db;
    $s = $_POST['s'];
    $e = $_POST['e'];
    $find = $_POST['find'];
    $text_search = trim($_POST['txtSearch']);
    $searchFld = explode( " ",trim($_POST['searchFld'])) ;  //tbl_news.id 0  //convet string to array
    // echo $searchFld[0];   tbl_news.id
    // echo $searchFld[1];    0
    if($find == 0){
        $sql = "SELECT 
        tbl_news.id,tbl_menu.name,tbl_news.title,tbl_news.img,
        tbl_news.location,tbl_news.od,tbl_news.view,tbl_news.uid,tbl_user.u_name,
        tbl_news.status FROM tbl_news 
        INNER JOIN tbl_menu on tbl_menu.id = tbl_news.mid
        INNER JOIN tbl_user ON tbl_user.id = tbl_news.uid
        ORDER BY tbl_news.id DESC LIMIT $s,$e ";
        $post_data = $db->readData($sql);

        $sql_count = "SELECT COUNT(*) AS total FROM tbl_news INNER JOIN tbl_menu 
        on tbl_menu.id = tbl_news.mid";
        $total_count = $db->readData($sql_count);
    }else{
        if($searchFld[1] == 0){
            $sql = "SELECT 
            tbl_news.id,tbl_menu.name,tbl_news.title,tbl_news.img,
            tbl_news.location,tbl_news.od,tbl_news.view,tbl_news.uid,tbl_user.u_name,
            tbl_news.status FROM tbl_news 
            INNER JOIN tbl_menu on tbl_menu.id = tbl_news.mid
            INNER JOIN tbl_user ON tbl_user.id = tbl_news.uid
            WHERE ".$searchFld[0]." = '$text_search' ORDER BY tbl_news.id DESC LIMIT $s,$e ";
            $post_data = $db->readData($sql);

            $sql_count = "SELECT COUNT(*) AS total FROM tbl_news INNER JOIN tbl_menu 
            ON tbl_menu.id = tbl_news.mid WHERE ".$searchFld[0]." = '$text_search'";
            $total_count = $db->readData($sql_count);
        }else{
            $sql = "SELECT 
            tbl_news.id,tbl_menu.name,tbl_news.title,tbl_news.img,
            tbl_news.location,tbl_news.od,tbl_news.view,tbl_news.uid,tbl_user.u_name,
            tbl_news.status FROM tbl_news 
            INNER JOIN tbl_menu on tbl_menu.id = tbl_news.mid
            INNER JOIN tbl_user ON tbl_user.id = tbl_news.uid
            WHERE ".$searchFld[0]." LIKE '%$text_search%' ORDER BY tbl_news.id DESC LIMIT $s,$e ";
            $post_data = $db->readData($sql);

            $sql_count = "SELECT COUNT(*) AS total FROM tbl_news INNER JOIN tbl_menu 
            ON tbl_menu.id = tbl_news.mid WHERE ".$searchFld[0]." LIKE '%$text_search%'";
            $total_count = $db->readData($sql_count);
        }      
    }
    $data = array();
    if($post_data != '0'){   //note it return as string
        $total_data = $total_count->fetch_array();
        while($row=$post_data->fetch_array()){
            $data[] = array(
                "id"=>$row[0],
                "menu"=>$row[1],
                "title"=>$row[2],
                "img"=>$row[3],
                "location"=>$row[4],
                "od"=>$row[5],
                "view"=>$row[6],
                "user"=>$row[8],
                "status"=>$row[9],
                "total_item"=>$total_data[0],
            );
        }
    }
    echo json_encode($data);
?>