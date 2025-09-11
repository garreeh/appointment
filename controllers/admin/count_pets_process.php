<?php

$user_id = $_SESSION['user_id'];

// Query to get all pets owned by the user
$query = "SELECT * FROM pets WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

$pets = [];
if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $pets[] = $row;
  }
}

// Total pets count
$total_pets = count($pets);
