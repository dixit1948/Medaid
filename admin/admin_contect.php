<?php
$cn = new mysqli("localhost", "root", "", "medical_db");
if ($cn->connect_error) {
    die("Database connection failed: " . $cn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

$sql = "INSERT INTO contacts (name, email, subject, message)
VALUES (?, ?, ?, ?)";

$stmt = $cn->prepare($sql);

$stmt->bind_param("ssss",
    $name,
    $email,
    $subject,
    $message
);

if ($stmt->execute()) {
    echo "✅ Your message has been sent. Thank you!";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$cn->close();
?>