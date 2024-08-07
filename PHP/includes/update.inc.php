<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $type = trim($_POST['type']);
    $pwd = trim($_POST['pwd']);

    // Error checks
    if (empty($firstName) || empty($lastName) || empty($email) || empty($type) || empty($pwd)) {
        $_SESSION['error'] = "Please fill in all fields";
        header("Location: ../adminDashboard.php?error=" . urlencode($_SESSION['error']));
        exit;
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
        header("Location: ../adminDashboard.php?error=" . urlencode($_SESSION['error']));
        exit;
    }

    // Hash the password
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);

    try {
        require_once "dbcon.inc.php";

        if ($type === 'teacher') {
            $query = "UPDATE teacher SET email=?, pwd=? WHERE firstName=? AND lastName=?";
        } elseif ($type === 'student') {
            $query = "UPDATE student SET email=?, pwd=? WHERE firstName=? AND lastName=?";
        } else {
            throw new Exception("Invalid type");
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute([$email, $hashedPwd, $firstName, $lastName]);

        $pdo = null;
        $stmt = null;

        $_SESSION['message'] = 'Update successful';
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
