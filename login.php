<?php
include("dbConnection.php");

$db= new DatabaseConnection;
$err=array();
$id='';

  //var_dump($_COOKIE);
  if(isset($_COOKIE["user_login"])) {
    $value=$_COOKIE["user_login"];

    $q_get_cookie_data=("SELECT * FROM cookies_data WHERE cookie_det='".$value."'"); 
    $r_query_get_cookie_data=mysqli_query($db->con, $q_get_cookie_data);
    $row = $r_query_get_cookie_data->fetch_assoc();
    $user_id=$row['user_id'];

    $q_get_user_data = ("SELECT * FROM `user` WHERE id ='".$user_id."'");
    $r_query_get_user_data=mysqli_query($db->con, $q_get_user_data);
    $rs_query_get_user_data = mysqli_num_rows($r_query_get_user_data);
    $r_query_get_user_data = mysqli_fetch_array($r_query_get_user_data);
    if($rs_query_get_user_data){
      session_start();
      $_SESSION['email'] = $r_query_get_user_data['email'];
      $_SESSION['user_name'] = $r_query_get_user_data['user_name'];
      $_SESSION['user_id'] = $r_query_get_user_data['id'];
      header("Location:home.php");

    }
  }else{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email= $_REQUEST['email'];
      $password= $_REQUEST['password'];
      
      //validate email
      $email=SanitizeValues($email);
      if (empty($email)) {
        $err['email']="please enter your email here"; 
      }

      //validate password
      $password=SanitizeValues($password);
      if (empty($password)) {
        $err['password']="please enter your password here"; 
      }

      // Check Email/Username exists Or not
      $secure_pass = md5($password);
      $q_get_user_deta_for_check = "SELECT * FROM user 
      WHERE email='$email' AND password='$secure_pass'";
      $r_query_get_user_deta_for_check = mysqli_query($db->con, $q_get_user_deta_for_check);

      if (mysqli_num_rows($r_query_get_user_deta_for_check) == 1) {
        $row = mysqli_fetch_array($r_query_get_user_deta_for_check);
      }else{
        $err['email']="Check your email and password";
      }

      if(empty($err)){
        if ($row['email'] === $email && $row['password'] === $secure_pass) {
          echo "Logged in!";
          $id=$row['id'];
          session_start();
          $_SESSION['email'] = $row['email'];
          $_SESSION['user_name'] = $row['user_name'];
          $_SESSION['user_id'] = $row['id'];

          // Check user click or not click Remember me Checkbox Button
          if (isset($_POST['remember'])) { //if user click or checked checkbox then set cookies
            $spacialKey=$id."cookie##sdfdskljljeruyoe";
            setcookie('user_login',"$spacialKey",time()+60*60*24*30);
            //insert cookie details to the dtabase
              $sql =("INSERT INTO cookies_data (`cookie_det`,`id`) 
              VALUES ('$spacialKey','$id')");      
              $query = mysqli_query($db->con, $sql);//check query
              if($query) {
                echo "Entries added!<br>";
              }else {
                echo "Entries  cannot added<br>";
              }

          }else{
            if (isset($_COOKIE["user_login"])) {
              setcookie("user_login", "");
            }
            header("Location:home.php");

          }
          // redirect to welcome page
        header("Location: home.php");
        exit();
        }
      }
    }

  }
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
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                  <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                      <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                          <form class="mx-1 mx-md-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="myform">
                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>          
                                <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example3">User Name or Email</label>
                                <input type="email" id="form3Example3" name="email" class="form-control form-control-lg"
                                placeholder="Enter user name or email address" />
                                <span class="errorc">
                                  <?php echo $err['email']??'' ?>
                                </span>
                            </div>
                
                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="form3Example4">Password</label>
                                <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" />
                                <span class="errorc">
                                  <?php echo $err['password']??'' ?>
                                </span>
                            </div>
                
                            <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                                <div class="form-check mb-0">
                                    <input class="form-check-input me-2" name="remember" type="checkbox" value="" id="form2Example3" />
                                    <label class="form-check-label" for="form2Example3">
                                    Remember me
                                    </label>
                                </div>
                            </div>
                
                            <div class="text-center text-lg-start mt-4 pt-2">

                                <button type="submit" name ="submit" id="submit " value="submit" class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="register.php"
                                    class="link-danger">Register</a></p>
                            </div>
                                
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>

        <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </body>
</html>