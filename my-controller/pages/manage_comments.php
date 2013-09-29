<?php 
        $class = "paging";// for designers
        $p = !empty($_GET['p']) ? $_GET['p'] : 1;
        $perpage = !empty($_GET['per']) ? $_GET['per'] : 10;
        $sql = "SELECT * from tbl_newscomment where status=0";
        $order = " order by posted_on desc";
        $url = "?page=manage_comment";
        $result = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
        //$obj->printArray(gd_info());
?>
<script>
function changeStatus(rowId, status){
    //alert(rowId+'------'+status);
    $.ajax({
       url:"actpages/commentStat.php",
       data:{'rowId':rowId,"status":status},
       dataType:'json',
       type:'post',
       success:function(data){
           if(data.status==1){
               location.reload();
           }
           
       } 
       
    });
}
    $(document).ready(function(){
        $('.popupcontent').hide();
            $('.linker').hover(function() {
                $(this).find('.popupcontent').show();
            }, function() {
                $(this).find('.popupcontent').hide();
            });
        });
</script>
<h1>New Comments</h1>
<table id="dataGrid">
    <thead>
        <tr>
            <td colspan="2"></td>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($result!=""){
                while($rowComment = $obj->fetch($result[0])){
                    $newsId = $rowComment['news_id'];
                    $resultNews = $obj->select(NEWS_TBL,array("id","title"),array("id"=>$newsId));
                    if(mysql_num_rows($resultNews)!=""){
                        $rowNews = $obj->fetch($resultNews);
                        echo '<tr style="position:relative;">
                                <td class="linker" >'.stripslashes($rowNews['title']).'
                                    <div class="popupcontent">
                                        <div class="newscontent">
                                        <b>Sender:</b> '.stripslashes($rowComment['posted_by']).'<br />
                                            <b>Email:</b>  '.stripslashes($rowComment['email']).'<br />
                                            <b>Date:</b>   '.$rowComment['date'].'<br />
                                            <b>Comment:</b><br />
                                            '.stripslashes($rowComment['message']).'
                                        </div>
                                    </div>
                                </td>
                                <td><select name="status" onchange="changeStatus('.$rowComment['id'].',+this.value)"><option value="0">Not Processed</option><option value="1">Processed</option><option value="2">Cancelled</option></select></td>
                              </tr>';
                    }
                }
            }else{
                echo "No Comments Found";
            }
        ?>
        
    </tbody>
    
</table>
