<!DOCTYPE html>
<?php
	session_start();
	include_once "function.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media browse</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/default.css" />

<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">

function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message)
    { 

    }
 	);
}
</script>
</head>

<body style = "background-image:url(img/bg.png) !important; color:white !important; ">

<nav class="navbar navbar-expand-lg bg-danger">
  <a class="navbar-brand" href="browse.php"><img src="img/metube.png" width="80" height="40" alt="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <div class="dropdown">
  <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a class="nav-link" href="wordcloud.php"> Word Cloud<span class="sr-only">(current)</span></a>

	<?php 
	$username=$_SESSION['username'];
	$query = "SELECT createdby from subscribe where username='$username'";
		$result = mysqli_query($con, $query);
		while ($row = mysqli_fetch_row($result)){ ?>
		<a class="dropdown-item" href="<?php echo "subscriptions.php?id=".$row[0];?>"><?php echo $row[0];?></a>
		<?php }?>
  </div>
</div>
<form class="form-inline" action="browseFilter.php" method="post" style ="width:50rem; margin-left:20%">
    <input class="form-control mr-sm-2" type="search" name="searchwords" placeholder="" aria-label="Search" style ="margin-left:25%; width:50%;">
    <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg></button>
  </form>
  </div>
  
<?php
	if (! empty($_SESSION['logged_in']))
	{
		echo "
		<a href='update.php'style= 'color:white !important; margin-left:19%; '> 
		<button type='button' class='btn  ' ><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person' viewBox='0 0 16 16' style= 'color:white !important; '>
		<path d='M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z'/>
		
	  </svg>   <span class = 'text-white'>
	  ".$_SESSION['username'],"</span>
		</button>
		</a>";
	}
	else {
		echo "
		<a href='index.php'style= 'color:white !important; margin-left:19%; '> 
		<button type='button ' class='btn   ' ><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person' viewBox='0 0 16 16' style= 'color:white !important; '>
		<path d='M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z'/>
		
	  </svg>   <span class = 'text-white'>
	  SIGN IN</span>
		</button>
		</a>";
	}

	if(isset($_POST['search'])){

	}

  ?>
  </div>
</nav>

<?php
	if (! empty($_SESSION['logged_in']))
	{
		$username = $_SESSION['username'];
		echo " <br> <div class = 'row'><div class = 'col'><a href='media_upload.php'><button class = 'btn btn-primary' > Upload a File
		<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-upload' viewBox='0 0 16 16'>
  <path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>
  <path d='M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z'/>
</svg>
		</button></a></div>";
?>
	<div class ='col-3'>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  + Create New Playlist
</button></div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style = 'color:black'>Playlist</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="browse.php" method="post">
				<div class = "row" >
				<input class = "form-control " name="new_playlist" type="text" placeholder="new playlist..." maxlength="20" style ="width:50%; margin-left:5%; margin-right:1%;"> 
				<button class = "btn btn-primary " type="submit" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg> Create a Playlist</button>
	</div>
			

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		   
      </div>
	</form>
    </div>
  </div>
</div>
		


	<br/><br/>
	<!-- Button trigger modal -->
<div class = 'col-3'>
<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"> Add Channel
</button></div>
	</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style ='color:black'>Channel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form action="browse.php" method="post" style = "margin-left:5.35%">
					 <?php 
						$query = "select username from users where username != '$username' and username not in (select channel from channels where user='$username')";
						$channels_result = mysqli_query($con, $query); 
						if(!$channels_result){
							echo mysqli_error($con);
						}

						?>
						<select name="new_channel">
							<?php while ($channel_row = mysqli_fetch_row($channels_result)){ ?>
							<option value="<?php echo $channel_row[0]; ?>"> <?php echo $channel_row[0]; ?> </option><br>;
							<?php } ?>
						</select>
						<button style = " margin-left:1.1%;" class = "btn btn-primary " type="submit" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg> Add a Channel</button>
				</form>
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		   
      </div>
    </div>
  </div>
</div>
		<div id='upload_result' >
		<?php if(isset($_REQUEST['result']) && $_REQUEST['result']!=0)
		{
			echo upload_error($_REQUEST['result']);
		}
		if(isset($_POST['delchannel'])) {
			$channelname = $_POST['delchannel'];
			$query = "DELETE FROM channels WHERE user='$username' AND channel='$channelname'";
			$result = mysqli_query($con, $query );
			if(!$result){
				echo mysqli_error($con);
			}
			
		}
		if (empty($_SESSION['logged_in']))
		{
			$username="NULL";
		}
		?>
		</div>
		
	
			

		
		<?php }
		else {
			
		}
		?>
