<?php
	include "includes/head.php";
	$result_parent = $obj->select('tbl_product_cat','*',array('parent_id'=>0));
	if(mysql_num_rows($result_parent)!=""){
		while($row_parent = $obj->fetch($result_parent)){
			$myarray[] = $row_parent;
		}
	}
	$chunks = array_chunk($myarray, 2);
	//printArray($chunks);
?>

<body>
<div id="wrapperic">
<?php
	include "includes/headerSec.php";
?>
<div id="aramaorta">Products</div>
<div id="content">
  <div class="clear"></div>
  <div id="urunleft">
    <?php
		include "includes/sideproduct.php";
	?>
    <div id="urunkatalt"></div>
  </div>
  <div id="urunicerik">
    <div style="float:left; width:656px;">
      <table border="0" cellspacing="0" cellpadding="0" align="center">
      	<?php 
      		foreach($chunks as $k => $v){
      			echo '<tr>';
				foreach($v as $key => $value){
					echo '<td><a href="subcategory.php?pid='.$value['id'].'" title="'.$value['category_name'].'"><img src="uploads/productscat/'.$value['category_image'].'"/></a></td>';
				}
				echo '</tr>';
      		}
      	?>
        
      </table>
    </div>
  </div>
</div>
<?php
	include "includes/footerSec.php";
?>

</body>
</html>