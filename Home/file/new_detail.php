<div class="col-xl-9 col-lg-9 news-content new-detail">
    <div class="new-detail-box">
        <?php 
            $db->updateData("tbl_news","view=view+1 ","id=$newid");
            //get news detain
            $row = $db->selectCurrentData("tbl_news","title,des,post_date,img","id=$newid");
        ?>
        <h1><?php echo $row[0] ?></h1>
        <h2>
            <i class='fas fa-clock'></i>
            <?php 
                $date = date("Y/m/d",strtotime($row[2]) );
                $time = date("h:iA",strtotime($row[2]) );
                echo $db->getPostData($time,$date);
            ?>
        </h2>
        <h5></h5>
        <!-- <img src="<?php // echo $BASE_URL;?>Admin/images/<?php // echo $row[3];?>" alt="1"> -->
        <p><?php echo $row[1] ?></p>
    </div>
</div>