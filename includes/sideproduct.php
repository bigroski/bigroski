<div id="urunkat">
      <div class="baslik">PRODUCTS</div>
      <div class="clear"></div>
      <div class="kategoriler">
        <?php 
        	$result_side = $obj->select('tbl_product_cat','*',array('parent_id'=>0),null, null, true);
        		if($result_side->total_data()!=""){
        			while($row_side  =  $result_side->fetch_data()){
        				echo '<div style="line-height:20px; background-color:#f1f0f0; border:1px solid #cccccc; padding-left:10px;"><a href="subcategory.php?pid='.$row_side->id.'" style="color:#FF0000">'.$row_side->category.'</a></div>
        <div class="clear"></div>';
		
		    $result_ssub = $obj->select('tbl_product_cat','*', array('parent_id'=>$row_side->id),null, null, true);
			if($result_ssub->total_data()!=""){
				echo '<div>';
				while($row_ssub = $result_ssub->fetch_data()){
					echo '<div style="width:200px; margin-left:20px; line-height:20px;"><a href="producttype.php?pid='.$row_ssub->id.'">>>'.$row_ssub->category.'</a></div>
          <div class="clear"></div>';
				}
				echo '</div><div class="clear"></div>';
			}
		/*echo '<div>
          <div style="width:200px; margin-left:20px; line-height:20px;"><a href="producttype.php">>>Eclairs</a></div>
          <div class="clear"></div>
          <div style="width:200px; margin-left:20px; line-height:20px;"><a href="producttype.php">>>Soft Candies With Filling</a></div>
          <div class="clear"></div>
          <div style="width:200px; margin-left:20px; line-height:20px;"><a href="producttype.php">>>Soft Candies</a></div>
          <div class="clear"></div>
          <div style="width:200px; margin-left:20px; line-height:20px;"><a href="producttype.php">>>Hard Candies</a></div>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>';*/
        			}		
        		}
        	
        ?>
        
        
      </div>
    </div>
    