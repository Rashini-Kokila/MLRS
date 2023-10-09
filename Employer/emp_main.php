<?php
include("../session.php");
include("../dbConnection.php");

$db= new DatabaseConnection;
$err=array();
$filename='';

if(isset($_POST["submit"])){
    $cName=SanitizeValues($_REQUEST['cName']);
    $fullName=SanitizeValues($_REQUEST['fullName']);
    $email=SanitizeValues($_REQUEST['email']);
    $phone=SanitizeValues($_REQUEST['phone']);
    $address=SanitizeValues($_REQUEST['address']);
   
    //image
    $filename = SanitizeValues($_FILES["image"]["name"]);
    if(!empty($filename)){
        $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
        $maxsize = 2 * 1024 * 1024;
        $tempname = $_FILES["image"]["tmp_name"];
        $file_size = $_FILES['image']['size'];
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

        $imgProperties = getimagesize($tempname);
        $img_type=$imgProperties[2];

        if(!in_array(strtolower($file_ext), $allowed_types)) {
            $err['image']="({$file_ext} file type is not allowed)<br / >";
        }
        // Verify file size - 2MB max
        if ($file_size > $maxsize) {
            $err['image']= "Error: File size is larger than the allowed limit.";
        }
    }
    
    if(empty($err)){
        //insert questions to the databse
        $last_update=date("Y-m-d h:i:s");
        $pathToImages = "Employer_img/";
        $pathToThumbs = "Employer_img/thumbs/";

        if(!empty($tempname)){    
            if($img_type==IMAGETYPE_JPEG){
                $source=imagecreatefromjpeg($tempname);
                $resizeImg = image_resize($source,$imgProperties[0],$imgProperties[1]);
                imagegif($resizeImg,$pathToThumbs.$filename);
            }elseif ($img_type == IMAGETYPE_PNG ) {
                $source = imagecreatefrompng($tempname);            
                $resizeImg = image_resize($source,$imgProperties[0],$imgProperties[1]);
                imagepng($resizeImg,$pathToThumbs.$filename);
            } elseif ($img_type == IMAGETYPE_GIF ) {
                $source = imagecreatefromgif($tempname);
                $resizeImg = image_resize($source,$imgProperties[0],$imgProperties[1]);
                imagegif($resizeImg,$pathToThumbs.$filename);
            }
            // move the uploaded image into the folder: image
            if (!move_uploaded_file($tempname,$pathToImages.$filename)) {
                echo "<h3>  Failed to upload image!</h3>";
            }
        }
        //$modified_by=$_SESSION['id'];
        $is_expired=0;
        //enter employer details
        $q_insert_employer_det=("INSERT INTO employers ( `company_name`, `name`,`email`,`contact_no`,`address`,`logo`,`last_update`,`is_expired`) 
        VALUES ('$cName','$fullName','$email','$phone','$address','$filename','$last_update','$is_expired')");
        //echo  $q_insert_employer_det;
        $r_q_insert_employer_det = mysqli_query($db->con, $q_insert_employer_det);//check query
        if($r_q_insert_employer_det) {
            //$last_quiz_id = $db->con->insert_id;
            //echo "Entries added!<br>";      
        }else {
            //echo "Entries  cannot added<br>";
        }    
        header("Location:Post-job.php");
        exit();  
    }
   
}
//Sanitize values
function SanitizeValues($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//create canvas for image
function image_resize($source,$width,$height) {
    $new_width =800;
    $new_height =600;
    $thumbImg=imagecreatetruecolor($new_width,$new_height);
    imagecopyresampled($thumbImg,$source,0,0,0,0,$new_width,$new_height,$width,$height);
    return $thumbImg;
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
                <a href="../home.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Find Job<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="../img/pic-1.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Hire the right person for your business</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">
                                            No matter the skills, experience, or qualifications you’re 
                                            looking for, you’ll find the right people on Indeed’s matching and hiring platform.</p>
                                    <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->

        <div class="container mt-5">
            <h1>Create an employer account</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="formi" enctype="multipart/form-data">
                <div class="row g-3">
                    <!-- Employer Information -->
                    <div class="col-12">
                        <label for="companyName" class="form-label">Enter your company name or Your family name</label>
                        <input type="text" class="form-control" id="companyName" placeholder="Achievz pvt ltd / Rajapaksha" name="cName" required>
                    </div>
                    <div class="col-12">
                        <label for="companyName" class="form-label">Enter your name or resposible person's name</label>
                        <input type="text" class="form-control" id="fullName" placeholder="R.Mahindanda" name="fullName" required>
                    </div>

                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter email</label>
                        <input type="email" class="form-control" placeholder="example@gmail.com" name="email">
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter mobile number</label>
                        <input type="tel" class="form-control" placeholder="077 0000 000" id="phone" name="phone" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter address</label>
                        <input type="text" class="form-control" id="address" placeholder="No.00, main street, colomba" name="address" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="companyName" class="form-label">Enter Company Logo / Employer Image</label>
                        <input type="file" id="image" name="image" class="form-control " placeholder="Enter image " />
                    </div>
                    <!-- Submit Button -->
                    <div class="col-12">
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