<?php
if(isset($_POST['submit']) && $_POST['submit'])
{
  $id = $_POST['id'];
  $obj->table_name = "questions";
  $obj->val = array("ques"=>$_POST['poll_question']);
  $obj->cond = array("id"=>$id);
  $obj->update();
  $option_id = $_POST['option_id'];
  foreach($option_id as $key=>$val)
  {
      $poll_option = stripslashes($_POST['poll_option'][$key]);
      $obj->table_name = "options";
      $obj->val = array("value"=>$poll_option);
      $obj->cond = array("id"=>$val);
      $obj->update();
  }
  Page_finder::set_message('A Poll has been edited.');  
  $obj->redirect("?page=manage_poll");
}
?>
