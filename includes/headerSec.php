<div id="head">
  <div id="search">
    <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 38px">     
      <form id="form1" name="form1" method="post" action="arama_eng.asp">
        <tr>
          <td><input type="text" name="FAra" id="FAra" class="input"></td>
          <td><input type="image" src="images/yolla.gif" name="button" id="button" value="Submit" class="btn"></td>
          <td width="25">&nbsp;</td>
        </tr>
      </form>
    </table>
  </div>
  <div class="clear"></div>
  <div id="menu">
    <ul>
      <li style="background-image:url(images/menubg1.jpg); background-repeat:no-repeat; width:94px; padding-left:13px; margin:0;"><a href="index.php">&nbsp;&nbsp;&nbsp;&nbsp;HOME</a></li>
      <li ><script type="text/javascript">
            <!--
            stm_bm(["menu28fb",820,"","",0,"","",0,0,150,0,150,1,0,0,"","",0,0,1,2,"default","hand",""],this);
            stm_bp("p0",[0,0,0,0,0,0,0,10,100,"progid:DXImageTransform.Microsoft.Wipe(GradientSize=1.0,wipeStyle=1,motion=forward,enabled=0,Duration=0.40)",5,"progid:DXImageTransform.Microsoft.Wipe(GradientSize=1.0,wipeStyle=1,motion=forward,enabled=0,Duration=0.40)",5,70,0,0,"#ffffff","transparent","",2,0,0,"#ffffff"]);
            stm_ai("p0i0",[0,"    CORPORATE","","",-1,-1,0,"","_self","","","","",0,0,0,"","",10,10,0,0,1,"#ffffff",1,"#ffffff",1,"#ffffff","#E6EFF9",0,0,0,0,,,,,,,,"bold"],90,20);
            stm_bpx("p1","p0",[1,4,0,0,1,3,,,90]);
            <?php 
				$result = $obj->select('tbl_page',array('id','pagelabel'),array('parent_id'=>1),array('p_order'=>'asc'),null, true);
				if($result->total_data()!=""){
					while($r = $result->fetch_data()){
						echo 'stm_aix("p1i0","p0i0",[0,"      '.stripslashes($r->pagelabel).'","","",-1,-1,0,"pages.php?pid='.$r->id.'","_self","","","","",0,0,0,"","",7,7,0,0,1,"#E6EFF9",1,"#FFD602",1,"images/MenuOver.jpg","images/MenuOver.jpg",3,3,0,0,"#000000","#000000","#000000","#333333","11px \'Arial\'","11px \'Arial\'"],178,18);';
					}
				}            
            ?>
            
            
            stm_mc("p1",[10,"#FFFFFF",1,5,"",3]);
            stm_ep();
            stm_mc("p0",[6,"#FFFFFF",1,0,"",3]);
            stm_ep();
            stm_em();
            //-->
            </script></li>
      <li ><script type="text/javascript">
            <!--
            stm_bm(["menu28fb",820,"","",0,"","",0,0,150,0,150,1,0,0,"","",0,0,1,2,"default","hand",""],this);
            stm_bp("p0",[0,0,0,0,0,0,0,10,100,"progid:DXImageTransform.Microsoft.Wipe(GradientSize=1.0,wipeStyle=1,motion=forward,enabled=0,Duration=0.40)",5,"progid:DXImageTransform.Microsoft.Wipe(GradientSize=1.0,wipeStyle=1,motion=forward,enabled=0,Duration=0.40)",5,70,0,0,"#ffffff","transparent","",2,0,0,"#ffffff"]);
            stm_ai("p0i0",[0,"     PRODUCTS","","",-1,-1,0,"","_self","","","","",0,0,0,"","",10,10,0,0,1,"#ffffff",1,"#ffffff",1,"#ffffff","#E6EFF9",0,0,0,0,,,,,,,,"bold"],90,20);
            stm_bpx("p1","p0",[1,4,0,0,1,3,,,90]);
            stm_aix("p1i0","p0i0",[0,"      PRODUCT CATALOG","","",-1,-1,0,"products.php","_self","","","","",0,0,0,"","",7,7,0,0,1,"#E6EFF9",1,"#FFD602",1,"images/MenuOver.jpg","images/MenuOver.jpg",3,3,0,0,"#000000","#000000","#000000","#333333","11px 'Arial'","11px 'Arial'"],178,18);
            stm_aix("p1i0","p0i0",[0,"      NEW PRODUCTS","","",-1,-1,0,"newproducts.php","_self","","","","",0,0,0,"","",7,7,0,0,1,"#E6EFF9",1,"#FFD602",1,"images/MenuOver.jpg","images/MenuOver.jpg",3,3,0,0,"#000000","#000000","#000000","#333333","11px 'Arial'","11px 'Arial'"],178,18);
			stm_aix("p1i0","p0i0",[0,"      ADVERTISEMENTS","","",-1,-1,0,"advertisements.php","_self","","","","",0,0,0,"","",7,7,0,0,1,"#E6EFF9",1,"#FFD602",1,"images/MenuOver.jpg","images/MenuOver.jpg",3,3,0,0,"#000000","#000000","#000000","#333333","11px 'Arial'","11px 'Arial'"],178,18);
			stm_aix("p1i0","p0i0",[0,"      CAMPAIGNS","","",-1,-1,0,"campaigns.php","_self","","","","",0,0,0,"","",7,7,0,0,1,"#E6EFF9",1,"#FFD602",1,"images/MenuOver.jpg","images/MenuOver.jpg",3,3,0,0,"#000000","#000000","#000000","#333333","11px 'Arial'","11px 'Arial'"],178,18);
			
            stm_mc("p1",[10,"#FFFFFF",1,5,"",3]);
            stm_ep();
            stm_mc("p0",[6,"#FFFFFF",1,0,"",3]);
            stm_ep();
            stm_em();
            //-->
            </script></li>
      <li style="margin-left:10px;" ><a href="pressroom.php">&nbsp;PRESS ROOM</a></li>
      
      <li ><a href="contact.php">CONTACT</a></li>
    </ul>
  </div>
</div>
<div class="clear"></div>