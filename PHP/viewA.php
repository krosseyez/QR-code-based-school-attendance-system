<?php
require_once 'includes/config.inc.php';
require_once 'includes/dbcon.inc.php';

// Check if the user is logged in and is a student
if (!isset($_SESSION['student_id'])) {
    die("You must be logged in to view your attendance.");
}

$studentID = $_SESSION['student_id'];

// Fetch student details
$query = "SELECT firstName, lastName FROM student WHERE studentID = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$studentID]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Student not found.");
}

// Fetch attendance details
$query = "SELECT a.date, a.duration, a.status, c.className 
          FROM attendance a
          JOIN classes c ON a.classID = c.classID
          WHERE a.studentID = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$studentID]);
$attendances = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total and absent hours
$totalHours = 0;
$absentHours = 0;

foreach ($attendances as $attendance) {
    $totalHours += $attendance['duration'];
    if ($attendance['status'] == 'absent') {
        $absentHours += $attendance['duration'];
    }
}

$absentPercentage = $totalHours > 0 ? ($absentHours / $totalHours) * 100 : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance</title>
    <link rel="stylesheet" href="..\CSS\styleD.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container flex-lg-column">
            <a class="navbar-brand mx-lg-auto mb-lg-4" href="#">
                <span class="h4 fw-bold" style="color:black;">PgLang University</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto flex-lg-column text-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="includes/logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="content-wrapper">

<section class="full-height px-lg-5">
<div class="container">
    <div class="row">
        <div class="col-12">
        <h2>Attendance for <?php echo htmlspecialchars($student['firstName'] . ' ' . $student['lastName']); ?></h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Duration (hours)</th>
                    <th>Class</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendances as $attendance): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($attendance['date']); ?></td>
                        <td><?php echo htmlspecialchars($attendance['duration']); ?></td>
                        <td><?php echo htmlspecialchars($attendance['className']); ?></td>
                        <td><?php echo htmlspecialchars($attendance['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Attendance Summary</h3>
        <p>Total Hours: <?php echo $totalHours; ?></p>
        <p>Absent Hours: <?php echo $absentHours; ?></p>
        <p>Absent Percentage: <?php echo number_format($absentPercentage, 2); ?>%</p>

        <a href="includes/download.inc.php?studentID=<?php echo urlencode($studentID); ?>" class="btn btn-success">Download PDF</a>
        <a href="stdDashboard.php" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
</div>
</section>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
