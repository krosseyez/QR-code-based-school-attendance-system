<?php
require_once 'config.inc.php';
require_once 'dbcon.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classID = trim($_POST['class']);
    $studentID = trim($_POST['student']);
    $attendance = trim($_POST['attendance']);
    $duration = trim($_POST['duration']);
    $date = trim($_POST['date']);

    // Error checks
    if (empty($classID) || empty($studentID) || empty($attendance) || empty($duration) || empty($date)) {
        $error = "All fields are required!";
        header("Location: ../tchDashboard.php?error=" . urlencode($error));
        exit;
    }

    try {
        // Prepare and execute the SQL statement
        $query = "INSERT INTO attendance (classID, studentID, date, status, duration) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$classID, $studentID, $date, $attendance, $duration]);

        // Set success message
        $_SESSION['message'] = 'Attendance marked successfully.';
        header('Location: ../tchDashboard.php?message=' . urlencode($_SESSION['message']));
        exit;
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            $error = "Attendance already marked for this date";
        } else {
            $error = "Error: " . $e->getMessage();
        }
        header('Location: ../tchDashboard.php?error=' . urlencode($error));
        exit;
    }
} else {
    // Redirect if the request method is not POST
    header('Location: ../tchDashboard.php');
    exit;
}
