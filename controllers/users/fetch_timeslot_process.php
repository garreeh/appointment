<?php
include './../../connections/connections.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['date'])) {
    $selected_date = $_POST['date'];

    // Escape the input to prevent SQL injection
    $selected_date = mysqli_real_escape_string($conn, $selected_date);

    // Query to fetch all time slots and check if they are booked
    $query = "SELECT timeslot.timeslot_id, timeslot.time_from, timeslot.time_to,
                     CASE 
                         WHEN appointment.appointment_id IS NULL THEN 'Available'
                         ELSE 'Booked'
                     END AS status
              FROM timeslot
              LEFT JOIN appointment ON timeslot.timeslot_id = appointment.timeslot_id 
              AND appointment.appointment_date = '$selected_date'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Fetch all time slots with their statuses
    $available_timeslots = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $available_timeslots[] = $row;
    }

    // Return the available time slots as JSON
    echo json_encode($available_timeslots);

    // Close the database connection
    mysqli_close($conn);
    exit;
}
?>
