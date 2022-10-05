<?php
    $img = $_FILES['txt_file'];
    $name = $img['name'];
    $tmp_name = $img['tmp_name'];
    $ext = pathinfo($name,PATHINFO_EXTENSION);
    $new_name = time();
    $new_name = mt_rand(100000,999999).$new_name.'.'.$ext;
    move_uploaded_file($tmp_name,'../images/'.$new_name);
    $smg['img'] = $new_name;
    echo json_encode($smg);   
?>