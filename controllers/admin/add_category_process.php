<?php
session_start();

include '../../connections/connections.php';

if (isset($_POST['add_category'])) {
  // Get form data
  $category_name = $conn->real_escape_string($_POST['category_name']);
  $price = $conn->real_escape_string($_POST['price']);

  if (!isset($_SESSION['user_id'])) {
    $response = array('success' => false, 'message' => 'User not logged in.');
    echo json_encode($response);
    exit();
  }

  $account_login = $_SESSION['user_id'];


  // Construct SQL query
  $sql = "INSERT INTO `category` (category_name, price)
          VALUES ('$category_name', '$price')";

  // Execute SQL query
  if (mysqli_query($conn, $sql)) {

    $activity = "Added a Category, Category Name: $category_name";
    $log_sql = "INSERT INTO `activity_logs` (user_id, actions) 
                VALUES ('$account_login', '$activity')";
    mysqli_query($conn, $log_sql);

    // Supplier added successfully
    $response = array('success' => true, 'message' => 'Service Added successfully!');
    echo json_encode($response);
    exit();
  } else {
    // Error adding supplier
    $response = array('success' => false, 'message' => 'Error Adding Service!: ' . mysqli_error($conn));
    echo json_encode($response);
    exit();
  }
}
