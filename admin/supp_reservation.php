<?php
    require_once '../connect.php';
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
    }
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
    }
    $q="DELETE FROM `reservation` WHERE `id_reservation`='$id'";
    $r=mysqli_query($dbc,$q);
    header('Location:gestion_des_reservation.php');
?>