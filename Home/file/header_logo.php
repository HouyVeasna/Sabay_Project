<div class="container-fluid box1">
    <div class="container container-box">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 logo">
                <a href="<?php echo $BASE_URL;?>">
                    <img src="<?php echo $BASE_URL;?>Home/image/logo.png" alt="sabay.logo">
                </a>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 ads1">
            <?php  
                $post_data = $db->selectData("tbl_ads","url,img,type_ads","location=1 && status=1","od DESC",0,1);
                foreach($post_data as $row ){
                    ?>
                        <a target="_blank" href="<?php echo $row[0];?>">
                            <img src="<?php echo $BASE_URL;?>Admin/images/<?php echo $row[1];?>" alt="">
                        </a>
                    <?php
                }
            ?>
            </div>
        </div>
    </div>
</div>