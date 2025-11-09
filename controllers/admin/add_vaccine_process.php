<?php
session_start();
include '../../connections/connections.php';

if (isset($_POST['add_vaccine'])) {
  // Get form data
  $vaccine_name = $conn->real_escape_string($_POST['vaccine_name']);
  $price = $conn->real_escape_string($_POST['price']);
  if (!isset($_SESSION['user_id'])) {
    $response = array('success' => false, 'message' => 'User not logged in.');
    echo json_encode($response);
    exit();
  }

  $account_login = $_SESSION['user_id'];
  // Construct SQL query
  $sql = "INSERT INTO `vaccine` (vaccine_name, price)
          VALUES ('$vaccine_name', '$price')";

  // Execute SQL query
  if (mysqli_query($conn, $sql)) {
    $activity = "Added a Vaccination: $vaccine_name";
    $log_sql = "INSERT INTO `activity_logs` (user_id, actions) 
                VALUES ('$account_login', '$activity')";
    mysqli_query($conn, $log_sql);
    // Supplier added successfully
    $response = array('success' => true, 'message' => 'Vaccine Added successfully!');
    echo json_encode($response);
    exit();
  } else {
    // Error adding supplier
    $response = array('success' => false, 'message' => 'Error Adding Vaccine!: ' . mysqli_error($conn));
    echo json_encode($response);
    exit();
  }
}
