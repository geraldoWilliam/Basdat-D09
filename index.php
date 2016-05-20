<?php
  require 'script\login.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Silu Hotel</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

	<?php
	session_start ();
	
	if ($_SERVER ["REQUEST_METHOD"] == "POST") {
		if (isset ( $_POST ['login'] )) {
			authenticate ();
		}
	}
	
	redirectUser ();
	?>


</head>
<body>
  <div id="divv" style="background-color:#DDDDDD; margin-top:15%">
    <div class="container">
      <div class="row">
        <div class="one-half column" style="margin: 5% 0%">
          <h4>Welcome to Silu Hotel</h4>
          <p>
            Hotel terbaik se-Asia Tenggara dengan pelayanan berkualitas tinggi.
            Serta memiliki sertifikasi Hotel Bintang 5.
          </p>
          <p>
            PLEASE LOG IN
          </p>
        </div>
          <!-- TEMPAT LOG IN -->
          <?php
            loadLoginDummy()
           ?>
      </div>
    </div>
  </div>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->


<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
