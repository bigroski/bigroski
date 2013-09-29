<?php
if(isset($_POST['submit']) && !empty($_POST['submit']))
{
    $obj->table_name = "questions";
    $obj->val = array("ques"=>$_POST['poll_question']);
    $id = $obj->insert();
    $count = count($_POST['value']);
    for($i=0;$i<$count;$i++)
    {
        $poll_option = $_POST['value'][$i];
		$obj->table_name = "options";
		$obj->val = array("value"=>$poll_option,"ques_id"=>$id);
		$obj->insert();
               
    }
   
     $obj->redirect('?page=manage_poll');
 }
?>
<script type="text/javascript">
function poll_option(value)
{
    htmlString = '';
    for(i=1;i<=value;i++)
    {
            htmlString += "<fieldset style='width:150px;'><legend>Option"+i+"</legend><input type='text' class='required' style='float:left;' title='Please Enter the option' name='value[]'size='30'></fieldset><br />";
    }
    $("#poll").show();
    $("#poll").html(htmlString);
}
</script>

<?php 
	if(isset($_GET['id'])){
		$title = "<h2>Edit Poll</h2>";
//	echo "Select * from questiosn where id=".$_GET['id'];
$result = $obj->exec("Select * from questions where id=".$_GET['id']);
		$row = $obj->fetch($result);
		$url = "?page=act_adedpoll&amp;fol=actpages";
	}else{
		$title = "<h2>Add Poll</h2>";
		$url ="";
	}
	 ?>
<form name="addpoll" id="addpoll" action="<?php echo $url; ?>" method="post" enctype="multipart/form-data">
<table id="dataGrid" border="0">
  <tr>
    <td width="25%">
		<?php echo $title; ?>
	</td>
    <td width="75%">&nbsp;</td>
  </tr>
  <tr>
    <td>Poll Question </td>
    <td><textarea  name="poll_question" cols="45"  rows="3" class="required" id="poll_question" title="Please Enter the Poll Question"><?php echo $row['ques'];  ?></textarea>
    </td>
  </tr>
  <?php 
  	if($_GET['id']){
  	$result = $obj->optionsbypollId($_GET['id']);
	 while($row1= $obj->fetch($result))
  {
   ?>
	<tr>
    <td>Poll Option </td>
    
    <td>
 <input name="poll_option[]" type="text" size="30" value="<?php echo $row1['value'];?>" class="required" title="Please Enter the Poll Answer"></td>
  <input type="hidden" name="option_id[]" value="<?php echo $row1['id'];?>">
  </tr>
	<?php }}else{ ?>
  <tr>
    <td>Poll Option </td>
    <td><select name="i" onchange="poll_option(this.value)" class="required">
        <option value="">Select One</option>
    <?php for($i=1;$i<=5;$i++)
	{
	?>
	<option value= <?php echo $i?>><?php echo $i;?></option>
	<?php
	}
        ?>
    </select>    </td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
      <td>
          <div id="poll" style="display:none;">  </div>
    </td>

  </tr>
  <tr>
    <td><input type="hidden" name="id" value="<?php if(isset($_GET['id'])) echo (int)$_GET['id']; ?>" /></td>
    <td><input type="submit" name="submit" value="Submit"></td>
  </tr>
</table>
</form>
