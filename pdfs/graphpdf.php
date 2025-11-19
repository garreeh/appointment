<?php
include '../connections/connections.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Get parameters from URL
$date_from = isset($_GET['date_from']) ? $conn->real_escape_string($_GET['date_from']) : null;
$date_to = isset($_GET['date_to']) ? $conn->real_escape_string($_GET['date_to']) : null;
$category_id = isset($_GET['category_id']) ? $conn->real_escape_string($_GET['category_id']) : 'All';

if (!$date_from || !$date_to) {
  die('Error: Missing date range.');
}

// Fetch appointments grouped by date, category, timeslot, and status
$sql = "SELECT DATE(a.appointment_date) AS appointment_date, c.category_name, t.time_from, t.time_to, a.appointment_status, COUNT(*) AS total
        FROM appointment a
        LEFT JOIN category c ON a.category_id = c.category_id
        LEFT JOIN timeslot t ON a.timeslot_id = t.timeslot_id
        WHERE a.appointment_date BETWEEN '$date_from' AND '$date_to'";

if ($category_id !== 'All') {
  $sql .= " AND a.category_id = '$category_id'";
}

$sql .= " GROUP BY DATE(a.appointment_date), c.category_name, t.time_from, t.time_to, a.appointment_status
          ORDER BY DATE(a.appointment_date) ASC";

$result = mysqli_query($conn, $sql);

// Prepare arrays for Chart.js
$dates = [];
$dataByCombination = [];
$totalByDate = []; // <-- to store total appointments per date

while ($row = mysqli_fetch_assoc($result)) {
  $formattedDate = date("M d, Y", strtotime($row['appointment_date']));
  $category = $row['category_name'];
  $timeslot = $row['time_from'] && $row['time_to']
    ? date("h:i A", strtotime($row['time_from'])) . '-' . date("h:i A", strtotime($row['time_to']))
    : 'N/A';
  $status = $row['appointment_status'];
  $count = $row['total'];

  // Dataset key
  $key = $category . ' | ' . $timeslot . ' | ' . $status;

  if (!in_array($formattedDate, $dates)) {
    $dates[] = $formattedDate;
  }

  if (!isset($dataByCombination[$key])) {
    $dataByCombination[$key] = [];
  }

  $dataByCombination[$key][$formattedDate] = $count;

  // Add to total per date
  if (!isset($totalByDate[$formattedDate])) {
    $totalByDate[$formattedDate] = 0;
  }
  $totalByDate[$formattedDate] += $count;
}

// Fill missing dates with 0
foreach ($dataByCombination as $key => $counts) {
  foreach ($dates as $d) {
    if (!isset($dataByCombination[$key][$d])) {
      $dataByCombination[$key][$d] = 0;
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Appointments Graph</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: Arial;
      padding: 20px;
    }

    #chart-container {
      width: 90%;
      max-width: 1000px;
      margin: auto;
    }

    table {
      width: 90%;
      margin: 20px auto;
      border-collapse: collapse;
      text-align: center;
    }

    table,
    th,
    td {
      border: 1px solid #ddd;
    }

    th,
    td {
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h2 style="text-align:center;">Appointments Graph by Category, Timeslot & Status</h2>
  <div id="chart-container">
    <canvas id="myChart"></canvas>
  </div>

  <!-- Total Appointments Table -->
  <h3 style="text-align:center;">Total Appointments by Date</h3>
  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Total Appointments</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dates as $d): ?>
        <tr>
          <td><?php echo $d; ?></td>
          <td><?php echo $totalByDate[$d]; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script>
    const labels = <?php echo json_encode($dates); ?>;
    const rawData = <?php echo json_encode($dataByCombination); ?>;

    function generateColors(count) {
      const arr = [];
      for (let i = 0; i < count; i++) {
        arr.push(`hsl(${(i * 50) % 360}, 70%, 55%)`);
      }
      return arr;
    }

    const combinations = Object.keys(rawData);
    const colors = generateColors(combinations.length);

    const datasets = combinations.map((combo, i) => ({
      label: combo,
      data: labels.map(date => rawData[combo][date] || 0),
      backgroundColor: colors[i],
      borderColor: colors[i],
      borderWidth: 1
    }));

    const ctx = document.getElementById('myChart').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: datasets
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
            position: 'bottom'
          },
        },
        scales: {
          x: {
            stacked: true
          },
          y: {
            beginAtZero: true,
            stacked: true
          }
        }
      }
    });
  </script>
</body>

</html>