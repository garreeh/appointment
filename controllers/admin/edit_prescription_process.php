<?php
session_start();
include '../../connections/connections.php';

if (isset($_POST['edit_prescription'])) {

  $prescription_id = $conn->real_escape_string($_POST['prescription_id']);

  $prescription_notes = $conn->real_escape_string($_POST['prescription_notes']);

  if (!isset($_SESSION['user_id'])) {
    $response = array('success' => false, 'message' => 'User not logged in.');
    echo json_encode($response);
    exit();
  }

  $account_login = $_SESSION['user_id'];

  $sql = "UPDATE `prescription` 
          SET 
            prescription_notes = '$prescription_notes'
          WHERE prescription_id = '$prescription_id'";

  if (mysqli_query($conn, $sql)) {
    // ✅ Insert into activity_logs
    $activity = "Edited a Prescrition Notes to Prescription ID: $prescription_id";
    $log_sql = "INSERT INTO `activity_logs` (user_id, actions) 
                VALUES ('$account_login', '$activity')";
    mysqli_query($conn, $log_sql);

    $response = array('success' => true, 'message' => 'Prescription updated successfully!');
    echo json_encode($response);
    exit();
  } else {
    $response = array('success' => false, 'message' => 'Error updating Prescription: ' . mysqli_error($conn));
    echo json_encode($response);
    exit();
  }
}
