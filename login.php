
<?php 
    date_default_timezone_set("Asia/Samarkand");
?><?php
  if(isset($_COOKIE['UserID'])){
    setcookie('UserID', '', time() - 1800, "/");
  }
  include("./config/config.php");
  if(isset($_GET['shartnoma'])){
    $sql00 = "SELECT * FROM `admin_time` WHERE `date`<'".date("Y-m-d")."' AND `Status`='true'";
    $res00 = $conn->query($sql00);
    while ($row=$res00->fetch()) {
      echo "<script>alert('".$row['text']."');</script>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/icon.png" rel="icon">
  <link href="assets/img/icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <script>
    <?php
      if(isset($_GET['error'])){ echo "alert('Login yoki parol xato');";}
    ?>
  </script>
</head>
<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                </a>
              </div>
              <div class="card mb-3" style="border-radius:0;">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">KIRISH</h5>
                  </div>
                  <form class="row g-3 needs-validation" novalidate action="./config/login.php" method="post">
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Login</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" style="border-radius:0;">@</span>
                        <input type="text" name="Username" class="form-control" required style="border-radius:0;">
                        <div class="invalid-feedback">Logini kiriting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Parol</label>
                      <input type="password" name="Password" class="form-control" required style="border-radius:0;">
                      <div class="invalid-feedback">Parolni kiriting</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" style="border-radius:0;">Login</button>
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
  
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>