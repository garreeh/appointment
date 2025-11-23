<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check if the user is logged in and an admin
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === "0") {
  // If the user is an admin, redirect them to the admin dashboard
  header("Location: /appointment/views/user/user_dashboard.php");
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

  <?php include './includes/navigation.php' ?>

  <!-- END nav -->
  <div class="hero">
    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image:url(assets/user/images/bg_1.webp);">
        <div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-end">
            <div class="col-md-6 ftco-animate">
              <div class="text">
                <h1 class="mb-3">Vet ng Concepcion Clinic</h1>
                <h2 class="mb-3">Comprehensive care for your pets, every day of the year.</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image:url(assets/user/images/bg_2.webp);">
        <div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-end">
            <div class="col-md-6 ftco-animate">
              <div class="text">
                <h1 class="mb-3">Vet ng Concepcion Clinic</h1>
                <h2 class="mb-3">We value your pet health.</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <span class="subheading">Welcome to Vet ng Concepcion</span>
          <h2 class="mb-4">With our trusted Vet Doctors and Nurses</h2>
        </div>
      </div>
      <div class="row d-flex">
        <div class="col-md pr-md-1 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services py-4 d-block text-center">
            <div class="d-flex justify-content-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="ion-ios-checkmark-circle"></span>
              </div>
            </div>
            <div class="media-body">
              <h3 class="heading mb-3">General Health Check-ups</h3>
            </div>
          </div>
        </div>
        <div class="col-md px-md-1 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services active py-4 d-block text-center">
            <div class="d-flex justify-content-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="ion-ios-calendar"></span>
              </div>
            </div>
            <div class="media-body">
              <h3 class="heading mb-3">Vaccinations and Preventive Care</h3>
            </div>
          </div>
        </div>
        <div class="col-md px-md-1 d-flex align-sel Searchf-stretch ftco-animate">
          <div class="media block-6 services py-4 d-block text-center">
            <div class="d-flex justify-content-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="ion-ios-cut"></span>
              </div>
            </div>
            <div class="media-body">
              <h3 class="heading mb-3">Surgical Services</h3>
            </div>
          </div>
        </div>
        <div class="col-md px-md-1 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services py-4 d-block text-center">
            <div class="d-flex justify-content-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="ion-ios-document"></span>
              </div>
            </div>
            <div class="media-body">
              <h3 class="heading mb-3">Diagnostic Services</h3>
            </div>
          </div>
        </div>
        <div class="col-md pl-md-1 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services py-4 d-block text-center">
            <div class="d-flex justify-content-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="ion-ios-paw"></span>

              </div>
            </div>
            <div class="media-body">
              <h3 class="heading mb-3">Emergency and Critical Care</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include './includes/footer.php' ?>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="assets/user/js/google-map.js"></script>
<script src="assets/user/js/main.js"></script>