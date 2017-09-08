<?php
 require 'header.php';
 include 'chat_box.php';
 check_login();

 ?>

<div class="notifications_page">
  <div class="panel panel-default">
  <h2>Notifications</h2>
  <?php  $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
   $notf_query = "SELECT * FROM `notification` WHERE `parent_id` = $me AND `notf_read` = 0 ORDER BY `notf_id` DESC;";
   $notf_result = mysqli_query($conn, $notf_query);
   $notf_row = mysqli_fetch_all($notf_result);
   $notf_arr = mysqli_fetch_array($notf_result);
  //  for each row
   foreach ($notf_row as $notf_row => $value) {
    //  friend request
     if ($value[3] == 1) :?>
     <?php
      $query = "SELECT * FROM `users` WHERE `user_id` = $value[2];";
      $result = mysqli_query($conn, $query);
      $result_arr = mysqli_fetch_array($result);
      ?>
   <div class="notification container-fluid">
       <i class="fa fa-flag" aria-hidden="true"></i>
       <h5><?php echo $result_arr['user_nick']; ?> Sent a friend request!</h5>
       <span class="btn btn-success">Accept</span>  <span class="btn btn-danger">Decline</span>
   </div>
     <?php endif;}?>
<hr />
</div>
</div>

 <?php
 require 'footer.php';
 ?>
