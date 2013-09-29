<?php  
$available_reffer  = array("page","news","slider","events");
$query_reffer = $_GET['per'];
$send_back_to = $_SERVER[HTTP_REFERER];
if(in_array($query_reffer,$available_reffer)){
    $table_name = DB_PREFIX.'_'.$query_reffer;
    $to_delete = (int)$_GET['to_delete'];
    switch($query_reffer){
        case 'page':
            $data = $obj->get_deletable_content($table_name, $to_delete);
            if(is_array($data)){
                $result_sub = $obj->select($table_name,'*',array('parent_id'=>$data['id']));
                if(mysql_num_rows($result_sub)!=""){
                    $obj->table_name = $table_name;
                    $obj->cond = array('parent_id'=>$data['id']);
                    $obj->delete();    
                }
                $obj->table_name = $table_name;
                $obj->cond = array('id'=>$data['id']);
                $obj->delete();
                Page_finder::set_message("Page Successfully Deleted.",'check-64.png');
                $send_back_to = 'index.php';
                $obj->redirect($send_back_to);
            }else{
                Page_finder::redirect_with_error();
            }
            break;
        case 'news':
            $data = $obj->get_deletable_content($table_name, $to_delete);
            if(is_array($data)){
                $obj->table_name = $table_name;
                $obj->cond = array('id'=>$to_delete);
                $obj->delete();
                if($data['image']!=""){
                    @unlink('../uploads/news/'.$data['image']);
                    @unlink('../uploads/news/thumbs/'.$data['image']);
                }
                Page_finder::set_message("An article has been deleted. ",'check-64.png');
                $obj->redirect($send_back_to);   
            }else{
                Page_finder::redirect_with_error();
            }
            break;
        case "slider":
            $data = $obj->get_deletable_content($table_name, $to_delete);
            if(is_array($data)){
                if($data['image']!=""){
                    @unlink('../uploads/slider/'.$data['image']);
                    @unlink('../uploads/slider/thumbs/'.$data['image']);
                }
                $obj->table_name = $table_name;
                $obj->cond = array('id'=>$to_delete);
                $obj->delete();
                Page_finder::set_message("Slider Image Deleted. ",'check-64.png');
                $obj->redirect($send_back_to);
            }else{
                Page_finder::redirect_with_error();
            }
            break;
        case "events":
            $data = $obj->get_deletable_content($table_name, $to_delete);
            if(is_array($data)){
                $obj->table_name = $table_name;
                $obj->cond = array('id'=>$to_delete);
                $obj->delete();
                Page_finder::set_message("An Event Has Been Deleted");
                $obj->redirect($send_back_to);
            }else{
                Page_finder::redirect_with_error();
            }
            
            break;
    }
}
$obj->printArray($_SERVER);

?>