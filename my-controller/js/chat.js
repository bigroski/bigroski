$(document).ready(function(){
	$('.online_client').live('click',function(){
		var client_chat_name = $(this).html();
		var client_id = $(this).attr('name');
		var me = $('.current_online').attr('name');
		$.get('ajaxdata/chat_template.php',{'client_name':client_chat_name,'client_id':client_id,'client_me':me},
				function(r){
					$('.chat_loader').append(r);
				});
	});
});
