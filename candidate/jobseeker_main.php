<?php
include("../session.php");
include("../dbConnection.php");

$db= new DatabaseConnection;
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
            <a href="jobseeker_main.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
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
                <a href="../Employer/emp_main.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Employers/Post Job<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="../img/pic-3.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Find the perfect job that you deserved</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Find the best place to match your skills and experience level. </p>
                                    <a href="jobseeker_main.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                    <a href="../Employer/emp_main.php" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->
        <!-- Search Start -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="formi" enctype="multipart/form-data">
            <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
                <div class="container">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <select class="form-select border-0 selectpicker" data-live-search="true" name="nature">
                                        <option selected>Job Nature</option>
                                        <option value="Full time">Full time</option>
                                        <option value="Part time">Part time</option>
                                        <option value="Temporary">Temporary</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Internship">Internship</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select border-0 selectpicker" data-live-search="true" name="category">
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
                                <div class="col-md-4">
                                    <select class="form-select border-0" id="searchableDropdown" name="location">
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
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-dark border-0 w-100" name="search">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
            if (isset($_POST["search"])){
                $nature=$_POST["nature"];
                $category=$_POST["category"];
                $location=$_POST["location"];
                $q_get_job_details= "SELECT * FROM jobs WHERE nature='$nature' and category_id='$category' and district_id='$location 'and is_expired=0
                ORDER BY id DESC";
                //echo $q_get_job_details;
                $r_q_get_job_details =mysqli_query($db->con, $q_get_job_details);
                if ($r_q_get_job_details->num_rows> 0) {
                    while ($row = $r_q_get_job_details->fetch_assoc()) { 
            ?>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3"><?php echo $row['title']; ?></h5>
                                        <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo $row['location']; ?></span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?php echo $row['nature']; ?></span>
                                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?php echo $row['salary_rate']; ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="register.php?status=<?php echo "0";?>">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: <?php echo $row['starting_date']; ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                    }
                }
            }
        ?>

        <div class=" d-flex justify-content-center align-items-center">
            <h4 class="mb-4">Let employers find you</h4>
        </div>
        <div class=" d-flex justify-content-center align-items-center">
            <a class="btn btn-primary py-3 px-5" href="profile.php">Upload your resume</a>
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
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
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