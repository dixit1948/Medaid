<?php
// 🏥 Database connection
$conn = new mysqli("localhost", "root", "", "medical_db");
if ($conn->connect_error) {
    die("Database connection failed");
}
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"] ?? '';
    $last_name  = $_POST["last_name"] ?? '';
    $phone      = $_POST["phone"] ?? '';
    $department = $_POST["department"] ?? '';
    $doctor     = $_POST["doctor"] ?? '';
    $message    = $_POST["message"] ?? '';
    $user_date  = $_POST["date"] ?? '';
    $date_time  = date("Y-m-d H:i:s", strtotime($user_date));

    if (!empty($user_date)) {
        $date_time = date("Y-m-d H:i:s", strtotime($user_date));
    }else{
        echo "Please select a valid appointment date and time.";
        exit;
    }

    // 🔍 Check if same date & time already exists
    $check_sql = "SELECT id FROM appointments WHERE date_time = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $date_time);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // ❌ Already booked
        $error = "This time slot is already booked. Please choose another time.";
    }$stmt->close();
        // ✅ Insert new appointment
         $sql = "INSERT INTO appointments (first_name, last_name, phone, date_time, department, doctor, message) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $first_name, $last_name, $phone, $date_time, $department, $doctor, $message);

    if ($stmt->execute()) {
        echo "OK"; 
        if ($stmt->execute()) {
            $success = "Appointment successfully booked!";
        } else {
            $error = "Database error: " . $stmt->error;
        }
    $stmt->close();
}
}
$conn->close();
?>
