<?php  
	//echo "this is edit";
	$obj->table_name = IMAGE_TBL;
    $obj->val = array("title"=>$_POST['title'],"caption"=>$_POST['caption']);
    $obj->cond = array("id"=>$_POST['id']);
    $obj->update();
    if(isset($_FILES['image']) && $_FILES['image']!='')
    {
        $type = $_FILES['image']['type'];
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

        		$uploadPath = "../uploads/images/";
        		$destPath = "../uploads/images/thumbs/";
                //for uploading image
				$temp_name = $_FILES['image']['tmp_name'];
				$img_name = $_POST['id'].".".$ext;
				$obj->UploadImage($temp_name, $ext, $img_name, $uploadPath);
		        if(file_exists($uploadPath.$img_name))
        	        $obj->CreateThumb($img_name,$ext,$uploadPath,$destPath,100,100);
                $obj->val = array("image"=>$img_name);
                $obj->cond = array("id"=>$_POST['id']);
                $obj->update();
		}
	}	
	$msg = "Image Successfully updated";
		$url = "?page=view_gallery&id=".$_GET['type'];
		$obj->alert($msg,$url);

?>