<?php
require_once 'includes/config.inc.php';
require_once 'includes/dbcon.inc.php';

$query = "SELECT departmentID, departmentName FROM departments";
$stmt = $pdo->prepare($query);
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query2 = "SELECT classID, className FROM classes";
$stmt = $pdo->prepare($query2); // Corrected query variable name
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query3 = "SELECT teacherID, firstName , lastName FROM teacher";
$stmt = $pdo->prepare($query3); // Corrected query variable name
$stmt->execute();
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query4 = "
    SELECT 
        cv.versionID,
        cv.term,
        CONCAT(t.firstName, ' ', t.lastName) as teacherName,
        c.className
    FROM 
        class_versions cv
    JOIN 
        teacher t ON cv.teacherID = t.teacherID
    JOIN 
        classes c ON cv.classID = c.classID";
$stmt = $pdo->prepare($query4);
$stmt->execute();
$terms = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query5 = "SELECT studentID, firstName, lastName FROM student";
$stmt = $pdo->prepare($query5);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Admin Dashboard</title>
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
                        <a class="nav-link" href="#upUser">Update User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#delete">Delete User</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#createDepartment">Department</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#createClass">Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentList">Student List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="includes/logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- //NAVBAR -->

    <!-- CONTENT WRAPPER -->
    <div class="content-wrapper">
        <!-- CREATE USER -->
        <section id="home" class="full-height px-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-4 fw-bold d-flex justify-content-center align-item-center "
                            data-aos="fade-up">Admin Dashboard</h1>
                    </div>
                    <div class="col-12 d-flex justify-content-center align-item-center">
                        <p>In case of any issues contact Us.</p>
                        <a href="#" class="link-custom">.......Call: (233) 3454 2342</a>
                    </div>
                </div>
                
                <div class="justify-content-center text-center " data-aos="fade-up">
                    <h1 class="text-brand">Create a User</h1>
                    <div class="row ">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <h6 class="text-brand">CREATE</h6>
                            <form action="includes/signUp.inc.php" method="post" class="row g-lg-3 gy-3">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="firstName" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="lastName" placeholder="Last Name">
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="gender" class="form-control" placeholder="Gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="type" class="form-control">
                                        <option value="teacher">Teacher</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="password" name="pwd" class="form-control" placeholder="Password">
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
        <!-- //CREATE -->

        <!-- UPDATE USER -->
        <section id="upUser" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center " data-aos="fade-up">
                    <h1 class="text-brand">Update User Information</h1>
                    <div class="row">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <h6 class="text-brand">Update</h6>
                            <form action="includes/update.inc.php" method="post" class="row g-lg-3 gy-3">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="firstName" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="lastName" placeholder="Last Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="type" class="form-control">
                                        <option value="teacher">Teacher</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="form-group col-12">
                                    <input type="password" class="form-control" name="pwd" placeholder="Password">
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
        <!-- //UPDATE -->

        <!-- DELETE USER -->
        <section id="delete" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center " data-aos="fade-up">
                    <h1 class="text-brand">Delete User</h1>
                    <div class="row">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <h6 class="text-brand">Delete</h6>
                            <form action="includes/delete.inc.php" method="post" class="row g-lg-3 gy-3">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="firstName" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="lastName" placeholder="Last Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="type" class="form-control">
                                        <option value="teacher">Teacher</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
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
        <!-- //DELETE -->

        <!-- CREATE DEPARTMENT -->
        <section id="createDepartment" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center " data-aos="fade-up">
                    <h1 class="text-brand">Create Department</h1>
                    <div class="row">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <h6 class="text-brand">Create</h6>
                            <form action="includes/createDep.inc.php" method="post" class="row g-lg-3 gy-3">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" name="departmentName"
                                        placeholder="Department Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" name="departmentDescription"
                                        placeholder="Department Description"></textarea>
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
        <!-- //CREATE DEPARTMENT -->

        <!-- CREATE CLASSES -->
        <section id="createClass" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center " data-aos="fade-up">
                    <h1 class="text-brand">Create Class</h1>
                    <div class="row">
                        <div class="col-md-6 pb-4" data-aos="fade-up">
                            <h6 class="text-brand">Create Class</h6>
                            <form action="includes/createClass.inc.php" method="post" class="row g-lg-3 gy-3">
                                <div class="form-group col-12">
                                    <select name="department" class="form-control">
                                        <option value="">Select Department</option>
                                        <?php
                                        foreach ($departments as $department) {
                                            echo '<option value="' . htmlspecialchars($department['departmentID']) . '">' . htmlspecialchars($department['departmentName']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <input type="text" class="form-control" name="className" placeholder="Class Name">
                                    </div>
                                <div class="form-group col-12 d-grid">
                                    <button type="submit" class="btn btn-brand fw-bold">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 pb-4" data-aos="fade-up">
                            <h6 class="text-brand">Create Term</h6>
                            <form action="includes/createTerm.inc.php" method="post" class="row g-lg-3 gy-3">
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
                                    <select name="teacher" class="form-control">
                                        <option value="">Select a Teacher</option>
                                        <?php
                                        foreach ($teachers as $teacher) {
                                            echo '<option value="' . htmlspecialchars($teacher['teacherID']) . '">' . htmlspecialchars($teacher['firstName'] . ' ' . $teacher['lastName']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <input type="text" class="form-control" name="termName" placeholder="Term Name">
                                </div>
                                <div class="form-group col-12 d-grid">
                                    <button type="submit" class="btn btn-brand fw-bold">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pb-4" data-aos="fade-up">
                            <h6 class="text-brand">Enrollment</h6>
                            <form action="includes/enrollment.inc.php" method="post" class="row g-lg-3 gy-3">
                                <div class="form-group col-md-6">
                                    <select name="term" class="form-control">
                                        <option value="">Select a Term</option>
                                        <?php
                                        foreach ($terms as $term) {
                                            echo '<option value="' . htmlspecialchars($term['versionID']) . '">'
                                                . htmlspecialchars($term['term']) . ' - '
                                                . htmlspecialchars($term['teacherName']) . ' - '
                                                . htmlspecialchars($term['className']) . '</option>';
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
                                <div class="form-group col-12 d-grid">
                                    <button type="submit" class="btn btn-brand fw-bold">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- //CREATE CLASSES -->

        <!-- STUDENT LIST -->
        <section id="studentList" class="full-height px-lg-5">
            <div class="container">
                <div class="justify-content-center text-center " data-aos="fade-up">
                    <h1 class="text-brand">Student List</h1>
                    <div class="row">
                        <div class="col-12">
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
                                    <?php
                                    $students = getAllStudents();
                                    foreach ($students as $student) {
                                        echo "
                                <tr>
                                    <td>" . htmlspecialchars($student['studentID']) . "</td>
                                    <td>" . htmlspecialchars($student['firstName']) . "</td>
                                    <td>" . htmlspecialchars($student['lastName']) . "</td>
                                    <td>" . htmlspecialchars($student['gender']) . "</td>
                                    <td>" . htmlspecialchars($student['email']) . "</td>
                                </tr>
                                ";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //STUDENT LIST -->
    </div>
    <!-- //CONTENT WRAPPER -->

    <script src="../JS/aos.js"></script>
    <script src="../JS/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if (isset($_SESSION['message'])): ?>
                alert("<?php echo $_SESSION['message']; ?>");
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                alert("<?php echo $_SESSION['error']; ?>");
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        });
    </script>
</body>

</html>