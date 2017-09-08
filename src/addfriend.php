<?php
require 'db_cfg.php';
$user_id = $user_ID_array['user_id'];
$profile_id = $_POST['profile_id'];
$conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
$query = " INSERT INTO `relationship` (`user_one_id`, `user_two_id`, `status`, `action_user_id`) VALUES ('$user_id', $profile_id, 0, 1)";
  mysqli_query($conn, $query);
  ?>
