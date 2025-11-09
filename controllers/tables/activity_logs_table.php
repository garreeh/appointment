<?php

// Define table and primary key
$table = 'activity_logs';
$primaryKey = 'activity_log_id';
// Define columns for DataTables
$columns = array(
  array(
    'db' => 'activity_log_id',
    'dt' => 0,
    'field' => 'activity_log_id',
    'formatter' => function ($lab1, $row) {
      return $row['activity_log_id'];
    }
  ),

  array(
    'db' => 'actions',
    'dt' => 1,
    'field' => 'actions',
    'formatter' => function ($lab1, $row) {
      return $row['actions'];
    }
  ),

  array(
    'db' => 'user_fullname',
    'dt' => 2,
    'field' => 'user_fullname',
    'formatter' => function ($lab1, $row) {
      return $row['user_fullname'];
    }
  ),

  array(
    'db' => 'date_created',
    'dt' => 3,
    'field' => 'date_created',
    'formatter' => function ($lab1, $row) {
      return $row['date_created'];
    }
  ),

);

// Database connection details
include '../../connections/ssp_connection.php';

// Include the SSP class
require('../../assets/datatables/ssp.class.php');

$where = "activity_log_id";

// THIS IS A SAMPLE ONLY
$joinQuery = "FROM $table
              LEFT JOIN users ON $table.user_id = users.user_id";

// Fetch and encode JOIN AND WHERE
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where));

// Fetch and encode ONLY WHERE
// echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $where));
