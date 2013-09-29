$().ready(function() {
$("#addaid").validate();
$("#chngpass").validate({
		rules: {
			
			oldpass: "required",
			newpass: {
				required: true,
				minlength: 5
			},
			conpass: {
				required: true,
				minlength: 5,
				equalTo: "#newpass"
			},
			
		},
		messages: {
			oldpass: "Please enter  Old Password",
			newpass: {
			required: "Please provide a password",
			minlength: "Your password must be at least 5 characters long"
			},
			conpass: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			
			
		}
	});
$("#addpfile").validate();
$("#addgallery").validate();
$("#addimage").validate();
$("#addnews").validate();
$("#addslider").validate();
$("#addsubpage").validate();
$("#editaid").validate();
$("#editnews").validate();
$("#editslider").validate();
$("#add_video").validate();
$("#docform").validate();
$("#audform").validate();
$("#prgform").validate();
$("#newsform").validate();
$("#staffform").validate();

});
