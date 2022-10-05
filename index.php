<?php 
    include_once("_config_inc.php");
    include_once("Admin/action/db/db.php");
    $db = new Db;
    $BASE_URL = BASE_URL;
    $BASE_PATH = BASE_PATH;   //for include file
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
    $start=0;
    $end = 5;
    $mid = 0;
    $con = "status=1";
    $home_color = "rgba(0, 0, 0, 0.3)";
    $newid=0;
    if(isset($_GET['newid'])){
        $newid = $_GET['newid'];
        $mid = $_GET['mid'];
        $home_color = "rgba(0, 0, 0, 0.3)";
    }
    if(isset($_GET['mid'])){
        $mid = $_GET['mid'];
        $con = "mid=$mid && status=1";
        $home_color="#FA1939";
    }
    //count all data 
    // $sql = "SELECT COUNT(*) AS total FROM tbl_news WHERE $con";
    // $res= $cn->query($sql);
    // $res_count=$res->fetch_array();
    $total_data= $db->countData("tbl_news",$con);
?>
     <!-- header -->
    <?php include_once($BASE_PATH."Home/file/header.php") ?>
<body>
    <?php 
        //header-logo
        include_once($BASE_PATH."Home/file/header_logo.php");
        //menu
        include_once($BASE_PATH."Home/file/menu.php");
        //slide
        if($mid==0){
            include_once($BASE_PATH."Home/file/slide.php");
            include_once($BASE_PATH."Home/file/video.php");
            include_once($BASE_PATH."Home/file/komsan.php");
            include_once($BASE_PATH."Home/file/technology.php");
            include_once($BASE_PATH."Home/file/life_social.php");
            include_once($BASE_PATH."Home/file/sport.php");
            include_once($BASE_PATH."Home/file/deals.php");
        }
    ?>
    <!-- contend -->
    <div class="container container-contend">
        <div class="row">
            <?php
                if($mid !=0 && $newid ==0){
                    //new content
                    include_once($BASE_PATH."Home/file/news_content.php");
                    //ads content
                    include_once($BASE_PATH."Home/file/ads_content.php");
                }
                else if($mid !=0 && $newid!=0){
                     //new detail
                     include_once($BASE_PATH."Home/file/new_detail.php");
                     include_once($BASE_PATH."Home/file/ads_content.php");
                }
            ?>
        </div>
    </div>
    <div class="btn-scroll-top">
    <i class="fas fa-arrow-up"></i>
    </div>
    <!-- footer -->
    <?php include_once($BASE_PATH."Home/file/footer.php"); ?>
    <input type="hidden" id="txt_start" value="<?php echo $start+$end; ?>">
    <input type="hidden" id="txt_end" value="<?php echo $end; ?>">
    <input type="hidden" id="txt_total_data" value="<?php echo $total_data-$end; ?>">
    <input type="hidden" id="txt_con" value="<?php echo $con; ?>">
    <input type="hidden" id="txt_base_url" value="<?php echo $BASE_URL; ?>">
</body>
    <script src="<?php echo $BASE_URL?>Home/js/home.js"></script>
</html>