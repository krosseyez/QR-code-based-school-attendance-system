<?php
require_once 'config.inc.php';
require_once 'dbcon.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classID = trim($_POST['class']);
    $teacherID = trim($_POST['teacher']);
    $termName = trim($_POST['termName']);

    // Debugging output
    echo "Class ID: $classID\n";
    echo "Teacher ID: $teacherID\n";
    echo "Term Name: $termName\n";

    // Error checks
    if (empty($classID) || empty($teacherID) || empty($termName)) {
        $error = "All fields are required!";
        echo $error;
        header("Location: ../createTerm.php?error=" . urlencode($error)); // Corrected redirection
        exit;
    }

    try {
        // Prepare and execute the SQL statement
        $query = "INSERT INTO class_versions (classID, teacherID, term) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$classID, $teacherID, $termName]);

        // Set success message
        $_SESSION['message'] = 'Term created successfully.';
        echo $_SESSION['message'];
        header('Location: ../adminDashboard.php?message=' . urlencode($_SESSION['message'])); // Corrected redirection
        exit;
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            $error = "Term already exists";
        } else {
            $error = "Error: " . $e->getMessage();
        }
        echo $error;
        header('Location: ../createTerm.php?error=' . urlencode($error)); // Corrected redirection
        exit;
    }
} else {
    // Redirect if the request method is not POST
    header('Location: ../createTerm.php'); // Corrected redirection
    exit;
}
