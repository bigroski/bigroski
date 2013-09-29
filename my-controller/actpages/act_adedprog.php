<?php  
//echo $_POST['action'];
//echo $_POST['type'];
if($_POST['action']=="edit")
{
	//echo "this is edit";
	$obj->table_name = "tbl_resource_sub_cat";
    $obj->val = array("title"=>$_POST['title'],"shortdesc"=>$_POST['shortdesc']);
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

        		$uploadPath = "../uploads/programs/";
        		$destPath = "../uploads/programs/thumbs/";
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
   	$msg = "Data Successfully updated";
	$url = "?page=manage_resources&id=".$_POST['type'];
	$obj->alert($msg,$url);
}else
{

 	$obj->table_name = "tbl_resource_sub_cat";
    $obj->val = array("title"=>$_POST['title'],"type"=>$_POST['type'],"shortdesc"=>$_POST['shortdesc']);
   // $obj->cond = array("id"=>$_POST['id']);
    $id = $obj->insert();
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
		$uploadPath = "../uploads/programs/";
		$destPath = "../uploads/programs/thumbs/";
			//for uploading image
		 $temp_name = $_FILES['image']['tmp_name'];
		
		$img_name = $id.".".$ext;
		$obj->UploadImage($temp_name, $ext, $img_name, $uploadPath);
		if(file_exists($uploadPath.$img_name))
			 $obj->CreateThumb($img_name,$ext,$uploadPath,$destPath,100,100);
                $obj->val = array("image"=>$img_name);
                $obj->cond = array("id"=>$id);
                $obj->update();
		}
        $msg = "Data Successfully Added";
		$url = "?page=manage_resources&id=".$_POST['type'];
		$obj->alert($msg,$url);	

}

//$obj->redirect("index.php?page=news");
?>