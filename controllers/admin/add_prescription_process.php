<?php
session_start();
include '../../connections/connections.php';

if (isset($_POST['add_prescription'])) {
  // Get form data
  $prescription_notes = $conn->real_escape_string($_POST['prescription_notes']);
  $pet_id = $conn->real_escape_string($_POST['pet_id']);
  $user_id = $conn->real_escape_string($_POST['user_id']);

  if (!isset($_SESSION['user_id'])) {
    $response = array('success' => false, 'message' => 'User not logged in.');
    echo json_encode($response);
    exit();
  }

  $account_login = $_SESSION['user_id'];

  // Construct SQL query
  $sql = "INSERT INTO `prescription` (prescription_notes, pet_id, user_id)
          VALUES ('$prescription_notes', '$pet_id', '$user_id')";

  // Execute SQL query
  if (mysqli_query($conn, $sql)) {

    // ✅ Insert into activity_logs
    $activity = "Added a Prescrition Notes to Pet ID: $pet_id";
    $log_sql = "INSERT INTO `activity_logs` (user_id, actions) 
                VALUES ('$account_login', '$activity')";
    mysqli_query($conn, $log_sql);

    // Supplier added successfully
    $response = array('success' => true, 'message' => 'Prescription Added successfully!');
    echo json_encode($response);
    exit();
  } else {
    // Error adding supplier
    $response = array('success' => false, 'message' => 'Error Adding Prescription!: ' . mysqli_error($conn));
    echo json_encode($response);
    exit();
  }
}
