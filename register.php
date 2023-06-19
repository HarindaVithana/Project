<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $email = $_POST['youremail'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $type = "user";
    // Check if all fields are filled
    if (empty($name) || empty($nic) || empty($email) || empty($password) || empty($password2)) {
        echo "<div id='general'>";
        echo "One or more fields are not filled.";
        echo "</div>";
        exit(); // Stop further execution
    }

    // Check if passwords match
    if ($password !== $password2) {
        echo "<div id='general'>";
        echo "Passwords do not match.";
        echo "</div>";
        exit(); // Stop further execution
    }

    // Check if NIC is available in the database
    $nicQuery = "SELECT * FROM users WHERE nic = '$nic'";
    $nicResult = mysqli_query($con, $nicQuery);
    if (mysqli_num_rows($nicResult) > 0) {
        echo "<div id='general'>";
        echo "The provided NIC is already registered. Please choose a different one.";
        echo "</div>";
        
        mysqli_close($con);
        exit(); // Stop further execution
    } else

    $password_e = sha1($password);
    // Insert new user into the database
    $sql = "INSERT INTO users (name, nic, email, password,type) VALUES ('$name', '$nic', '$email', '$password_e','$type')";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }

    echo '<script type="text/javascript">'; 
    echo 'alert("Your account is created");'; 
    echo 'window.location.href = "/index.php";';
    echo '</script>';

    mysqli_close($con);
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Pages / Register - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <main>
      <div class="container">
        <section
          class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
        >
          <div class="container">
            <div class="row justify-content-center">
              <div
                class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
              >
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">
                        Create an Account
                      </h5>
                      <p class="text-center small">
                        Enter your personal details to create account
                      </p>
                    </div>

                    <form class="row g-3 needs-validation" novalidate action="" method="POST">
                      <div class="col-12">
                        <label for="yourName" class="form-label"
                          >Your Name</label
                        >
                        <input
                          type="text"
                          name="name"
                          class="form-control"
                          id="name"
                          required
                        />
                        <div class="invalid-feedback">
                          Please, enter your name!
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourEmail" class="form-label"
                          >National Identity card number</label
                        >
                        <input
                          type="text"
                          name="nic"
                          class="form-control"
                          id="nic"
                          required
                        />
                        <div class="invalid-feedback">
                          Please enter a valid National Identity card number!
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourEmail" class="form-label"
                          >Your Email</label
                        >
                        <input
                          type="email"
                          name="youremail"
                          class="form-control"
                          
                          required
                        />
                        <div class="invalid-feedback">
                          Please enter a valid Email adddress!
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label"
                          >Password</label
                        >
                        <input
                          type="password"
                          name="password"
                          class="form-control"
                          id="yourPassword"
                          required
                        />
                        <div class="invalid-feedback">
                          Please enter your password!
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="yourPassword" class="form-label"
                          >Confirm password</label
                        >
                        <input
                          type="password"
                          name="password2"
                          class="form-control"
                          id="password2"
                          required
                        />
                        <div class="invalid-feedback">
                          Please enter your password!
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            name="terms"
                            type="checkbox"
                            value=""
                            id="acceptTerms"
                            required
                          />
                          <label class="form-check-label" for="acceptTerms"
                            >I agree and accept the
                            <a href="#">terms and conditions</a></label
                          >
                          <div class="invalid-feedback">
                            You must agree before submitting.
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">
                          Create Account
                        </button>
                      </div>
                      <div class="col-12">
                        <p class="small mb-0">
                          Already have an account?
                          <a href="./index.php">Log in</a>
                        </p>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    <!-- End #main -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
