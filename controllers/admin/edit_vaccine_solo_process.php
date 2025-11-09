<?php
session_start();
include '../../connections/connections.php';

if (isset($_POST['edit_vaccination'])) {

  $vaccination_id = $conn->real_escape_string($_POST['vaccination_id']);
  $vaccine_id = $conn->real_escape_string($_POST['vaccine_id']);
  $expiration_date = $conn->real_escape_string($_POST['expiration_date']);

  if (!isset($_SESSION['user_id'])) {
    $response = array('success' => false, 'message' => 'User not logged in.');
    echo json_encode($response);
    exit();
  }

  $account_login = $_SESSION['user_id'];

  $sql = "UPDATE `vaccination` 
          SET 
            vaccine_id = '$vaccine_id',
            expiration_date = '$expiration_date'
            
          WHERE vaccination_id = '$vaccination_id'";

  if (mysqli_query($conn, $sql)) {

    $activity = "Edited a Vaccine, ID: $vaccination_id";
    $log_sql = "INSERT INTO `activity_logs` (user_id, actions) 
                VALUES ('$account_login', '$activity')";
    mysqli_query($conn, $log_sql);

    $response = array('success' => true, 'message' => 'Vaccination updated successfully!');
    echo json_encode($response);
    exit();
  } else {
    $response = array('success' => false, 'message' => 'Error updating Vaccination: ' . mysqli_error($conn));
    echo json_encode($response);
    exit();
  }
}
