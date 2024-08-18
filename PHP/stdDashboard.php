<?php
require_once 'includes/config.inc.php';
require_once 'includes/dbcon.inc.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="../CSS/aos.css" />
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
                        <a class="nav-link" href="#genQR">QR Code</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#attendance">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
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
                            data-aos="fade-up">Student Dashboard</h1>
                    </div>
                    <div class="col-12 d-flex justify-content-center align-item-center">
                        <p>Incase of any issues contact Us.</p>
                        <a href="#" class="link-custom">.......Call: (233) 3454 2342</a>
                    </div>
                </div>
            </div>
        </section>
        <!--//HOME-->

        <!--QR CODE-->
        <section id="genQR" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center" data-aos="fade-up">
                    <h1 class="text-brand">QR Code</h1>
                    <div class="row">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <h6 class="text-brand">To take attendance press the generate button to preview your QR code
                            </h6>
                            <form id="qrForm" action="includes/generate.inc.php" method="post">
                                <button type="button" class="btn btn-brand fw-bold" onclick="generateQRCode()">Generate
                                    QR Code</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--//QR CODE-->

        <!--ATTENDNACE-->
        <section id="attendance" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center " data-aos="fade-up">
                    <h1 class="text-brand">Attendance</h1>
                    <div class="row ">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <h6 class="text-brand">View your attendance</h6>
                            <a href="viewA.php" class="btn btn-brand fw-bold">View Attendance</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--//STUDENT-->
    </div>

    <!--//CONTENT WRAPPER-->
    <script>
        function generateQRCode() {
            document.getElementById('qrForm').submit();
        }
    </script>

    <script src="../JS/aos.js"></script>
    <script src="../JS/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

</body>

</html>