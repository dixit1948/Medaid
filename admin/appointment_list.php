<?php
// Database connection
$cn = new mysqli("localhost", "root", "", "medical_db");
if ($cn->connect_error) {
    die("Database connection failed: " . $cn->connect_error);
}

// Fetch all appointments
$sql = "SELECT id, first_name, last_name, phone, date_time, department, doctor, message 
        FROM appointments 
        ORDER BY date_time DESC";
$result = $cn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Appointment List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4 text-center">📅 All Appointments</h2>

  <table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Patient Name</th>
        <th>Phone</th>
        <th>Date & Time</th>
        <th>Department</th>
        <th>Doctor</th>
        <th>Message</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['first_name'] . " " . $row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['date_time']) ?></td>
            <td><?= htmlspecialchars($row['department']) ?></td>
            <td><?= htmlspecialchars($row['doctor']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="7" class="text-center text-danger">❌ No appointments found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>

<?php $cn->close(); ?>