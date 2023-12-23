<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>To'lovlar</title>
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
  <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
  <!-- ======= TOP START ======= -->
  <?php  include("./connect/top.php"); ?>
  <!-- ======= TOP END ======= -->
  <?php
    $menu = "Tashriflat";
    $blok = "ShowTashrif";
    $submenu = "tulovlar";
    include("./connect/menu.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>To'lovlar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">To'lovlar</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
        <div class="col-lg-12 col-12">
            <div class="info-box card px-2">
                <h5 class="card-title w-100 text-center pb-0 mb-1">To'lovlar</h5>
                <div class="table-responsive">
                    <table  class="table table-bordered text-center align-baseline table-striped" style="font-size:14px;" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="align-middle">
                                <th style="background-color: blue;color:white">#</th>
                                <th style="background-color: blue;color:white">Talaba</th>
                                <th style="background-color: blue;color:white">To'lov turi</th>
                                <th style="background-color: blue;color:white">To'lov summasi</th>
                                <th style="background-color: blue;color:white">To'lov vaqti</th>
                                <th style="background-color: blue;color:white">To'lov haqida</th>
                                <th style="background-color: blue;color:white">Meneger</th>
                                <th style="background-color: blue;color:white">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "SELECT user_student_tulov.MenegerID,users.UserID,users.FIO,user_student_tulov.TulovType,user_student_tulov.TulovSumma,user_student_tulov.Izoh,user_student_tulov.InsertData,users.UserID FROM `user_student_tulov` JOIN `users` ON user_student_tulov.UserID = users.UserID ORDER BY user_student_tulov.id DESC";
                            $res = $conn->query($sql);
                            $i = 1;
                            while ($row=$res->fetch()) {
                              $MenegerID = $row['MenegerID'];
                              $sql1 = "SELECT * FROM `users` WHERE `UserID`='".$MenegerID."'";
                              $res1 = $conn->query($sql1);
                              $row1 = $res1->fetch();
                              echo "<tr>
                                <td>".$i."</td>
                                <td>".$row['FIO']."</td>
                                <td>".$row['TulovType']."</td>
                                <td>".number_format($row['TulovSumma'], 0, '.', ' ')." so`m</td>
                                <td>".$row['InsertData']."</td>
                                <td>".$row['Izoh']."</td>
                                <td>".$row1['Username']."</td>
                                <td>
                                  <a href='./blog/tashrif_eye.php?UserID=".$row['UserID']."' class='btn btn-warning py-0 px-1' style='border-radius: 0;'>
                                      <i class='bi bi-eye-fill' style='font-size:15px;color:white'></i>
                                  </a>
                                </td>
                            </tr>";
                            $i++;
                            }
                            if($i===1){
                              echo "<tr><td colspan=8 class='text-center'>To'lovlar mavjud emas</td></tr>";
                            }
                          ?>
                            
                        </tbody>
                    </table> 
                  </div>
            </div>
        <div>
    </section>
  </main>
  
  <!-- ======= START FOOTER ======= -->
  <?php include("./connect/footer.php"); ?>
  <!-- ======= END FOOTER ======= -->

  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="assets/js/jquery.masknumber.js"></script>
  <script src="assets/js/jquery.masknumber.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.inputmask.min.js"></script>
    <script src="./assets/dselect.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>