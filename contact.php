<?php
	include "includes/head.php";
	if(isset($_GET['pid'])&&$_GET['pid']!=""){
		$page_id = (int)$_GET['pid'];
		$result = $obj->select('tbl_page','*',array("id"=>$page_id),null, null, true);
		
		if($result->total_data()!=""){
			$d = $result->fetch_data();
		}
	}else{
		$page_id = 2;
		$result = $obj->select('tbl_page','*',array("id"=>$page_id),null, null, true);
		
		if($result->total_data()!=""){
			$d = $result->fetch_data();
		}
		
	}
?>

<body>
<div id="wrapperic">
<?php
	include "includes/headerSec.php";
?>
        
 <div style="background-image:url(images/iletisimres.jpg);	height:117px;	color: #ffffff;	font-size: 30px;	text-decoration:none;	padding-right:30px;	text-align:right; 	line-height:117px;">Contact Information
        </div>
         <div class="clear"></div>
        <div id="content">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="272" rowspan="2" valign="top"><div id="urunleft">
          <div id="urunkat">
            <div class="baslik">Contact Us</div>
              
            <div class="clear"></div>
                <div class="kategoriler">
                	<?php 
                	    $result_side_page = $obj->select('tbl_page', array('id', 'pagelabel'), array('parent_id'=>2), null, null,true);
						if($result_side_page->total_data()!=""){
							while($row_side_page = $result_side_page->fetch_data()){
								echo '<div style="line-height:20px; border:1px solid #cccccc; padding-left:10px;"><a href="contact.php?pid='.$row_side_page->id.'" style="color:#FF0000">'.$row_side_page->pagelabel.'</a></div>';
							}
						}
                	?>
                    
                    
                </div>
            </div>
            
          <div id="urunkatalt"></div>
  
      </div></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td width="1086" valign="top"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          
          <tr>
            <td><table width="100%" border="0" cellpadding="2" cellspacing="2" class="text">
              
              <tr>
                <td height="30" colspan="3" bgcolor="e1e1e1"><span style="font-size:14px; padding-left:5px; font-weight:bold;"><?php echo stripslashes($d->heading) ?></span></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"></td>
              </tr>
              
              <tr>
                <td colspan="3"><?php echo $d->description; ?></td>
                
              </tr>
              
              
              <tr>
                <td colspan="3" align="center"></td>
              </tr>
              <tr>
                <td colspan="3" bgcolor="#999999"></td>
              </tr>
              <tr>
                <td colspan="3"></td>
              </tr>
              
            </table></td>
          </tr>
          
          
          
        </table></td>
      </tr>
    </table>
   
  </div>    
    <div class="clear"></div>
    
   
<?php
	include "includes/footerSec.php";
?>

</body>
</html>