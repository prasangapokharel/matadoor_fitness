<?php
// register.php

// Include database connection
include 'includes/db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and handle missing fields
    $full_name = isset($_POST['full-name']) ? $_POST['full-name'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $contact_number = isset($_POST['contact-number']) ? $_POST['contact-number'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $emergency_phone = isset($_POST['emergency-phone']) ? $_POST['emergency-phone'] : ''; // Default to an empty string if not set
    $fitness_level = isset($_POST['fitness-level']) ? $_POST['fitness-level'] : '';
    $health_conditions = isset($_POST['health-conditions']) ? $_POST['health-conditions'] : '';
    $membership_type = isset($_POST['membership-type']) ? $_POST['membership-type'] : '';
    $training_sessions = isset($_POST['training-sessions']) ? $_POST['training-sessions'] : '';
    $referral_source = isset($_POST['referral-source']) ? $_POST['referral-source'] : '';

    // Prepare and execute SQL query
    $sql = "INSERT INTO gym_registrations (full_name, dob, gender, contact_number, email, address, emergency_phone, fitness_level, health_conditions, membership_type, training_sessions, referral_source) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $full_name, $dob, $gender, $contact_number, $email, $address, $emergency_phone, $fitness_level, $health_conditions, $membership_type, $training_sessions, $referral_source);

    if ($stmt->execute()) {
        header("Location: registration?status=success");
    } else {
        header("Location: registration?status=error");
    }

    $stmt->close();
    $conn->close();
}
?>
