<div class="col-xl-9 col-lg-9 news-content">
    <?php
        $get_title = $db->selectCurrentData("tbl_news INNER JOIN tbl_menu on tbl_menu.id = $mid","tbl_news.id,tbl_menu.name,tbl_news.mid","tbl_news.id > 0");
        if($get_title != '0'){
            $color = '';
            if($get_title[1] == "កម្សាន្ត"){
                $color = "#FA5480";
            }else if($get_title[1] == "បច្ចេកវិទ្យា"){
                $color = "#38C378";
            }else if($get_title[1] == "កីឡា"){
                $color = "#4390F8";
            }else if($get_title[1] == "ជីវិតនិងសង្គម"){
                $color = "#F9A62B";
            }else if($get_title[1] == "DEALS" || $get_title[1] == "AUTO TALK"){
                $color = "#555555";
            }else if($get_title[1] == "DEALS" || $get_title[1] == "STARTING UP"){
                $color = "#555555";
            }
        }
        $post_data = $db->selectData("tbl_news","id,post_date,title,img,des,mid",$con,"id DESC",$start,$end);
        if($post_data != '0' && $get_title != '0' ){
        ?>
            <div class="main-header">
                <div class="header" style="background-color: <?php echo $color ?>;">
                    <h3><?php echo $get_title[1];?> <i class="fa-solid fa-chevron-right"></i></h3>
                </div>
            </div>
            <div class="main-box-content" style="border-top: 3px solid <?php echo $color; ?>;">
                <div class="top-box">
                    
                    <?php 
                    $i = 1;
                    if($start <= 1){
                        foreach($post_data as $row){
                            if($i<=2){
                                ?>
                                <a class="sub-top-box" href="<?php echo $BASE_URL; ?>?mid=<?php echo $row[5]; ?>&newid=<?php echo $row[0]; ?>">
                                    <div class="img-box">
                                        <div class="cover-img">
                                            <div class="img bg-img" style="background-image:url('<?php echo $BASE_URL;?>Admin/images/<?php echo $row[3];?>');"></div>
                                        </div>
                                    </div>
                                    <div class="txt-box">
                                        <h1><?php echo $row[2]?></h1>
                                    </div>
                                </a>     
                                <?php
                                if($i==2){
                                    ?>
                </div>   
                                    <?php
                                }
                                $i +=1;
                            }else if($i>2){
                                ?>
                                    <a class="box" href="<?php echo $BASE_URL; ?>?mid=<?php echo $row[5]; ?>&newid=<?php echo $row[0]; ?>">
                                        <div class="img-box">
                                            <div class="img bg-img" style="background-image:url('<?php echo $BASE_URL;?>Admin/images/<?php echo $row[3];?>');">
                                            </div>
                                        </div>
                                        <div class="txt-box">
                                            <h1><?php echo $row[2].'-'.$row[0]?></h1>
                                            <h2>
                                                <i class='fas fa-clock'></i>
                                                <?php
                                                    $date = date("Y/m/d",strtotime($row[1]) );
                                                    $time = date("h:iA",strtotime($row[1]) );
                                                    echo $db->getPostData($time,$date);
                                                ?>
                                            </h2>
                                            <hr>
                                            <p><?php echo subwords(strip_tags($row[4]),4)?></p>
                                        </div>
                                    </a>
                                <?php
                            }else{
                                return;
                            }
                            
                        }
                        
                    }          ?>       
                
        <?php
        }
    ?>
     <div class="more">
        
    </div>
        <center>
            <div class="btn-more">
                   
            </div>
        </center>
    </div>
</div>