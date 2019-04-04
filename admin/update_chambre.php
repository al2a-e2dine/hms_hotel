<?php 
  require_once '../connect.php';
  session_start();
  if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
  }

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  if (isset($_POST['submit'])) {

    $num_chambres = $_POST['num_chambres'];
    $num_etage = $_POST['num_etage'];
    $type_chambres = $_POST['type_chambres'];
    $description_chambres = $_POST['description_chambres'];
    $prix = $_POST['prix'];

    if ($num_chambres and $num_etage and $type_chambres and $description_chambres) {
      $q="UPDATE `chambres` SET `num_chambres`='$num_chambres',`num_etage`='$num_etage',`type_chambres`='$type_chambres',`description_chambres`='$description_chambres',`prix`='$prix' WHERE `chambres_id`='$id'";
      $r=mysqli_query($dbc,$q);
      $err="La modification est terminé";

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

  <link rel="stylesheet" type="text/css" href="css/upload.css">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Mettre à jour les informations chambre
</div>
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
          $q="SELECT * FROM `chambres` WHERE `chambres_id`='$id'";
          $r=mysqli_query($dbc,$q);
          $row=mysqli_fetch_assoc($r);
         ?>
        <form action="update_chambre.php?id=<?= $id ?>" method="post">
          <div class="form-group">
            <label for="num_chambres">le numero de la chambre</label>
            <input type="number" class="form-control" name="num_chambres" placeholder="le numero de la chambre" value="<?= $row['num_chambres'] ?>">
          </div>
          <div class="form-group">
            <label for="num_etage">Numéro d'étage</label>
            <select class="form-control" name="num_etage">
              <option value="<?= $row['num_etage'] ?>"><?= $row['num_etage'] ?></option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>
          <div class="form-group">
            <label for="type_chambres">Type de chambre</label>
            <select class="form-control" name="type_chambres">
              <option value="<?= $row['type_chambres'] ?>"><?= $row['type_chambres'] ?></option>
              <option value="Single">Single</option>
              <option value="Double">Double</option>
              <option value="Triple">Triple</option>
              <option value="Suite">Suite</option>
            </select>
          </div>
          <div class="form-group">
            <label for="description_chambres">Spécifications de la chambre</label>
            <textarea class="form-control" rows="5" name="description_chambres">
              <?= $row['description_chambres'] ?>
            </textarea>
          </div>
          <div class="form-group">
            <label for="prix">Le prix de la location d'une chambre (DA/j)</label>
            <input type="number" class="form-control" name="prix" placeholder="Le prix de la location d'une chambre (DA/j)" value="<?= $row['prix'] ?>">
          </div>
          <!-- <div class="form-group">
            <label for="description_chambres">Ajouter des photos de la chambre</label>
            <div class="custom-file mb-3">
              <input type="file" class="custom-file-input" id="customFile" name="filename">
              <label class="custom-file-label" for="customFile">Choose files</label>
            </div>
          </div> -->
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>


        <div class="text-center">
          <a class="d-block small" href="update_photos_chambre.php?id=<?= $id ?>">Éditer les photos de la chembre</a>
          <a class="d-block small" href="gestion_des_chambres.php">Gestion des chambres</a>
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
