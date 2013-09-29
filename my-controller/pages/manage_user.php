<?php
$class = "paging";// for designers
$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$perpage = !empty($_GET['per']) ? $_GET['per'] : 10;
$sql = "SELECT * from tbl_admin WHERE id != 1";
$order = " order by id ";
$url = "?page=manage_user";
$result = $obj->PageMe($url, $order, $perpage, $sql, $class, $p); 
echo "<h2>Manage&nbsp;User</h2>";
$fieldnames = $obj->get_field_names('tbl_user_prev');
$filtered = array_slice($fieldnames, 2);

?>
<table id="dataGrid">
    <thead>
        <tr>
            <td colspan="<?php echo count($filtered)+2; ?>">All Users</td>
            <td><a href="?page=adeduser"><img src="images/add.png" /></a></td>
        </tr>
        <tr>
            <td>Username</td>
            <?php 
                
                foreach($filtered as $val){
                    
                    echo "<td>".ucfirst($val)."</td>";
                }
            ?>
            <td colspan="2" align="center">Action</td>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($result!=""){
                while($row = $obj->fetch($result[0])){
                    $adminId = $row['id'];
                    $result_prev = $obj->select('tbl_user_prev','*',array('admin_id'=>$adminId));
                    if(mysql_num_rows($result_prev)!=""){
                        $rowPrev = $obj->fetch($result_prev);
                    }
                    
                    echo '<tr>
                            <td>'.$row['username'].'</td>';
                    foreach($filtered as $v){
                        if($rowPrev[$v]==1){
                            echo '<td align="center"><img src="images/check-64.png" width="16"></td>';
                        }else{
                            echo '<td align="center"><img src="images/minus_2.png" width="16"></td>';
                        }
                    }        
                    echo '<td>
                                <a href="?page=adeduser&id='.$rowPrev['id'].'"><img src="images/pencil.png">Edit</a>
                            </td>
                            <td>
                                <a href="?fol=actpages&amp;page=deluser&id='.$rowPrev['id'].'"><img src="images/delete.png">Delete</a>
                            </td>
                          </tr>';
                    
                }
            }else{
                echo '<tr><td colspan="11">No Users Found</td></tr>';
            }
        ?>
    </tbody>
    
</table> 