<?php
    $cn = new mysqli('localhost','root','','pdk_project_2_db');
    $cn->set_charset("utf8");
    function subwords($str, $max = 24, $char = ' ', $end = '...'){
        $str = trim($str);
        $str = $str . $char;
        $len = strlen($str);
        $words = '';
        $w = '';
        $c = 0;
        for ($i = 0; $i < $len; $i++)
            if ($str[$i] != $char)
                $w = $w . $str[$i];
            else
                        if (($w != $char) and ($w != '')) {
                $words .= $w . $char;
                $c++;
                if ($c >= $max) {
                    break;
                }
                $w = '';
            }
        if ($i + 1 >= $len) {
            $end = '';
        }
        return trim($words) . $end;
    }
    $data = array();
    $st = $_POST['st'];
    $ed = $_POST['en'];
    $con = $_POST['con'];
    $BASE_URL = $_POST['baseurl'];
    // $st = 0;
    // $ed = 2;
    // $con = "mid=2 && status=1";
    $sql = "SELECT id,post_date,title,img,des,mid FROM tbl_news WHERE $con
    ORDER BY id DESC LIMIT $st,$ed";
    $res = $cn->query($sql);
    while ($row = $res->fetch_array()) {
        $date = date("Y/m/d",strtotime($row[1]) );
        $time = date("h:iA",strtotime($row[1]) );
        $data[] = array(
            "id" => $row[0],
            "date" => $db->getPostData($time,$date),
            "title" => $row[2],
            "img" => $row[3],
            "des" => subwords($row[4], 4),
            "mid" => $row[5],
        );
    }
    echo json_encode($data);
?>