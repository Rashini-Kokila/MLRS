<?php

?><!DOCTYPE html>
<html>
    <head>
        <title>Registration Page</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <style>
        .errorc{color:#FF0000;}
        </style>
      </head>
    <body style="background-color: #00B074;">
      <section class="vh-100">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <form class="mx-1 mx-md-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="myform">
                        <div class=" d-flex justify-content-center align-items-center">
                            <a class="btn btn-primary py-3 px-5" href="register.php?status=<?php echo "1";?>">Employer</a>
                        </div>
                        <div class=" d-flex justify-content-center align-items-center">
                            <p>or</P>
                        </div>
                        <div class=" d-flex justify-content-center align-items-center">
                            <a class="btn btn-primary py-3 px-5" href="register.php?status=<?php echo "0";?>">Job Seeker</a>
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
    </body>
</html>