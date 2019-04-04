<?php 
	require_once '../connect.php';
	session_start();
	if (isset($_GET['cid'])) {
		$cid=$_GET['cid'];
	}
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$q="DELETE FROM `photos` WHERE `photo_id`='$id'";
		$r=mysqli_query($dbc,$q);
		header('Location: update_photos_chambre.php?id='.$cid);
	}else{
		header('Location: index.php');
	}
 ?>