<?php
require('../vendor/setasign/fpdf/fpdf.php');
include '../connections/connections.php';

// Start the session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Clinic Name
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 8, 'Vet ng Concepcion', 0, 1, 'C');

// Subtitle or address (optional)
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 6, 'Official Appointment Report', 0, 1, 'C');


$pdf->Ln(10);
// ---------------------- DATE RANGE ----------------------
$pdf->SetFont('Arial', 'B', 9);  // Set bold font for labels
$pdf->Cell(20, 5, 'Printed By: ', 0, 0);
// Format the dates
$user_in_session = isset($_SESSION['user_fullname']) ? $_SESSION['user_fullname'] : null;

$pdf->SetFont('Arial', '', 9);  // Set regular font for the variable value
$pdf->Cell(0, 5, $user_in_session, 0, 1);

// Helper function to replace empty values with '-'
function checkEmpty($value)
{
  return empty($value) ? '-' : $value;
}

// Fetch Paid records from the database
$query = $conn->query("SELECT * FROM activity_logs
LEFT JOIN users ON activity_logs.user_id = users.user_id");

$totalAmountPaid = 0;
$pdf->Ln(15);

// ---------------------- TABLE HEADER ----------------------
$pdf->SetFillColor(220, 220, 220); // Light gray background
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 5, 'ID', 1, 0, 'C', true);
$pdf->Cell(110, 5, 'Actions', 1, 0, 'C', true);
$pdf->Cell(40, 5, 'User', 1, 0, 'C', true);
$pdf->Cell(30, 5, 'Timestamp', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 8);

// ---------------------- TABLE CONTENT ----------------------
while ($row = $query->fetch_assoc()) {
  $activity_log_id = checkEmpty($row['activity_log_id']);
  $actions = checkEmpty($row['actions']);
  $user_fullname = checkEmpty($row['user_fullname']);
  $date_created = checkEmpty($row['date_created']);



  $pdf->Cell(15, 5, $activity_log_id, 1, 0, 'C');
  $pdf->Cell(110, 5, $actions, 1, 0, 'C');
  $pdf->Cell(40, 5, $user_fullname, 1, 0, 'C');
  $pdf->Cell(30, 5, $date_created, 1, 1, 'C');
}

// Spacer
$pdf->Ln(1);

// ---------------------- FOOTER (optional) ----------------------
// You can add page numbers or any footer info
$pdf->SetY(-15);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 10, 'Vet ng Concepcion - Generated on ' . date('M d, Y'), 0, 0, 'C');

// Output the PDF to the browser
$pdf->Output();

exit();
