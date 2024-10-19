
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in and an admin
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === "1") {
    // If the user is an admin, redirect them to the admin dashboard
    header("Location: /appointment/views/admin/dashboard.php");
    exit();
}


?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Appointment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/user/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="assets/user/css/animate.css">
    <link rel="stylesheet" href="assets/user/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/user/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/user/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/user/css/aos.css">
    <link rel="stylesheet" href="assets/user/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/user/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/user/css/jquery.timepicker.css">
    <link rel="stylesheet" href="assets/user/css/flaticon.css">
    <link rel="stylesheet" href="assets/user/css/icomoon.css">
    <link rel="stylesheet" href="assets/user/css/style.css">

  <!-- Theme styles END -->
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body>
 
<?php include './includes/navigation.php'?>


    
<div class="hero-wrap" style="background-image: url('assets/user/images/bg_3.jpg');">

  <div class="overlay"></div>

  <div class="container">
    <div class="row no-gutters slider-text d-flex align-itemd-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
        <div class="text">
          <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home</a></span> <span>Contact Us</span></p>
          <h1 class="mb-4 bread">Contact Us</h1>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section contact-section bg-light">
  <div class="container">
    <div class="row d-flex mb-5 contact-info">
      <div class="col-md-12 mb-4">
        <h2 class="h3">Contact Information</h2>
      </div>
      <div class="w-100"></div>
      <div class="col-md-3 d-flex">
        <div class="info rounded bg-white p-4">
          <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
        </div>
      </div>
      <div class="col-md-3 d-flex">
        <div class="info rounded bg-white p-4">
          <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
        </div>
      </div>
      <div class="col-md-3 d-flex">
        <div class="info rounded bg-white p-4">
          <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
        </div>
      </div>
      <div class="col-md-3 d-flex">
        <div class="info rounded bg-white p-4">
          <p><span>Website</span> <a href="#">yoursite.com</a></p>
        </div>
      </div>
    </div>
    <div class="row block-9">
      <div class="col-md-6 order-md-last d-flex">
        <form class="bg-white p-5 contact-form">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Your Name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Your Email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Subject">
          </div>
          <div class="form-group">
            <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
          </div>
        </form>
      
      </div>

      <div class="col-md-6 d-flex">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.1267680563315!2d121.10120277457368!3d14.648744575897219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b93f7622b361%3A0x7ef86ec11a7b2b64!2sVet%20ng%20Concepcion%20Animal%20Clinic!5e0!3m2!1sen!2sph!4v1729324870089!5m2!1sen!2sph" 
            width="600" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>

    </div>
  </div>
</section>

<?php include './includes/footer.php'?>

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

</body>
<!-- END BODY -->
</html>

<script src="assets/user/js/jquery.min.js"></script>
<script src="assets/user/js/jquery-migrate-3.0.1.min.js"></script>
<script src="assets/user/js/popper.min.js"></script>
<script src="assets/user/js/bootstrap.min.js"></script>
<script src="assets/user/js/jquery.easing.1.3.js"></script>
<script src="assets/user/js/jquery.waypoints.min.js"></script>
<script src="assets/user/js/jquery.stellar.min.js"></script>
<script src="assets/user/js/owl.carousel.min.js"></script>
<script src="assets/user/js/jquery.magnific-popup.min.js"></script>
<script src="assets/user/js/aos.js"></script>
<script src="assets/user/js/jquery.animateNumber.min.js"></script>
<script src="assets/user/js/bootstrap-datepicker.js"></script>
<script src="assets/user/js/scrollax.min.js"></script>
<script src="assets/user/js/main.js"></script>