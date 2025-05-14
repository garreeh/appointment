<?php
include '../../connections/connections.php';

// Get the billing_id from the URL
$billing_id = $_POST['billing_id'] ?? null;

if (!$billing_id) {
  echo json_encode(['success' => false, 'message' => 'Missing or invalid billing ID']);
  exit;
}

// Sanitize to integer
$billing_id = intval($billing_id);

// Direct query (without prepared statements)
$query = "SELECT payment_status FROM billing WHERE billing_id = $billing_id";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo json_encode(['success' => true, 'payment_status' => $row['payment_status']]);
} else {
  echo json_encode(['success' => false, 'message' => 'Billing record not found']);
}
