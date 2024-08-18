<?php
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params(1800, '/', 'localhost', true, true);

session_start();

require_once 'dbcon.inc.php';

function regenerate_session_id_loggedIn($userId)
{
    session_regenerate_id(true);
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $userId;
    session_id($sessionId);
    $_SESSION["last_regeneration"] = time();
}

function regenerate_session_id()
{
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}

if (isset($_SESSION['admin_id'])) {
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id_loggedIn($_SESSION['admin_id']);
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id_loggedIn($_SESSION['admin_id']);
        }
    }
} elseif (isset($_SESSION['student_id'])) {
    $studentId = $_SESSION['student_id'];
    $stmt = $pdo->prepare("SELECT studentID, firstName, lastName, email FROM student WHERE studentID = ?");
    $stmt->execute([$studentId]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        $_SESSION['student_data'] = $student;
    } else {
        echo "Student not found!";
        exit;
    }

    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
        }
    }
} else {
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
        }
    }
}
?>