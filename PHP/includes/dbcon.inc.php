<?php

$dsn = "mysql:host=localhost;dbname=school";
$dbusername = "root";
$dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}

if (!function_exists('getAllStudents')) {
    function getAllStudents()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM student");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
