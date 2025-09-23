<?php
include './../../connections/connections.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
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

  <title>Client | Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Custom fonts for this template-->
  <link href="./../../assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="./../../assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include './../../includes/user/user_nav.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php include './../../includes/user/user_topbar.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h4 mb-0 text-gray-800">Users Dashboard</h2>
          </div>

          <!-- Date and Time -->

          <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div id="clockAndDate" class="h1 mb-0 font-weight-bold text-gray-800"></div>
          </div> -->


          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center">
              <img src="/appointment/assets/admin/img/test.png" alt="Logo"
                class="me-2" style="height:40px; width:auto;">
              Vet ng Concepcion
            </h1>
          </div>


          <!-- Content Row -->

          <hr>

          <h1 class="font-weight-bold text-gray-800">My Pets:</h1>

          <!-- Pet Cards -->
          <div class="row">
            <?php include './../../controllers/admin/count_pets_process.php'; ?>

            <?php if (!empty($pets)) : ?>
              <?php foreach ($pets as $pet) : ?>
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card shadow h-100">
                    <div class="card-body">
                      <ul class="list-unstyled mb-3">
                        <li class="mb-2">
                          <i class="fas fa-paw text-primary mr-2"></i>
                          <strong>Name:</strong> <?php echo htmlspecialchars($pet['pet_name']); ?>
                        </li>
                        <li class="mb-2">
                          <i class="fas fa-dna text-success mr-2"></i>
                          <strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?>
                        </li>
                        <li>
                          <i class="fas fa-dog text-warning mr-2"></i>
                          <strong>Species:</strong> <?php echo htmlspecialchars($pet['species']); ?>
                        </li>
                      </ul>
                      <!-- Anchor / Button -->
                      <a href="./../user/user_patient_module.php?pet_id=<?php echo $pet['pet_id']; ?>&user_id=<?php echo $user_id; ?>"
                        class="btn btn-sm btn-primary w-100">
                        View Details
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="col-12">
                <p class="text-muted">You don’t have any pets yet.</p>
              </div>
            <?php endif; ?>
          </div>






        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="./../../assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="./../../assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="./../../assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="./../../assets/admin/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>

<!-- Running Clock Script -->
<script>
  function updateClockAndDate() {
    var now = new Date();
    var hours = now.getHours();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12; // Convert 24-hour time to 12-hour time
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var month = monthNames[now.getMonth()];
    var day = now.getDate();
    var year = now.getFullYear();

    // Format the time (add leading zero if needed)
    var formattedTime = hours + ":" + (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds + " " + ampm;

    // Format the date
    var formattedDate = month + " " + day + ", " + year;

    // Update the clock and date elements
    document.getElementById("clockAndDate").innerText = formattedTime + " | " + formattedDate;

    // Update the clock and date every second
    setTimeout(updateClockAndDate, 1000);
  }

  // Initial call to start the clock and date
  updateClockAndDate();
</script>