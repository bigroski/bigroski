<?php
include "includes/head.php";
if(isset($_GET['cid'])&&$_GET['cid']!=""){
	$cat_id = (int)$_GET['cid'];
	$breadcrum = $obj->find_product_parents($cat_id);
	$breadcrum_array = explode(',', $breadcrum);
	$rev = array_reverse($breadcrum_array);
	$pagination_query = array('tbl_products',
								  '*',
								  array('cat_id'=>$cat_id),
								  array('product_name'=>'desc'));
		$config = array('query'=>$pagination_query);
		$pagination = new Pagination('productitems.php?cid='.$cat_id, $config);
		if($pagination->resource_body->total_data()!=""){
			while($row = $pagination->resource_body->fetch_data()){
				$data[] = $row;
			}
		}
		$chunks = array_chunk($data, 2);
		
}
?>

<body>
	<div id="wrapperic">
		<?php
		include "includes/headerSec.php";
		?>
		<div id="aramaorta">
			Products
		</div>

		<div id="content">
			<div class="clear"></div>
			<div id="urunleft">
				<?php
				include "includes/sideproduct.php";
				?>
				<div id="urunkatalt"></div>
			</div>
			<div id="urunicerik">

				<h2>Products / <?php 
		foreach($rev as $k =>$v){
			if($v != ""){
				echo $v.' / ';
			}
		}
	?></h2>
				<div class="clear"></div>
				<hr />
				<div class="clear"></div>

				<div style="width:600px;">

					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<?php 
							foreach($chunks as $k => $v){
								echo '<tr>';
								foreach($v as $key=> $val){
									echo '<td>
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/tablo_ust.jpg" width="307" height="27" /></td>
								</tr>
								<tr>
									<td background="images/tablo_orta.jpg">
									<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td width="100">
											<div align="center">

												<a href="uploads/products/'.$val->product_image.'" rel="lightbox[roadtrip]" title="'.stripslashes($val->product_name).'"><img src="uploads/products/'.$val->product_image.'" width="110" border="0" /></a>

												</span>
											</div></td>
											<td>
											<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
												<tr>
													<td colspan="2">
													<div class="urunad" align="center">
														<div align="left">
															'.stripslashes($val->product_name).'
														</div>
													</div></td>
												</tr>
												<tr>
													<td colspan="2" height="5"></td>
												</tr>
												<tr>
													<td colspan="2"><strong>Code:</strong> '.$val->product_code.'
													<br />
													'.$val->short_code.'
													<br />
													</td>
												</tr>
												<tr>
											<td colspan="2"><strong>Price:</strong>'.$val->product_price.'</td>
										</tr>
											</table></td>
										</tr>
									</table></td>
								</tr>
								<tr>
									<td><img src="images/tablo_alt.jpg" width="307" height="37" /></td>
								</tr>
							</table></td>';
								}
								echo '</tr>';
							}
						?>
						
						

						
						
						
						

						
						

					</table>

				</div>
				<div class="clear"></div>

				<br />
				</td>

				<?php 
				if($pagination->pagination_link!=""){
	                echo '<tr><td class="pagination" colspan="4">'.$pagination->pagination_link.'</td></tr>';
	            }
				?>
				<br />
				<br />
				<input onClick="history.back();" type="button" value="&laquo; Back" class="buton">

			</div>
		</div>
		<?php
		include "includes/footerSec.php";
		?>
</body>
</html>