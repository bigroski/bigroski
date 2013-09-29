<?php 
if($_POST['action']=="edit"){
	
	if(isset($_POST['submit2']))		//--------------Page Deleting Action start-----------
	{
	//echo "delete<br>";
	$id = $_POST['id'];
	$table = "tbl_page";
	$row = $obj->getDelInfo($table,$id);
	if($row['image']!="" || $row['file']!=""){
		$url = "../uploads/subpage/";
		$url2 = "../uploads/subpage/thumbs/";
		$file1 = $url.$row['image'];
		$file2 = $url2.$row['image'];
		unlink($file1);
		unlink($file2);
	   }
		$obj->table_name = MAIN_PAGE;
		$obj->cond = array("id"=>$id);
		$obj->delete();
		$msg = "Page Successfully deleted";
		$url = "index.php";
		$obj->alert($msg,$url);

	}								//------------------page Deleting Action End

	else			//------------Page edition action start
	{
	
	//echo $_POST['id'];
	$obj->table_name = "tbl_page";
    $obj->val = array("pagelabel"=>$_POST['pagelabel'],
                        "description"=>$_POST['description'],
                        "shortdesc"=>$_POST['shortdesc'],
                        "heading"=>$_POST['heading']);
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

        $uploadPath = "../uploads/subpage/";
        $destPath = "../uploads/subpage/thumbs/";
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
	$obj->redirect('?page=manage_subpage&stat=u-success&type='.$_POST['type'].'&id='.$_POST['id']);


	}//--------------------------Page editiong action end
	
	
}elseif($_POST['action']=="add")//----------------------- Page Adding action start
{				
	//echo "add";
	//echo "type".$_POST['type'];
	$obj->table_name = "tbl_page";
    $obj->val = array("pagelabel"=>$_POST['pagelabel'],
                        "description"=>$_POST['description'],
                        "shortdesc"=>$_POST['shortdesc'],
                        "heading"=>$_POST['heading'],
                        "parent_id"=>$_POST['type']);
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
		$uploadPath = "../uploads/subpage/";
		$destPath = "../uploads/subpage/thumbs/";
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
    $obj->redirect('?page=manage_subpage&stat=i-success&type='.$_POST['type'].'&id='.$id);  
    
} 										//----------------------Page Adding action end

 ?>