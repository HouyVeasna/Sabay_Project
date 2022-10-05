<div class="container-fluid menu-box">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <ul>
                    <li><a href="<?php echo $BASE_URL; ?>" style="background-color: <?php echo $home_color?>;"><i class="fas fa-home"></i></a></li>
                    <?php  
                        $post_data = $db->selectData("tbl_menu","id,name","status=1","od",0,100);
                        foreach($post_data as $row){
                            if( $mid==$row[0]){
                                $color = "rgba(0, 0, 0, 0.3)";
                            }else{
                                $color = "#FA1939";
                            }
                            ?>
                                <li><a style="background-color: <?php echo $color?>;" href="<?php echo $BASE_URL; ?>?mid=<?php echo $row[0];?>"><?php echo $row[1]; ?></a></li>
                            <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>