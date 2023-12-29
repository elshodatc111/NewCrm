
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
  <title>Guruh</title>
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
      if(isset($_GET['davomadPlus'])){echo "alert('Bugungi kun uchun davomad olindi.')";}
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
                            <?php
                                $sqla = "SELECT * FROM `guruh` WHERE `GuruhID`='".$_GET['GuruhID']."'";
                                $resa = $conn->query($sqla);
                                $rowa = $resa->fetch();
                                $start = $rowa['Start'];
                                $end = $rowa['End'];
                                if($start<=date("Y-m-d") AND $end<=date("Y-m-d")){
                                    $STATUS = "NONE";
                                }else{
                                    $sqlb = "SELECT * FROM `guruh_davomad` WHERE `GuruhID`='".$_GET['GuruhID']."' AND `Date`='".date("Y-m-d")."'";
                                    $resb = $conn->query($sqlb);
                                    $rowb = $resb->fetchColumn();
                                    if($rowb>=1){$STATUS = "NONE";}
                                    else{$STATUS="";}
                                }
                            ?>
                            <button class="btn btn-primary w-100" style="border-radius:0;<?php echo "display:".$STATUS; ?>" data-bs-toggle="modal" data-bs-target="#basicModal">Davomad <i>(Davomad bir kunda bir marta olinadi)</i></button><hr>
                            <div class="modal fade" id="basicModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Davomad</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./davomad.php?GuruhID=<?php echo $_GET['GuruhID']; ?>" method="POST">
                                                <p class='w-100 text-center text-danger'><i>Olingan davomad natijalarini o'zgartirib bo'lmaydi!!!</i></p>
                                                <table class="table text-center table-bordered">
                                                    <tr>
                                                        <th>Tanlang</th>
                                                        <th>FIO</th>
                                                    </tr>
                                                    <?php
                                                        $sql1 = "SELECT * FROM `guruh_plus` JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh_plus.GuruhID='".$_GET['GuruhID']."' AND guruh_plus.Status='true'";
                                                        $res1 = $conn->query($sql1);
                                                        while ($row1 = $res1->fetch()) {
                                                            echo "<tr>
                                                                <td>
                                                                    <input type='checkbox' name=".$row1['UserID'].">
                                                                </td>
                                                                <td style='text-align:left'>".$row1['FIO']."</td>
                                                            </tr>";
                                                        }
                                                    ?>
                                                    
                                                    <tr>
                                                        <td colspan=2>
                                                            <button name="davomatplus" class="btn btn-primary w-100" style="border-radius:0">Saqlash</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <?php
                                        $dates = array();
                                        $sqldata = "SELECT DISTINCT `Date` FROM `guruh_davomad` WHERE `GuruhID`='".$_GET['GuruhID']."' ORDER BY `Date` ASC";
                                        $resdata = $conn->query($sqldata);
                                        while ($rowdata = $resdata->fetch()) {
                                            array_push($dates,$rowdata['Date']);
                                        }
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>#</th><th>FIO</th><?php foreach ($dates as $data) {echo "<th>".$data."</th>";} ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sqldav = "SELECT * FROM `guruh_plus` JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh_plus.Status='true' AND guruh_plus.GuruhID='".$_GET['GuruhID']."'";
                                            $resdav = $conn->query($sqldav);
                                            $i=1;
                                            while ($rowdav = $resdav->fetch()) {
                                                echo "<tr><td class='text-center'>".$i."</td><td>".$rowdav['FIO']."</td>";
                                                    foreach ($dates as $data) {
                                                    $sqld = "SELECT * FROM `guruh_davomad` WHERE `UserID`='".$rowdav['UserID']."' AND `GuruhID`='".$_GET['GuruhID']."' AND `Date`='".$data."'";
                                                    $resd = $conn->query($sqld);
                                                    if($resd->fetchColumn()>0){
                                                        echo "<td class='text-center'><span class='badge bg-success'>+</span></td>";
                                                    }else{
                                                        echo "<td class='text-center'><span class='badge bg-danger'>-</span></td>";
                                                    }
                                                    }
                                                echo "</tr>";
                                                $i++;
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