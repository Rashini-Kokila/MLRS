<?php
//include("session.php");
include("../dbConnection.php");

$db= new DatabaseConnection;
$err=array();
$filename='';

if(isset($_POST["submit"])){
    $category_id = SanitizeValues($_REQUEST['category_id']);
    $jobTitle = SanitizeValues($_REQUEST['jobTitle']);
    $district_id = SanitizeValues($_REQUEST['district_id']);
    $location=SanitizeValues($_REQUEST['location']);
    $nofEmployees=SanitizeValues($_REQUEST['nofEmployees']);
    $jobNature=SanitizeValues($_REQUEST['jobNature']);
    $salaryRate=SanitizeValues($_REQUEST['salaryRate']);
    $startingDate=SanitizeValues($_REQUEST['startingDate']);
    $jobDescription = SanitizeValues($_REQUEST['jobDes']);
    $responsibility =SanitizeValues($_REQUEST['responsibility']);
    $qualifications=SanitizeValues($_REQUEST['qualifications']);

    if(empty($err)){
        //insert questions to the databse
        $is_expired=0;
        $last_update=date("Y-m-d h:i:s");
        $pathToImages = "Employer_img/";
        $pathToThumbs = "Employer_img/thumbs/";
        //enter job details
        $q_insert_job_det=("INSERT INTO jobs ( `category_id`,`title`,`district_id`,`location`, `nof_employee`,`nature`,`salary_rate`,`starting_date`,`jobDescription`,`responsibility`,`qualifications`,`is_expired`,`last_update`) 
        VALUES ('$category_id','$jobTitle','$district_id','$location','$nofEmployees','$jobNature','$salaryRate','$startingDate','$jobDescription','$responsibility','$qualifications','$is_expired','$last_update')");
        // echo  $q_insert_job_det;
        $r_q_insert_job_det = mysqli_query($db->con, $q_insert_job_det);//check query
        if($r_q_insert_job_det) {
            //$last_quiz_id = $db->con->insert_id;
            //echo "Entries added!<br>";      
        }else {
            //echo "Entries  cannot added<br>";
        }   
        //header("Location:emp_main.php");
        //exit();  
    }

}
//Sanitize values
function SanitizeValues($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manual labor recruitment system</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">JobFair</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="emp_main.php" class="nav-item nav-link active">Post a Job</a>
                    <a href="candidates.php" class="nav-item nav-link">Find candidates</a>
                    <div class="nav-item dropdown no-arrow">
                        <li>
                            <a class="nav-link" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge bg-primary">7</span>
                            </a>
                        </li>
                    </div>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge bg-primary">3+</span>
                        </a>
                    </li>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                            <img class="img-profile rounded-circle"
                                src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </div>
                <a href="../candidate/jobseeker_main.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Find Job<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->
        <div class="container mt-5">
            <h1>Create an employer account</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="formi" enctype="multipart/form-data">
                <div class="row g-3">
                    <!-- Job Information -->
                    <h3> Add job basics</h3>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter Job Title</label>
                        <input type="text" class="form-control" id="address" placeholder="Driver" name="jobTitle" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter Job Category</label>
                        <select class="form-select form-control" data-live-search="true" name="category_id">
                            <?php
                            //get categories
                                $q_get_category="SELECT * FROM categories";
                                $result_q_get_category =mysqli_query($db->con, $q_get_category);
                            ?>
                            <option selected>Category</option>
                            <?php
                            if($result_q_get_category->num_rows > 0){
                                while($row_category= $result_q_get_category->fetch_assoc()){
                                    echo '<option value="'.$row_category["id"].'">'.$row_category["category_name"].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter Job District</label>
                        <select class="form-select form-control" id="searchableDropdown" name="district_id">
                            <?php
                            //get categories
                                $q_get_location="SELECT * FROM districts";
                                $result_q_get_location =mysqli_query($db->con, $q_get_location);
                            ?>
                            
                            <?php
                            if($result_q_get_location->num_rows > 0){
                                while($row_location= $result_q_get_location->fetch_assoc()){
                                    echo '<option value="'.$row_location["id"].'">'.$row_location["name_en"].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter Job Location</label>
                        <input type="text" class="form-control" id="location" placeholder="Pelawatta , Battaramulla" name="location" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Job Nature</label>
                        <select id="jobNature" name="jobNature" class="form-select form-control">
                            <option value="Full time">Full time</option>
                            <option value="Part time">Part time</option>
                            <option value="Temporary">Temporary</option>
                            <option value="Contract">Contract</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter Salary rate</label>
                        <input type="text" class="form-control" id="address" placeholder="Rs.1000.00-Rs.10000.00" name="salaryRate" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter number of employees</label>
                        <input type="number" class="form-control" id="address" placeholder="0" name="nofEmployees" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter job starting date</label>
                        <input type="date" class="form-control" id="date" placeholder="" name="startingDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="jobDes" class="form-label">Job Description</label>
                        <textarea class="form-control" id="coverLetter" name="jobDes" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jobDes" class="form-label">Job responsiblity</label>
                        <textarea class="form-control" id="coverLetter" name="responsibility" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jobDes" class="form-label">Qualifications</label>
                        <textarea class="form-control" id="coverLetter" name="qualifications" rows="4" required></textarea>
                    </div>
                    <!-- Submit Button -->
                    <div class="mb-3">
                        <input class="btn btn-primary" type="submit" value="Submit Application" name="submit" />
                    </div>
                </div>
            </form>
        </div>

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">JobFair</a>, All Right Reserved.
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>