<?php
include './../../connections/connections.php';

// Initialize total
$total_data = 0;

if (isset($_POST['searchAppointmentReports'])) {
  $date_from = $_POST['date_from'];
  $date_to = $_POST['date_to'];
  $category_id = trim($_POST['category_id']);

  if ($date_from && $date_to && $category_id) {

    // Use DATE() to compare just the date portion
    /$query = "SELECT COUNT(a.appointment_id) AS total_count
                  FROM appointment a
                  LEFT JOIN category c ON a.category_id = c.category_id
                  WHERE DATE(a.appointment_date) BETWEEN '$date_from' AND '$date_to'";

    // Filter by category if not "All"
    if ($category_id !== 'All') {
      $query .= " AND a.category_id = '$category_id'";
    }

    $result = $conn->query($query);

    if ($result) {
      $data = $result->fetch_assoc();
      $total_data = $data['total_count'] ?? 0;
    } else {
      // Debug SQL error
      // echo "SQL Error: " . $conn->error;
    }
  }
}

// Format total
$formatted_data = number_format($total_data);

// Return JSON
echo json_encode(['total_data' => $formatted_data]);
