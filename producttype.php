<?php
	include "includes/head.php";
		if(isset($_GET['pid'])&&$_GET['pid']!=''){
		$cat_id=(int)$_GET['pid'];
			$breadcrum = $obj->find_product_parents($cat_id);
	$breadcrum_array = explode(',', $breadcrum);
	$rev = array_reverse($breadcrum_array);
		$result_sub=$obj->select('tbl_product_cat', '*', array('parent_id'=>$cat_id), null, null, true);
	}
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
	    
           <div style="width:670px;">            
			
			<h2>Products / <?php 
		foreach($rev as $k =>$v){
			if($v != ""){
				echo $v.' / ';
			}
		}
	?></h2>
            <hr />            
			
			<?php 
				if($result_sub->total_data()!=''){
					while($re=$result_sub->fetch_data()){
						echo '<div id="markaaltkat">
                <div align="center" style="margin-top:12px;">
                <a href="productitems.php?cid='.$re->id.'" title="'.$re->category.'"><img src="uploads/productscat/'.$re->category_image.'" /></a>
                </div>
            </div>
            ';
						
					}
				}
			
			?>
            
            
            </div>
            <div class="clear"></div>
            <input onClick="history.back();" type="button" value="� Back" class="buton">
			 
         </div>   
  </div>
<?php
	include "includes/footerSec.php";
?>

</body>
</html>