<?php
session_start();
include '../../connections/connections.php';

if (isset($_POST['delete_prescription'])) {
  // Get form data
  $prescription_id = $conn->real_escape_string($_POST['prescription_id']);

  // Construct SQL query to delete the particular item
  $sql = "DELETE FROM `prescription` 
          WHERE prescription_id = '$prescription_id'";

  if (!isset($_SESSION['user_id'])) {
    $response = array('success' => false, 'message' => 'User not logged in.');
    echo json_encode($response);
    exit();
  }

  $account_login = $_SESSION['user_id'];
  // Execute SQL query
  if (mysqli_query($conn, $sql)) {

    // ✅ Insert into activity_logs
    $activity = "Deleted a Prescrition Notes, Prescription ID: $prescription_id";
    $log_sql = "INSERT INTO `activity_logs` (user_id, actions) 
                VALUES ('$account_login', '$activity')";
    mysqli_query($conn, $log_sql);

    // Particular deleted successfully
    $response = array('success' => true, 'message' => 'Prescription deleted successfully!');
    echo json_encode($response);
    exit();
  } else {
    // Error deleting particulars
    $response = array('success' => false, 'message' => 'Error deleting Prescription: ' . mysqli_error($conn));
    echo json_encode($response);
    exit();
  }
} else {
  // Invalid request
  $response = array('success' => false, 'message' => 'Invalid request!');
  echo json_encode($response);
  exit();
}
