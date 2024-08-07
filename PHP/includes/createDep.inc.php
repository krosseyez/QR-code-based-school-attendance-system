<?php
require_once 'config.inc.php';
require_once 'dbcon.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departmentName = $_POST['departmentName'];
    $departmentDescription = $_POST['departmentDescription'];

    // Error checks
    if (empty($departmentName) || empty($departmentDescription)) {
        $error = "Please fill in all fields";
        header("Location: ../adminDashboard.php?error=" . urlencode($error));
        exit;
    }

    try {
        $query = "INSERT INTO departments (departmentName, departmentDescription) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$departmentName, $departmentDescription]);

        $_SESSION['message'] = 'Department created successfully.';
        header("Location: ../adminDashboard.php?message=" . urlencode($_SESSION['message']));
        exit;
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            $error = "Department name already exists";
            header("Location: ../adminDashboard.php?error=" . urlencode($error));
        } else {
            $error = "Error: " . $e->getMessage();
            header("Location: ../adminDashboard.php?error=" . urlencode($error));
        }
        exit;
    }
} else {
    header("Location: ../adminDashboard.php");
    exit;
}
?>