<?php
	if (isset($_POST['channel'])) {
		$channel = $_POST['channel'];
		if ($channel == "all"){
			$channel_query = "SELECT mediaid FROM media";
		}
		else if ($channel == "mine"){
			$channel_query = "SELECT mediaid FROM media WHERE user='$username'";
		}
		else {
			$channel_query = "SELECT mediaid FROM media WHERE user='$channel'";
		}
	}
	else {
		$channel_query = "SELECT mediaid FROM media";
	}
	if(isset($_POST['type'])) {
		$type = $_POST['type'];
		if($type == 'all'){
			$type_query = "SELECT mediaid FROM media";
		}
		else if($type == 'images') {
			$type_query = "SELECT mediaid FROM media WHERE category='image'";
		}
		else if($type == 'videos'){
			$type_query = "SELECT mediaid FROM media WHERE category='video'";
		}
		else if($type == 'audio'){
			$type_query = "SELECT mediaid FROM media WHERE category='audio'";
		}
		else{
			$type_query = "SELECT mediaid FROM media";
		}
	}
	else {
		$type_query = "SELECT mediaid FROM media";
	}

	if(isset($_POST['playlist'])){
		$playlist = $_POST['playlist'];
		if($playlist == 'all'){
			$playlist_query = "SELECT mediaid from media";
		}
		else {
			$playlist_query = "SELECT media.mediaid FROM media INNER JOIN playlists ON media.mediaid=playlists.mediaid WHERE playlists.playlist='$playlist' AND username='$username'";
		}
	}
	else{
		$playlist_query = "SELECT mediaid from media";
	}
	$bigq = "SELECT media.mediaid FROM media WHERE media.mediaid in ($channel_query) AND media.mediaid in ($type_query) AND media.mediaid in ($playlist_query)";
	$allq = "SELECT * FROM media WHERE media.mediaid IN ($bigq)";
	if(isset($_POST['order']))
	{
		$order = $_POST['order'];
		if($order=='recent')
		{
			$allq = "SELECT * FROM media WHERE media.mediaid IN ($bigq) ORDER BY time DESC";
		}
		if($order=='name')
		{
			$allq = "SELECT * FROM media WHERE media.mediaid IN ($bigq) ORDER BY filename";
		}
		if($order=='size')
		{
			$allq = "SELECT * FROM media WHERE media.mediaid IN ($bigq) ORDER BY size";
		}
		if($order=='viewed')
		{
			$allq = "SELECT * FROM media WHERE media.mediaid IN ($bigq) ORDER BY views DESC";
		}
	}
	$result = mysqli_query($con, $allq);
	if(!$result){
		echo mysqli_error($con);
	}
?>
   
