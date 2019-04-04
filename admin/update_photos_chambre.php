<?php
  require_once '../connect.php';
  session_start();
  if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
  }elseif (isset($_SESSION['admin_id']) and ($_SESSION['admin_id']==1 or $_SESSION['admin_id']==2)){
    //$admin_id=$_SESSION['admin_id'];
  }else{
    header('Location: index.php');
  }

  if (isset($_GET['id'])) {
    $id=$_GET['id'];
  }

  if (isset($_POST['submit'])) {
    foreach ($_FILES['upload']['name'] as $key => $name){
    $newFilename = time() . "_" . $name;
    move_uploaded_file($_FILES['upload']['tmp_name'][$key], 'upload/' . $newFilename);
    $location = $newFilename;
    if ($location!=time() . "_") {

    $perDestination="upload/$newFilename";

    $q0="INSERT INTO `photos`(`chambres_id`, `name`) VALUES ('$id','$location')";
    //echo $q0;
    //exit();
    $r0=mysqli_query($dbc,$q0);
    $err="Photos ajoutées avec succès";
    
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

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/upload.css">

</head>

<body id="page-top">
  <?php 
      include 'nav.html';
     ?>

  <div id="wrapper">

  <?php 
      include 'sidebar.html';
     ?>

    <div id="content-wrapper">
      <div class="container">
      <h2>Gestion des photos chambres</h2>
      <?php 
        if (isset($err)) {
       ?>
      <div class="alert alert-info">
        <strong>Alerte!</strong> <?= $err ?>
      </div>
      <?php 
        }
       ?>

      <?php 
        include 'uploadyourfile.php';
       ?>
      <br>           
      <table class="table table-hover">
        <thead>
          <tr>
            <th>photo</th>
            <th>photo_id</th>
            <th>chambres_id</th>
            <th>name</th>
            <th>supprimer</th>
          </tr>
        </thead>
        <tbody>
          <tr>
        <?php 
          $q="SELECT * FROM `photos` where chambres_id='$id'";
          $r=mysqli_query($dbc,$q);
          while ($row=mysqli_fetch_assoc($r)) {
          ?>
            <td><img class="img-fluid" src="upload/<?= $row ['name'] ?>" alt="<?= $row ['name'] ?>"></td>
            <td><?= $row ['photo_id'] ?></td>
            <td><?= $row ['chambres_id'] ?></td>
            <td><?= $row ['name'] ?></td>
            <td>
                  <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?= $row ['photo_id'] ?>">supprimer</a>

                  <!-- The Modal -->
                  <div class="modal" id="myModal<?= $row ['photo_id'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">HOTEL KADI Ex EL MENZEH</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                          Êtes-vous sûr de vouloir supprimer cet photo?
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <a href="delete_photo.php?id=<?= $row ['photo_id'] ?>&cid=<?= $row ['chambres_id'] ?>" type="button" class="btn btn-success">Oui</a>
                          <a type="button" class="btn btn-danger" data-dismiss="modal">No</a>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <!-- The Modal END -->
            </td>
            </tr>
          <?php 
            }
           ?>
          
        </tbody>
      </table>


    </div>

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
