<?php
        include('resize_action.php');
        $file = $_FILES['txt_file']['tmp_name']; 
        $sourceProperties = getimagesize($file);
        $fileNewName = time()."".mt_rand(100000,999999);
        $folderPath = "../images/";
        $ext = pathinfo($_FILES['txt_file']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];
		$filesize = filesize($file);
		$dst_w =760;
    	$dst_h ='';
		if($filesize <= (300*1024))
		{		
			move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);
			$res['img']=$fileNewName. ".". $ext;
			echo json_encode($res);
			return;
		}
		switch ($imageType) {
            case IMAGETYPE_PNG:
                $imageResourceId = imagecreatefrompng($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1],$dst_w,$dst_h);
                imagepng($targetLayer,$folderPath. $fileNewName. ".". $ext);
                break;

            case IMAGETYPE_GIF:
                $imageResourceId = imagecreatefromgif($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1],$dst_w,$dst_h);
                imagegif($targetLayer,$folderPath. $fileNewName. ".". $ext);
                break;
            case IMAGETYPE_JPEG:
                $imageResourceId = imagecreatefromjpeg($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1],$dst_w,$dst_h);
                imagejpeg($targetLayer,$folderPath. $fileNewName. ".". $ext);
                break;
            default:
                echo "Invalid Image type.";
                exit;
                break;
		//move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);
      
	
}
    $msg['img']= $fileNewName. ".". $ext;
    echo json_encode($msg);  
?>