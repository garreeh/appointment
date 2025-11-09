<?php
session_start();
include '../../connections/connections.php';

if (isset($_POST['edit_category'])) {

  $category_id = $conn->real_escape_string($_POST['category_id']);
  $category_name = $conn->real_escape_string($_POST['category_name']);
  $price = $conn->real_escape_string($_POST['price']);
  if (!isset($_SESSION['user_id'])) {
    $response = array('success' => false, 'message' => 'User not logged in.');
    echo json_encode($response);
    exit();
  }

  $account_login = $_SESSION['user_id'];

  $sql = "UPDATE `category` 
          SET 
            category_name = '$category_name',
            price = '$price'
          WHERE category_id = '$category_id'";

  if (mysqli_query($conn, $sql)) {

    $activity = "Edited a Category, Category ID: $category_id, changed into: $category_name";
    $log_sql = "INSERT INTO `activity_logs` (user_id, actions) 
                VALUES ('$account_login', '$activity')";
    mysqli_query($conn, $log_sql);

    $response = array('success' => true, 'message' => 'Service updated successfully!');
    echo json_encode($response);
    exit();
  } else {
    $response = array('success' => false, 'message' => 'Error updating Service: ' . mysqli_error($conn));
    echo json_encode($response);
    exit();
  }
}
