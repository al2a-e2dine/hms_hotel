<?php 
  require_once '../connect.php';
  session_start();
  if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
  }

  if (isset($_POST['submit'])) {

    $num_chambres = $_POST['num_chambres'];
    $num_etage = $_POST['num_etage'];
    $type_chambres = $_POST['type_chambres'];
    $description_chambres = $_POST['description_chambres'];
    $prix = $_POST['prix'];

    if ($num_chambres and $num_etage and $type_chambres and $description_chambres) {
      $q="INSERT INTO `chambres`(`num_chambres`, `num_etage`, `type_chambres`, `description_chambres`, `prix`) VALUES ('$num_chambres','$num_etage','$type_chambres','$description_chambres','$prix')";
      $r=mysqli_query($dbc,$q);
      $last_id = mysqli_insert_id($dbc);

    }else{
      $err="svp remplir tt les champs";
    }


    foreach ($_FILES['upload']['name'] as $key => $name){
    $newFilename = time() . "_" . $name;
    move_uploaded_file($_FILES['upload']['tmp_name'][$key], 'upload/' . $newFilename);
    $location = $newFilename;
    if ($location!=time() . "_") {

    $perDestination="upload/$newFilename";

    $q0="INSERT INTO `photos`(`chambres_id`, `name`) VALUES ('$last_id','$location')";
    //echo $q0;
    //exit();
    $r0=mysqli_query($dbc,$q0);
    $err="La chambre a été ajoutée avec succès";
    
    /*if ($r0) {
      header('Location:index.php?alert=1');
    }else{
      header('Location:index.php?alert=0');
    }*/
    

  }
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
      <div class="card-header">Ajouter une chambre</div>
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
        <form action="add_room.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="num_chambres">le numero de la chambre</label>
            <input type="number" class="form-control" name="num_chambres" placeholder="le numero de la chambre">
          </div>
          <div class="form-group">
            <label for="num_etage">Numéro d'étage</label>
            <select class="form-control" name="num_etage">
              <option></option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>
          <div class="form-group">
            <label for="type_chambres">Type de chambre</label>
            <select class="form-control" name="type_chambres">
              <option></option>
              <option value="Single">Single</option>
              <option value="Double">Double</option>
              <option value="Triple">Triple</option>
              <option value="Suite">Suite</option>
            </select>
          </div>
          <div class="form-group">
            <label for="description_chambres">Spécifications de la chambre</label>
            <textarea class="form-control" rows="5" name="description_chambres"></textarea>
          </div>
          <div class="form-group">
            <label for="prix">Le prix de la location d'une chambre (DA/j)</label>
            <input type="number" class="form-control" name="prix" placeholder="Le prix de la location d'une chambre (DA/j)">
          </div>
          <!-- <div class="form-group">
            <label for="description_chambres">Ajouter des photos de la chambre</label>
            <div class="custom-file mb-3">
              <input type="file" class="custom-file-input" id="customFile" name="filename">
              <label class="custom-file-label" for="customFile">Choose files</label>
            </div>
          </div> -->
          <div>
              <div class="form-group files color">
                <label>Upload Your File</label>
                <input type="file" class="form-control" name="upload[]" multiple required>
              </div>  
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>


        <div class="text-center">
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
