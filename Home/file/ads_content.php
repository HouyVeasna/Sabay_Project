<div class="col-xl-3 col-lg-3 ads-content">
    <?php  
        $post_data = $db->selectData("tbl_ads","url,img,type_ads","location=3 && status=1","id",0,200);
         foreach($post_data as $row){
            if($row[2] == 1){
             ?>
                 <ul>
                    <li>
                        <a target="_blank" href="<?php echo $row[0];?>">
                            <img src="<?php echo $BASE_URL;?>Admin/images/<?php echo $row[1];?>" alt="<?php echo $row[1];?>">
                        </a>
                    </li>
                 </ul>
             <?php
            }else{
                ?>
                    <ul>
                        <li>
                            <?php echo $row[0];?>
                        </li>
                    </ul>
                <?php
            }
         }
    ?>
</div>