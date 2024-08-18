<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST['firstName']);
    $email = trim($_POST['email']);
    $type = trim($_POST['type']);

    // Error checks
    if (empty($firstName) || empty($email) || empty($type)) {
        $_SESSION['error'] = "Please fill in all fields";
        header("Location: ../adminDashboard.php?error=" . urlencode($error));
        exit;
    }

    try {
        require_once "dbcon.inc.php";

        if ($type === 'teacher') {
            $query = "DELETE FROM teacher WHERE firstName=? AND email=?";
        } elseif ($type === 'student') {
            $query = "DELETE FROM student WHERE firstName=? AND email=?";
        } else {
            throw new Exception("Invalid type");
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute([$firstName, $email]);

        $pdo = null;
        $stmt = null;

        $_SESSION['message'] = 'Deletion successful';
        header("Location: ../adminDashboard.php?message=" . urlencode($_SESSION['message']));
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: ../adminDashboard.php?error=" . urlencode($_SESSION['error']));
        exit;
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: ../adminDashboard.php?error=" . urlencode($_SESSION['error']));
        exit;
    }
} else {
    header("Location: ../adminDashboard.php");
    exit;
}
?>