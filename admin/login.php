<?php 
  require_once '../connect.php';
  session_start();
  if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
  }

  if (isset($_POST['submit'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];

    $password=md5($password);
    $q="SELECT * FROM `admin` WHERE `email`='$email' and `password`='$password'";
    $r=mysqli_query($dbc,$q);
    $num=mysqli_num_rows($r);

    if ($num==0) {
      $err="l'adresse électronique ou le mot de passe entré est incorrect";
    }else{
      $row=mysqli_fetch_assoc($r);
      
      $_SESSION['admin_id']=$row['admin_id'];
      $_SESSION['firstname']=$row['firstname'];
      $_SESSION['lastname']=$row['lastname'];
      $_SESSION['email']=$row['email'];
      $_SESSION['password']=$row['password'];
      $_SESSION['date_reg']=$row['date_reg'];
      header('Location:index.php');
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
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Se connecter</div>
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
        <form action="login.php" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Adresse électronique" required="required" autofocus="autofocus" name="email">
              <label for="inputEmail">Adresse électronique</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="required" name="password">
              <label for="inputPassword">Mot de passe</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="submit">Connexion</button>
        </form>
        <br>
        <div class="text-center">
          <a class="d-block small" href="index.php">Page d'accueil</a>
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
