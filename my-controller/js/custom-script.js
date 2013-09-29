//used in settings page get the selected category
    function get_selected_category(category){
        //alert(category);
        if(category=='pages'){
            var link = '?page=manage_page';
        }else if(category == 'articles'){
            var link = '?page=addcategory&type=news'
        }else if(category == 'members'){
            var link = '?page=addcategory&type=staffs'
        }else if(category == 'ad'){
        	var link = '?page=addcategory&type=ad';
        }else{
            var link = '';
        }
        $('.generated, .dymAdd').remove();
        $('select[name=category_type]').after('<a href="'+link+'" class="dymAdd"><img src="images/add.png" /></a>');
        $.ajax({
            url:'ajaxdata/get_category.php',
            data:{'find':category},
            type:'post',
            dataType:'json',
            success:function(r){
                //console.log(r);
                $('table.dhold').append('<tr class="generated"><td><b>Category Name</b></td><td colspan="2"></td></tr>');
                $.each(r, function(key,val){
                 $('table.dhold').generate_code(val);
                });
                
            }
        });
        $.fn.generate_code = function(values){
            var child = '';
            if(values.child != undefined){
                var has_subpage = '<span><a href="javascript:void(0)" class=""><img src="images/check-64.png" width="16"  alt="Yes" /></a></span>';
                $.each(values.child, function(key,v){
                 child += $(this).generate_code_child(v);
                });
            }else{
                var has_subpage = '<span><a href="javascript:void(0)"><img src="images/error.png" alt="No" width="16" /></a></span>';
                 child = '';
            }
            //$(this).append('<tr class="generated"><td>'+values.title+'</td><td>'+has_subpage+'</td></tr>'+child);
            $(this).append('<tr class="generated"><td class="changable">'+values.title+'</td><td width="25%"><a href="javascript:void(0);" onclick="edit_me(this)" class="'+values.id+'" >Edit</a></td><<td><a href="javascript:void(0);" class="'+values.id+'" onclick="delete_me(this)">Delete</a></td></tr>'+child);
            
        }
        $.fn.generate_code_child = function(va){
            //console.log(va);
            return '<tr class="generated sub"><td class="changable">'+va[1]+'</td><td width="25%"><a href="javascript:void(0);" onclick="edit_me(this)" class="'+va[0]+'" >Edit</a></td><<td><a href="javascript:void(0);" class="'+va[0].id+'" onclick="delete_me(this)">Delete</a></td><</tr>'
        }
        
    }
    function edit_me(obj){
    	
        //console.log('edit=>'+$(obj).attr('class'));
        var newName = '<div class="small-feature-box">Enter A new Name : <label><input type="text" class="'+$(obj).attr('class')+'" name="newVal" value="'+$(obj).parent('td').prev('td').html()+'"></label></div><div class="small-feature-box"><input type="button" id="submit_change" value="Submit" /></div>';
        $('.hundred').show();
        $('.popup-container').html(newName);
        
    }
    function delete_me(obj){
    	//delete selected category here
        console.log('delete=>'+$(obj).attr('class'));
    }
    $(document).ready(function(){
        $('#submit_change').live('click',function(){
        	var to = $('select[name=category_type] option:selected').val();
        	if(to=='pages'){
        		alert('This Feature is under Development.');
        	}else{
        		var change_to = $('input[name=newVal]').val();
	            var id = $('input[name=newVal]').attr('class');
	            $.ajax({
	                url:'ajaxdata/change_category_name.php',
	                data:{'id':id,'change_to':change_to,'to':to},
	                type:'post',
	                dataType:'json',
	                success:function(r){
	                    if(r.status==1){
	                        $('.'+id).parent('td').prev('td.changable').html(change_to);
	                    }else{
	                        alert('Error!! Cannot rename Category');
	                    }
	                    $('.hundred').hide();
	                }
	            });
        	}
        	
        });
        //site feature setting 
        $('input[name=sub_btn]').live('click',function(){
            var makeChanges = $('form#site_settings').serialize();
            $.ajax({
                url:'ajaxdata/change_site_features.php',
                data:{'string_data':makeChanges},
                type:'post',
                dataType:'json',
                success:function(r){
                    if(r.status=1){
                        location.reload();
                    }else{
                        alert('unable to preform request');
                    }
                }
                
            });
        });
        $('#site_features').click(function(){
            //alert(1);
            $.get('ajaxdata/getfeatures.php',
                function(r){
                    $('.hundred').show();
                    $('.popup-container').html(r);
                    //alert(r);
                }    
             );
        });
    });
