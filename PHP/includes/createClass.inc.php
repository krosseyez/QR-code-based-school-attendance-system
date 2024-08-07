<?php
require_once 'config.inc.php';
require_once 'dbcon.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $className = trim($_POST['className']);
    $departmentID = trim($_POST['department']);

    // Error checks
    if (empty($className) || empty($departmentID)) {
        $error = "All fields are required!";
        header("Location: createClass.php?error=" . urlencode($error));
        exit;
    }

    try {
        // Prepare and execute the SQL statement
        $query = "INSERT INTO classes (className, departmentID) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$className, $departmentID]);

        // Set success message
        $_SESSION['message'] = 'Class created successfully.';
        header('Location: ../adminDashboard.php?message=' . urlencode($_SESSION['message']));
        exit;
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            $error = "Class name already exists";
        } else {
            $error = "Error: " . $e->getMessage();
        }
        header('Location: createClass.php?error=' . urlencode($error));
        exit;
    }
} else {
    // Redirect if the request method is not POST
    header('Location: createClass.php');
    exit;
}
?>
