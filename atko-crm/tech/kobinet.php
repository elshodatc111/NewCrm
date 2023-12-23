
<?php 
    date_default_timezone_set("Asia/Samarkand");
?><?php
  include("../config/config.php");
  if(!$_COOKIE['UserIDs']){
    header("location: ./login.php");
  }else{
    $stmt = $conn->query("SELECT * FROM `users` WHERE `UserID`='".$_COOKIE['UserIDs']."'");
    $user = $stmt->fetch();
    $FIO = $user['FIO'];
    $Manzil = $user['Manzil'];
    $Phone = $user['Phone'];
    $TKun = $user['TKun'];
    $Username = $user['Username'];
    $Type = $user['Type'];
    if($Type==='admin'){
      header("location: ./login.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Kabinet</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="../assets/img/icon.png" rel="icon">
  <link href="../assets/img/icon.png" rel="apple-touch-icon">
  <link href="../https://fonts.gstatic.com" rel="preconnect">
  <link href="../https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <script>
    <?php
      if(isset($_GET['edet'])){echo "alert('Parol yangilandi')";}
      if(isset($_GET['birxil'])){echo "alert('Parol bir xil emas.')";}
      if(isset($_GET['error'])){echo "alert('Joriy parol xato.')";}
    ?>
  </script>
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="../assets/img/logo.png" alt="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
    </header>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Guruhlar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="tulov.php">
                    <i class="bi bi-question-circle"></i>
                    <span>To'lovlar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="kobinet.php">
                    <i class="bi bi-person"></i>
                    <span>Kobinet</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="../login.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Chiqish</span>
                </a>
            </li>
        </ul>
    </aside>
  
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Kobinet</h1>
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <h2 class="w-100 text-center"><?php echo $FIO; ?></h2>
                            <h3><?php echo $Username; ?></h3>
                            <p><b>Tel: </b><?php echo $Phone ?></p>
                            <p><b>Manzil: </b><?php echo $Manzil ?></p>
                            <p><b>Tug`ilgan kun:  </b><?php echo $TKun ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Parolni yangilash</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <form action="./password.php" method="POST">
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Joriy parol</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="password" name="pass1" class="form-control" required style="border-radius:0;">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Yangi parol</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="password" name="pass2" class="form-control" required style="border-radius:0;">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Parolni takrorlang</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="password" name="pass3" class="form-control" required style="border-radius:0;">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary" style="border-radius:0;">Parolni yangilash</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery.inputmask.min.js"></script>
    <script src="../assets/dselect.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>