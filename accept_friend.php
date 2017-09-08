<?php
  require ('src/db_cfg.php');

  if (!check_login()) {
    die(header("Location: index.php"));
  } else {
    $me = $user_ID_array['user_id'];
    $other = $_GET['id'];
      $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
      if ($me < $other) {
$af_query = "UPDATE `relationship` SET `status` = 1, `action_user_id` = $other WHERE `user_one_id` = $me AND `user_two_id` = $other";
      } else {
        $af_query = "UPDATE `relationship` SET `status` = 1, `action_user_id` = $other WHERE `user_one_id` = $other AND `user_two_id` = $me";
      }
      $notf_query = "UPDATE `notification` SET `notf_read` = '1' WHERE `notification`.`notf_id` = 5;";
     $af_result = mysqli_query($conn, $af_query);
     echo "Friend accepted!";
  }

 ?>
