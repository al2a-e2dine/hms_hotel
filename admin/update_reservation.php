<?php 
  require_once '../connect.php';
  session_start();
  if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
  }

  if (isset($_GET['id'])) {
      $id=$_GET['id'];
  }

  if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $countries = $_POST['countries'];
    $type_chambres = $_POST['type_chambres'];
    $date_in = $_POST['date_in'];
    $date_out = $_POST['date_out'];

    if ($firstname and $lastname and $email and $phone and $countries and $type_chambres and $date_in and $date_out) {
        $q="UPDATE `reservation` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`phone`='$phone',`countries`='$countries',`type_chambres`='$type_chambres',`date_in`='$date_in',`date_out`='$date_out',`n_days`=datediff('$date_out','$date_in') WHERE id_reservation='$id'";
    
      $r=mysqli_query($dbc,$q);
      $err="reservation terminé";
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
      <div class="card-header">Réservation de chambres</div>
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
        $q="SELECT * FROM `reservation` where id_reservation='$id'";
        $r=mysqli_query($dbc,$q);
        $row=mysqli_fetch_assoc($r);
      ?>
        <form action="update_reservation.php?id=<?= $id ?>" method="post">
          <div class="form-group">
            <label for="firstname">Nom</label>
            <input type="text" class="form-control" name="firstname" placeholder="Nom" value="<?= $row['firstname'] ?>">
          </div>
          <div class="form-group">
            <label for="lastname">Prénom</label>
            <input type="text" class="form-control" name="lastname" placeholder="Prénom" value="<?= $row['lastname'] ?>">
          </div>
          <div class="form-group">
            <label for="email">Adresse électronique</label>
            <input type="email" class="form-control" name="email" placeholder="Adresse électronique" value="<?= $row['email'] ?>">
          </div>
          <div class="form-group">
            <label for="phone">Numéro de téléphone</label>
            <input type="number" class="form-control" name="phone" placeholder="Numéro de téléphone" value="<?= $row['phone'] ?>">
          </div>

            <?php 
              $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palestine", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
             ?>
          <div class="form-group">
            <label for="countrie">Pays du passeport</label>
            <select class="form-control" name="countries">
              <option value="<?= $row['countries'] ?>"><?= $row['countries'] ?></option>
              <?php 
                foreach ($countries as $key => $value) {
               ?>
              <option value="<?= $value ?>"><?= $value ?></option>
              <?php 
                }
               ?>
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
          <div class="form-group row">
            <label for="example-date-input" class="col-2 col-form-label">À partir de cette date</label>
            <div class="col-10">
              <input class="form-control" type="date" name="date_in" value="<?= $row['date_in'] ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="example-date-input" class="col-2 col-form-label">À ce jour</label>
            <div class="col-10">
              <input class="form-control" type="date" name="date_out" value="<?= $row['date_out'] ?>">
            </div>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Mise à jour</button>
        </form>
        <div class="text-center">
          <a class="d-block small" href="gestion_des_reservation.php">Gestion des Réservation</a>
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
