<?php 
	if(isset($_GET[catid])&&$_GET['catid']!=""){
		$cat_id = (int)$_GET[catid];
		$breadcrum = $obj->find_product_parents($cat_id);
		$breadcrum_array = explode(',', $breadcrum);
		$rev = array_reverse($breadcrum_array);
		$pagination_query = array('tbl_products',
								  '*',
								  array('cat_id'=>$cat_id),
								  array('product_name'=>'desc'));
		$config = array('query'=>$pagination_query);
		$pagination = new Pagination('?page=manage_products&amp;catid='.$cat_id, $config);
	}else{
		$obj->redirect('?page=404');
	}
?>
<h2 class="green">
	<?php 
		foreach($rev as $k =>$v){
			if($v != ""){
				echo $v.' &raquo; ';
			}
		}
	?>
</h2>
<table id="dataGrid">
	<thead>
		<tr>
			<td colspan="3">Add More Products</td>
			<td><a href="?page=adedproducts&amp;catid=<?php echo $cat_id; ?>"><img src="images/add.png" alt="add" title="Add more Products" /></a></td>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($pagination->resource_body->total_data()!=""){
				while($data_row = $pagination->resource_body->fetch_data()){
					echo '<tr>
							<td>'.$data_row->product_code.'</td>
							<td>'.$data_row->product_name.'</td>
							<td><a href="?page=adedproducts&amp;catid='.$cat_id.'&amp;product_id='.$data_row->id.'"><img src="images/pencil.png" alt="Edit" title="Edit Product" /></a></td>
							<td><a href="?fol=actpages&amp;page=act_delete&to_delete='.$data_row->id.'&per=products&amp;callback='.$cat_id.'"><img src="images/delete.png" alt="Delete" title="Delete Product" /></a></td>
					      </tr>';	
				}
			}else{
				echo '<tr><td class="no-contents-found" colspan="4">No Products Found</td></tr>';
				
			}
		?>
	</tbody>
</table>
