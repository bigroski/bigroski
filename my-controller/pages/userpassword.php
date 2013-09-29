<?php 
    if(isset($_POST['btn_submit'])&&$_POST['btn_submit']!=""){
        $password = mysql_real_escape_string($_POST['pass']);
        $repass = mysql_real_escape_string($_POST['repass']);
        if($password==$repass){
            $result_find = $obj->select('tbl_admin',array('password','salt'),array('id'=>(int)$_POST['id']));
            if(mysql_num_rows($result_find)!=""){
                $rowFind = $obj->fetch($result_find);
                $user_obj->salt = $rowFind['salt'];
                $user_obj->change_admin_password((int)$_POST['id'],NULL,$password);
                $msg = "Password successfully Changed";
                $url = "?page=manage_user";
                $obj->alert($msg,$url);
            }else{
                $msg = "The Password Could not be changed.";
                $url = "?page=userpassword&userId=".$_POST['id'];
                $obj->alert($msg, $url);
            }
        }else{
            $msg = "Password not Match Please reenter password.";
            $url = "?page=userpassword&userId=".$_POST['id'];
            $obj->alert($msg, $url);
        }
        
        
    }
    if(isset($_GET['userId'])&&$_GET['userId']!=""){
        $userId = (int)$_GET['userId'];
        $resultUser = $obj->select("tbl_admin",'*',array("id"=>$userId));
        if(mysql_num_rows($resultUser)!=""){
            $rowUser = $obj->fetch($resultUser);
            
        }else{
            $obj->redirect("index.php");
        }
    }else{
        $obj->redirect("index.php");
    }
    echo '<h2>Change Password for &raquo; '.stripslashes($rowUser['username']).'</h2>';
?>
<form id="userForm" method="post" action="">
    <table id="dataGrid" width="70%">
        <tr>
            <td width="20%">Enter Password</td>
            <td >
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
            <tr><td><input type="hidden" name="id" value="<?php echo $userId ?>" /></td><td><input type="submit" value="submit" name="btn_submit" /></td></tr>
    </table>
</form>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {


        var validator = $("#userForm").validate({//validate form
            rules : {
               
                pass: 'required',
                repass : {
                    required : true,
                    equalTo : '#password'
                }
                

            },
            messages : {
                
                pass : 'Please Enter your password',
                repass: {
                    required: 'Please re-enter your password',
                    equalTo: 'Password Not Match'
                }
                

            },
            success : function(label) {
                // set &nbsp; as text for IE
                label.html("&nbsp;").addClass("checked");
            }
        })
    }); 
</script>
