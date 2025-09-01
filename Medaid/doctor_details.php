<?php
// session_start();

// // Check if admin is logged in
// if (!isset($_SESSION['admin'])) {
//     header("Location: login1.php");
//     exit();
// }

$conn = new mysqli("localhost", "root", "", "medical_db");
//if ($conn->connect_error) {
  //  die("Connection failed: " . $conn->connect_error);
//}

// Approve Booking
//if (isset($_GET['approve'])) {
  //  $id = $_GET['approve'];
    //$conn->query("UPDATE bookings SET status='Approved' WHERE id=$id");
    //header("Location: managebooking.php");
//}

// Reject Booking
//if (isset($_GET['reject'])) {
  //  $id = $_GET['reject'];
    //$conn->query("UPDATE bookings SET status='Rejected' WHERE id=$id");
    //header("Location: managebooking.php");
//}

// Delete Booking
//if (isset($_GET['delete'])) {
  //  $id = $_GET['delete'];
    //$conn->query("DELETE FROM bookings WHERE id=$id");
    //header("Location: managebooking.php");
//}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Details- Admin</title>
    <style>
        body { font-family: Arial; margin: 20px; background: #f4f4f4; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        .btn { padding: 5px 10px; border-radius: 5px; text-decoration: none; }
        .approve { background: green; color: white; }
        .reject { background: orange; color: white; }
        .delete { background: red; color: white; }
    </style>
</head>
<body>

<h2>Doctor Details</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Qualification</th>
        <th>Specialization</th>
        <th>Experience</th>
        <th>Fees</th>
        <th>Img</th>
        
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM doctor_details");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['Name']}</td>
                <td>{$row['Qualification']}</td>
                <td>{$row['Specialization']}</td>
                <td>{$row['Experience']}</td>
                <td>{$row['Fees']}</td>
                <td>{$row['Img']}</td>
                
              </tr>";
    }
    ?>
</table>

</body>
</html>