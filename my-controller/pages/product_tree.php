<?php 
    $result = $obj->select('tbl_product_cat','*',array('parent_id'=>0),array('category'=>'asc'),null, true);
	if($result->total_data()!=""){
		while($row_f = $result->fetch_data()){
			$tree[] = $row_f[category];
			if($row_f[has_subcat] == 'Y' ){
				
			}
		}
	}
?>
<h2>Product Overview</h2>
