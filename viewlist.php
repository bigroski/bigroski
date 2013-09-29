<?php 
	include 'classes/application_top.php';
	$result = $obj->select('tbl_products','*',null, array('product_name'=>'asc'),null, true);
	if($result->total_data()!=""){
		echo '<table border="1">
		      <tr>
		         <td><strong>Sno</strong></td>
		         <td><strong>Product </strong></td>
		         <td><strong>Code</strong></td>
		         <td><strong>Qty</strong></td>
		         <td><strong>Price</strong></td>
		      </tr>';
		while($r = $result->fetch_data()){
			echo '<tr>
			          <td>'.++$sno.'</td>
			          <td>'.$r->product_name.'</td>
			          <td>'.$r->product_code.'</td>
			          <td>'.$r->short_code.'</td>
			          <td>'.$r->product_price.'</td>
			      </tr>';
		}
		echo '</table>';
	}
?>