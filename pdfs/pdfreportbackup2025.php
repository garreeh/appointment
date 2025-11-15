<?php
require('../vendor/setasign/fpdf/fpdf.php');
include '../connections/connections.php';

// Start the session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$category_id = isset($_GET['category_id']) ? $conn->real_escape_string($_GET['category_id']) : null;
$date_from = isset($_GET['date_from']) ? $conn->real_escape_string($_GET['date_from']) : null;
$date_to = isset($_GET['date_to']) ? $conn->real_escape_string($_GET['date_to']) : null;

// Validate dates
if (!$date_from || !$date_to) {
  die('Error: Missing date range.');
}

// Build base query
$sql = "SELECT * FROM appointment WHERE appointment_date BETWEEN '$date_from' AND '$date_to'";

// Add category filter only if it's not "All"
if ($category_id !== 'All') {
  $sql .= " AND category_id = '$category_id'";
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $appointment_id = $row['appointment_id'];
    $queue_number = $row['queue_number'];
    $appointment_date = $row['appointment_date'];
    $appointment_status = $row['appointment_status'];
  }
} else {
  echo "No records found.";
}

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Add Logo (optional)
// $pdf->Image('./../assets/logo/header.png', 10, 6, 190, 23); // Increase width to 100 and height to 50
// Add smaller logo

// Line break
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);  // Set bold font for labels
$pdf->Cell(40, 5, 'Report Date Range: ', 0, 0);
// Format the dates
$formatted_from = date("M d, Y", strtotime($date_from));
$formatted_to = date("M d, Y", strtotime($date_to));

$pdf->SetFont('Arial', '', 9);  // Set regular font for the variable value
$pdf->Cell(0, 5, $formatted_from . ' - ' . $formatted_to, 0, 1);

// Line break

// Helper function to replace empty values with '-'
function checkEmpty($value)
{
  return empty($value) ? '-' : $value;
}

// Fetch Paid records from the database
$query = $conn->query("SELECT * FROM appointment 
                       LEFT JOIN users ON appointment.user_id = users.user_id
                       LEFT JOIN pets ON appointment.user_id = pets.pet_id
                       LEFT JOIN timeslot ON appointment.timeslot_id = timeslot.timeslot_id
                       LEFT JOIN category ON appointment.category_id = category.category_id
                       WHERE appointment_date BETWEEN '$date_from' AND '$date_to'");

// Add category filter only if it's not "All"
if ($category_id !== 'All') {
  $sql .= " AND category_id = '$category_id'";
}

$totalAmountPaid = 0;
$pdf->Ln(15);

// $pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(0, 8, 'All Paid PDC', 0, 1, 'C'); // Title for Paid Transactions
// $pdf->Ln(1);

$pdf->SetFillColor(220, 220, 220); // Light gray background
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(25, 5, 'Appointment #', 1, 0, 'C', true);
$pdf->Cell(25, 5, 'Queue #', 1, 0, 'C', true);
$pdf->Cell(40, 5, 'Category', 1, 0, 'C', true);
$pdf->Cell(30, 5, 'Timeslot', 1, 0, 'C', true);
$pdf->Cell(30, 5, 'Appointment Date', 1, 0, 'C', true);
$pdf->Cell(30, 5, 'Status', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 8);

while ($row = $query->fetch_assoc()) {
  $appointment_id = checkEmpty($row['appointment_id']);
  $queue_number = checkEmpty($row['queue_number']);
  $category_name = checkEmpty($row['category_name']);

  // Format time_from and time_to to 12-hour with AM/PM
  $time_from = !empty($row['time_from']) ? date("h:i A", strtotime($row['time_from'])) : '';
  $time_to = !empty($row['time_to']) ? date("h:i A", strtotime($row['time_to'])) : '';

  $appointment_date_report = !empty($row['appointment_date'])
    ? date("M d, Y", strtotime($row['appointment_date']))
    : 'N/A';
  $appointment_status_specific = checkEmpty($row['appointment_status']);




  $pdf->Cell(25, 5, $appointment_id, 1, 0, 'C');
  $pdf->Cell(25, 5, $queue_number, 1, 0, 'C');
  $pdf->Cell(40, 5, $category_name, 1, 0, 'C');
  $pdf->Cell(30, 5, $time_from  . ' - ' . $time_to, 1, 0, 'C');
  $pdf->Cell(30, 5, $appointment_date_report, 1, 0, 'C');
  $pdf->Cell(30, 5, $appointment_status_specific, 1, 1, 'C');
}


// Spacer
$pdf->Ln(1);

// Output the PDF to the browser
// $pdf->Output('D', 'Statement of Account for ' . $client_name . '.pdf');

$pdf->Output();

exit();
