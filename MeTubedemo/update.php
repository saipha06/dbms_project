<?php
session_start();

include_once "function.php";
?>

<head>
<title>Profile</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="default.css" />
</head>

<body style = "background-image:url(img/bg.png) !important; color:white !important; ">
<div class="navbar navbar-expand-lg bg-danger">
<a class="active logo" href="browse.php"><img src="img/metube.png" width="85" height="40" alt="logo"></a>
  <?php
	if (! empty($_SESSION['logged_in']))
	{
  		echo "<a class = 'btn' style = 'margin-left:80%; color:white;' href='logout.php'>Logout <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-box-arrow-right' viewBox='0 0 16 16'>
		  <path fill-rule='evenodd' d='M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z'/>
		  <path fill-rule='evenodd' d='M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z'/>
		</svg></a>";
  		
	}
	else {
		echo"<a href='index.php'>Login</a>";
		echo"<a href='register.php'>Register</a>";
	}
  ?>
</div>
</body>

<?php

	$_susername = $_SESSION['username'];
	$query = "select * from users where username='$_susername'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_row($result);
	$_semail = $row[2];
	$_spassword = $row[1];

if(isset($_POST['submit'])) {
	if($_POST['email'] == "") {
		$update_error = "Please fill in email field.";
	}
	else {
		$email = $_POST['email'];
		$old_password = $_POST['old_password'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  		$update_error = "Invalid email format";
		}
		else {
			if($_POST['new_password'] != "") {
				$new_password = $_POST['new_password'];
				$confirm_new_password = $_POST['confirm_new_password'];

				if($old_password != $_spassword) {
					$update_error = "Old password is not correct.";
				}
				else {
					if($new_password != $confirm_new_password){
						$update_error = "New passwords do not match.";
					}
					else {
						$query = "UPDATE users SET email='$email', password='$new_password' WHERE username='$_susername'";
						$result = mysqli_query($con, $query);

						if($result){
							$smsg = "User Updated Successfully";
						}
						else {
							$fmsg = "User Update Failed".mysqli_error($con);
						}
					}
				}
			}
			else {
				if($old_password != $_spassword) {
					$update_error = "Old password is not correct.";
				}
				else {
					$query = "UPDATE users SET email='$email' WHERE username='$_susername'";
					$result = mysqli_query($con, $query);

					if($result){
						$smsg = "User Updated Successfully";
					}
					else {
						$fmsg = "User Update Failed".mysqli_error($con);
					}
				}
			}
		}
	}
}
  if(isset($update_error))
   {  echo "<div><h2>".$update_error."</h2></div>";}


if(isset($_POST['delete_contact'])) {
	$_susername = $_SESSION['username'];
	$delusername = $_POST['delete_contact'];
	$res = mysqli_query($con, "SELECT conversationID FROM conversations WHERE (userA='$_susername' AND userB='$delusername') OR (userB='$_susername' AND userA='$delusername')");
	$convIDrow = mysqli_fetch_row($res);
	$convID_del = (int)$convIDrow[0];
	$query = "SELECT id FROM users WHERE username='$_susername'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_row($result);
	$userid = (int)$row[0];
	$query = "SELECT id FROM users WHERE username='$delusername'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_row($result);
	$contactid = (int)$row[0];

	$sql = "DELETE FROM conversations WHERE conversationID='$convID_del'";
	$res = mysqli_query($con,$sql);
	if(!$res){
		echo mysqli_error($con);
	}
	$sql = "DELETE FROM messages WHERE convID='$convID_del'";
	$res = mysqli_query($con,$sql);
	if(!$res){
		echo mysqli_error($con);
	}
	$sql = "DELETE FROM user_contact WHERE userid='$userid' AND contactid='$contactid'";
	$res = mysqli_query($con,$sql);
	if(!$res){
		echo mysqli_error($con);
	}
	$sql = "DELETE FROM user_contact WHERE contactid='$userid' AND userid='$contactid'";
	$res = mysqli_query($con,$sql);
	if(!$res){
		echo mysqli_error($con);
	}
}

