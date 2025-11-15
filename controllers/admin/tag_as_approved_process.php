<?php
session_start();
include '../../connections/connections.php';

if (isset($_POST['tag_as_approved'])) {

  // Get appointment_id and user_id
  $appointment_id = $conn->real_escape_string($_POST['appointment_id']);


  if (!isset($_SESSION['user_id'])) {
    $response = array('success' => false, 'message' => 'User not logged in.');
    echo json_encode($response);
    exit();
  }
  $user_id = $_SESSION['user_id'];

  // Construct SQL query for UPDATE
  $sql = "UPDATE `appointment` 
          SET 
              appointment_status = 'Ongoing',
              `notification` = '1'
          WHERE appointment_id = '$appointment_id'";

  // Execute SQL query
  if (mysqli_query($conn, $sql)) {

    // ✅ Insert into activity_logs
    $activity = "Tagged appointment ID #$appointment_id as Ongoing";
    $log_sql = "INSERT INTO `activity_logs` (user_id, actions) 
                VALUES ('$user_id', '$activity')";
    mysqli_query($conn, $log_sql);

    // User updated successfully
    $response = array('success' => true, 'message' => 'Tag as Ongoing successfully!');
    echo json_encode($response);
    exit();
  } else {
    // Error updating user
    $response = array('success' => false, 'message' => 'Error Tagging: ' . mysqli_error($conn));
    echo json_encode($response);
    exit();
  }
}
