<?php
session_start();
include '../../connections/connections.php';

if (!isset($_SESSION['user_id'])) {
  echo json_encode([]);
  exit();
}

// Query appointments with LEFT JOIN on users table
$sql = "SELECT a.*, u.user_fullname
        FROM appointment AS a
        LEFT JOIN users AS u ON a.user_id = u.user_id
        WHERE a.notification = '1'
        ORDER BY a.updated_at DESC
        LIMIT 10";

$result = mysqli_query($conn, $sql);

$rows = [];

if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {

    // Format updated_at
    $row['updated_at'] = date("F d Y h:i A", strtotime($row['updated_at']));

    // Prepare fullname
    $fullname = $row['user_fullname'] ?? "The user";

    // Initialize message and redirect_url
    $message = "";
    $redirect_url = "";

    // Updated wording
    switch ($row['appointment_status']) {
      case 'Pending':
      case 'Booked':
        $message = "$fullname appointment has been updated to $row[appointment_status].";
        $redirect_url = "appointment_request_module.php";
        break;

      case 'Ongoing':
        $message = "$fullname appointment has been updated to Ongoing.";
        $redirect_url = "appointment_approved_module.php";
        break;

      case 'Completed':
      case 'Cancelled':
        $message = "$fullname appointment has been updated to $row[appointment_status].";
        $redirect_url = "appointment_archive_module.php";
        break;

      default:
        $message = "$fullname appointment has been updated.";
        $redirect_url = "#"; // default fallback
    }

    $row['message'] = $message;
    $row['redirect_url'] = $redirect_url;

    $rows[] = $row;
  }
}

echo json_encode($rows);
