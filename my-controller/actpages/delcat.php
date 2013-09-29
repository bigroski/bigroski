<?php  
	include("../../classes/application_top.php");
	$type = $_GET['type'];
	$id = (int)$_GET['id'];
	
	switch($type)
		{
			case 1:
				$obj->table_name = "tbl_news_type";
                $table_cat = "tbl_news_type";
                $table_main= "tbl_news";
				break;
			case 2:
				$obj->table_name = "tbl_staff_cat";
                $table_cat = "tbl_staff_cat";
                $table_main= "tbl_staffs";
				break;
		}
	$traverse_category = $obj->travese_categories($obj->table_name, $id);
    $exp = explode(',',$traverse_category);
    //printArray($exp);
    //die();
    if(is_array($exp)&&count($exp)>1){
        foreach($exp as $val){
            $obj->table_name = $table_main;
            $obj->cond = array('type'=>$val);
            $obj->delete();
            $obj->table_name = $table_cat;
            $obj->cond = array('id'=>$val);
            $obj->delete();
        }
        $obj->table_name = 'tbl_staff_cat';
        $obj->cond = array('id'=>$id);
        $obj->delete();
    }else{
            $obj->table_name = $table_main;
            $obj->cond = array('type'=>$id);
            $obj->delete();
            $obj->table_name = $table_cat;
            $obj->cond = array('id'=>$id);
            $obj->delete();
    }
	$obj->alert("Category Successfully Deleted.","../index.php");
	
?>
