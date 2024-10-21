<?php 

include './../../connections/connections.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM category";
$resultCategory = mysqli_query($conn, $sql);

$category_names = [];
if ($resultCategory) {
    while ($row = mysqli_fetch_assoc($resultCategory)) {
        $category_names[] = $row;
    }
}

$sql = "SELECT * FROM pets WHERE user_id = '$user_id'";
$resultPetsUser = mysqli_query($conn, $sql);

$pet_names = [];
if ($resultPetsUser) {
    while ($row = mysqli_fetch_assoc($resultPetsUser)) {
        $pet_names[] = $row;
    }
}

$sql = "SELECT * FROM timeslot";
$resultTimeslot = mysqli_query($conn, $sql);

$timeslot_names = [];
if ($resultTimeslot) {
    while ($row = mysqli_fetch_assoc($resultTimeslot)) {
        $timeslot_names[] = $row;
    }
} else {
    echo "Error: " . mysqli_error($conn); // Display any SQL error
}

$sql = "SELECT unavailable_date FROM unavailable_dates";
$resultDates = mysqli_query($conn, $sql);

$unavailable_dates = [];
if ($resultDates) {
    while ($row = mysqli_fetch_assoc($resultDates)) {
        $unavailable_dates[] = $row['unavailable_date'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

$unavailable_dates_js = json_encode($unavailable_dates);

?>

<style>
  /* Custom CSS for label color */
  .modal-body label {
    color: #333; /* Darker label color */
    font-weight: bolder;
  }
</style>

<?php
include './../../connections/connections.php';

if (isset($_POST['appointment_id'])) {
  $appointment_id = $_POST['appointment_id'];
  $sql = "SELECT * FROM appointment WHERE appointment_id = '$appointment_id'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $current_timeslot_id = $row['timeslot_id'];
    ?>
  <div class="modal fade" id="editAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Appointment ID: <?php echo $row['appointment_id']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="category_id">Service:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                  <option value="">Select Service</option>
                  <?php foreach ($category_names as $category_rows) : ?>
                      <option value="<?php echo $category_rows['category_id']; ?>"
                        <?php echo ($category_rows['category_id'] == $row['category_id']) ? 'selected' : ''; ?>>
                        <?php echo $category_rows['category_name']; ?>
                      </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="pet_id">My Pet:</label>
                <select class="form-control" id="pet_id" name="pet_id" required>
                  <option value="">Select Pet</option>
                  <?php foreach ($pet_names as $pet_rows) : ?>
                      <option value="<?php echo $pet_rows['pet_id']; ?>"
                        <?php echo ($pet_rows['pet_id'] == $row['pet_id']) ? 'selected' : ''; ?>>
                        <?php echo $pet_rows['pet_name']; ?>
                      </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="appointment_date">Appointment Date:</label>
                <input type="text" class="form-control" id="appointment_date" name="appointment_date" 
                      value="<?php echo $row['appointment_date']; ?>" required>
              </div>
            </div>



            <div class="form-row">
              <div class="form-group col-md-12">
                  <label for="timeslot_id">Time Slot:</label>
                  <select class="form-control" id="timeslot_id" name="timeslot_id" required>
                      <option value="" disabled>Select Time Slot</option> <!-- Placeholder option -->
                      <?php foreach ($timeslot_names as $timeslot_row) : ?>
                          <option value="<?php echo $timeslot_row['timeslot_id']; ?>"
                              <?php echo ($timeslot_row['timeslot_id'] == $current_timeslot_id) ? 'selected' : ''; ?>>
                              <?php echo isset($timeslot_row['time_from']) ? $timeslot_row['time_from'] : 'N/A'; ?> 
                              <?php echo ' - '; ?>
                              <?php echo isset($timeslot_row['time_to']) ? $timeslot_row['time_to'] : 'N/A'; ?>
                          </option>
                      <?php endforeach; ?>
                  </select>
              </div>
          </div>


            <!-- Add a hidden input field to submit the form with the button click -->
            <input type="hidden" name="edit_appointment" value="1">

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="addButton">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- COPY THESE WHOLE CODE WHEN IMPORT SELECT -->
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize Selectize
    $('#category_id').selectize();
    $('#pet_id').selectize();
    $('#timeslot_id').selectize();
  });
</script>

<script>
  $(document).ready(function() {
    const unavailableDates = <?php echo $unavailable_dates_js; ?>;
    
    // Initialize Flatpickr for the appointment_date field
    const unavailableDatesObjects = unavailableDates.map(date => new Date(date));

    flatpickr("#appointment_date", {
        minDate: "today",
        maxDate: new Date().fp_incr(30), 
        disable: unavailableDatesObjects,
        onChange: function(selectedDates) {
            const selectedDate = selectedDates[0];
            if (selectedDate) {
                // Fetch available timeslots for the selected date
                fetchAvailableTimeslots(selectedDate.toISOString().split('T')[0]);
            }
        }
    });

    function fetchAvailableTimeslots(date) {
        $.ajax({
            type: 'POST',
            url: '/appointment/controllers/users/fetch_timeslot_process.php',
            data: { date: date },
            success: function(response) {
                response = JSON.parse(response);
                if (response.success) {
                    updateTimeslotDropdown(response.timeslots);
                } else {
                    // Handle error if no timeslots available
                    updateTimeslotDropdown([]); // Clear dropdown
                    Toastify({
                        text: response.message,
                        duration: 2000,
                        backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
                    }).showToast();
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', error);
            }
        });
    }

    function updateTimeslotDropdown(timeslots) {
        let timeslotDropdownHTML = '<option value="" disabled>Select Time Slot</option>'; // Placeholder option
        
        // Loop through all timeslots and create options
        timeslots.forEach(slot => {
            timeslotDropdownHTML += `<option value="${slot.timeslot_id}">${slot.time_from} - ${slot.time_to}</option>`;
        });

        $('#timeslot_id').html(timeslotDropdownHTML); // Update the dropdown
    }
    
    // Other existing code...

  });
</script>


<?php 
    }
  }
}
?>
