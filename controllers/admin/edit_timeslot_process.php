<?php
session_start();
include '../../connections/connections.php';

if (isset($_POST['edit_timeslot'])) {
    $timeslot_id = $conn->real_escape_string($_POST['timeslot_id']);
    $time_from = $conn->real_escape_string($_POST['time_from']);
    $time_to = $conn->real_escape_string($_POST['time_to']);
    if (!isset($_SESSION['user_id'])) {
        $response = array('success' => false, 'message' => 'User not logged in.');
        echo json_encode($response);
        exit();
    }

    $account_login = $_SESSION['user_id'];

    // Check if the time slot already exists for another record
    $checkSql = "SELECT * FROM `timeslot` WHERE time_from = '$time_from' AND time_to = '$time_to' AND timeslot_id != '$timeslot_id'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // Time slot already exists for another record
        $response = array('success' => false, 'message' => 'The time slot already exists for another record!');
        echo json_encode($response);
        exit();
    }

    // Construct SQL query for UPDATE
    $sql = "UPDATE `timeslot` 
            SET 
                time_from = '$time_from',
                time_to = '$time_to'
            WHERE timeslot_id = '$timeslot_id'";

    // Execute SQL query
    if (mysqli_query($conn, $sql)) {
        $activity = "Edited a Timeslot ID: $timeslot_id";
        $log_sql = "INSERT INTO `activity_logs` (user_id, actions) 
                VALUES ('$account_login', '$activity')";
        mysqli_query($conn, $log_sql);

        // Time slot updated successfully
        $response = array('success' => true, 'message' => 'Timeslot updated successfully!');
        echo json_encode($response);
        exit();
    } else {
        // Error updating timeslot
        $response = array('success' => false, 'message' => 'Error updating Timeslot: ' . mysqli_error($conn));
        echo json_encode($response);
        exit();
    }
}
