<?php
session_start();
include '../../connections/connections.php';

if (!isset($_SESSION['user_id'])) {
  $response = array('success' => false, 'message' => 'User not logged in.');
  echo json_encode($response);
  exit();
}

$account_login = $_SESSION['user_id'];

if (isset($_POST['edit_vaccine'])) {

  $vaccine_id = $conn->real_escape_string($_POST['vaccine_id']);
  $vaccine_name = $conn->real_escape_string($_POST['vaccine_name']);
  $price = $conn->real_escape_string($_POST['price']);


  $sql = "UPDATE `vaccine` 
          SET 
            vaccine_name = '$vaccine_name',
            price = '$price'
          WHERE vaccine_id = '$vaccine_id'";

  if (mysqli_query($conn, $sql)) {

    $activity = "Edited a Vaccination, Vaccination ID: $vaccine_id";
    $log_sql = "INSERT INTO `activity_logs` (user_id, actions) 
                VALUES ('$account_login', '$activity')";
    mysqli_query($conn, $log_sql);

    $response = array('success' => true, 'message' => 'Vaccine updated successfully!');
    echo json_encode($response);
    exit();
  } else {
    $response = array('success' => false, 'message' => 'Error updating Vaccine: ' . mysqli_error($conn));
    echo json_encode($response);
    exit();
  }
}