<?php
	
	if(isset($_POST['new_playlist'])){
		$new_playlist = $_POST['new_playlist'];
		$query = "SELECT playlist FROM user_playlists WHERE username='$username' and playlist='$new_playlist'";
		$playlist_result = mysqli_query($con, $query);
		$row = mysqli_fetch_row($playlist_result);
		if(!$row) {
			$query = "INSERT into user_playlists(playlist, username) VALUES('$new_playlist', '$username')";
			$new_playlist_result = mysqli_query($con, $query);
		}

		if($row) {
			echo 'You already have a playlist with that name.';
		}
	}
	
	if(isset($_POST['new_channel'])){
		$new_channel = $_POST['new_channel'];
		$query = "INSERT into channels(user, channel) VALUES('$username','$new_channel')";
		$channel_result = mysqli_query($con, $query);
		if(!$channel_result){
			echo mysqli_error($con);
		}
		?>
		<meta http-equiv="refresh" content="0;url=browse.php">
		<?php
	}

?>

<br/><br/><br/><br/>
<h2 style = "padding-left:4%;border-bottom:1.5px solid white;padding-bottom:0.5%;">Feed</h2>
<hr/>
<hr style="width:100%; height:3;  color:white;">  
<div class="row" style = "margin-left:2%">

<div class="col-8 col-sm-3">

    <table style = "width:70rem;margin-left:50%">
    <tr>
    	<th style = "width:20%"><h4>Category</h4></th>
    	<?php if (! empty($_SESSION['logged_in'])) { ?>
			<th style = "width:20%" ><h4 >Playlist</h4></th>
			<th style = "width:20%"><h4 >Channel</h4></th> <?php } ?>
			<th style = "width:20%"><h4 >Order By</h4></th>
    	<th></th>
    </tr>
    <tr>
	    <td>
	    	<form action="browse.php" method="post">
		  		<select class="form-select" name="type" type="text">
		    		<option value="all" selected="selected">All</option>
		    		<option value="images">Images</option>
		    		<option value="videos">Videos</option>
		    		<option value="audio">Audio</option>
		  		</select>
		</td>
		
	</div>
