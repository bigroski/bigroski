<?php
if (isset($_GET['id']) && (int)$_GET['id'] != "") {
    $action = "edit";
    $id = (int)$_GET['id'];
    $resultUserInfo = $obj->select("tbl_user_prev",'*',array("id"=>$id));
    if(mysql_num_rows($resultUserInfo)!=""){
        $row = $obj->fetch($resultUserInfo);
        $resultAdmin = $obj->select("tbl_admin",'*',array("id"=>$row['admin_id']));
        if(mysql_num_rows($resultAdmin)!=""){
            $rowAdmin = $obj->fetch($resultAdmin);
        }else{
            $obj->alert("user Not Found","?page=mange_user");
        }
    }else{
        $obj->alert("User Not Found","?page=manage_user");
    }
} else {
    $action = "add";
}
echo '<h2>' . ucfirst($action) . ' User</h2>';
?>
<form id="userForm" method="post" action="?fol=actpages&amp;page=act_adeduser">
    <table id="dataGrid" width="70%">
        <tr>
            <td>Enter Username</td>
            <td>
            <input type="text" name="username"  <?php if(isset($rowAdmin)) echo 'value="'.stripslashes($rowAdmin['username']).'" disabled="disabled"' ?>/>
            </td>
        </tr>
        <tr>
            <td>Enter Email </td>
            <td><input type="text" name="email" value="<?php if(isset($row)) echo $rowAdmin['email'] ?>" /></td>
        </tr>
        
        <?php 
            if(!is_array($row)){
        ?>
        <tr>
            <td>Enter Password</td>
            <td>
                <div style="position: relative;">
            <input type="password" name="pass" id="password" />
                <div class="progress red">
                                                <span class="bar" style="width:0%"></span>
                                                <small class="feedback"></small>
                </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Re-enter Password</td>
            <td><input type="password" name="repass"  /></td>
            </tr>
            <?php }else{
                echo "<tr><td></td><td><a href=\"?page=userpassword&userId=".$row['admin_id']."\">click here to change Only Password</a></td></tr>";
            } ?>
        <?php 
            $fieldnames = $obj->get_field_names('tbl_user_prev');
            $filtered = array_slice($fieldnames, 2);
            foreach($filtered as $v){
                echo '<tr>
            <td>'.ucfirst($v).'</td>
            <td>
                <select name="'.$v.'">
                    <option value="0">No</option>
                    <option value="1".'.((isset($row)&&$row[$v]==1)? " selected=\"selected\"":'').'>Yes</option>
                </select>
            </td>
            </tr>';
            }
        ?>
        
        <tr>
            <td><?php 
                    if(isset($row)&&is_array($row)){
                        echo '<input type="hidden" name="id" value="'.$id.'" />'; 
                        
                    }
                ?>
            </td>
            <td>
                <input type="submit" name="btn_submit" value="Submit" />
            </td>

        </tr>
    </table>

</form>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {


		var validator = $("#userForm").validate({//validate form
			rules : {
				user : 'required',
				username : 'required',
				<?php 
				    if(!is_array($row)){
				?>
				pass: 'required',
				repass : {
					required : true,
					equalTo : '#password'
				}
				<?php } ?>

			},
			messages : {
				user : "Enter Full Name of the User",
				username : "Enter Your Username",
				<?php 
				    if(!is_array($row)){
				?>
				pass : 'Please Enter your password',
				repass: {
				    required: 'Please re-enter your password',
				    equalTo: 'Password Not Match'
				}
				<?php } ?>

			},
			success : function(label) {
				// set &nbsp; as text for IE
				label.html("&nbsp;").addClass("checked");
			}
		})
	}); 
</script>