<?php
include './../../connections/connections.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$sql = "SELECT * FROM category";
$resultServices = mysqli_query($conn, $sql);

$service_names = [];
if ($resultServices) {
  while ($row = mysqli_fetch_assoc($resultServices)) {
    $service_names[] = $row;
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
  <link href="./../../assets/img/favicon.ico" rel="icon">


  <title>Admin | Reports</title>

  <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


  <link href="./../../assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <link href="./../../assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include './../../includes/admin/admin_nav.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php include './../../includes/admin/admin_topbar.php'; ?>

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Appointments Report</h1>

          </div>
          <div class="form-row align-items-end">
            <div class="col-auto">
              <label for="dateFrom">Date From:</label>
              <input type="date" id="dateFrom" name="dateFrom" class="form-control">
            </div>
            <div class="col-auto">
              <label for="dateTo">Date To:</label>
              <input type="date" id="dateTo" name="dateTo" class="form-control">
            </div>

            <div class="col-auto">
              <label for="category_id">Service:</label>
              <select class="form-control" id="category_id" name="category_id" required style="width: 15rem;">
                <option value="All">All</option> <!-- Added "All" option -->
                <option value="">Select Services</option>
                <?php foreach ($service_names as $service_rows): ?>
                  <option value="<?php echo $service_rows['category_id']; ?>">
                    <?php echo $service_rows['category_name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>


            <div class="col-auto">
              <button class="btn btn-success shadow-sm mb-4" id="searchAppointmentReports" disabled>Search</button>
            </div>
          </div>

          <br>

          <div id="dateRangeDisplay" class="mb-4">
            <h3><strong>Category: </strong><strong><span id="agent_name_display"> </span></strong></h3>
            <h4>From: <span id="displayFrom"> </span></h4>
            <br>
            <h4>To: <span id="displayTo"> </span></h4>
          </div>

          <!-- <button id="exportToExcel" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mb-4" disabled>
            <i class="fas fa-file-excel"></i> Export to Excel
          </button> -->

          <hr>
          <div class="row">
            <div class="col-xl-12 col-lg-12">
              <div class="tab-pane fade show active" id="aa" role="tabpanel" aria-labelledby="aa-tab">

                <div class="table-responsive">
                  <div id="modalContainerCategory"></div>

                  <table class="table custom-table table-hover" name="appointment_reports_table"
                    id="appointment_reports_table">
                    <thead>
                      <tr>
                        <th>Appointment #</th>
                        <th>Qeueu #</th>
                        <th>Category</th>
                        <th>Timeslot</th>
                        <th>Appointment Date</th>
                        <th>Appointment Status</th>


                      </tr>
                    </thead>
                  </table>


                </div>
                <div id="dateRangeDisplay" class="mb-4 row">
                  <div class="col-6 text-left">
                    <!-- THIS IS FOR SPACING ONLY -->
                  </div>
                  <div class="col-6">
                    <hr>
                    <h1><strong>Total Data: </strong><strong id="totalData"></strong></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <script src="./../../assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="./../../assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./../../assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="./../../assets/admin/js/sb-admin-2.min.js"></script>

  <!-- Data tables -->
  <link rel="stylesheet" type="text/css" href="./../../assets/datatables/datatables.min.css" />
  <script type="text/javascript" src="./../../assets/datatables/datatables.min.js"></script>



</body>

</html>

<!-- COPY THESE WHOLE CODE WHEN IMPORT SELECT -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
  integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
  integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<script>
  $(document).ready(function() {
    $('select').selectize({
      sortField: 'text'
    });
  });
</script>

<!-- END OF SELECT -->

<script>
  $(document).ready(function() {
    $('#sidebarToggle').click(function() {
      $('#appointment_reports_table').css('width', '100%');
    });

    category_id = $('#category_id').get(0).selectize.getValue();


    // $('#payment_status_display').text(payment_status);

    appointment_reports_table = $('#appointment_reports_table').DataTable({
      pagingType: "numbers",
      processing: true,
      serverSide: true,
      order: [
        [1, 'asc']
      ],
      ajax: {
        url: "./../../controllers/tables/appointment_reports_table.php",
        type: "GET",
        data: function(d) {
          d.date_from = $('#dateFrom').val();
          d.date_to = $('#dateTo').val();
          d.category_id = $('#category_id').get(0).selectize.getValue();
        }
      }
    });

    $(document).ready(function() {
      // Call toggleSearchButton on input or change
      $('#dateFrom, #dateTo, #category_id').on('input change', function() {
        toggleSearchButton();
      });

      function toggleSearchButton() {
        const dateFrom = $('#dateFrom').val();
        const dateTo = $('#dateTo').val();
        const category_id = $('#category_id').val();

        if (dateFrom && dateTo && category_id) {
          $('#searchAppointmentReports').prop('disabled', false);
        } else {
          $('#searchAppointmentReports').prop('disabled', true);
        }
      }

      // Optional: call once on page load in case some fields are prefilled
      toggleSearchButton();
    });

    // Handle the search button click event
    $('#searchAppointmentReports').click(function() {
      $(this).text('Searching...').prop('disabled', true); // Disable search button

      var dateFrom = $('#dateFrom').val();
      var dateTo = $('#dateTo').val();
      var category_id = $('#category_id').val();

      $('#displayFrom').text(dateFrom);
      $('#displayTo').text(dateTo);
      $('#agent_name_display').text($('#category_id option:selected').text());

      if (appointment_reports_table) {
        appointment_reports_table.ajax.reload(function() {
          $.ajax({
            type: 'POST',
            url: './../../controllers/admin/appointment_reports_process.php',
            data: {
              searchAppointmentReports: true,
              date_from: dateFrom,
              date_to: dateTo,
              category_id: category_id,
            },
            success: function(response) {
              try {
                const data = JSON.parse(response);
                // ✅ Use correct key from your PHP response
                $('#totalData').text(data.total_data || '0');
              } catch (error) {
                console.error("Error parsing JSON response:", error);
                $('#totalData').text('Error');
              }
              $('#searchAppointmentReports').text('Search').prop('disabled', false); // Re-enable search button
            },
            error: function() {
              alert('An error occurred while fetching total sales.');
              $('#searchAppointmentReports').text('Search').prop('disabled', false);
            }
          });
        });
      } else {
        console.error('DataTable is not initialized.');
        $('#searchAppointmentReports').text('Search').prop('disabled', false);
      }
    });

    // Initial call to ensure the search button is disabled on page load
    // toggleSearchButton();


  });
</script>