<?php  
include ("../../classes/application_top.php");

if(isset($_POST['news_id'])){
$id = $_POST['news_id'];
$status = $_POST['value'];
  //echo "    update tbl_staff set s_order = '$s_order' where id = '$id'";
  //echo "update tbl_news set status = '$status' where id = '$id'";
mysql_query("update tbl_news set status = '$status' where id = '$id'");
echo json_encode(array("status"=>1));

}elseif(isset($_POST['img_id'])){
$id = $_POST['img_id'];
$status = $_POST['value'];
  //echo "    update tbl_staff set s_order = '$s_order' where id = '$id'";
  //echo "update tbl_news set status = '$status' where id = '$id'";
  $res = mysql_query("select * from tbl_images where id = '$id'");
  if(mysql_num_rows($res)!=""){
      $row = mysql_fetch_array($res);
      if($status==1){
          mysql_query("update tbl_images set isprimary='0' WHERE type='".$row['type']."'");
      }
  }
mysql_query("update tbl_images set isprimary = '$status' where id = '$id'");
echo json_encode(array("status"=>1));

}elseif(isset($_POST['featured_id'])){
$id = $_POST['featured_id'];
$status = $_POST['value'];
  //echo "    update tbl_staff set s_order = '$s_order' where id = '$id'";
  //echo "update tbl_news set status = '$status' where id = '$id'";
mysql_query("update tbl_news set featured = '$status' where id = '$id'");
echo json_encode(array("status"=>1));

}elseif(isset($_POST['h_mp3_id'])){
$id = $_POST['h_mp3_id'];
$status = $_POST['value'];
  //echo "    update tbl_staff set s_order = '$s_order' where id = '$id'";
  //echo "update tbl_news set status = '$status' where id = '$id'";
mysql_query("update tbl_resource set hot = '$status' where r_id = '$id'");
echo json_encode(array("status"=>1));

}elseif(isset($_POST['f_mp3_id'])){
$id = $_POST['f_mp3_id'];
$status = $_POST['value'];
  //echo "    update tbl_staff set s_order = '$s_order' where id = '$id'";
  //echo "update tbl_news set status = '$status' where id = '$id'";
mysql_query("update tbl_resource set featured = '$status' where r_id = '$id'");
echo json_encode(array("status"=>1));

}elseif(isset($_POST['message_id'])){
$id = $_POST['message_id'];
$status = $_POST['value'];
  //echo "    update tbl_staff set s_order = '$s_order' where id = '$id'";
  //echo "update tbl_news set status = '$status' where id = '$id'";
mysql_query("update tbl_message set status = '$status' where id = '$id'");
echo json_encode(array("status"=>1));

}
elseif(isset($_POST['ad_id'])){
$id = $_POST['ad_id'];
$status = $_POST['value'];
  //echo "    update tbl_staff set s_order = '$s_order' where id = '$id'";
  //echo "update tbl_news set status = '$status' where id = '$id'";
mysql_query("update tbl_advertisement set display = '$status' where id = '$id'");
echo json_encode(array("status"=>1));

}
?>