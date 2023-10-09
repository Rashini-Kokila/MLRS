<?php
//include("session.php");
include("../dbConnection.php");

$db= new DatabaseConnection;

if(isset($_POST["post"])){
    $fullName=SanitizeValues($_REQUEST['fullName']);
    $email=SanitizeValues($_REQUEST['email']);
    $phone=SanitizeValues($_REQUEST['phone']);
    $address=SanitizeValues($_REQUEST['address']);
    $location=SanitizeValues($_REQUEST['location']);
    $coverLetter=SanitizeValues($_REQUEST['coverLetter']);

    // Retrieve user input (PDF title and file)
    
    $pdfFileName =SanitizeValues( $_FILES["resume"]["name"]);
    $pdfFileTmpName = $_FILES["resume"]["tmp_name"];

    // Read the file content
    $pdfContent = file_get_contents($pdfFileTmpName);


    if(empty($err)){
        //insert questions to the databse
        $last_update=date("Y-m-d h:i:s");
        $is_expired=0;
        //enter employer details
        $q_insert_employer_det=("INSERT INTO jobseekers (`name`,`email`,`phone_no`,`address`,`district_id`,`resume`,`cover`,`last_update`,`is_expired`) 
        VALUES ('$fullName','$email','$phone','$address','$location','$pdfFileName','$coverLetter','$last_update','$is_expired')");
        //echo  $q_insert_employer_det;
        $r_q_insert_employer_det = mysqli_query($db->con, $q_insert_employer_det);//check query
        if($r_q_insert_employer_det) {
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
                    <a href="jobseeker_main.php" class="nav-item nav-link active">Find Jobs</a>
                    <a href="../testimonial.php" class="nav-item nav-link">Testimonial</a>
                    <a href="job-list.php" class="nav-item nav-link active">Jobs-list </a>
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
                <a href="Employer/emp_main.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Employers/Post Job<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->
        <!-- job seeker details -->
        <div class="container mt-5">
            <h1>Job Application Form</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="formi" enctype="multipart/form-data">
                <div class="row g-3">
                    <!-- Personal Information -->
                    <div class="col-12">
                        <input type="text" class="form-control" id="fullName" placeholder="Full Name" name="fullName" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="email" class="form-control" placeholder="Your Email" name="email">
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="tel" class="form-control" placeholder="Phone Number" id="phone" name="phone" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="text" class="form-control" id="address" placeholder="Enter your permanent address" name="address" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <select class="form-select form-control" id="searchableDropdown" name="location">
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

                    <!-- Resume Upload -->
                    <div class="col-12 ">
                        <label for="resume" class="form-label">Resume (PDF or Word)</label>
                        <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                    </div>

                    <!-- Cover Letter -->
                    <div class="mb-3">
                        <label for="coverLetter" class="form-label">Cover Letter</label>
                        <textarea class="form-control" id="coverLetter" name="coverLetter" rows="4" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" name="post">Submit Application</button>
                </div>
            </form>
        </div>
        <div class="container mt-3">
        <h3>Qualifications</h3>
        <p>We use these details to show you jobs that match your unique skills and experience.</P>
            <!-- first Button to Open the Modal -->
                <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#myModal">
                add most resent work experience
                <i class="bi bi-plus"></i>
                </button>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Modal Heading</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Modal body..
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            <!-- second Button to Open the Modal -->
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#myModal">
            add education
            <i class="bi bi-plus"></i>
            </button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Modal body..
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Third Button to Open the Modal -->
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#myModal">
            add skill
            <i class="bi bi-plus"></i>
            </button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Modal body..
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- 4th Button to Open the Modal -->
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#myModal">
            add licenses
            <i class="bi bi-plus"></i>
            </button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Modal body..
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- fifth Button to Open the Modal -->
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#myModal">
            add sertifications
            <i class="bi bi-plus"></i>
            </button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Modal body..
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- sixth Button to Open the Modal -->
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#myModal">
            add languages
            <i class="bi bi-plus"></i>
            </button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Modal body..
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-3">
            <h3>Job Preferences</h3>
            <p>Tell us the job details you’re interested in to get better recommendations across Indeed.</P>
            <!-- 7th Button to Open the Modal -->
                <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#myModal">
                add job types
                <i class="bi bi-plus"></i>
                </button>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Modal Heading</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Modal body..
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            <!-- 8th Button to Open the Modal -->
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#myModal">
            add work schedule
            <i class="bi bi-plus"></i>
            </button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Modal body..
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- 9th Button to Open the Modal -->
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#myModal">
            add pay
            <i class="bi bi-plus"></i>
            </button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Modal body..
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- job seeker details -->
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