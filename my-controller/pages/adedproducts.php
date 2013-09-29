<?php
if(isset($_GET['catid'])&&$_GET[catid]!=""){
	$catid = (int)$_GET['catid'];
	$breadcrum = $obj->find_product_parents($catid);
	$breadcrum_array = explode(',', $breadcrum);
	$rev = array_reverse($breadcrum_array);
	if(isset($_GET['product_id'])&&$_GET['product_id']!=""){
		$action = "edit";
		$product_id = (int)$_GET[product_id];
		$result_product = $obj->select('tbl_products','*',array('id'=>$product_id),null, null, true);
		if($result_product->total_data()!=""){
			$row_p = $result_product->fetch_data();
		}else{
			$obj->redirect('?page=404');
		}
	}else{
		$action = "add";
	}	
}else{
	$obj->redirect("?page=404");
}
?>
<h2 class="">
	<?php 
		foreach($rev as $k =>$v){
			if($v != ""){
				echo $v.' &raquo; ';
			}
		}
		echo '<span class="green">('.ucfirst($action).')</span>';
	?>
</h2>
<form method="post" action="?page=act_adedproducts&amp;fol=actpages" enctype="multipart/form-data">
	<table id="dataGrid">
		<tr>
			<td>
				Product Name	
			</td>
			<td>
				<input type="text" name="product_name" value="<?php if(isset($row_p)) echo stripslashes($row_p->product_name); ?>" />
			</td>
		</tr>
		<tr>
			<td>
				Product Code	
			</td>
			<td>
				<input type="text" name="product_code" value="<?php if(isset($row_p)) echo stripslashes($row_p->product_code); ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				Short Code	
			</td>
			<td>
				<input type="text" name="short_code" value="<?php if(isset($row_p)) echo stripslashes($row_p->short_code); ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				Product Price	
			</td>
			<td>
				<input type="text" name="product_price" value="<?php if(isset($row_p)) echo stripslashes($row_p->product_price); ?>" />
			</td>
		</tr>
		<?php 
			if(isset($row_p)&&$row_p->product_image!=""){
				echo '<tr>
				         <td>Current Image</td>
				         <td><img src="../uploads/products/thumbs/'.$row_p->product_image.'" /></td>
				      </tr>';
			}
		?>
		<tr>
			<td>Product Image</td>
			<td><input type="file" name="image" /></td>
		</tr>
		<tr>
			<td>
				<?php 
					if(isset($product_id)&&$product_id!=""){
						echo '<input type="hidden" name="product_id" value="'.$product_id.'">';
					}
				?>
				<input type="hidden" name="cat_id" value="<?php echo $catid; ?>" />
			</td>
			<td>
				<input type="submit" class="btn" name="btn_submit" value="Submit" />
			</td>
		</tr>
	</table>
</form>