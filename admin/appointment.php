<?php
$cn = new mysqli("localhost", "root", "", "medical_db");
if ($cn->connect_error) {
    die("Database connection failed: " . $cn->connect_error);
}

$first_name = $_POST["first_name"] ?? '';
$last_name  = $_POST["last_name"] ?? '';
$phone      = $_POST["phone"] ?? '';
$date_time  = $_POST["date"] ?? '';  
$date_time = date("d-m-y H:i:s", strtotime($user_date)); 
$department = $_POST["department"] ?? '';
$doctor     = $_POST["doctor"] ?? '';
$message    = $_POST["message"] ?? '';


$sql = "INSERT INTO appointments
(first_name, last_name, phone, date_time, department, doctor, message)
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $cn->prepare($sql);

$stmt->bind_param("sssssss",
    $first_name,
    $last_name,
    $phone,
    $date_time,
    $department,
    $doctor,
    $message
);

if ($stmt->execute()) {
    echo "✅ Appointment saved successfully!";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$cn->close();
?>