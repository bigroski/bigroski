<?php
if ($_GET['type'] == 'staffs') {
    $tbl = 'tbl_staff_cat';
} elseif ($_GET['type'] == "news") {
    $tbl = "tbl_news_type";
}elseif($_GET['type']=='ad'){
    $tbl = "tbl_ad_category";
}elseif($_GET[type]=='product'){
	$tbl = "tbl_product_cat";
}
if (isset($_GET['parent_id']) && $_GET['parent_id'] != "") {
    $parent_id = (int)$_GET['parent_id'];
}

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    switch($_POST['type']) {
        case "staffs" :
            $obj -> table_name = STAFF_CAT;
            break;
        case "news" :
            $obj -> table_name = NEWS_TYPE;
            break;
        case "ad":
            $obj->table_name = 'tbl_ad_category';
            break;
		case 'product';
		    $obj->table_name = 'tbl_product_cat';
		    break;
    }
    if(isset($_FILES['p_image'])&&is_array($_FILES['p_image'])){
    	$config['directory'] = '../uploads/productscat/';
        $config['thumb_width'] = DEFAULT_THUMB_WIDTH;
        $config['thumb_height'] = DEFAULT_THUMB_HEIGHT;
        $image_obj  =  ImageManipulation::generateClass($config);
		$uploaded_files = $image_obj  ->  upload_multiple_image($_FILES['p_image']);
		printArray($uploaded_files);
    }
    if (is_array($_POST['category'])) {
        foreach ($_POST['category'] as $key => $val) {
            if($val!=""){
                $obj -> val = array("category" => $obj -> sanitize_quotes($val));
                if (isset($_POST['parent_id']) && $_POST['parent_id'] != "0") {
                    $obj -> val['parent_id'] = (int)$_POST['parent_id'][$key];
                }
                if (isset($_POST['has_subcat'])) {
                    $obj -> val['has_subcat'] = $_POST['has_subcat'][$key];
                }
				if(isset($uploaded_files)&&is_array($uploaded_files)){
					$obj->val['category_image'] = $uploaded_files[$key];
				}
                $obj->insert();
            }
                    }
    }
    Page_finder::set_message("New Category Added");
    $obj->redirect('index.php');
    //$obj->alert("New ".ucfirst($_POST['type'])." Category successfully Added","index.php");
}
?>
<form method="post" action="?page=addcategory&type=<?php echo $_GET['type']; ?>" enctype="multipart/form-data">
    <table id="dataGrid">
        <thead>
            <tr>
                <td>Category Settings</td>
                <td colspan="3"></td>
                <?php
                   if($_GET['type']=="product"){
                 ?>
                 <td></td>
                 <?php } ?>
            </tr>
        </thead>
        <tbody>

            <tr id="ori">
                <td>Enter <?php echo ucfirst($_GET['type']); ?>
                Category</td>
                <td width="50">
                    <input type="text" name="category[]" value="" />
                </td>
                <?php 
                    if($_GET['type']=="ad"){
                        echo '<td colspan="2"></td>';
                    }else{
                ?>
                <td width="140">
                    <label>
                        <input type="checkbox" name="has_subcat[0]" value="Y">
                        Has Child 
                    </label>
                </td>
                <td><?php $result_parents = $obj -> select($tbl, '*', array('has_subcat' => 'y'));
                if (mysql_num_rows($result_parents) != "") {
                    echo '<select name="parent_id[]">';
                    echo '<option value="0">Select A Parent</option>';
                    while ($row_parents = $obj -> fetch($result_parents)) {
                        echo '<option value="' . $row_parents['id'] . '" ' . ((isset($parent_id) && $parent_id == $row_parents['id']) ? ' selected="selected"' : '') . '>' . stripslashes($row_parents['category']) . '</option>';
                    }
                    echo '</select>';
                }
                ?></td>
                <?php } ?>
                <?php
                   if($_GET['type']=="product"){
                 ?>
                <td>
                	<input type="file" name="p_image[]" placeholder="Select An image file" />
                </td>
                <?php } ?>
            </tr>
            <tr class="addMore">
                <td></td>
                <td>
                <input type="button"  value="addMore" />
                </td>

            </tr>
            <tr>
                <td>
                <input type="hidden" name="type" value="<?php echo $_GET['type']; ?>"/>
                </td>
                <td>
                <input type="submit" name="submit" value="Submit" />
                </td>
            </tr>

        </tbody>
    </table>
</form>
<script>
	$(document).ready(function(){
        var addHtml=$('#ori').html();
        $('.addMore input[type=button]').live('click',function(){
            var cP = parseInt($('tr').length-3);
            var nH = addHtml.replace(/\[0\]/,'['+cP+']');
            $('.addMore').before('<tr>'+nH+'</tr>');
        });
    });
</script>