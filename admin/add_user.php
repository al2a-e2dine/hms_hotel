<?php 
  require_once '../connect.php';
  session_start();
  if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
  }
  if (isset($_SESSION['admin_id']) and ($_SESSION['admin_id']==1 or $_SESSION['admin_id']==2)) {
    
  }else{
    header('Location: index.php');
  }

  if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($firstname and $lastname and $email and $password and $password) {
      $q="SELECT * FROM `admin` WHERE `email`='$email'";
      $r=mysqli_query($dbc,$q);
      $num=mysqli_num_rows($r);
      if ($num==0) {
        if ($password==$password2) {
          $password=md5($password);
          $q="INSERT INTO `admin`(`firstname`, `lastname`, `email`, `password`) VALUES ('$firstname','$lastname','$email','$password')";
          $r=mysqli_query($dbc,$q);
          $err="inscription terminé";
        }else{
          $err="Les mots de passe ne correspondent pas";
        }
      }else{
        $err="l'email déja utiliser";
      }
    }else{
      $err="svp remplir tt les champs";
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
      <div class="card-header">Ajouter un utilisateur</div>
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
        <form action="add_user.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus" name="firstname">
                  <label for="firstName">Nom</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" class="form-control" placeholder="Last name" required="required" name="lastname">
                  <label for="lastName">Prénom</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" name="email">
              <label for="inputEmail">Adresse électronique</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="password">
                  <label for="inputPassword">Mot de passe</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required" name="password2">
                  <label for="confirmPassword">Confirmer le mot de passe</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="submit">Inscription</button>
        </form>
        <div class="text-center">
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
