<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if the user is not logged in
  header("Location: /appointment/views/login.php");
  exit();
}

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== "0") {
  // If the user is not an admin (is_admin is not set or not "1"), redirect to the user dashboard
  header("Location: /appointment/index.php");
  exit();
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

  <!-- <script src="./../../assets/admin/vendor/jquery/jquery.min.js"></script> -->
  <!-- <script src="./../../assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

  <!-- <script src="./../../assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script> -->

  <script src="./../../assets/admin/js/sb-admin-2.min.js"></script>

  <style>
    /* Force icon-only sidebar for nav items */
    .sidebar .nav-link {
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
      height: 60px !important;
      padding: 0 !important;
    }

    .sidebar .nav-link i {
      font-size: 1.3rem !important;
    }

    /* Keep brand icon centered */
    .sidebar-brand-icon {
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
      height: 40px !important;
      font-size: 1.8rem;
    }

    /* Brand text visible */
    .sidebar-brand-text {
      line-height: 1.1;
      text-align: center;
    }

    /* Black dividers */
    .sidebar-divider {
      border-top: 1px solid #8e8080ff !important;
    }
  </style>
</head>

<body id="page-top">
  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <br>

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center"
      href="/appointment/views/admin/dashboard.php">
      <div class="sidebar-brand-icon">
        <img src="/appointment/assets/admin/img/test.png"
          alt="Clinic Logo"
          style="width: 40px; height: 40px; object-fit: contain;">
      </div>
      <div class="sidebar-brand-text mt-1 text-center">
        <small class="fw-bold">Vet ng Concepcion</small><br>
        <small>Animal Clinic</small>
      </div>
    </a>


    <br>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
      Dashboard
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="/appointment/views/admin/dashboard.php" data-bs-toggle="tooltip"
        data-bs-placement="right" title="Dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
      </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
      User Panel
    </div>

    <!-- Nav Item - My Pets -->
    <li class="nav-item">
      <a class="nav-link" href="/appointment/views/user/pets_module.php" data-bs-toggle="tooltip"
        data-bs-placement="right" title="My Pets">
        <i class="fas fa-fw fa-paw"></i>
      </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Appointment -->
    <li class="nav-item">
      <a class="nav-link" href="/appointment/views/user/appointment_module.php" data-bs-toggle="tooltip"
        data-bs-placement="right" title="Set Appointment">
        <i class="fas fa-fw fa-calendar-check"></i>
      </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Billings -->
    <!-- <li class="nav-item">
      <a class="nav-link" href="/appointment/views/user/billings_module.php" data-bs-toggle="tooltip"
        data-bs-placement="right" title="My Billings">
        <i class="fas fa-fw fa-file-invoice-dollar"></i>
      </a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
      Sign Out
    </div>

    <!-- Nav Item - Sign Out -->
    <li class="nav-item">
      <a class="nav-link" href="/appointment/controllers/logout_process.php" data-bs-toggle="tooltip"
        data-bs-placement="right" title="Sign Out">
        <i class="fas fa-fw fa-sign-out-alt"></i>
      </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

  </ul>
  <!-- End of Sidebar -->

  <!-- Bootstrap JS (for tooltips) -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
  <!-- <script>
    // Enable tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
      new bootstrap.Tooltip(el)
    });
  </script> -->
</body>

</html>