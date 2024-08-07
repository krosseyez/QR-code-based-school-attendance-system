<?php
session_start(); // Start session at the beginning

require_once 'config.inc.php';
require_once 'dbcon.inc.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $user = $_POST["user"]; // Assuming user type is provided by the form

    // Check if all fields are filled
    if (empty($email) || empty($pwd) || empty($user)) {
        $error = "Please fill in all fields";
        header("Location:../index.php?error=$error");
        exit;
    }

    switch($user) {
        case 'admin':
            $query = "SELECT * FROM adminn WHERE email = :email AND pwd = :pwd";
            break;
        case 'student':
            $query = "SELECT * FROM student WHERE email = :email AND pwd = :pwd";
            break;
        case 'teacher':
            $query = "SELECT * FROM teacher WHERE email = :email AND pwd = :pwd";
            break;
        default:
            $error = "Invalid user type";
            header("Location:../index.php?error=$error");
            exit;
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $pwd);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // User exists, start session and redirect based on user type
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $_SESSION["user_id"] = $userData["{$user}ID"]; 
        $_SESSION["firstName"] = $userData["firstName"];
        $_SESSION["lastName"] = $userData["lastName"];
        $_SESSION["email"] = $email;

        switch($user) {
            case 'admin':
                header("Location:../adminDashboard.php");
                break;
            case 'student':
                $_SESSION["student_id"] = $userData["studentID"]; 
                header("Location:../stdDashboard.php");
                break;
            case 'teacher':
                $_SESSION["teacher_id"] = $userData["teacherID"]; 
                header("Location:../tchDashboard.php");
                break;
        }
        exit;
    } else {
        $error = "Invalid email or password";
        header("Location:../index.php?error=$error");
        exit;
    }
} else {
    // Redirect to index.php if accessed without form submission (optional)
    header("Location:../index.php");
    exit;
}
?>
