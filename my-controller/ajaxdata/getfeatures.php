<?php 
    include '../../classes/application_top.php';
    if(isset($_POST['feature_name'])&&$_POST['feature_name']!=""){
        $obj->table_name = 'tbl_features';
        $obj->val = array('feature_name'=>$obj->sanitize_quotes($_POST['feature_name']));
        $obj->insert();
    }
    $data = $obj->get_site_features();
    if($data==""){
        $returnHtml = "No Contents Found";
    }else{
        $returnHtml = '<form id="site_settings" method="post">';
        foreach($data as $key=>$val){
            $returnHtml .= '<div class="small-feature-box">
                                <label>
                                    <input type="checkbox" name="isactive['.$val['id'].']" '.checkSelected($val['isactive'], 1, true).'> '.ucfirst($val['feature_name']).'
                                </label>
                           </div>';
        }
        $returnHtml .= '</form>';
    }
    echo $returnHtml.'<br /><a href="javascript:void(0)" id="addFeature">Add Another Feature</a>
            <div class="btn_holder"><input type="button" name="sub_btn" value="Make Changes" class="btn" /></div>';
?>