<?php
require ('header.php');
include 'chat_box.php';
check_login();
$me = $user_ID_array['user_id'];
if (isset($_GET['id'])) {
  $profile_id = $_GET['id'];
  $postID = getProfPostID($profile_id);
  // $friendid = showfriends($profile_id);
  if (profile_exist($profile_id) === FALSE) {
    header("location: index.php");
  }
}

/* check if friends */
$conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
if ($me < $profile_id) {
  $query = " SELECT * FROM relationship WHERE user_one_id = '$me' AND user_two_id = '$profile_id' LIMIT 1;";
} else {
  $query = " SELECT * FROM relationship WHERE user_one_id = '$profile_id' AND user_two_id = '$me' LIMIT 1;";
}


   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


      $count = mysqli_num_rows($result);
      // if users are friends, count will be 1

      /*end of check if friends */
 ?>

 <?php
 // post submition
    if (isset($_POST['new_post'])) {
      $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
      $content = $_POST['new_post'];
      $contentQ = "INSERT INTO `posts` (`post_id`, `post_writer_id`, `post_content`, `post_time`) VALUES (NULL, '$me', '$content', CURRENT_TIMESTAMP);";
      mysqli_query($conn, $contentQ);
      mysqli_close($conn);
    }
  ?>
 <div class="container-fluid">

<div class="panel panel-default">
 <div class="profile">

      <img src="<?php echo profile_avatar($profile_id); ?>" alt="profile pic" width="170px" height="170px">
      <h1><?php echo profile_nick($profile_id); ?></h1>
      <h2 class="profile_motto">"<?php echo profile_motto($profile_id); ?>"</h2>
      <?php if (check_login() === TRUE): ?>
        <?php if ($profile_id != $user_ID_array['user_id']): ?>
          <!-- if users are friends -->
          <?php if ($count == 1): ?>
          <a href="<?php echo "profile.php?id=$profile_id&action=unfriend"; ?>" class="btn btn-danger">Unfriend</a>
          <?php else: ?>
            <!-- if not -->
            <a href="<?php echo "profile.php?id=$profile_id&action=addfriend"; ?>" class="btn btn-success">Add friend</a>

          <?php endif; ?>
          <a class="btn btn-primary">Send message</a>
        <?php endif; ?>

      <?php endif; ?>
</div>
</div>

<!-- New post submition -->
<?php if ($me == $profile_id): ?>
  <div class="new_post">
    <form action="#" method="post">
      <h4 class="new_post_title">Upload a new post</h4><br />
      <textarea required type="text" name="new_post" rows="6" cols="90" placeholder="Write a post"></textarea><br />
      <input type="submit" value="send new post">

    </form>
  </div>
<?php endif; ?>

<!-- added friends bar on profile 10/05 - 01:00 -->
<?php $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
$friends_query = " SELECT * FROM `relationship` WHERE (`user_one_id` = '$profile_id' OR `user_two_id` = '$profile_id') AND `status` = 1";
$friends_result = mysqli_query($conn, $friends_query);

$friends = mysqli_fetch_row($friends_result);
$friend_limiter = 0;?>


        <?php foreach ($friends as $friends => $friends_value) :?>
          <div class="friends">
            <div class="panel panel-default" id="friendspanel">
          <img src="<?php echo profile_avatar(1); ?>" alt="friend profile pic" width="60px" height="60px"/>
          <h6>friend's name</h6>
        </div>
        </div>
      <?php endforeach; ?>

        <?php    $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
    $profile_post_query = " SELECT * FROM posts WHERE post_writer_id = '$profile_id' ORDER BY `post_time` DESC;";
    $profile_post_result = mysqli_query($conn, $profile_post_query);

     $profile_post = mysqli_fetch_all($profile_post_result);?>
      <?php foreach ($profile_post as $profile_post => $value) :?>
<div class="post">
  <div class="panel panel-default">
  <a href="#"><img src="<?php echo profile_avatar($profile_id); ?>" alt="profile pic" width="82px" height="82px"/></a>
  <h4><?php echo   profile_nick($profile_id); ?></h4>
  <span class="post_time"><a href="post.php?id=<?php echo $value[0];?>"><?php echo "$value[3]"; ?></span></a>
  <p class="post_content"><?php echo nl2br("$value[2]"); ?></span></p>
</div>
</div>
<?php endforeach; ?>

</div>


<!-- Friend request -->
<?php if (isset($_GET['action'])) {
  $action = $_GET['action'];
  $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
  switch ($action) {
    case 'addfriend':
      if ($me < $profile_id) {
        $friend_query = "INSERT INTO `relationship` (`user_one_id`, `user_two_id`, `status`, `action_user_id`) VALUES ($me, $profile_id, 0, $me);";
      } else {
        $friend_query = "INSERT INTO `relationship` (`user_one_id`, `user_two_id`, `status`, `action_user_id`) VALUES ($profile_id, $me, 0, $me);";
      }
      $notf_query = "INSERT INTO `notification` (`notf_id`, `parent_id`, `actor_id`, `notf_type`, `notf_read`) VALUES (NULL, $profile_id, $me, '1', '0');";
      mysqli_query($conn, $friend_query);
      mysqli_query($conn, $notf_query);
      mysqli_close($conn);

      break;

      case 'unfriend':
        if ($me < $profile_id) {
        $friend_query = "DELETE FROM `relationship` WHERE `relationship`.`user_one_id` = $me AND `relationship`.`user_two_id` = $profile_id";
      } else {
        $friend_query = "DELETE FROM `relationship` WHERE `relationship`.`user_one_id` = $profile_id AND `relationship`.`user_two_id` = $me";
      }
      mysqli_query($conn, $friend_query);
      mysqli_close($conn);

        break;

    default:
      echo "error";
      break;
  }
} ?>
<?php
require ('footer.php');
 ?>
