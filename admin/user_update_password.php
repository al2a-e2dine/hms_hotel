<?php
  require_once '../connect.php';
  session_start();
  if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
  }else{
    $admin_id=$_SESSION['admin_id'];
  }

  if (isset($_POST['submit'])) {
   $old_password=$_POST['old_password'];
   $n_password=$_POST['n_password'];
   $n_password2=$_POST['n_password2'];

   $old_password=md5($old_password);
   if ($old_password==$_SESSION['password']) {
    if ($n_password==$n_password2) {
      $n_password=md5($n_password);
      $q="UPDATE `admin` SET `password`='$n_password' WHERE `admin_id`='$admin_id'";
      $r=mysqli_query($dbc,$q);
      $err="modification terminé";
    }else{
      $err="Les mots de passe ne correspondent pas";
    }
   }else{
    $err="Le mot de passe actuel est incorrect";
   }
  }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>HOTEL KADI Ex EL MENZEH</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Modifier le mot de passe</div>
      <?php 
        if (isset($err)) {
       ?>
      <div class="alert alert-info">
        <strong>Alerte!</strong> <?= $err ?>
      </div>
      <?php 
        }
       ?>
      <div class="card-body">
        <form action="user_update_password.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="required" name="old_password">
                  <label for="inputPassword">Mot de passe actuel</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="required" name="n_password">
                  <label for="inputPassword">Mot de passe</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required" name="n_password2">
                  <label for="confirmPassword">Confirmer le mot de passe</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="submit">Mettre à jour</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="user_update.php">Mettre à jour les informations utilisateur</a>
          <a class="d-block small" href="gestion_des_utilisateurs.php">Gestion des utilisateurs</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
