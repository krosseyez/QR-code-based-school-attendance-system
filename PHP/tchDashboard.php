<?php
require_once 'includes/config.inc.php';
require_once 'includes/dbcon.inc.php';

$queryClasses = "SELECT classID, className FROM classes";
$stmtClasses = $pdo->prepare($queryClasses);
$stmtClasses->execute();
$classes = $stmtClasses->fetchAll(PDO::FETCH_ASSOC);

// Fetch students
$queryStudents = "SELECT studentID, firstName, lastName FROM student";
$stmtStudents = $pdo->prepare($queryStudents);
$stmtStudents->execute();
$students = $stmtStudents->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM student";
$stmt = $pdo->prepare($query);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="assets/css/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../CSS/styleD.css" />
    <title>Document</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!-- NAVBAR -->
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
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#attendance">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#qrcodeScan">Scan QRCode</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#view">View Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="includes/logout.php">Log Out</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- //NAVBAR -->

    <!--CONTENT WRAPPER-->
    <div class="content-wrapper">
        <!--HOME-->
        <section id="home" class="full-height px-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-4 fw-bold d-flex justify-content-center align-item-center "
                            data-aos="fade-up">Teachers Dashboard</h1>
                    </div>
                    <div class="col-12 d-flex justify-content-center align-item-center">
                        <p>Incase of any issues contact Us.</p>
                        <a href="#" class="link-custom">.......Call: (233) 3454 2342</a>
                    </div>
                </div>
            </div>
        </section>
        <!--//HOME-->

        <!--ATTENDANCE-->
        <section id="attendance" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center" data-aos="fade-up">
                    <h1 class="text-brand">Attendance</h1>
                    <div class="row">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <h6 class="text-brand">View your attendance</h6>
                            <form action="includes/mark.inc.php" method="post" class="row g-lg-3 gy-3">
                                <div class="form-group col-md-6">
                                    <select name="class" class="form-control">
                                        <option value="">Select a Class</option>
                                        <?php
                                        foreach ($classes as $class) {
                                            echo '<option value="' . htmlspecialchars($class['classID']) . '">' . htmlspecialchars($class['className']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select name="student" class="form-control">
                                        <option value="">Select a Student</option>
                                        <?php
                                        foreach ($students as $student) {
                                            echo '<option value="' . htmlspecialchars($student['studentID']) . '">'
                                                . htmlspecialchars($student['firstName'] . ' ' . $student['lastName']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duration">Duration (hours)</label>
                                    <input type="number" name="duration" class="form-control"
                                        placeholder="Enter duration in hours" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="attendance">Attendance</label>
                                    <select name="attendance" class="form-control">
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 d-grid">
                                    <button type="submit" class="btn btn-brand fw-bold">Submit</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--//ATTENDANCE-->

        <!--QRCODE SCAN-->
        <section id="qrcodeScan" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center" data-aos="fade-up">
                    <h1 class="text-brand">Mark Attendance</h1>
                    <div class="row">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <form id="attendanceForm" action="includes/mark_attendance.inc.php" method="post">
                                <div class="form-group">
                                    <label for="attendanceDate" class="text-brand">Select Date</label>
                                    <input type="date" id="attendanceDate" name="attendanceDate" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="classSelection" class="text-brand">Select Class</label>
                                    <select id="classSelection" name="classSelection" class="form-control" required>
                                        <option value="" disabled selected>Select a class</option>
                                        <?php
                                        foreach ($classes as $class) {
                                            echo '<option value="' . htmlspecialchars($class['classID']) . '">' . htmlspecialchars($class['className']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="duration" class="text-brand">Duration (hours)</label>
                                    <input type="number" id="duration" name="duration" class="form-control"
                                        placeholder="Enter duration in hours" required>
                                </div>
                                <button type="button" class="btn btn-brand fw-bold" onclick="startQRCodeScanner()">Scan
                                    QR Code</button>
                            </form>
                        </div>
                    </div>
                    <div id="qrScanner" style="display: none;">
                        <h2 class="text-brand">Scan QR Code</h2>
                        <video id="qrVideo" style="width: 100%;"></video>
                        <button type="button" class="btn btn-secondary mt-3"
                            onclick="closeQRCodeScanner()">Close</button>
                    </div>
                </div>
            </div>
        </section>
        <!--//QRCODE SCAN-->

        <!--VIEW ATTENDANCE-->
        <section id="view" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center" data-aos="fade-up">
                    <h1 class="text-brand">Mark Attendance</h1>
                    <div class="row">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($students as $student): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($student['studentID']); ?></td>
                                            <td><a
                                                    href="studentAtten.php?studentID=<?php echo htmlspecialchars($student['studentID']); ?>"><?php echo htmlspecialchars($student['firstName']); ?></a>
                                            </td>
                                            <td><?php echo htmlspecialchars($student['lastName']); ?></td>
                                            <td><?php echo htmlspecialchars($student['gender']); ?></td>
                                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--//VIEW ATTENDANCE-->





    </div>

    <!--//CONTENT WRAPPER-->
    <script>
        function startQRCodeScanner() {
            document.getElementById('qrcodeScan').style.display = 'block';
            document.getElementById('qrScanner').style.display = 'block';

            const codeReader = new ZXing.BrowserQRCodeReader();
            const videoElement = document.getElementById('qrVideo');

            codeReader.decodeFromVideoDevice(null, videoElement, (result, err) => {
                if (result) {
                    const [studentID, studentName] = result.text.split(','); // Assuming QR code data is "studentID,studentName"
                    document.getElementById('attendanceForm').innerHTML += `
                        <input type="hidden" name="studentID" value="${studentID}">
                        <input type="hidden" name="studentName" value="${studentName}">
                    `;
                    document.getElementById('attendanceForm').submit();
                }
                if (err instanceof ZXing.NotFoundException) {
                    console.error(err);
                }
            });
        }

        function closeQRCodeScanner() {
            document.getElementById('qrScanner').style.display = 'none';
        }

    </script>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script src="assets/js/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

</body>

</html>