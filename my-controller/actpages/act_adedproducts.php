<?php 
//printArray($_POST);
//printArray($_FILES);
if($_FILES['image']['error']==0){
        $config['directory'] = '../uploads/products/';
        $config['thumb_width'] = DEFAULT_THUMB_WIDTH;
        $config['thumb_height'] = DEFAULT_THUMB_HEIGHT;
        $image_obj  =  ImageManipulation::generateClass($config);
        $imageResult = $image_obj  ->  upload_image($_FILES['image']);
        
}else{
        $imageResult = "";
}
if(isset($_POST[btn_submit])&&$_POST[btn_submit]=="Submit"){
	if(isset($_POST[product_id])&&$_POST[product_id]!=""){
		$obj->table_name = 'tbl_products';
		$obj->val = array("product_name"=>$_POST[product_name],
						  "product_code"=>$_POST['product_code'],
						  "short_code"=>$_POST['short_code'],
						  "product_price"=>$_POST[product_price],
						  "cat_id"=>$_POST[cat_id]);
		if($imageResult!=""){
        	$obj->val['product_image'] = $imageResult;
    	}
		$obj->cond = array("id"=>$_POST['product_id']);
		$obj->update();
		Page_finder::set_message("A Product has been Udated");
		$obj->redirect("?page=manage_products&catid=".$_POST['cat_id']);
	}else{
		$obj->table_name = 'tbl_products';
		$obj->val = array("product_name"=>$_POST[product_name],
						  "product_code"=>$_POST['product_code'],
						  "short_code"=>$_POST['short_code'],
						  "product_price"=>$_POST[product_price],
						  "cat_id"=>$_POST[cat_id],
						  "product_image"=>$imageResult);
		$obj->insert();
		Page_finder::set_message("A Product has been Added");
		$obj->redirect("?page=manage_products&catid=".$_POST['cat_id']);
	}
}
?>