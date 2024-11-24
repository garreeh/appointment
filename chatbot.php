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

include './includes/chatbot_plugins.php';


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



  <div class="hero-wrap" style="background-image: url('assets/user/images/bg_3.jpg');">

    <div class="overlay"></div>

    <div class="container">
      <div class="row no-gutters slider-text d-flex align-itemd-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          <div class="text">
            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home</a></span> <span>ChatBot</span></p>
            <h1 class="mb-4 bread">Inquire with our ChatBot</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="contact-section bg-light">

    <?php $page = isset($_GET['p']) ? $_GET['p'] : 'home';  ?>
    <?php
    if (!file_exists($page . ".php") && !is_dir($page)) {
      include '404.html';
    } else {
      if (is_dir($page))
        include $page . '/index.php';
      else
        include $page . '.php';
    }
    ?>
    <div class="container">
      <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog   rounded-0 modal-md modal-dialog-centered" role="document">
          <div class="modal-content  rounded-0">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="uni_modal_right" role='dialog'>
        <div class="modal-dialog  rounded-0 modal-full-height  modal-md" role="document">
          <div class="modal-content rounded-0">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="fa fa-arrow-right"></span>
              </button>
            </div>
            <div class="modal-body">
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="viewer_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
            <img src="" alt="">
          </div>
        </div>
      </div>
      <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
              <div id="delete_content"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<script src="assets/user/js/main.js"></script>