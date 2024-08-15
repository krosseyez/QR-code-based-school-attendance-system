<?php
require_once 'config.inc.php';
require_once 'dbcon.inc.php';
require_once '../../vendor/autoload.php'; // If using Composer for TCPDF

if (!isset($_GET['studentID'])) {
    die("Student ID is required.");
}

$studentID = $_GET['studentID'];

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

// Generate PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PgLang University');
$pdf->SetTitle('Student Attendance');
$pdf->SetSubject('Attendance Details');
$pdf->SetKeywords('Attendance, PDF, PgLang University');

// Set header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Add a page
$pdf->AddPage();

// Set content
$html = '<h2>Attendance for ' . htmlspecialchars($student['firstName'] . ' ' . $student['lastName']) . '</h2>';
$html .= '<table border="1" cellspacing="3" cellpadding="4">';
$html .= '<thead><tr>
            <th>Date</th>
            <th>Duration (hours)</th>
            <th>Class</th>
            <th>Status</th>
          </tr></thead><tbody>';

foreach ($attendances as $attendance) {
    $html .= '<tr>
                <td>' . htmlspecialchars($attendance['date']) . '</td>
                <td>' . htmlspecialchars($attendance['duration']) . '</td>
                <td>' . htmlspecialchars($attendance['className']) . '</td>
                <td>' . htmlspecialchars($attendance['status']) . '</td>
              </tr>';
}

$html .= '</tbody></table>';
$html .= '<h3>Attendance Summary</h3>';
$html .= '<p>Total Hours: ' . $totalHours . '</p>';
$html .= '<p>Absent Hours: ' . $absentHours . '</p>';
$html .= '<p>Absent Percentage: ' . number_format($absentPercentage, 2) . '%</p>';

// Write content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF
$pdf->Output('attendance_' . $studentID . '.pdf', 'D');
