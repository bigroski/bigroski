<?php
	include "includes/head.php";
	
		
		$result = $obj->select('tbl_page','*',array("id"=>7),null, null, true);
		if($result->total_data()!=""){
			$d = $result->fetch_data();
		}
	
	//printArray($r);
?>

<body>
<div id="wrapperic">
<?php
	include "includes/headerSec.php";
?>
<div id="kurumsalorta">
        <?php echo stripslashes($d->heading) ?></div>
        
        <div id="content">
        <div class="clear"></div>
				<?php 
				  if($d->image!=""){
				?>
				<img src="uploads/pages/<?php echo $d->image; ?>" align="left" alt="Tayaş - Başkanın Mesajı" style="padding-right:10px;">
				<?php } ?>
				<p><?php echo stripslashes($d->description); ?></p>
    	</div>
    
   
<?php
	include "includes/footerSec.php";
?>

</body>
</html>