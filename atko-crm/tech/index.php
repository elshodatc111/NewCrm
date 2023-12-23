
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
  <title>Bosh sahifa</title>
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
                <a class="nav-link" href="index.php">
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
                <a class="nav-link collapsed" href="kobinet.php">
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
            <h1>Guruhlar</h1>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-3">
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Guruh</th>
                                            <th scope="col">Boshlanish vaqti</th>
                                            <th scope="col">Yakunlanish vaqti</th>
                                            <th scope="col">Talabalar</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT * FROM `guruh` WHERE `TecherID`='".$_COOKIE['UserIDs']."'";
                                            $res = $conn->query($sql);
                                            $i=1;
                                            while ($row=$res->fetch()) {
                                                $talaba = 0;
                                                $sql1 = "SELECT * FROM `guruh_plus` WHERE `GuruhID`='".$row['GuruhID']."' AND `Status`='true'";
                                                $res1 = $conn->query($sql1);
                                                while ($row1 = $res1->fetch()) {
                                                    $talaba = $talaba + 1;
                                                }
                                                echo "<tr>
                                                    <td>".$i."</td>
                                                    <td>".$row['GuruhName']."</td>
                                                    <td>".$row['Start']."</td>
                                                    <td>".$row['End']."</td>
                                                    <td>".$talaba."</td>
                                                    <td class='text-center'><a href='./guruh_eye.php?GuruhID=".$row['GuruhID']."'><i class='bi bi-eye'></i></a></td>
                                                </tr>";
                                                $i++;
                                            }
                                            if($i===1){
                                                echo "<tr><td colspan=6 class='text-center'>Guruhlar mavjud emas</td></tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
</body>

</html>