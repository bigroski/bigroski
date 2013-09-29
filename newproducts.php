<?php
include "includes/head.php";
$result_new = $obj->select('tbl_products', '*', null, array('id'=>'desc'),array(0,9), true);
if($result_new->total_data()!=""){
	while($row = $result_new->fetch_data()){
		$dr[] = $row;
	}
}

if(isset($dr)&&!empty($dr)){
	$chunks = array_chunk($dr, 3);	
}
?>

<body>
	<div id="wrapperic">
		<?php
		include "includes/headerSec.php";
		?>

		<div id="aramaorta">
			New Products
		</div>

		<div id="content">
			<div class="clear"></div>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<?php 
				if(isset($chunks)&&!empty($chunks)){
					foreach($chunks as $k => $v){
						echo '<tr>';
						//print_r($v);
						foreach($v as $kv){
							echo '<td class="u">
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

										<a href="uploads/products/'.$kv->product_image.'" rel="lightbox[roadtrip]" title="'.$kv->product_name.'"><img src="uploads/products/thumbs/'.$kv->product_image.'" width="110" border="0" /></a>

										</span>
									</div></td>
									<td>
									<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td colspan="2">
											<div class="UrunAD" align="center">
												<div align="left">
													'.$kv->product_name.'
												</div>
											</div></td>
										</tr>
										<tr>
											<td colspan="2" height="5"></td>
										</tr>
										<tr>
											<td colspan="2"><strong>Code:</strong> '.$kv->product_code.'
											<br />
											'.$kv->short_code.'
											<br />
											</td>
										</tr>
										
										<tr>
											<td colspan="2"><strong>Price:</strong>'.$kv->product_price.'</td>
										</tr>
									</table></td>
								</tr>
							</table></td>
						</tr>
						<tr>
							<td><img src="images/tablo_alt.jpg" width="307" height="37" /></td>
						</tr>
					</table>
					</td>';
						}
						echo '</tr>';
					}
					}
				?>
				<!-- <tr>

					<td class="u">
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

										<a href="Resimler/SiteIcerik/6400TOFFELATTEKRSKMEYVSUTKKSEKR1KGPST(1x8)-b_20130220_151255.jpg" rel="lightbox[roadtrip]" title="Toffe Latte Soft Candy"><img src="Resimler/SiteIcerik/6400TOFFELATTEKRSKMEYVSUTKKSEKR1KGPST(1x8)-k_20130220_151232.jpg" width="110" border="0" /></a>

										</span>
									</div></td>
									<td>
									<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td colspan="2">
											<div class="UrunAD" align="center">
												<div align="left">
													Toffe Latte Soft Candy
												</div>
											</div></td>
										</tr>
										<tr>
											<td colspan="2" height="5"></td>
										</tr>
										<tr>
											<td colspan="2"><strong>Code:</strong> 6400
											<br />
											1 Kg x 8
											<br />
											</td>
										</tr>
										
										<tr>
											<td colspan="2"><strong>Price:</strong>$ 4.00</td>
										</tr>
									</table></td>
								</tr>
							</table></td>
						</tr>
						<tr>
							<td><img src="images/tablo_alt.jpg" width="307" height="37" /></td>
						</tr>
					</table>
					</td>

					

					
				</tr> -->
				
				
			</table>

		</div>
		<div class="clear"></div>

		<?php
		include "includes/footerSec.php";
		?>
</body>
</html>