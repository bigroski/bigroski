<?php  
//print_r($_POST);
if($_GET['action']=="delete"){
		//echo $_GET['action'];
	$obj->table_name = PROGRAM_TBL;	
	$obj->cond = array("pro_id"=>$_GET['id']);
	$obj->delete();
	$url = "?page=manage_program&day=".$_GET['day'];
	$obj->redirect($url);
	}
    

if($_POST['action']=="edit")
{
	
	$obj->table_name = PROGRAM_TBL;
    //$days = array("01"=>"Sunday","02"=>"Monday","03"=>"Tuesday","04"=>"Wednesday","05"=>"Thursday","06"=>"Friday","07"=>"Saturday");
	//$day = $_POST['daySele'];
	//$pgmday = $days[$day];
	$start_time = $_POST['start_hour'].":".$_POST['start_min'].":"."00";
    $end_time = $_POST['end_hour'].":".$_POST['end_min'].":"."00";
    $obj->val = array("title"=>$_POST['title'],"start_time"=>$start_time,"end_time"=>$end_time,"rj_id"=>$_POST['rj_id']);
    $obj->cond = array("pro_id"=>$_POST['id']);
    $obj->update();
  	$msg = "Program Successfully updated";
	//$url = "?page=manage_program&day=".$_POST['to'];
	$obj->alert1($msg);
	
}elseif($_POST['action']=="add")
{

 //	$obj->table_name = PROGRAM_TBL;
   // $obj->val = array("title"=>$_POST['title'],"rj_id"=>$_POST['rj_id']);
	//$id = $obj->insert();

    $days = array("01"=>"Sunday","02"=>"Monday","03"=>"Tuesday","04"=>"Wednesday","05"=>"Thursday","06"=>"Friday","07"=>"Saturday");
	foreach($_POST['dayselect'] as $key=>$value)
	{
	
		$day = $value;
		$pgmday = $days[$day];
 	$obj->table_name = PROGRAM_TBL;
	$start_time = $_POST['start_hour'].":".$_POST['start_min'].":"."00";
    $end_time = $_POST['end_hour'].":".$_POST['end_min'].":"."00";
	$obj->val = array("day"=>$pgmday,"title"=>$_POST['title'],"start_time"=>$start_time,"end_time"=>$end_time,"rj_id"=>$_POST['rj_id']);
	$obj->insert();
	}
	$msg = "Program Successfully Added";
	$url = "?page=manage_program&day=".$_POST['r_dic'];
	$obj->alert1($msg);	


}


?>