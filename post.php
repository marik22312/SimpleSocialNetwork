<?php
require ("header.php");
if (!isset($_GET['id'])) {
  die(header("location: index.php"));
} else {
  $post_id = $_GET['id'];
}?>

<?php
  //open connection
    $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);

    //get post content
    $post_query = " SELECT * FROM posts WHERE post_id = '$post_id';";
    $post_result = mysqli_query($conn, $post_query);
    $post = mysqli_fetch_array($post_result);
    $writer_id = $post['post_writer_id'];
    //get post writer
    $writer_query = "SELECT * FROM users WHERE user_id = '$writer_id';";
    $writer_result = mysqli_query($conn, $writer_query);
    $writer = mysqli_fetch_array($writer_result);

    mysqli_close($conn);
    ?>



<div style="margin-top: 100px;">

<div class="post">
<div class="panel panel-default">
<a href="profile.php?id=<?php echo $writer_id; ?>"><img src="<?php echo profile_avatar($writer_id); ?>" alt="profile pic" width="82px" height="82px"/></a>
<h4><a href="profile.php?id=<?php echo $writer_id;?>"><?php echo $writer['user_nick'];?></a></h4>
<span class="post_time"><a href="#"><?php echo $post['post_time']; ?></span></a>
<p class="post_content">"<?php echo nl2br($post['post_content']); ?>"</span></p>
</div>
</div>
</div>
<?php require 'footer.php'; ?>
