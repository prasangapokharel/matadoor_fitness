<?php
// register.php

// Include database connection
include 'includes/db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $full_name = $_POST['full-name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact-number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $emergency_name = $_POST['emergency-name'];
    $emergency_phone = $_POST['emergency-phone'];
    $emergency_relationship = $_POST['emergency-relationship'];
    $fitness_level = $_POST['fitness-level'];
    $health_conditions = $_POST['health-conditions'];
    $fitness_goals = $_POST['fitness-goals'];
    $membership_type = $_POST['membership-type'];
    $training_sessions = $_POST['training-sessions'];
    $referral_source = $_POST['referral-source'];

    // Prepare and execute SQL query
    $sql = "INSERT INTO gym_registrations (full_name, dob, gender, contact_number, email, address, emergency_name, emergency_phone, emergency_relationship, fitness_level, health_conditions, fitness_goals, membership_type, training_sessions, referral_source) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssss", $full_name, $dob, $gender, $contact_number, $email, $address, $emergency_name, $emergency_phone, $emergency_relationship, $fitness_level, $health_conditions, $fitness_goals, $membership_type, $training_sessions, $referral_source);

    if ($stmt->execute()) {
        header("Location: registration?status=success");
    } else {
        header("Location: registration?status=error");
    }

    $stmt->close();
    $conn->close();
}
?>
