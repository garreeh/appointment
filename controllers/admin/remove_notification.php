<?php
session_start();
include '../../connections/connections.php';

if (!isset($_SESSION['user_id'])) {
  echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
  exit();
}

// Check if appointment_id is provided
if (!isset($_POST['appointment_id'])) {
  echo json_encode(['status' => 'error', 'message' => 'Missing appointment ID']);
  exit();
}

$appointment_id = intval($_POST['appointment_id']);

// Update notification to 0
$sql = "UPDATE appointment 
        SET notification = 0 
        WHERE appointment_id = $appointment_id";

if (mysqli_query($conn, $sql)) {
  echo json_encode(['status' => 'success']);
} else {
  echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
}
