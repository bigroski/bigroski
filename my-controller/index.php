<?php
include ("../classes/application_top.php");
include ('../classes/soptimizer.php');
//error_reporting(E_ALL);
$user_obj->checkLoggedIn();
$option_global = $obj->get_setting_options();
$pagename = Page_finder::pagefinder($_GET['page'], $_GET['fol']);
ob_start();
//$pagename = $obj->pagefinder($_GET['page']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administration</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" href="navigation/css/dropdownmenu.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/cmxform.css" />
        <link rel="stylesheet" type="text/css" href="css/dataGrid.css" />
        <link rel="stylesheet" type="text/css" href="css/bigroski.css" />
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="navigation/js/dropdownmenu.js"></script>
        
        <link rel="stylesheet" type="text/css" href="css/cmxform.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.19.custom.css" />
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="ckfinder/ckfinder.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
        <link rel="stylesheet" href="css/password.css" type="text/css" />
        <script src="js/password.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/custom-script.js"></script>
        <script src="js/chat.js" type="text/javascript"></script>
        <script type="text/javascript">
			$(function() {
				$("#datepicker").datepicker({
					dateFormat : "yy-mm-dd",
					onSelect : function() {
						$(this).valid();
					}
				});

			});

        </script>
        <script>
        /*
         * Custom radio plugin 
         * $('input[type=radio]').each(function(){
                    var val = $(this).val();
                    var is_selected = $(this).attr('checked');
                    if($(this).is(':checked')){
                        var class_r="bigroski b-checked";
                    }else{
                        var class_r="bigroski b-un-checked";
                    }
                    if(val == 'y'){
                        $(this).after('<span class="'+class_r+'">Yes</span>')
                    }else{
                        $(this).after('<span class="'+class_r+'">No</span>')
                    }
                   $(this).hide();
                    
                });
         */
         
			$(document).ready(function() {
			    //variable Debugger Script
			    var check_online_members = setInterval(function(){
			        $.get('ajaxdata/online_users.php',function(r){
			            //alert(r);
			            $('.current_online').html(r);
			        });
			    },5000);
		
			
			    $('.nav_container').click(function(){
			        $(this).find('.nav_popup').toggle();
			    });
			    
			    $('.debugger_val_title').click(function(){
			        $(this).next().toggle('easeInOutBounce');
			    });
			    $('#debugger_console_close').click(function(){
			        $('#debugger_console').hide('fadeOut');
			    });
			    $('#variable_logger').click(function(){
                    $('#debugger_console').toggle('easeInOutBounce');
                });
                $('#close_qr').click(function(){
			        $('.hundred').hide();
			    });
			    $('#addFeature').live('click',function(){
			        var haf = '<form id="ajax_add_feature"><table><tr><td>Enter Feature Name</td><td><input type="text" name="feature_name"/></td><td><input type="button" name="btn_sub" id="ajax_add_feature_btn" value="submit"  /></td></tr></table></form>';
			        $('.popup-container').html(haf);
			    });
			    $('#ajax_add_feature_btn').live('click',function(){
			        var f_val = $('input[name=feature_name]').val();
			        alert(f_val);
			        $.ajax({
			            url:'ajaxdata/getfeatures.php',
			            data:{'feature_name':f_val},
			            type:'post',
			            dataType:'html',
			            success:function(r){
			                $('.popup-container').html(r);
			            }
			        })
			        return false;
			    });
				if ($('#newsHov').is(':visible')) {
					$('#newsHov').css('width', '400px');
				}
				$('.colorSelector').click(function(){
				    $('.nav-color-selector').toggle('slow');
				});
				$('.select-color').click(function(){
				    var selected_color = $(this).css('background-color');
				    var formm  = selected_color.slice(4,-1);
				    var arr = formm.split(',');
				    var R = arr[0];
				    var G = arr[1];
				    var B = arr[2];
				    var hexColor = rgbToHex(R,G,B);
				    setCookie('color_val',hexColor);
				    $('#nav, #footer, #dataGrid > thead, .page_selected').css('background','#'+hexColor);
				    $('#content_right, ul.dropdown ul   ').css('border-color','#'+hexColor);
				    //document.write('<style>ul.dropdown li.hover,ul.dropdown li:hover{ background: #'+hexColor+'}</style>');
				    $('ul.dropdown li').hover(function(){
				       $(this).css('background','#'+hexColor);
				        
				    },function(){
				        $(this).css('background','#FFF');
				    });
				     $('.nav-color-selector').hide('slow');   
				    
				});
				
			});

        </script>
        <script type="text/javascript">
            function rgbToHex(R,G,B) {return toHex(R)+toHex(G)+toHex(B)}
            function toHex(n) {
                 n = parseInt(n,10);
                 if (isNaN(n)) return "00";
                 n = Math.max(0,Math.min(n,255));
                 return "0123456789ABCDEF".charAt((n-n%16)/16)
                      + "0123456789ABCDEF".charAt(n%16);
            }
            function setCookie(c_name,value,exdays)
            {
                var exdate=new Date();
                exdate.setDate(exdate.getDate() + exdays);
                var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
                document.cookie=c_name + "=" + c_value;
            }
            function getCookie(c_name)
            {
            var c_value = document.cookie;
            var c_start = c_value.indexOf(" " + c_name + "=");
            if (c_start == -1)
              {
              c_start = c_value.indexOf(c_name + "=");
              }
            if (c_start == -1)
              {
              c_value = null;
              }
            else
              {
              c_start = c_value.indexOf("=", c_start) + 1;
              var c_end = c_value.indexOf(";", c_start);
              if (c_end == -1)
              {
            c_end = c_value.length;
            }
            c_value = unescape(c_value.substring(c_start,c_end));
            }
            if(c_value!=null){
                
                $('#nav, #footer, #dataGrid > thead').css('background','#'+c_value);
                    $('#content_right, ul.dropdown ul   ').css('border-color','#'+c_value);
                    //document.write('<style>ul.dropdown li.hover,ul.dropdown li:hover{ background: #'+hexColor+'}</style>');
                    $('ul.dropdown li').hover(function(){
                       $(this).css('background','#'+c_value);
                        
                    },function(){
                        $(this).css('background','#FFF');
                    });
            }else{
                
                $('#nav, #footer ,#dataGrid > thead').css('background','#66a1d2');
                $('#content_right, ul.dropdown ul   ').css('border-color','#66a1d2');
                
                    
            }
            }
        </script>
    </head>

    <body onload="getCookie('color_val');">
        <div id="container">
            <div id="nav">
                    <?php
                    include ('includes/nav.php');
                    ?>
                </div>
                <div id="content">
            <div id="content_left">
                <?php
                if(strstr($pagename, 'codemirror')){
                    include ('includes/menu-directory.php');
                }else{
                    include ('includes/menu.php');
                }
                
                ?>
            </div>
            <div id="content_right">
                <?php 
                    if(count($_GET)==""&&count($_POST)==""){
                ?>
                <div id="banner" class="border-radius-bottom">
                    <?php
                        echo '<h1>'.$option_global['sitename'].'</h1>';
                        //$obj->get_header_image(); 
                    ?>
                    <div style="clear:both;"></div>
                </div>
                <?php } ?>
                
                <div id="content_inner" class="border-radius-bottom">

                    <?php echo Page_finder::get_message(); ?>
                    <?php
                        include ($pagename);
                    ?>
                </div>
            </div>
            <div class="hundred">
                <div class="mask">&nbsp;</div>
                <a id="close_qr" style="position:absolute; top:5px; right:5px;" href="javascript:void(0)">[X] Close</a>
                <div class="popup-container">
                    
                </div>
            </div>
            </div>
            <div id="footer">
                
                <a href="http://www.itechnepal.com/" target="_blank">&copy; Copyright  2013 | Tayas</a>
                
            </div>

        </div>
        <div class="chat_loader">&nbsp;</div>
            <?php 
                $variable_debugger = Variable_Debugger::debug_vars(get_defined_vars());
            ?>               
    </body>
</html>
<?php
//printArray($setting_options); 
//$obj->show_query_log();
ob_end_flush();
?>