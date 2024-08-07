<?php
require_once 'config.inc.php';
require_once 'dbcon.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $versionID = trim($_POST['term']);
    $studentID = trim($_POST['student']);

    // Error checks
    if (empty($versionID) || empty($studentID)) {
        $error = "All fields are required!";
        header("Location: ../createEnrollment.php?error=" . urlencode($error));
        exit;
    }

    try {
        // Prepare and execute the SQL statement
        $query = "INSERT INTO enrollment (studentID, versionID, enrollmentDate) VALUES (?, ?, NOW())";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$studentID, $versionID]);

        // Set success message
        $_SESSION['message'] = 'Student enrolled successfully.';
        header('Location: ../adminDashboard.php?message=' . urlencode($_SESSION['message']));
        exit;
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            $error = "Enrollment already exists";
        } else {
            $error = "Error: " . $e->getMessage();
        }
        header('Location: ../createEnrollment.php?error=' . urlencode($error));
        exit;
    }
} else {
    // Redirect if the request method is not POST
    header('Location: ../createEnrollment.php');
    exit;
}
