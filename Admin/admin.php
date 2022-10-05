<?php 
    session_start();
    include_once("action/db/db.php");
    $db = new Db;
    //$ip = $_SESSION['REMOTE_ADDR'];
    if(!$_SESSION['login'] || $_SESSION['login'] == false){
            header('Location: index.php'); 
    }else{
        if(!$_SESSION['uid'] || !$_SESSION['uemail']){
            header('Location: index.php');
        }else{
            $email = $_SESSION['uemail'];
            $uid = $_SESSION['uid'];
            $dpl = $db->dplData("tbl_user","u_email='$email' && id = $uid");
          //  && u_ip='$ip'
            if($dpl == false){
                header("Location: index.php");
            }
        }
    }
    $uid = $_SESSION['uid'];
    $utype = $_SESSION['utype'];

    $menu = array(
        "0" => "User List",
        "1" => "Menu List",
        "2" => "News List",
        "3" => "Ads List",
    );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="icon/fontawesome-5.15.4/css/all.min.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <!-- tiny editor -->
    <script src="Js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="Js/jquery-3.2.1.min.js"></script>
</head>
<body>
   <div class="bar1">
       <div class="box1">
            <div class="btn-menu">
                <i class="fas fa-bars"></i>
            </div>
            <div class="logo">
                <img src="css/bg-img/saby-logo.png" alt="">
            </div>
       </div>
       <div class="box2">
            <div class="title-box">
                Sabay Admin Page
            </div>
            <div class="user-box">
                <div class="user-name">
                    <i class="fa fa-user" aria-hidden="true"></i> <?php echo $email; ?>
                </div>
                <div class="btn-logout">
                    <a href="index.php"> <i class="fas fa-sign-out-alt"></i></a> 
                </div>
            </div>
       </div>
   </div>
   <!-- left-menu -->
   <div class="left-menu">
       <ul>
       <?php 
            if($utype !='admin'){
                $post_data = $db->selectData("tbl_permission","*","uid=$uid && aid !=0","mid>0","0","10");
                if($post_data !='0'){
                    foreach($post_data as $val){
                        ?>
                             <li data-role="<?php echo $val[3]; ?>" data-frm_id="<?php echo $val[2]; ?>">
                                <?php echo $menu[ $val[2] ]; ?>
                            </li>
                        <?php
                    }
                }
            }else{
                foreach($menu as $key => $val){
                    ?>
                        <li data-role="1" data-frm_id="<?php echo $key; ?>">
                            <?php echo $val; ?>
                        </li>
                    <?php
                }
            }
            
        ?>
           <!-- <li data-frm_id="0">User</li>
           <li data-frm_id="1">Menu</li>
           <li data-frm_id="2">News</li>
           <li data-frm_id="3">Ads</li>      -->
       </ul>
   </div>
   <!-- contend-box -->
   <div class="content-box">
       <div class="bar2">
           <ul>
               <li class="btn btn-1" id="btn_add">
                   Add New
               </li>
           </ul>
           <ul class="search">
                <li>
                    <select name="" id="txt_select_search" class="btn btn-1">
                        
                    </select>
               </li>
               <li>
                   <input type="text" name="" id="txt_search_text">
               </li>
               <li class="btn btn-1" id="btn_search">
                   <i class="fas fa-search"></i>
                </li>
           </ul>
           <ul class="page">
               <li>
                   <select name="txt_limit" id="txt_limit" class="btn btn-1" style="padding: 8.2px;">
                       <!-- <option value="2">2</option>
                       <option value="5">5</option> -->
                       <option value="10">10</option>
                       <option value="20">20</option>
                       <option value="30">30</option>
                       <option value="40">40</option>
                       <option value="50">50</option>
                       <option value="50000000000">All</option>
                   </select>
                </li>
                <li class="btn btn-1" id="btn_back">
                   <i class="fas fa-chevron-left"></i>
                </li>
                <li class="page-number">
                   <span id="current_page">1</span>/ <span id="total_page">0</span> of <span id="total_data">0</span>
                </li>
                <li class="btn btn-1" id="btn_next">
                   <i class="fas fa-chevron-right"></i>
                </li>
           </ul>
       </div>
        <div class="box-2">
            <!-- table -->
            <table id="tblData">
            
            </table>
        </div>
   </div>
   <input type="hidden" id="txt_username" value="<?php echo $_SESSION['uname']; ?>">
   <!-- Jquery -->
    <script src="Js/action.js"></script>
</body>
</html> 