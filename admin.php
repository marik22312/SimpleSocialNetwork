<?php
require ('header.php');
  require 'chat_box.php';
check_login();

 if (check_login() === TRUE):
$conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);
//Get statistics
$users="SELECT * FROM users ";

if ($users_result=mysqli_query($conn,$users))
  {
  // Return the number of rows in result set
  $user_count=mysqli_num_rows($users_result);
  $user_row = mysqli_fetch_array($users_result);
}

  //Get Posts
  $posts="SELECT post_id FROM posts ";

  if ($posts_result=mysqli_query($conn,$posts))
    {
    // Return the number of rows in result set
    $post_count=mysqli_num_rows($posts_result);}
   ?>
 <div class="container">
   <div class="panel panel-default">
     <div class="panel-heading">
       <h3 class="panel-title">Statistics</h3>
     </div>
     <div class="panel-body">
       <h2>Number of registered users: <?php echo $user_count;?></h2>
       <h2>Number of Posts: <?php echo $post_count;?></h2>
     </div>
   </div>

   <!-- Grant admin premission -->
   <?php
     //open connection
    $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
     $admin_query = " SELECT * FROM users WHERE sc_admin = '0';";
     $admin_result = mysqli_query($conn, $admin_query);

     $admin_fetch = mysqli_fetch_all($admin_result);


       mysqli_close($conn);
       ?>
   <div class="panel panel-default grant">
     <div class="panel-heading">
       <h3 class="panel-title">Grant Admin Premission</h3>
     </div>
     <div class="panel-body">
       <form class="form-inline" action="admin.php" method="POST">
  <div class="form-group">
    <label class="sr-only" for="exampleInputAmount">Select User</label>
    <div class="input-group">
      <div class="input-group-addon">@</div>
      <input list="browsers" name="user">
       <datalist id="browsers">
         <?php foreach ($admin_fetch as $admin_fetch => $value) :?>
           <option value="<?php echo $value[1]; ?>"></option>
         <?php endforeach; ?>
       </datalist>
    </div>
    <?php if (isset($_POST['user'])) {
      $g_admin = $_POST['user'];
      //connect to DB
      $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
      //set admin
      $g_admin_query = "UPDATE `users` SET `sc_admin` = '1' WHERE `users`.`user_nick` = '$g_admin';";
      $g_admin_result = mysqli_query($conn, $g_admin_query);
        if ($g_admin_result) {
          echo "Succsess!";
        }
      }?>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

     </div>
   </div>

<?php else: header("location: index.php") ?>
<?php endif; ?>

<div class="footer_admin footer">
	<div class="footer-container">
		<div class="footer-links">
			<span>
			<a href="#" >Terms of Use</a>
			</span>
			<span><a href="#">&nbsp;Privacy Policy</a></span>
			<span><a href="#">&nbsp;Disclaimer</a></span>
			<span><a href="#">&nbsp;Developers</a></span>
			<span><a href="#">&nbsp;Contact</a></span>
			<span><a href="#">&nbsp;About</a></span>
		</div>
			Copyright &copy; 2000 - <?php echo date("Y"); ?>
	</div>
</div>
<!-- custom JS -->
<script type="src/text/javascript" src="src/script.js"></script>
<script src="src/addons/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="src/addons/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="src/js/index.js"></script>
</body>
</html>
