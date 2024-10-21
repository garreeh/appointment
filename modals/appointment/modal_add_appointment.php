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

<div class="modal fade" id="addDataAppointments" tabindex="-1" role="dialog" aria-labelledby="addDataAppointmentsLabel" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataAppointmentsLabel">Add Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-12">
            <label for="category_id">Service:</label>
              <select class="form-control" id="category_id" name="category_id" required">
                <option value="">Select Service</option>
                <?php foreach ($category_names as $category_rows) : ?>
                  <option value="<?php echo $category_rows['category_id']; ?>">
                    <?php echo $category_rows['category_name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
            <label for="pet_id">My Pet:</label>
              <select class="form-control" id="pet_id" name="pet_id" required">
                <option value="">Select Pet</option>
                <?php foreach ($pet_names as $pet_rows) : ?>
                  <option value="<?php echo $pet_rows['pet_id']; ?>">
                    <?php echo $pet_rows['pet_name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-row">
              <div class="form-group col-md-12">
                  <label for="appointment_date">Set Appointment Date:</label>
                  <input type="date" class="form-control" id="appointment_date" name="appointment_date" placeholder="Tap to Choose Appointment Date" required">
              </div>
          </div>

          <div class="form-row">
              <div class="form-group col-md-12">
                  <label for="timeslot_id">Time Slot:</label>
                  <select class="form-control" id="timeslot_id" name="timeslot_id" required>
                      <option value="">Select Time Slot</option>
                      <?php foreach ($timeslot_names as $timeslot_row) : ?>
                          <option value="<?php echo $timeslot_row['timeslot_id']; ?>">
                              <?php echo isset($timeslot_row['time_from']) ? $timeslot_row['time_from'] : 'N/A'; ?> 
                              <?php echo ' - '; ?>
                              <?php echo isset($timeslot_row['time_to']) ? $timeslot_row['time_to'] : 'N/A'; ?>
                          </option>
                      <?php endforeach; ?>
                  </select>
              </div>
          </div>


          <!-- Add a hidden input field to submit the form with the button click -->
          <input type="hidden" name="add_appointment" value="1">

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="addButton">Add</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Toastify JS -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<!-- Include Flatpickr JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Include Selectize JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.default.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/standalone/selectize.min.js"></script>

<script>
  
  $(document).ready(function() {
    // Initialize Flatpickr for the appointment_date field
    const unavailableDates = <?php echo $unavailable_dates_js; ?>;
    
    const unavailableDatesObjects = unavailableDates.map(date => new Date(date));

    flatpickr("#appointment_date", {
        minDate: "today", // Disable past dates
        maxDate: new Date().fp_incr(30), // Limits the date to 1 Month
        disable: unavailableDatesObjects, // Disable unavailable dates
        onClose: function(selectedDates, dateStr, instance) {
            // Check if selected date is unavailable and show Toastify
            if (unavailableDates.includes(dateStr)) {
              Toastify({
                text: 'The selected date is unavailable. Please choose another date.',
                duration: 3000,
                backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
              }).showToast();
              instance.clear(); // Clear the input field
            }
        }
    });

    // Form submission
    $('#addDataAppointments form').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get the selected appointment date
        const appointmentDate = $('#appointment_date').val();

        // Check if the appointment date is empty
        if (!appointmentDate) {
          Toastify({
            text: 'Please select an appointment date.',
            duration: 3000,
            backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
          }).showToast();
          return; // Prevent form submission if date is not selected
        }

        // Store a reference to $(this)
        var $form = $(this);

        // Serialize form data
        var formData = $form.serialize();

        // Change button text to "Adding..." and disable it
        var $addButton = $('#addButton');
        $addButton.text('Adding...');
        $addButton.prop('disabled', true);

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '/appointment/controllers/users/add_appointment_process.php',
            data: formData,
            success: function(response) {
                // Handle success response
                console.log(response); // Log the response for debugging
                response = JSON.parse(response);
                
                if (response.success) {
                    Toastify({
                        text: response.message,
                        duration: 2000,
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
                    }).showToast();
                    
                    // Optionally, reset the form
                    $form.trigger('reset');
                    
                    // Clear Selectize dropdowns
                    $('#category_id')[0].selectize.clear();  
                    $('#pet_id')[0].selectize.clear();
                    $('#timeslot_id')[0].selectize.clear();

                    // Optionally, close the modal
                    $('#addDataAppointments').modal('hide');
                    window.reloadDataTable();
                } else {
                    Toastify({
                        text: response.message,
                        duration: 2000,
                        backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
                    }).showToast();
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                Toastify({
                    text: "Error occurred while adding appointment. Please try again later.",
                    duration: 2000,
                    backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
                }).showToast();
            },
            complete: function() {
                // Reset button text and re-enable it
                $addButton.text('Add');
                $addButton.prop('disabled', false);
            }
        });
    });
  });

</script>
