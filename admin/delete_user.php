<?php 
	require_once '../connect.php';
	session_start();
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$q="DELETE FROM `admin` WHERE `admin_id`='$id'";
		$r=mysqli_query($dbc,$q);
		header('Location: gestion_des_utilisateurs.php');
	}else{
		header('Location: index.php');
	}
 ?>