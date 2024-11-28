<?php

// Define table and primary key
$table = 'inside_billing';
$primaryKey = 'bill_id';
// Define columns for DataTables
$columns = array(
  array(
    'db' => 'items',
    'dt' => 0,
    'field' => 'items',
    'formatter' => function ($lab2, $row) {
      return $row['items'];
    }
  ),

  array(
    'db' => 'inside_billing.price',
    'dt' => 1,
    'field' => 'price',
    'formatter' => function ($lab4, $row) {
      return $row['price'];
      // return '<a href="../admin/inside_billing_module.php?billing_id=' . $row['bill_id'] . '&user_id=' . $row['user_id'] . '">' . $row['total'] . ' </a>';
    }
  ),

  // array(
  //   'db' => 'inside_billing.created_at',
  //   'dt' => 2,
  //   'field' => 'created_at',
  //   'formatter' => function ($lab5, $row) {
  //     return date('Y-m-d', strtotime($row['created_at']));
  //   }
  // ),

  array(
    'db' => 'bill_id',
    'dt' => 2,
    'field' => 'bill_id',
    'formatter' => function ($lab6, $row) {

      return '
      <div class="dropdown">
          <button class="btn btn-info" type="button" id="dropdownMenuButton' . $row['bill_id'] . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              &#x22EE;
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row['bill_id'] . '">
              <a class="dropdown-item fetchDataCategory" href="#" data-user-id="' . $row['bill_id'] . '">Delete</a>
          </div>
      </div>';
    }
  ),

  array(
    'db' => 'inside_billing.user_id',
    'dt' => 3,
    'field' => 'user_id',
    'formatter' => function ($lab2, $row) {
      return $row['user_id'];
    }
  ),

);

// Database connection details
include '../../connections/ssp_connection.php';

// Include the SSP class
require('../../assets/datatables/ssp.class.php');

$user_id = isset($_GET['user_id']) ? htmlspecialchars($_GET['user_id']) : 'Unknown User';

$where = "inside_billing.user_id = $user_id";

// THIS IS A SAMPLE ONLY
$joinQuery = "FROM $table
              LEFT JOIN users ON $table.user_id = users.user_id
              LEFT JOIN category ON $table.category_id = category.category_id
              LEFT JOIN vaccine ON $table.vaccine_id = vaccine.vaccine_id";

// Fetch and encode JOIN AND WHERE
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where));

// Fetch and encode ONLY WHERE
// echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $where));
