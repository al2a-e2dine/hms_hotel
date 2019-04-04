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
      <h2>Gestion des utilisateurs</h2> 
      <a href="add_user.php" type="button" class="btn btn-primary btn-block">Ajouter un utilisateur</a>
      <br>           
      <table class="table table-hover">
        <thead>
          <tr>
            <th>admin_id</th>
            <th>firstname</th>
            <th>lastname</th>
            <th>email</th>
            <th>password</th>
            <th>date_reg</th>
            <th>modifier</th>
            <th>supprimer</th>
          </tr>
        </thead>
        <tbody>
          <tr>
        <?php 
          $q="SELECT * FROM `admin`";
          $r=mysqli_query($dbc,$q);
          while ($row=mysqli_fetch_assoc($r)) {
          ?>
            <td><?= $row ['admin_id'] ?></td>
            <td><?= $row ['firstname'] ?></td>
            <td><?= $row ['lastname'] ?></td>
            <td><?= $row ['email'] ?></td>
            <td><?= $row ['password'] ?></td>
            <td><?= $row ['date_reg'] ?></td>
            <td>
              <a href="user_update2.php?id=<?= $row ['admin_id'] ?>" type="button" class="btn btn-primary">modifier</a>
            </td>
            <td>
              <?php 
                if ($row ['admin_id']==1 or $row ['admin_id']==2) {
               ?>
              <a href="#" type="button" class="btn btn-danger">supprimer</a>
              <?php 
                }else{
                  ?>
                  <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?= $row ['admin_id'] ?>">supprimer</a>

                  <!-- The Modal -->
                  <div class="modal" id="myModal<?= $row ['admin_id'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">HOTEL KADI Ex EL MENZEH</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                          Êtes-vous sûr de vouloir supprimer cet utilisateur?
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <a href="delete_user.php?id=<?= $row ['admin_id'] ?>" type="button" class="btn btn-success">Oui</a>
                          <a type="button" class="btn btn-danger" data-dismiss="modal">No</a>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <!-- The Modal END -->
              <?php
                }
               ?>
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
