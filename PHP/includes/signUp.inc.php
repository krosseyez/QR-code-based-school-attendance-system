<?php
require 'config.inc.php';
require 'dbcon.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);
    $type = trim($_POST['type']);
    $pwd = trim($_POST['pwd']);

    // Error checks
    if (empty($firstName) || empty($lastName) || empty($email) || empty($gender) || empty($type) || empty($pwd)) {
        $error = "Please fill in all fields";
        header("Location: ../adminDashboard.php?error=" . urlencode($_SESSION['error']));
        exit;
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
        header("Location: ../adminDashboard.php?error=" . urlencode($_SESSION['error']));
        exit;
    }

   

    try {
        if ($type === 'teacher') {
            $query = "INSERT INTO teacher (firstName, lastName, gender, email, pwd) VALUES (?, ?, ?, ?, ?)";
        } elseif ($type === 'student') {
            $query = "INSERT INTO student (firstName, lastName, gender, email, pwd) VALUES (?, ?, ?, ?, ?)";
        } else {
            throw new Exception("Invalid type");
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute([$firstName, $lastName, $gender, $email, $pwd]);

        $pdo = null;
        $stmt = null;

        $_SESSION['message'] = 'Sign-up successful';
        header("Location: ../adminDashboard.php?message=" . urlencode($_SESSION['message']));
        exit;
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            $error = "Email already exists";
            header("Location: ../adminDashboard.php?error=" . urlencode($_SESSION['error']));
        } else {
            $error = "Error: " . $e->getMessage();
             header("Location: ../adminDashboard.php?error=" . urlencode($_SESSION['error']));
        }
        exit;
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
         header("Location: ../adminDashboard.php?error=" . urlencode($_SESSION['error']));
        exit;
    }
} else {
    header("Location: ../adminDashboard.php");
    exit;
}
?>