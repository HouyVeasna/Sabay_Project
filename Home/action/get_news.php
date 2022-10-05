<?php
    include_once("../../Admin/action/db/db.php");
    $db = new Db;
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
    $st = $_POST['st'];
    $ed = $_POST['en'];
    $con = $_POST['con'];
    $BASE_URL = $_POST['baseurl'];
    $post_data = $db->selectData("tbl_news","id,post_date,title,img,des,mid",$con,"id DESC",$st,$ed);
    if($post_data != '0'){
        foreach($post_data as $row) {
            ?>
                <a class="box" href="<?php echo $BASE_URL;?>?mid=<?php echo $row[5];?>&newid=<?php echo $row[0];?>">
                    <div class="img-box">
                        <div class="img bg-img" style="background-image: url('<?php echo $BASE_URL."Admin/images/" . $row[3] ?>');">
            
                        </div>
                    </div>
                    <div class="txt-box">
                        <h1><?php echo $row[2] . '-' . $row[0] ?></h1>
                        <h2>
                            <i class='fas fa-clock'></i>
                            <?php 
                                $date = date("Y/m/d",strtotime($row[1]) );
                                $time = date("h:iA",strtotime($row[1]) );
                                echo $db->getPostData($time,$date);
                             ?>                     
                        </h2>
                        <hr>
                        <p><?php echo subwords($row[4], 4) ?></p>
                    </div>
                </a>
            <?php
        }
    }
?>