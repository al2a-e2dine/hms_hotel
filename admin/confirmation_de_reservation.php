<?php
    require_once '../connect.php';
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
    }
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
    }
    if (isset($_GET['num_cham'])) {
        $num_cham=$_GET['num_cham'];
    }
    $q="UPDATE `reservation` SET `confirmation`=1, `num_cham`='$num_cham' WHERE `id_reservation`='$id'";
    //echo $q; exit();
    $r=mysqli_query($dbc,$q);
    $q2="UPDATE `chambres` SET `Reserve`=1 WHERE `num_chambres`='$num_cham'";
    //echo $q2; exit();
    $r2=mysqli_query($dbc,$q2);
    header('Location:gestion_des_reservation.php');
?>