</div>
  	<?php 
	if (! empty($_SESSION['logged_in']))
	{ ?>
		<td>
		  	<form action="browse.php" method="post">
		  <?php 
			$query = "SELECT * FROM user_playlists where username='$username'";
			$playlist_result = mysqli_query($con, $query); ?>
				<select name="playlist">
					<option value="all" selected="selected">All</option>
					<option value="favorites">Favorites</option>
				<?php while ($playlist_row = mysqli_fetch_row($playlist_result)){ ?>
					<option value="<?php echo $playlist_row[0]; ?>"> <?php echo $playlist_row[0]; ?> </option><br>;
			<?php } ?>
				</select>
		</td>
		<td>
		  	<form action="browse.php" method="post">
		  <?php 
			$query = "SELECT channel FROM channels where user='$username'";
			$channel_result = mysqli_query($con, $query); ?>
				<select name="channel">
					<option value="all" selected="selected">Any</option>
					<option value="mine">My Channel</option>
				<?php while ($channel_row = mysqli_fetch_row($channel_result)){ ?>
					<option value="<?php echo $channel_row[0]; ?>"> <?php echo $channel_row[0]; ?> </option><br>;
			<?php } ?>
				</select>
		</td>
		
	<?php } ?>
	<td>
	    	<form action="browse.php" method="post">
		  		<select name="order" type="text">
		    		<option value="recent" selected="selected">Most Recent</option>
		    		<option value="viewed">Most Viewed</option>
		    		<option value="name">Name</option>
		    		<option value="size">Size</option>
		  		</select>
		</td>

		<td><button class = "btn btn-primary" type="submit" > Apply Filters <i class="fa fa-filter" aria-hidden="true"></i></button></td>
		</form>
	</tr>
	</table>
	<br/><br/>
    <div class="all_media" >
		<?php
			//print $result;
			while ($result_row = mysqli_fetch_row($result))
			{
				if (empty($_SESSION['logged_in']))
		{
			$username="NULL";
		}
				$query="SELECT id FROM users INNER JOIN media ON users.username = media.user";
				$res = mysqli_query($con, $query);
				$res_row = mysqli_fetch_row($res);
				$id=$res_row[0];
				$query="SELECT id FROM users WHERE username='$username'";
				$res = mysqli_query($con, $query);
				$res_row = mysqli_fetch_row($res);
				$contactid=$res_row[0];
				$query="SELECT isblock FROM user_contact WHERE userid='$id' AND contactid='$contactid'";
				$res = mysqli_query($con, $query);
				$res_row = mysqli_fetch_row($res);
				$isblock=$res_row[0];
				if($isblock=='block')
				{
					continue;
				}
				$query = "SELECT user FROM media where mediaid='$result_row[0]'";
				$user_share_result = mysqli_query($con, $query);
				$user_share_row = mysqli_fetch_row($user_share_result);
				if(($result_row[9]=="me") && ($user_share_row[0]!=$username))
				{
					continue;
				}
				$query = "SELECT priority FROM users INNER JOIN user_contact ON users.id = user_contact.contactid WHERE users.username='$username'";
				$user_share_result = mysqli_query($con, $query);
				$user_share_row1 = mysqli_fetch_row($user_share_result);
				if(($result_row[9]=="friends") && (($user_share_row1[0]!="friend")))
				{
					if($user_share_row[0]!=$username)
					continue;
				}
				if(($result_row[9]=="family") && (($user_share_row1[0]!="family")))
				{
					if($user_share_row[0]!=$username)
					continue;
				}
				if(($result_row[9]=="favorites") && (($user_share_row1[0]!="favorite")))
				{
					if($user_share_row[0]!=$username)
					continue;
				}
		?>

		<div class="media_box" style = "height:300px" >
			<?php
				$mediaid = $result_row[0];
				$filename=$result_row[1];
				$filepath=$result_row[2];
				$type=$result_row[3];
				if(substr($type,0,5)=="image") //view image
				{
					echo "<img src='".$filepath.$filename."' height=200 width=300/>";
				}
				else //view movie
				{
			?>
		    		<div style = "border: 1px solid white; width:300px;height:200px">
					<video width="298" height="198" controls>
			<source src="<?php echo $result_row[2].$result_row[1];  ?>" type="video/mp4">
		</video>
					</div>
				<?php } ?>
			<div style = "margin-left:7%;"><h4 style = "margin-top:30%;"><a href="media.php?id=<?php echo $result_row[0];?>" target="_blank"><?php echo $result_row[4];?></a></h4>
			
			<div style = "width:5rem; margin-top:40%;  color:orange"><form action="browse.php" method="post" >
						<?php 
					$query = "SELECT AVG(rating) FROM rating_data where mediaid='$result_row[0]'";
				$rate_result = mysqli_query($con, $query);
				$rate_row = mysqli_fetch_row($rate_result);

				if($rate_row[0]==NULL)
				{
					echo "<i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
				}
				else{
					if($rate_row[0]=='0.5'){
						echo "<i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
					}
					if($rate_row[0]=='1'){
						echo "<i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
					}
					if($rate_row[0]=='1.5'){
						echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
					}
					if($rate_row[0]=='2'){
						echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
					}
					if($rate_row[0]=='2.5'){
						echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
					}
					if($rate_row[0]=='3'){
						echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
					}
					if($rate_row[0]=='3.5'){
						echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i> ";
					}
					if($rate_row[0]=='4'){
						echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i> ";
					}
					if($rate_row[0]=='4.5'){
						echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i> ";
					}
					if($rate_row[0]=='5'){
						echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> ";
					}				}
				?>
					</form><br></div>
				<div><form action="browse.php" method="post">
						
						<?php 
					$query = "SELECT views FROM media where mediaid='$result_row[0]'";
				$rate_result = mysqli_query($con, $query);
				$rate_row = mysqli_fetch_row($rate_result);
				if($rate_row[0]==NULL)
				{
					echo "0";
				}
				else{
				echo $rate_row[0];
				}
				?>
				views	</form><br></div>
				
			
			
		</div>
		</div> 
			<?php }  ?>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</body>
</html>