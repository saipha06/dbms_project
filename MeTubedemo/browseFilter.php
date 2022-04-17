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
<link rel="stylesheet" type="text/css" href="default.css" />
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
    <input class="form-control mr-sm-2" type="search" name="searchwords" placeholder="" aria-label="Search" style ="margin-left:25%; width:50%;" value =<?php $sw = $_POST['searchwords']; echo " '$sw'" ?>>
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


<br/><br/>

<h2 style = "padding-left:4%;border-bottom:1.5px solid white;padding-bottom:0.5%;">Feed</h2>
<br/><br/>
<h5>Search Results:</h5>
<?php
$srch = $_POST['searchwords'];
	$query = "SELECT count from keywords where keyword='$srch'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_row($result);
		$count=$row[0]+1;
		$query = "update keywords set count='$count' where keyword='$srch'";
		$result = mysqli_query($con, $query);
	if(isset($_POST['type'])) {
	$type = $_POST['type'];
	if($type == 'all'){
		$query = "SELECT DISTINCT media.mediaid, media.filename, media.filepath, media.type, media.lastaccesstime, media.title, media.description, media.category, media.user FROM media LEFT JOIN keywords ON media.mediaid = keywords.mediaid WHERE media.title LIKE '%$srch%' OR media.description LIKE '%$srch%' OR keywords.keyword LIKE '%$srch%' OR media.user LIKE '%$srch%'";
	}
	else if($type == 'images') {
		$query = "SELECT * from media WHERE category='image' AND title LIKE '%$srch%' OR description LIKE '%$srch%'";
	}
	else if($type == 'videos'){
		$query = "SELECT * from media WHERE category='video' AND title LIKE '%$srch%'";
	}
	else if($type == 'audio'){
		$query = "SELECT * from media WHERE category='audio' AND title LIKE '%$srch%'";
	}
	else{
		$query = "SELECT DISTINCT media.mediaid, media.filename, media.filepath, media.type, media.lastaccesstime, media.title, media.description, media.category, media.user FROM media LEFT JOIN keywords ON media.mediaid = keywords.mediaid WHERE media.title LIKE '%$srch%' OR media.description LIKE '%$srch%' OR keywords.keyword LIKE '%$srch%' OR media.user LIKE '%$srch%'";
	}
}
else {
	$query = "SELECT DISTINCT media.mediaid, media.filename, media.filepath, media.type, media.lastaccesstime, media.title, media.description, media.category, media.user FROM media LEFT JOIN keywords ON media.mediaid = keywords.mediaid WHERE media.title LIKE '%$srch%' OR media.description LIKE '%$srch%' OR keywords.keyword LIKE '%$srch%' OR media.user LIKE '%$srch%'";
}

$result = mysqli_query($con, $query );
if (!$result)
{
	 die ("Could not query the media table in the database: <br />". mysqli_error($con));
}
?>

<?php
	if(isset($_POST['favorite'])) {
		$mediaid = $_POST['favorite'];
		$query = "INSERT INTO playlists(playlist,username, mediaid) VALUES('favorites', '$username', '$mediaid')";
		$favs = mysqli_query($con, $query );
	}
	if(isset($_POST['unfavorite'])) {
		$mediaid = $_POST['unfavorite'];
		$query = "DELETE FROM playlists WHERE playlist='favorites' AND username='$username' AND mediaid='$mediaid'";
		$favs = mysqli_query($con, $query );
	}
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
	if(isset($_POST['add_to_playlist'])) {
		$mediaid = $_POST['mediaAddToPlaylist'];
		$addToPlaylist = $_POST['add_to_playlist'];
		$query = "SELECT * FROM playlists WHERE username='$username' and playlist='$addToPlaylist' and mediaid='$mediaid'";
		$add_to_playlist_result = mysqli_query($con, $query);
		$row = mysqli_fetch_row($add_to_playlist_result);
		if(!$row) {
			$query = "INSERT INTO playlists(playlist,username, mediaid) VALUES('$addToPlaylist', '$username', '$mediaid')";
			$add_to_playlist_result = mysqli_query($con, $query);
		}

		if($row){
			echo 'This media is already part of that playlist';
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


    <div class="all_media" style ='width:50%'>
		<?php
			//print $result;
			while ($result_row = mysqli_fetch_row($result))
			{
		?>

<div class="media_box row " style = "height:300px" >
				<div class = "col-8">
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
				</div>
			<div class = 'col-3'style = "margin-left:7%;"><h4 style = "margin-top:30%;"><a href="media.php?id=<?php echo $result_row[0];?>" target="_blank"><?php echo $result_row[5];?></a></h4>
			
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
		<br/>
		</div> 
			<?php }  ?>
	</div>
</body>
</html>
