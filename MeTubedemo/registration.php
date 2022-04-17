<head> 
<title>Registrations</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="default.css" />

</head>

<body style = "background-image:url(img/bg.png) !important; color:white !important; "><div class="navbar navbar-expand-lg bg-danger">
<a class="active logo" href="browse.php"><img src="img/metube.png" width="85" height="40" alt="logo"></a>


</div>


<?php
session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
		if($_POST['username'] == "" || $_POST['email'] == "" || $_POST['password'] == "") {
			$login_error = "One or more fields are missing.";
		}
		else {
			$username = $_POST['username'];
			$query = "SELECT * FROM users WHERE username='$username'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_row($result);
			if ($row) {
				$login_error = "That username exists already. Please choose a new one.";
			}
			else {
				$email = $_POST['email'];
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  				$login_error = "Invalid email format";
				}
				else {

					$password = $_POST['password'];
					$confirm_password = $_POST['confirm_password'];

					if($password != $confirm_password){
						$login_error = "Passwords do not match.";
					}
					else {
						$id = rand(0000,9999);
						$query = "INSERT INTO users(username, password, email, id) VALUES ('$username', '$password', '$email', '$id')";
						$result = mysqli_query($con, $query);

						if($result){
							$smsg = "User Created Successfully";
							$_SESSION['username']=$_POST['username']; //Set the $_SESSION['username']
							$_SESSION['logged_in']=1;
							header('Location: browse.php');
						}
						else {
							$fmsg = "User Registration Failed".mysqli_error($con);
						}
					}
				}
			}
		}
}

?>
<div class="container" style = "margin-top:5%">

<form method="POST" action="<?php echo "registration.php"; ?>">
</div>
</div>

<?php if(isset($smsg)){ ?><div role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div role="alert"> <?php echo $fmsg; ?> </div><?php } ?>

<div class="card  w-50" style = "color:black; margin-left:25%">
<div class="card-header">
    Registration
  </div>
            <div class=" card-body">
            <form method="post" action="<?php echo "index.php"; ?>">
            <div class="mb-3">
				<label for="username" class="form-label">Username</label>
    <input type="name" class="form-control" aria-describedby="emailHelp" name="username"id="exampleInputEmail1" placeholder="Enter username">

                
            </div>
			<div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" aria-describedby="emailHelp" name="email" maxlength="20" placeholder="Enter Email">
                
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1">Password (Max 10 characters)</label>
                <input type="password" class="text form-control" name="password" id="exampleInputPassword1" placeholder="Enter Password">
            </div>
			<div class="mb-3">
                <label for="exampleInputPassword1">Confirm Password (Max 10 characters)</label>
                <input type="password" class="text form-control" name="confirm_password" id="exampleInputPassword1" placeholder="Enter Password">
            </div>
            <div class="row ">
                <div class=" text-center" style = "margin-left:43%">
                    <button name="submit" type="submit" class="btn btn-success">Register</button>
            </div>
			</form>
			</div>
</div>
        
            
        

<div class="container" style = "margin-left:4%">
  <div class="col-md-4 offset-md-4">
    <div class="col">
<p>Already a user?</p>
<form action="index.php"><input name="login" type="submit" value="Login Here" class = "btn btn-primary"></form>

<?php
  if(isset($login_error))
   {  echo "<div>".$login_error."</div>";}
?>
</div>
</div>
</div>
</body>