<?php
require_once 'config.inc.php';
require_once 'dbcon.inc.php';
require_once '../../phpqrcode/qrlib.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['student_id'])) {
    echo "User not logged in!";
    exit;
}

$studentId = $_SESSION['student_id'];
$stmt = $pdo->prepare("SELECT studentID, lastName FROM student WHERE studentID = ?");
$stmt->execute([$studentId]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    echo "Student not found!";
    exit;
}

$uniqueData = $student['studentID'] . '_' . $student['lastName'];
$qrDir = '../qrcodes';
if (!file_exists($qrDir)) {
    mkdir($qrDir, 0777, true);
}
$qrFilePath = "{$qrDir}/{$uniqueData}.png";
QRcode::png($uniqueData, $qrFilePath, QR_ECLEVEL_L, 10, 2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../CSS/styleD.css" />
    <title>QRCode</title>
</head>
<body>
<section id="attendance" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center " data-aos="fade-up">
                    <h1 class="text-brand">QR Code</h1>
                    <div class="row ">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <img src="<?php echo $qrFilePath; ?>" alt="QR Code" class="img-fluid" style="max-width: 300px; margin: 20px auto;">
                            <br>
                            <button type="button" class="btn btn-brand fw-bold"><a href="../stdDashboard.php">Return to Dashboard</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</body>
</html>


