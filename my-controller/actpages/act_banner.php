<?php  
	$obj->table_name = "tbl_banner";
    if(isset($_FILES['file']) && $_FILES['file']!='')
    {
        $type = $_FILES['file']['type'];
        $ext = "";
        if($type == "image/png")
                $ext = "png";
        elseif($type == "image/gif")
                $ext = "gif";
        elseif($type == "image/jpeg")
                $ext = "jpg";
        elseif($type == "image/bmp")
                $ext = "bmp";
        elseif($type == "image/pjpeg")
                $ext = "jpg";

	    if($ext != "")
    	{

        		$uploadPath = "../uploads/banner/";
        		$destPath = "../uploads/banner/thumbs/";
                //for uploading image
				$temp_name = $_FILES['file']['tmp_name'];
				$img_name = "banner-image".".".$ext;
				$obj->UploadImage($temp_name, $ext, $img_name, $uploadPath);
		        if(file_exists($uploadPath.$img_name))
        	        $obj->CreateThumb($img_name,$ext,$uploadPath,$destPath,100,100);
                $obj->val = array("image"=>$img_name);
                $obj->cond = array("id"=>1);
                $obj->update();
		}
	}	
    	$msg = "Data Successfully updated";
		$url = "?page=manage_banner";
		$obj->alert($msg,$url);


//$obj->redirect("index.php?page=news");
?>