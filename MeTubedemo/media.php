<!DOCTYPE html>
<?php
session_start();
include_once "function.php";
?>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Media</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
	<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="default.css" />
</head>

<body style="background-image:url(img/bg.png) !important; color:white !important; ">
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
						$username = $_SESSION['username'];
						$query = "SELECT createdby from subscribe where username='$username'";
						$result = mysqli_query($con, $query);
						while ($row = mysqli_fetch_row($result)) { ?>
							<a class="dropdown-item" href="<?php echo "subscriptions.php?id=" . $row[0]; ?>"><?php echo $row[0]; ?></a>
						<?php } ?>
					</div>
				</div>
				<form class="form-inline" action="browseFilter.php" method="post" style="width:50rem; margin-left:20%">
					<input class="form-control mr-sm-2" type="search" name="searchwords" placeholder="" aria-label="Search" style="margin-left:25%; width:50%;">
					<button class="btn btn-outline-light my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
							<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
						</svg></button>
				</form>
		</div>

		<?php
		if (!empty($_SESSION['logged_in'])) {
			echo "
		<a href='update.php'style= 'color:white !important; margin-left:19%; '> 
		<button type='button' class='btn  ' ><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person' viewBox='0 0 16 16' style= 'color:white !important; '>
		<path d='M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z'/>
		
	  </svg>   <span class = 'text-white'>
	  " . $_SESSION['username'], "</span>
		</button>
		</a>";
		} else {
			echo "
		<a href='index.php'style= 'color:white !important; margin-left:19%; '> 
		<button type='button ' class='btn   ' ><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person' viewBox='0 0 16 16' style= 'color:white !important; '>
		<path d='M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z'/>
		
	  </svg>   <span class = 'text-white'>
	  SIGN IN</span>
		</button>
		</a>";
		}

		if (isset($_POST['search'])) {
		}

		?>
		</div>
	</nav>

	<?php
	if (isset($_GET['id'])) {
		$query = "SELECT * FROM media WHERE mediaid='" . $_GET['id'] . "'";
		$result = mysqli_query($con, $query);
		$result_row = mysqli_fetch_row($result);

		updateMediaTime($_GET['id']);

		$filename = $result_row[1];
		$filepath = $result_row[2];
		$type = $result_row[3];

		if (isset($_POST['submit'])) {
			$username = $_SESSION['username'];
			$mediaid = $_GET['id'];
			$comment = $_POST['comment'];
			$id = rand(0000, 9999);
			$query = "INSERT INTO comments(username, mediaid, comment,id) VALUES ('$username', '$mediaid', '$comment','$id')";
			$result = mysqli_query($con, $query);

			if ($result) {
				$smsg = "Comment Created Successfully";
				$mediapath = 'Location: media.php?id=' . $_GET["id"];
				header($mediapath);
			} else {
				$fmsg = "Comment Failed" . mysqli_error($con);
			}
		}
		if (isset($_POST['delete_comment'])) {
			$commentid = $_POST['delete_comment'];
			$res = mysqli_query($con, "DELETE FROM comments WHERE id = '$commentid'");
		}


	?>
		<div class="row" style = "padding-left:1%">
			<div class="meta_media col" style ="padding-right:0;padding-left:2%">
				<br /><br />
				<div class="media_player" style='border-bottom:solid; padding-left:1%'>
					<?php
					if (substr($type, 0, 5) == "image") //view image
					{
						echo "<img style = 'margin-left:45%' src='" . $filepath . $filename . "' width=400px height=325px/>";
					} else //view movie
					{
					?>
						<!--<object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components…" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

		<param name="filename" value="<?php echo $result_row[2] . $result_row[1];  ?>">
		<param name="Showcontrols" value="True">
		<param name="autoStart" value="True">

		<embed type="application/x-mplayer2" src="<?php echo $result_row[2] . $result_row[1];  ?>" name="MediaPlayer" width=320 height=240></embed>

		</object>-->
						<video style='margin-left:45%' width="320" height="240" controls>
							<source src="<?php echo $result_row[2] . $result_row[1];  ?>" type="video/mp4">
						</video>
					<?php } ?>
					<?php
					if (isset($_POST['submitrate'])) {
						$username = $_SESSION['username'];
						$rates = $_POST['rate'];
						$mediaid = $_POST['mediarate'];
						$query = "INSERT INTO rating_data(rating,mediaid,username) VALUES('$rates','$mediaid','$username')";
						$rate_result = mysqli_query($con, $query);
						if (!$rate_result) {
							echo mysqli_error($con);
						}
					?>
						<!--<meta http-equiv="refresh" content="0;url=media.php?id=".<?php echo $GET_['id']; ?>">-->
					<?php
					}
					$mediapath = "media.php?id=" . $_GET["id"];
					?>
					<?php
					$id = $_GET["id"];
					$query = "select allow_rating from media where mediaid='$id'";
					$rating_result = mysqli_query($con, $query);
					$rating_row = mysqli_fetch_row($rating_result);
					if ($rating_row[0] == 'yes') { ?>
						<br /><br />
						<h2 style="padding-left:4%;padding-bottom:0.5%;"><?php echo $result_row[4] ?></h2>

						<div style="margin-left:6%">
							<form action="browse.php" method="post">

								<?php
								$query = "SELECT views FROM media where mediaid='$result_row[0]'";
								$rate_result = mysqli_query($con, $query);
								$rate_row = mysqli_fetch_row($rate_result);
								if ($rate_row[0] == NULL) {
									echo "0";
								} else {
									echo $rate_row[0];
								}
								?>
								views </form><br>
						</div>
						<div style="color:orange;margin-left:6%">
							<form action=<?php echo $mediapath ?> method="post">

								<?php
								$query = "SELECT AVG(rating) FROM rating_data where mediaid='$result_row[0]'";
								$rate_result = mysqli_query($con, $query);
								$rate_row = mysqli_fetch_row($rate_result);
								if ($rate_row[0] == NULL) {
									echo "<i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
								} else {
									if ($rate_row[0] == '0.5') {
										echo "<i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
									}
									if ($rate_row[0] == '1') {
										echo "<i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
									}
									if ($rate_row[0] == '1.5') {
										echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
									}
									if ($rate_row[0] == '2') {
										echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
									}
									if ($rate_row[0] == '2.5') {
										echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
									}
									if ($rate_row[0] == '3') {
										echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
									}
									if ($rate_row[0] == '3.5') {
										echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i> ";
									}
									if ($rate_row[0] == '4') {
										echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i> ";
									}
									if ($rate_row[0] == '4.5') {
										echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i> ";
									}
									if ($rate_row[0] == '5') {
										echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> ";
									}
								}
								?>
							</form>
							<br>
						</div>
						<p>Uploaded Date- <?php echo $result_row[10] ?></p>
						<?php
						if ($username != NULL)
							echo "<div class = 'row'><div class ='col-3'><form action=" . $mediapath . " method='post'>
                        
                        <select name='rate' type='text'>
                    <option value='1' selected='selected'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                </select>
                
                <td>
                
                <input type='hidden' name='mediarate' value='" . $_GET['id'] . "'>
                <input class ='btn btn-warning' type='submit' value='Rate' name='submitrate'></td>
                    </form><br></div>";

						$mediapath = 'media.php?id=' . $_GET["id"];
						$mediaid = $_GET["id"];

						$query = "SELECT COUNT(*) FROM playlists WHERE playlist='favorites' AND username='$username' and mediaid='$mediaid'";
						$favs = mysqli_query($con, $query);
						$favs_row = mysqli_fetch_row($favs);
						if ($favs_row[0] == 0) {
							echo "<div class ='col-3'><form action= " . $mediapath . "method='post'>
							<input type='hidden' name='favorite' value=" . $mediaid . ">
							<button class = 'btn btn-success' type = 'submit' value = 'Favorite'>
							<i class='fa fa-thumbs-up'aria-hidden='true' ></i>
							Favorite
							</button>
							
						</form><br></div>";
						} else {
							echo '<div class ="col-6"><form action=' . $mediapath . ' method="post">
							<input type="hidden" name="unfavorite" value="' . $mediaid . '">
							<input type="submit" value="Unfavorite">
						</form><br></div></div>';
						}
						echo "<div class ='col-2'><a class ='btn btn-primary' href='media_download_process.php?id='" . $result_row[0] . " target='_blank' onclick='javascript:saveDownload(" . $result_row[0] . "'><i class='fa fa-download' aria-hidden='true'></i>
					Download</a></div>";





						?>

						<?php
						$query = "SELECT * FROM user_playlists where username='$username'";
						$addToPlaylist_result = mysqli_query($con, $query); ?>
						<div class='col-4'>
							<form action=<?php echo $mediapath ?> method="post">
								<input type="hidden" name="mediaAddToPlaylist" value="<?php echo $mediaid; ?>">
								<select name="add_to_playlist">
									<?php while ($addToPlaylist_row = mysqli_fetch_row($addToPlaylist_result)) { ?>
										<option value="<?php echo $addToPlaylist_row[0]; ?>"> <?php echo $addToPlaylist_row[0]; ?> </option><br>;
									<?php } ?>
								</select>
								<input class='btn btn-primary' type="submit" value="+ Add to Playlist">
							</form>
						</div>
				</div>





			</div>
		<?php } ?>
		<?php
		if ($_SESSION != NULL) {
			$username = $_SESSION['username'];
			$mediaid = $_GET["id"];
		}
		if (isset($_POST['favorite'])) {
			$mediaid = $_POST['favorite'];
			$query = "INSERT INTO playlists(playlist,username, mediaid) VALUES('favorites', '$username', '$mediaid')";
			$favs = mysqli_query($con, $query);
		}
		if (isset($_POST['unfavorite'])) {
			$mediaid = $_POST['unfavorite'];
			$query = "DELETE FROM playlists WHERE playlist='favorites' AND username='$username' AND mediaid='$mediaid'";
			$favs = mysqli_query($con, $query);
		}
		if (isset($_POST['subscribe'])) {
			$user = $_POST['subscribe'];
			$query = "INSERT INTO subscribe(subscribed,username, createdby) VALUES('yes', '$username', '$user')";
			$favs = mysqli_query($con, $query);
		}
		if (isset($_POST['unsubscribe'])) {
			$user = $_POST['unsubscribe'];
			$query = "DELETE FROM subscribe WHERE subscribed='yes' AND username='$username' AND createdby='$user'";
			$favs = mysqli_query($con, $query);
		}
		if (isset($_POST['add_to_playlist'])) {
			$mediaid = $_POST['mediaAddToPlaylist'];
			$addToPlaylist = $_POST['add_to_playlist'];
			$query = "SELECT * FROM playlists WHERE username='$username' and playlist='$addToPlaylist' and mediaid='$mediaid'";
			$add_to_playlist_result = mysqli_query($con, $query);
			$row = mysqli_fetch_row($add_to_playlist_result);
			if (!$row) {
				$query = "INSERT INTO playlists(playlist,username, mediaid) VALUES('$addToPlaylist', '$username', '$mediaid')";
				$add_to_playlist_result = mysqli_query($con, $query);
			}

			if ($row) {
				echo 'This media is already part of that playlist';
			}
		}
		?>
		<div class="meta" style='padding-top:4%'>
			<div class="row">
				<div class='col-6'>
					<h3> <?php echo $result_row[7] ?></h3>
				</div>
				<?php
				$query = "SELECT user FROM media WHERE mediaid='$mediaid'";
				$favs = mysqli_query($con, $query);
				$favs_row = mysqli_fetch_row($favs);
				$user = $favs_row[0];
				$query = "SELECT COUNT(*) FROM subscribe WHERE subscribed='yes' AND username='$username' and createdby='$user'";
				$favs = mysqli_query($con, $query);
				$favs_row = mysqli_fetch_row($favs);
				if ($favs_row[0] == 0) { ?>
					<div class='col-6' style = 'padding-right:5%;text-align:right;'>
						<form action=<?php echo $mediapath ?> method="post">
							<input type="hidden" name="subscribe" value="<?php echo $user; ?>">
							<input class='btn btn-danger' type="submit" value="Subscribe">
						</form><br>
					</div>
				<?php } else { ?>
					<div>
						<form action=<?php echo $mediapath ?> method="post">
							<input type="hidden" name="unsubscribe" value="<?php echo $user; ?>">
							<input type="submit" value="Unsubscribe">
						</form><br>
					</div>
				<?php } ?>
			</div>
			<p style='margin-left:5%'> <em> Description:</em></p>
			<p style='margin-left:11%'> <?php echo $result_row[5] ?></p>
			<?php $query = "SELECT views from media where mediaid='$result_row[0]'";
			$view_result = mysqli_query($con, $query);
			$view = mysqli_fetch_row($view_result); ?>
			<?php $query = "update media set views='$view[0]' where mediaid='$result_row[0]'";
			$view_result = mysqli_query($con, $query); ?>

		</div>
		<?php
		$id = $_GET["id"];
		$query = "select allow_disc from media where mediaid='$id'";
		$rating_result = mysqli_query($con, $query);
		$rating_row = mysqli_fetch_row($rating_result);
		if ($rating_row[0] == 'yes') { ?>
			<b>
				<p>
				<h4 style = 'text-decoration:underline'>Comments:</h4>
				</p>
			</b>
			<?php
			$query = "SELECT * FROM comments WHERE mediaid='" . $_GET['id'] . "'" . "ORDER BY commentTime";
			$result = mysqli_query($con, $query);
			?>
			<table style ='width:50%;' >
				<tr>
					<th></th>
					<th></th>
				</tr>
				<?php
				while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
				?>
					<tr>
						<td style="text-align:center"><em><b><?php echo $row[0] ?></b></em> says</td>
					</tr>
					<tr>
						<td style="text-align:center;padding-top:5%"><?php echo $row[2] ?></td>
						<?php if (!empty($_SESSION['logged_in'])) {
							if ($_SESSION['username'] == $row[0]) {
								$mediapath = "media.php?id=" . $_GET["id"]; ?>
								<td>
									<form action=<?php echo $mediapath ?> method="post">
										<input type="hidden" name="delete_comment" value="<?php echo $row[4]; ?>">
										<input type="submit" value="Delete">
									</form>
								</td>
						<?php }
						} ?>

					</tr>

				<?php } ?>
				<?php
				if (!empty($_SESSION['logged_in'])) {
					$mediapath = "media.php?id=" . $_GET["id"]; ?>
					<form method="POST" action=<?php echo $mediapath ?>>
						<tr>
							<td> &nbsp;</td>
						</tr>
						<tr>
							<td> &nbsp;</td>
						</tr>
						<tr style = 'height:150px;'>
							<td><input style = 'width:100%;height:90px;' name="comment" type="text" placeholder="New comment (max 200 characters)..." maxlength="200"> </td>
							<td style ='text-align:right;'><input class='btn btn-info' name="submit" type="submit" value="Comment"></td>
						</tr>

					</form>
				<?php }
				?>
			</table>
		<?php } ?>
		</div>
		<?php if (isset($smsg)) { ?><div role="alert"> <?php echo $smsg; ?> </div><?php } ?>
		<?php if (isset($fmsg)) { ?><div role="alert"> <?php echo $fmsg; ?> </div><?php } ?>


	<?php
	} else {
	?>
		<meta http-equiv="refresh" content="0;url=media.php?id=" .<?php echo $GET_['id']; ?>>
	<?php
	}
	?>
	<div style="width:40%;margin-top:30%;border-left: solid;">
		<h4 style = "border-top:solid;padding:4%">People also viewed</h4>
		<br /><br />
		<div class="all_media  ">
			<div class="media_box" style = 'height:100%'>
				<?php
				$array = array();
				$mediaid = $_GET['id'];
				$query = "SELECT keyword from keywords where mediaid='$mediaid'";
				$result = mysqli_query($con, $query);
				while ($row = mysqli_fetch_row($result)) {
					$query = "SELECT mediaid from keywords where mediaid!='$mediaid' AND keyword='$row[0]'";
					$res = mysqli_query($con, $query);
					while ($res_row = mysqli_fetch_row($res)) {
						if (!in_array($res_row[0], $array)) {
							array_push($array, $res_row[0]);
							$query = "SELECT * from media where mediaid='$res_row[0]'";
							$resu = mysqli_query($con, $query);
							while ($result_row = mysqli_fetch_row($resu)) {
				?>
								<?php
								$filename = $result_row[1];
								$filepath = $result_row[2];
								$type = $result_row[3];
								if (substr($type, 0, 5) == "image") //view image
								{
									echo "<img class = 'col-6' style = 'margin-top:5%' src='" . $filepath . $filename . "' height=200 width=300/> <br/>";
								} else //view movie
								{
								?>
									<div style="width:50%">
										<video style="margin-top:13%" width="290" height="240" controls> <br />
											<source src="<?php echo $result_row[2] . $result_row[1];  ?>" type="video/mp4">
										</video>
									</div>
								<?php } ?>
								<div style="margin-top:7%; margin-right:19%">
									<h4 style="margin-top:30%;"><a href="media.php?id=<?php echo $result_row[0]; ?>" target="_blank"><?php echo $result_row[4]; ?></a></h4>

									<div style="width:5rem; margin-top:40%;  color:orange">
										<form action="browse.php" method="post">
											<?php
											$query = "SELECT AVG(rating) FROM rating_data where mediaid='$result_row[0]'";
											$rate_result = mysqli_query($con, $query);
											$rate_row = mysqli_fetch_row($rate_result);

											if ($rate_row[0] == NULL) {
												echo "<i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
											} else {
												if ($rate_row[0] == '0.5') {
													echo "<i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
												}
												if ($rate_row[0] == '1') {
													echo "<i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
												}
												if ($rate_row[0] == '1.5') {
													echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
												}
												if ($rate_row[0] == '2') {
													echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
												}
												if ($rate_row[0] == '2.5') {
													echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
												}
												if ($rate_row[0] == '3') {
													echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i> ";
												}
												if ($rate_row[0] == '3.5') {
													echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i> ";
												}
												if ($rate_row[0] == '4') {
													echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i> ";
												}
												if ($rate_row[0] == '4.5') {
													echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i> ";
												}
												if ($rate_row[0] == '5') {
													echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> ";
												}
											}
											?>
										</form><br>
									</div>
									<div>
										<form action="browse.php" method="post">

											<?php
											$query = "SELECT views FROM media where mediaid='$result_row[0]'";
											$rate_result = mysqli_query($con, $query);
											$rate_row = mysqli_fetch_row($rate_result);
											if ($rate_row[0] == NULL) {
												echo "0";
											} else {
												echo $rate_row[0];
											}
											?>
											views </form><br>
									</div>



								</div>
								<div>
									<h4><a href="media.php?id=<?php echo $result_row[0]; ?>" target="_blank"><?php echo $result_row[5]; ?></a></h4>
								</div>

				<?php }
						}
					}
				}
				?>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
</body>

</html>