?>
<br><br><br>
<div class="card  w-50" style = "color:black; margin-left:25%">
  <div class="card-header">
    Update Profile
  </div>
  <div class="card-body">
  <?php if(isset($smsg)){ ?><div role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
  <form  method="POST" action="<?php echo "update.php"; ?>">
  
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="name" class="form-control" id="disabledInput" disabled = "True" aria-describedby="emailHelp" value = "<?php echo $_SESSION['username']; ?>"> 
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" aria-describedby="emailHelp" name="email" maxlength="20" value="<?php echo $_semail; ?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" >Old Password</label>
    <input type="password" class="form-control" name="old_password" maxlength="15" value="<?php echo $_spassword; ?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label"> New Password</label>
    <input type="password" class="form-control"  name="new_password" maxlength="15">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label"> Confirm New Password</label>
    <input type="password" class="form-control"  name="confirm_new_password" maxlength="15">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary "style = "margin-left:43%">Submit</button>
</form>
  </div>

</div>


<div class="my_contacts">
	<?php
		echo "<h3 style = 'padding-left:3%; margin-top:5%;'>Contacts</h3>";
		$query = "SELECT id FROM users WHERE username='$_susername'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_row($result);
		$userid = $row[0];

		$query = "SELECT username, email, priority FROM users INNER JOIN user_contact ON users.id = user_contact.contactid WHERE user_contact.userid='$userid' ORDER BY priority";
		$result = mysqli_query($con, $query);

		if(!$result){
			echo "fail";
		}
		else {
	?>
		<table class = "table" style=";color:white;">
			<thead>
			<tr>
				<th scope="col" style = "padding-left:4%">Username</th>
				<th scope="col">Email</th>
				<th scope="col">Relation</th>
				<th scope="col">Message</th>
			</tr>
		</thead>
		<?php
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
		?>
			<?php
				$conv_query = "SELECT conversationID FROM conversations WHERE (userA='$_susername' AND userB='$row[0]') OR (userB='$_susername' AND userA='$row[0]')";
				$conv_result = mysqli_query($con, $conv_query);
				$conv_row = mysqli_fetch_row($conv_result);
				$convid = $conv_row[0];
			?>

			<tr>
				<td><?php echo $row[0] ?></td>
				<td><?php echo $row[1] ?></td>
				<td><?php echo $row[2] ?></td>
				<td><a href="message.php?id=<?php echo $convid;?>" target="_blank">Message</a></td>
				<?php
			if (! empty($_SESSION['logged_in']))
			{ 
				$query = "SELECT id FROM users WHERE username='$_susername'";
				$res = mysqli_query($con, $query );
				$res_row = mysqli_fetch_row($res);
				$id=$res_row[0];
				$query = "SELECT id FROM users WHERE username='$row[0]'";
				$res = mysqli_query($con, $query );
				$res_row = mysqli_fetch_row($res);
				$contact_id=$res_row[0];
				$query = "SELECT COUNT(*) FROM user_contact WHERE isblock='block' AND userid='$id' and contactid='$contact_id'";
				$favs = mysqli_query($con, $query );
				$favs_row = mysqli_fetch_row($favs);
				if($favs_row[0] == 0){ ?>
					<td><form action="update.php" method="post">
						<input type="hidden" name="block" value="<?php echo $contact_id;?>">
						<input type="submit" value="Block">
					</form><br></td>
				<?php } 
				else { ?>
					<td><form action="update.php" method="post">
						<input type="hidden" name="unblock" value="<?php echo $contact_id;?>">
						<input type="submit" value="Unblock">
					</form><br></td>
			<?php } }?>
				<td><form action="update.php" method="post">
						<input type="hidden" name="delete_contact" value="<?php echo $row[0]; ?>">
						<input type="submit" value="Delete">
					</form></td>
			</tr>
		<?php } ?>
		</table>
		<?php } ?>

<?php
	if(isset($_POST['block'])) {
		$query = "SELECT id FROM users WHERE username='$_susername'";
				$res = mysqli_query($con, $query );
				$res_row = mysqli_fetch_row($res);
				$id=$res_row[0];
		$contactid = $_POST['block'];
		$query = "UPDATE user_contact SET isblock='block' WHERE userid='$id' AND contactid='$contactid'";
		$favs = mysqli_query($con, $query );
		?>
		<meta http-equiv="refresh" content="0;url=update.php">
		<?php
	}
	if(isset($_POST['unblock'])) {
		$query = "SELECT id FROM users WHERE username='$_susername'";
				$res = mysqli_query($con, $query );
				$res_row = mysqli_fetch_row($res);
				$id=$res_row[0];
		$contactid = $_POST['unblock'];
		$query = "UPDATE user_contact SET isblock='unblock' WHERE userid='$id' AND contactid='$contactid'";
		$favs = mysqli_query($con, $query );
		?>
		<meta http-equiv="refresh" content="0;url=update.php">
		<?php
	}?>
	<?php
    	echo "<br> <a class = 'btn btn-primary' href='add_contact.php' style = 'margin-left:2%'>+ Add Contact</a> ";
    ?>

</div>
<?php
	$query = "SELECT id FROM users WHERE username='$_susername'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_row($result);
		$userid = $row[0];
	$query = "SELECT username, email FROM users INNER JOIN user_contact ON users.id = user_contact.contactid WHERE user_contact.userid='$userid' AND user_contact.priority='friend'";
		$result = mysqli_query($con, $query);?>
			<div class="my_contacts">
				<?php echo "<h3 style = 'padding-left:3%; margin-top:3%;'>Friends</h3>";?>
				<table  class = "table" style=";color:white;">
				<thead>
			<tr>
				<th scope="col" style = "padding-left:4%">Username</th>
				<th scope="col" >Email</th>
				<th scope="col" >Message</th>
			</tr>
