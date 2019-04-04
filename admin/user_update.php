<?php
  require_once '../connect.php';
  session_start();
  if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
  }else{
    $admin_id=$_SESSION['admin_id'];
  }

  if (isset($_POST['submit'])) {
   $firstname=$_POST['firstname'];
   $lastname=$_POST['lastname'];
   //$email=$_POST['email'];
   $password=$_POST['password'];

   $password=md5($password);
   if ($password==$_SESSION['password']) {
     $q="UPDATE `admin` SET `firstname`='$firstname',`lastname`='$lastname' WHERE `admin_id`=$admin_id";
     $r=mysqli_query($dbc,$q);
     $err="modification terminé";
   }else{
    $err="mdp faux";
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
      <div class="card-header">Mettre à jour les informations utilisateur</div>
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
        <?php 
          $q="SELECT * FROM `admin` WHERE `admin_id`=$admin_id";
          $r=mysqli_query($dbc,$q);
          $row=mysqli_fetch_assoc($r);
         ?>
        <form action="user_update.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" class="form-control" placeholder="Nom" required="required" autofocus="autofocus" value="<?= $row['firstname'] ?>" name="firstname">
                  <label for="firstName">Nom</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" class="form-control" placeholder="Prénom" required="required" value="<?= $row['lastname'] ?>" name="lastname">
                  <label for="lastName">Prénom</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Adresse électronique" required="required" value="<?= $row['email'] ?>" name="email" disabled>
              <label for="inputEmail">Adresse électronique</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="required" name="password">
                  <label for="inputPassword">Mot de passe</label>
                </div>
              </div>
              <!-- <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div> -->
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="submit">Mettre à jour</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="user_update_password.php"> Modifier le mot de passe</a>
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
