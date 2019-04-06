<?php 
  require_once '../connect.php';
  session_start();
  if (!isset($_SESSION['admin_id'])) {
      header('Location: login.php');
  }
  if (isset($_GET['id'])) {
    $id=$_GET['id'];
  }
 ?>

<!-- Upload Your File -->
<form method="post" action="update_photos_chambre.php?id=<?= $id ?>" enctype="multipart/form-data">
  <div class="container" style="margin-top:60px">
      <div>
          <div class="form-group files color">
            <label>Upload Your File</label>
            <input type="file" class="form-control" name="upload[]" multiple required>
          </div>  
      </div>
          
  </div>
  <div class="container">
    <input type="submit" name="submit" class="btn btn-primary btn-block">
  </div>
</form>