</thead>
		<?php
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
		?>
			<?php
				$conv_query = "SELECT conversationID FROM conversations WHERE (userA='$_susername' AND userB='$row[0]') OR (userB='$_susername' AND userA='$row[0]')";
				$conv_result = mysqli_query($con, $conv_query);
				$conv_row = mysqli_fetch_row($conv_result);
				$convid = $conv_row[0];
			?>

			<tr>
				<td><?php echo $row[0] ?></td>
				<td><?php echo $row[1] ?></td>
				<td><a href="message.php?id=<?php echo $convid;?>" target="_blank">Message</a></td>
			<td><form action="update.php" method="post">
						<input type="hidden" name="delete_contact" value="<?php echo $row[0]; ?>">
						<input type="submit" value="Delete">
					</form></td>
			</tr>
		<?php }?>
		</table>
		</div>
			
<div class="my_uploads">
	<h3 style = 'padding-left:3%; margin-top:3%;'>My Uploads</h3>
	<form action="update.php" method="post" style = "margin-left:50%">
		Sort By: 
        <select name="type" type="text">
          <option value="all"  selected="selected">All</option>
          <option value="images">Images</option>
          <option value="videos">Videos</option>
          <option value="audio">Audio</option>
        </select>
        <button style = "color:white" class = "btn" type="submit" value="Sort" name="change"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm.5 5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1 0-1zM4 8.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm2 3a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5z"/>
</svg></button>
      </form>




	<table class = "table" style="width:50%;color:white;">
		<thead>
		<tr>
			<th scope="col" style = "padding-left:8%" >Title</th>
			<th scope="col">Description</th>
			<th></th>
		</tr>
		</thead>
    <?php
      $catquery="";

      if(isset($_POST['change'])){
        $type = $_POST['type'];
        if($type == 'all'){
          $catquery = "AND media.category IN ('image', 'video', 'audio')";
        }
        else if($type == 'images'){
          $catquery = "AND media.category = 'image'";
        }
        else if($type == 'videos'){
          $catquery = "AND media.category = 'video'";
        }
        else if($type == 'audio'){
          $catquery = "AND media.category = 'audio'";
        }
      }
  		$query = "SELECT * FROM media INNER JOIN upload ON media.mediaid = upload.mediaid INNER JOIN users ON upload.username = users.username WHERE users.username='$_susername' $catquery";


      $result = mysqli_query($con, $query );
  		if (!$result)
  		{
  		   die ("Could not query the media table in the database: <br />". mysqli_error($con));
  		}
  	?>


		<?php
			while ($result_row = mysqli_fetch_row($result))
			{
		?>
        <tr valign="top">
			<td>
					<h4><a href="media.php?id=<?php echo $result_row[0];?>" target="_blank"><?php echo $result_row[4];?></a></h4>
			</td>
			<td>
					<?php
						echo $result_row[5];
					?>
			</td>
			<td>
					<?php
						echo $result_row[6];
					?>
			</td>
         </tr>
		<?php
			}
		?>
	</table>

</div>
<div class="my_uploads">
	<h3 style = 'padding-left:3%; margin-top:3%;'>Groups</h3>
	<?php
	if(isset($_POST['join'])) {
		$groupname = $_POST['join'];
		$query = "INSERT INTO group_user(groupname,username) VALUES('$groupname', '$_susername')";
		$favs = mysqli_query($con, $query );
	}
	if(isset($_POST['leave'])) {
		$groupname = $_POST['leave'];
		$query = "DELETE FROM group_user WHERE groupname='$groupname' AND username='$_susername'";
		$favs = mysqli_query($con, $query );
	}
	?>
	<table class = "table" style =" width:25%;color:white">
		<thead>
		<tr>
			<th>Group Name</th>
			<th>Action </th>
		</tr>
</thead>
		<tr>
			<td>
			<?php
			$query = "SELECT groupname FROM groups";
				$res = mysqli_query($con, $query );
				$res_row = mysqli_fetch_row($res);
			?>
			<?php
			$query = "SELECT username FROM group_user WHERE groupname='$res_row[0]' AND username='$_susername'";
				$res = mysqli_query($con, $query );
				$row = mysqli_fetch_row($res);
				if($row[0]==$_susername){ 
				$href="groups.php?id=$res_row[0]";
				}
				else{
					$href="update.php";
				}?>
			<a href="<?php echo $href;?>" target="_blank"><?php echo $res_row[0];?></a>
			</td>
			<?php
			
			$query = "SELECT username FROM group_user WHERE groupname='$res_row[0]' AND username='$_susername'";
				$favs = mysqli_query($con, $query );
				$favs_row = mysqli_fetch_row($favs);
				$username=$_susername;
				if($favs_row[0]==$username){ ?>
					<td><form action="update.php" method="post">
						<input  type="hidden" name="leave" value="<?php echo $res_row[0];?>">
						<input type="submit" value="leave">
					</form><br></td>
				<?php } 
				else { ?>
					<td><form action="update.php" method="post">
						<input  type="hidden" name="join" value="<?php echo $res_row[0];?>">
						<input class = "btn btn-success" type="submit" value="Join">
					</form><br></td>
			<?php }   ?>
		</tr>
		
	</table>
	<?php
    	echo " <a class = 'btn btn-primary' href='add_group.php' style = 'margin-left:1%'>+ Add Group</a>";
		 
    ?>
</div>

