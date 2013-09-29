<?php
	include "includes/head.php";
?>

<body>
<div id="wrapper">
<?php
	include "includes/headerSec.php";
?>
<div class="flashbanner"> 
  <script language="javascript" type="text/javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0',
			'width', '983',
			'height', '243',
			'src', 'flash_eng',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'transparent',
			'devicefont', 'false',
			'id', 'flash_eng',
			'name', 'flash_eng',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'flash_eng',
			'salign', ''
			); //end AC code
	}
</script>
  <noscript>
  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="983" height="243" id="flash_eng" align="middle">
    <param name="allowScriptAccess" value="sameDomain" />
    <param name="allowFullScreen" value="false" />
    <param name="movie" value="flash_eng.swf" />
    <param name="quality" value="high" />
    
  </object>
  </noscript>
</div>
<div class="gecis">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="7"></td>
    </tr>
    <tr>
      <td><script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script> 
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','983','height','102','src','gecis_eng','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','gecis_eng' ); //end AC code
</script>
        <noscript>
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="983" height="102">
          <param name="movie" value="gecis_eng.swf" />
          <param name="quality" value="high" />
          <embed src="gecis_eng.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="983" height="102"></embed>
        </object>
        </noscript></td>
    </tr>
  </table>
</div>
<div class="clear"></div>
<div id="bottom"> 
  <!--News Begin-->
  
  <div class="newsbg">
    <div class="newsbaslik">PARTICIPATIONS </div>
    <div class="news">
    	<?php 
    		$result=  $obj->select('tbl_news', array('id','title'), array('type'=>2), array('posted_on'=>'desc'), array(0,4), TRUE);
			if($result->total_data()!=""){
				while($row  = $result->fetch_data()){
					echo '
					<a href="display.php?pid='.$row->id.'">'.stripslashes($row->title).' ...</a>
				      <div class="haberline"></div>
				      <div class="clear"></div>
					';
				}
			}
    	?> 
      
      
    </div>
  </div>
  <!--News End--> 
  
  <!--Lansman Begin-->
  <div class="lansmanbg">
    <div class="lansmanbaslik">NEW PRODUCTS</div>
    <div class="lansman"> 
    	<?php 
    		$result=  $obj->select('tbl_news', array('id','title'), array('type'=>2), array('posted_on'=>'desc'), array(0,4), TRUE);
			if($result->total_data()!=""){
				while($row  = $result->fetch_data()){
					echo '
					<a href="display.php?pid='.$row->id.'">'.stripslashes($row->title).' ...</a>
				      <div class="haberline"></div>
				      <div class="clear"></div>
					';
				}
			}
    	?> 
      
    </div>
  </div>
  <!--Lansman End--> 
  
  <!--Kampanya Begin-->
  <div class="kampbg">
    <div class="kampbaslik">NEWS / CAMPAIGNS</div>
    <div class="kamp"> 
    	<?php 
    		$result=  $obj->select('tbl_news', array('id','title'), array('type'=>2), array('posted_on'=>'desc'), array(0,4), TRUE);
			if($result->total_data()!=""){
				while($row  = $result->fetch_data()){
					echo '
					<a href="display.php?pid='.$row->id.'">'.stripslashes($row->title).'...</a>
      <hr />
      <div class="clear"></div>
					';
				}
			}
    	?> 
      
    </div>
  </div>
  <!--Kampanya End--> 
  
</div>
<?php
	include "includes/footerSec.php";
?>

</body>
</html>