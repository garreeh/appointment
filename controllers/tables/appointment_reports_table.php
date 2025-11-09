<?php

// Define table and primary key
$table = 'appointment';
$primaryKey = 'appointment_id';

// Define columns for DataTables
$columns = array(
  array(
    'db' => 'appointment_id',
    'dt' => 0,
    'field' => 'appointment_id',
    'formatter' => function ($lab1, $row) {
      return $row['appointment_id'];
    }
  ),

  array(
    'db' => 'queue_number',
    'dt' => 1,
    'field' => 'queue_number',
    'formatter' => function ($lab1, $row) {
      return $row['queue_number'];
    }
  ),

  array(
    'db' => 'category_name',
    'dt' => 2,
    'field' => 'category_name',
    'formatter' => function ($lab1, $row) {
      return $row['category_name'];
    }
  ),

  array(
    'db' => 'time_from',
    'dt' => 3,
    'field' => 'time_from',
    'formatter' => function ($lab1, $row) {
      // Return time_from - time_to
      return $row['time_from'] . ' - ' . $row['time_to'];
    }
  ),


  array(
    'db' => 'appointment_date',
    'dt' => 4,
    'field' => 'appointment_date',
    'formatter' => function ($lab1, $row) {
      // Get only the base name of the file (e.g., "something.pdf" from "./uploads/something.pdf")
      // return basename($row['files']);

      return $row['appointment_date'];
    }
  ),

  array(
    'db' => 'appointment_status', // Alias for the sales agent
    'dt' => 5,
    'field' => 'appointment_status',
    'formatter' => function ($lab1, $row) {
      return $row['appointment_status']; // Sales agent's full name
    }
  ),

  array(
    'db' => 'time_to', // Alias for the sales agent
    'dt' => 7,
    'field' => 'time_to',
    'formatter' => function ($lab1, $row) {
      return $row['time_to']; // Sales agent's full name
    }
  ),
);

// Database connection details
include '../../connections/ssp_connection.php';


// Include the SSP class
require('../../assets/datatables/ssp.class.php');

$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
// Fetch the date filters from the request
$dateFrom = isset($_GET['date_from']) ? $_GET['date_from'] : null;
$dateTo = isset($_GET['date_to']) ? $_GET['date_to'] : null;



// Build the where condition
$where = "appointment_date BETWEEN '$dateFrom' AND '$dateTo'";

if (!empty($category_id) && $category_id !== 'All') {
  $where .= " AND appointment.category_id = '$category_id'";
}

$joinQuery = "FROM $table 
              LEFT JOIN category ON $table.category_id = category.category_id
              LEFT JOIN timeslot ON $table.timeslot_id = timeslot.timeslot_id";


// Fetch and encode JOIN AND WHERE
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where));
