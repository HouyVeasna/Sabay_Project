<div class="container slide-box">
    <div class="row">
        <div class="col-xl-9 col-lg-9 slide-new">
            <?php
                $post_data = $db->selectData("tbl_news 
                INNER JOIN tbl_menu on tbl_menu.id = tbl_news.mid","tbl_news.id,tbl_news.post_date,tbl_news.title,tbl_news.img,tbl_news.des,tbl_menu.name,
                tbl_news.mid","tbl_news.location=1 && tbl_news.status=1","tbl_news.od DESC",0,4);
                foreach($post_data as $row){
                    ?>
                        <a href="<?php echo $BASE_URL; ?>?mid=<?php echo $row[6]; ?>&newid=<?php echo $row[0]; ?>" class="box bg-img" style="background-image: url('<?php echo $BASE_URL;?>Admin/images/<?php echo $row[3];?>');">
                            <div class="main-box">
                                <div class="box-title">
                                    <?php echo $row[2]; ?>
                                </div>
                                <div class="box-des">
                                    <?php echo substr($row[4],0,36); ?>
                                </div>
                            </div>
                            <span>
                                <?php
                                    $date = date("Y/m/d",strtotime($row[1]) );
                                    $time = date("h:iA",strtotime($row[1]) );
                                    echo $db->getPostData($time,$date);
                                ?>
                            </span>
                            <div class="category-box" style="background-color: <?php 
                                $color = '';
                                if($row[5] == "កម្សាន្ត"){
                                    $color = "#FA5480";
                                }else if($row[5] == "បច្ចេកវិទ្យា"){
                                    $color = "#38C378";
                                }else if($row[5] == "កីឡា"){
                                    $color = "#4390F8";
                                }else if($row[5] == "ជីវិតនិងសង្គម"){
                                    $color = "#F9A62B";
                                }else if($row[5] == "DEALS" || $row[5] == "AUTO TALK"){
                                    $color = "#555555";
                                }else if($row[5] == "DEALS" || $row[5] == "STARTING UP"){
                                    $color = "#555555";
                                }
                                echo $color; 
                            ?>;">
                                <?php echo $row[5]; ?>
                            </div>
                        </a>
                    <?php
                }
            ?>
        </div>
        <div class="col-xl-3 col-lg-3 slide-ads">
            <?php 
                $post_data = $db->selectData("tbl_ads","url,img,type_ads","location=2 && status=1","od DESC",0,2);
                foreach($post_data as $row){
                    ?>
                        <a target="_blank" href="<?php echo $row[0];?>" class="box">
                            <img src="<?php echo $BASE_URL;?>Admin/images/<?php echo $row[1];?>" alt="<?php echo $row[1];?>">
                        </a>
                    <?php
                }
            ?>
        </div>
    </div>
</div>