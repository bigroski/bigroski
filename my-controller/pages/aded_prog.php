<?php  
$title = $obj->getResourceType($_GET['type']);
    echo "<h2>".ucfirst($_GET['action'])."&nbsp;".$title['category']."</h2>";
if($_GET['action']=="edit"){
    $action = "edit";
    $row = $obj->getResource($_GET['id']);
}else{
    $action = "add";
}

?>
<form method="post" enctype="multipart/form-data" action="index.php?fol=actpages&amp;page=act_adedaudioprog&from=<?php echo $_GET['type']; ?>" name="docform" id="docform">
<table id="dataGrid">
<tr>
<td>Title</td>
<td><input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" class="required" title="Enter title"/></td>
</tr>
<tr>
<td>Short Description</td>
<td><textarea name="shortdesc" cols="30" rows="10"><?php echo $row['shortdesc']; ?></textarea></td>
</tr>
<tr>
<td></td>
<td style="color:#FF0000;">Select An MP3 File. </td>
</tr>
<tr>
<td>Select File</td>
<td><input type="file" name="file" accept="mp3" title="Only Mp3 Format Accepted" value=""></td>
</tr>
<?php 
    if(isset($row)&&$row['file']!=""){
        echo '<tr>
                <td>Current Song</td>
                <td>'.$row['file'].'</td></tr>';
    }
?>
<tr>
    <td>
    Select Category:
</td>
<td>
<?php
    $result_audioCat = $obj->select('tbl_resource_sub_cat',array('id','title'),array('type'=>1));
    if(mysql_num_rows($result_audioCat)!=""){
        echo '<select name="subtype">';
        while($row_audioCat  =  $obj->fetch($result_audioCat)){
            echo '<option value="'.$row_audioCat['id'].'" '.((isset($row)&&$row['sub_type']==$row_audioCat['id'])?'selected="selected"':'').'>'.$row_audioCat['title'].'</option>';
        }
        echo '</select>';
    }
?>
</td>
</tr>
<!---->

<tr>
<td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"><input type="hidden" name="action" value="<?php echo $action; ?>"><input type="hidden" name="type" value="<?php echo $_GET['type']; ?>"></td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>