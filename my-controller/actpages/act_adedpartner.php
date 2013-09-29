<?php  
//print_r($_POST);
//print_r($_FILES);

if($_POST['action']=="edit")
{
	//echo "this is edit";
	
	$obj->table_name = PARTNER_TBL;
    $obj->val = array("name"=>$_POST['name'],
    "street"=>$_POST['address'],
    "district"=>$_POST['district'],
    "url"=>$_POST['url'],
    "email"=>$_POST['email'],
    "phone"=>$_POST['phone'],
    "shortdesc"=>$_POST['shortdesc']);
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

        		$uploadPath = "../uploads/partner/";
        		$destPath = "../uploads/partner/thumbs/";
                //for uploading image
				$temp_name = $_FILES['image']['tmp_name'];
				$img_name = $_POST['id'].".".$ext;
				$obj->UploadImage($temp_name, $ext, $img_name, $uploadPath);
		        if(file_exists($uploadPath.$img_name))
        	        $obj->CreateThumb($img_name,$ext,$uploadPath,$destPath,100,100);
                $obj->val = array("logo"=>$img_name);
                $obj->cond = array("id"=>$_POST['id']);
                $obj->update();
		}
		$obj->redirect('?page=manage_partners&stat=u-success');
	}
}elseif($_POST['action']== "add")
{

 	$obj->table_name = PARTNER_TBL;
    $obj->val = array("name"=>$_POST['name'],"street"=>$_POST['address'],"district"=>$_POST['district'],"url"=>$_POST['url'],"email"=>$_POST['email'],"phone"=>$_POST['phone'],"shortdesc"=>$_POST['shortdesc']);
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
		$uploadPath = "../uploads/partner/";
		$destPath = "../uploads/partner/thumbs/";
			//for uploading image
		 $temp_name = $_FILES['image']['tmp_name'];
		
		$img_name = $id.".".$ext;
		$obj->UploadImage($temp_name, $ext, $img_name, $uploadPath);
		if(file_exists($uploadPath.$img_name))
			 $obj->CreateThumb($img_name,$ext,$uploadPath,$destPath,100,100);
                $obj->val = array("logo"=>$img_name);
                $obj->cond = array("id"=>$id);
                $obj->update();
		}
         $obj->redirect('?page=manage_partners&stat=i-success');   	

}

//$obj->redirect("index.php?page=news");
?>