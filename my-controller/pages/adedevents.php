<script type="text/javascript">
$(document).ready(function(){
	var validator = $("#addnews").validate({
		rules: {
			title: 'required',
			date:{
				required: true,
				date: true
				},
			shortdesc:{
				required: true,
				maxlength: 255
				}
			},
		messages: {
			title: "Please Enter Event Title",
			date: "Please Select Date",
			shortdesc:{
				required: "Please Enter Short Description",
				maxlength: "Characters Limit Exceeded"
				}
			},
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}
		
		})
	});
</script>

<script type="text/javascript">
<!--
function check_length(adednews)
{
maxLen = 255; // max number of characters allowed
if (adednews.shortdesc.value.length >= maxLen) {
// Alert message if maximum limit is reached.
// If required Alert can be removed.
var msg = "You have reached your maximum limit of characters allowed";
alert(msg);
// Reached the Maximum length so trim the textarea
adednews.shortdesc.value = adednews.shortdesc.value.substring(0, maxLen);
}
else{ // Maximum length not reached so update the value of my_text counter
adednews.text_num.value = maxLen - adednews.shortdesc.value.length;}
}
//-->
</script>
<?php  

if(isset($_GET['id'])){
$action = "edit"; 
$id = $_GET['id'];		
$result = $obj->select(EVENT_TBL,'*',array("id"=>$id));	   
if(mysql_num_rows($result)!=""){
$row = $obj->fetch($result);
}else{
	$obj->redirect('index.php');
}
}else{
 $action = "add";	
}
?>
<form method="post" enctype="multipart/form-data" action="index.php?page=act_adedevents&amp;fol=actpages" id="addnews">
<table id="dataGrid" cellspacing="0">
<tr>
			<td>Date : </td>
			<td><input id="datepicker" name="date" readonly="readonly" class="bordered required" value="<?php if(isset($row)) echo stripslashes($row['posted_on']); ?>"/></td>
		</tr>
<tr>
<td>Title</td>
<td><input type="text" name="title" class="bordered required" id="title" value="<?php if(isset($row)) echo stripslashes($row['title']); ?>"/></td>
</tr>

<tr>
<td>Short Description</td>

<td><textarea name="shortdesc" cols="30" rows="10" class="bordered" onKeyPress="check_length(this.form);" onKeyDown="check_length(this.form);"><?php if(isset($row)) echo stripslashes($row['shortdesc']); ?></textarea>
<input size=1 value=255 name="text_num" style="width:50px;"> Characters Left</td>
</tr>
<tr>
<td>Description</td>
<td width="800"><textarea id="description" name="description"><?php if(isset($row)) echo html_entity_decode(stripslashes($row['description'])); ?></textarea>
<script type="text/javascript">
	CKEDITOR.replace( 'description',{
		toolbar : 'MyToolbar' ,
		 filebrowserBrowseUrl : 'http://<?php echo SITE_URL; ?>admin/ckfinder/ckfinder.html',
        filebrowserUploadUrl : 'http://<?php echo SITE_URL; ?>admin/ckfinder/userfiles/'
	} );
</script></td>
</tr>


<tr>
<td>
<?php 
	if(isset($_GET['id'])&&$_GET['id']!=""){
		echo '<input type="hidden" name="id" value="'.(int)$_GET['id'].'">';
		echo '<input type="hidden" name="action" value="'.$action.'">';
	}
?>
</td>
<td><input type="submit" name="submit" class="btn" value="Submit"></td>
</tr>
</table>
</form>