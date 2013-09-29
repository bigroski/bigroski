<?php 
    if(isset($_POST)&&count($_POST)!=""){
        if(isset($_POST['btn_submit'])){
            $obj->table_name = "tbl_site_settings";
            foreach($_POST as $key => $val){
                $option_id = $obj->get_option_id($key);
                if($option_id!=false){
                    $obj->val = array('option_values'=>$val);
                    $obj->cond = array('id'=>$option_id);
                    $obj->update();
                }
                
            }
            Page_finder::set_message("Settings Saved",'check-64.png');
            $obj->redirect('?page=settings&show=0');
        }elseif(isset($_POST['btn_submit_banner'])){
            if($_FILES['image']['error']==0){
                    $config['directory'] = '../uploads/banner/';
                    $config['thumb_width'] = DEFAULT_THUMB_WIDTH;
                    $config['thumb_height'] = DEFAULT_THUMB_HEIGHT;
                    $image_obj  =  ImageManipulation::generateClass($config);
                    $imageResult = $image_obj  ->  upload_image($_FILES['image']);
                    
            }else{
                    $imageResult = "";
            }
            if($imageResult!=""){
                $obj->table_name = "tbl_site_settings";
                $obj->val = array('option_values'=>$imageResult);
                $obj->cond = array('id'=>3);
                $obj->update();
                Page_finder::set_message("Banner Successfully Changed",'check-64.png');
                $obj->redirect('?page=settings&show=1');
            }else{
                Page_finder::set_message("Banner Cannot be Changed",'check-64.png');
                $obj->redirect('?page=settings&show=1');
            }
            
        }elseif(isset($_POST['btn_res_enabled'])){
            //$obj->printArray($_POST);
            foreach($_POST['isactive'] as $key=>$val){
                $obj->table_name = RESOURCE_TBL;
                $obj->val = array('enabled'=>$val);
                $obj->cond = array('id'=>$key);
                $obj->update();
            }
            Page_finder::set_message("Resource Settings Saved",'check-64.png');
            $obj->redirect('?page=settings&show=3');
        } 
    }else{
        Page_finder::set_message("Illegal Access",'check-64.png');
        $obj->redirect('?page=settings');
    }
    
?>