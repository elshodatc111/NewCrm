<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Hisobotlar</title>
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
    $menu = "Hisobot";
    $blok = "false";
    $submenu = "false";
    include("./connect/menu.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Hisobotlar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Hisobotlar</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
      <div class="row">
        <div class="col-lg-2 col-4 py-2">
          <a href="./hisobot.php" class="btn btn-primary w-100" style="border-radius:0;">TASHRIFLAR</a>
        </div>
        <div class="col-lg-2 col-4 py-2">
          <a href="./hisobot_guruh.php" class="btn btn-primary w-100" style="border-radius:0;">GURUHLAR</a>
        </div>
        <div class="col-lg-4 col-4 py-2">
          <a href="./hisobot_moliya.php" class="btn btn-success w-100" style="border-radius:0;">MOLIYA</a>
        </div>
        <div class="col-lg-2 col-4 py-2">
          <a href="./hisobot_techer.php" class="btn btn-primary w-100" style="border-radius:0;">O'QITUVCHI</a>
        </div>
        <div class="col-lg-2 col-4 py-2">
          <a href="./hisobot_hodim.php" class="btn btn-primary w-100" style="border-radius:0;">HODIMLAR</a>
        </div>
      </div>
      <div class="col-lg-12 col-12">
        <div class="card ">
          <form action="./hisobot_moliya.php" method="POST">
            <div class="row px-2">
              <div class="col-lg-6 py-2">
                <select name="typing" class="form-select" required style="border-radius:0;">
                  <option value="">Tanlang</option>
                  <option value="Chiqimlar">Barcha chiqimlar</option>
                  <option value="Xarajatlar">Barcha xarajatlar</option>
                  <option value="Qaytarilgan_Tolovlar">Qaytarilgan to'lovlar</option>
                </select>
              </div>
              <div class="col-lg-6 py-2">
                <button class="btn btn-success w-100" name="moliya" style="border-radius:0;">FILTER</button>
              </div>
            </div>
          </form>
        </div>
        <div class="table-responsive" style="display:<?php if(!isset($_POST['moliya'])){echo 'none;';} ?>">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><?php echo $_POST['typing']; ?></li>
            <li class="breadcrumb-item active" style="cursor:pointer">
              <i class="bi bi-printer-fill"></i>
              <a id='export' style='border-radius:0;'> EXCEL</a>
            </li>
          </ol>
          <?php
            if($_POST['typing']==='Chiqimlar'){
          ?>
          <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>CHiqim turi</th>
                  <th>Chiqim summasi</th>
                  <th>Chiqim haqida</th>
                  <th>Chiqim vaqti</th>
                  <th>Meneger</th>
                  <th>Tasdiqlandi</th>
                  <th>Xisobchi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sql1 = "SELECT * FROM `moliya` WHERE `Typing`='Chiqim' AND `Status`='true'";
                  $res1 = $conn->query($sql1);
                  $i=1;
                  while ($row = $res1->fetch()) {
                    $sql2 = "SELECT * FROM `users` WHERE `UserID`='".$row['ChiqimMeneger']."'";
                    $res2 = $conn->query($sql2);
                    $row2 = $res2->fetch();
                    $sql3 = "SELECT * FROM `users` WHERE `UserID`='".$row['TasdiqMeneger']."'";
                    $res3 = $conn->query($sql3);
                    $row3 = $res3->fetch();
                    echo "<tr>
                      <td>".$i."</td>
                      <td>".$row['Type']."</td>
                      <td>".$row['Summa']."</td>
                      <td>".$row['ChiqimIzoh']."</td>
                      <td>".$row2['FIO']."</td>
                      <td>".$row['ChiqimData']."</td>
                      <td>".$row['TasdiqData']."</td>
                      <td>".$row3['FIO']."</td>
                    </tr>";
                    $i++;
                  }
                ?>
              </tbody>
          </table>
          <?php
            }elseif($_POST['typing']==='Xarajatlar'){
          ?>
          <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>CHiqim turi</th>
                  <th>Chiqim summasi</th>
                  <th>Chiqim haqida</th>
                  <th>Chiqim vaqti</th>
                  <th>Meneger</th>
                  <th>Tasdiqlandi</th>
                  <th>Xisobchi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  $sql11 = "SELECT * FROM `moliya` WHERE `Typing`='Xarajat' AND `Status`='true'";
                  $res111 = $conn->query($sql11);
                  $i=1;
                  while ($row = $res111->fetch()) {
                    $sql2222 = "SELECT * FROM `users` WHERE `UserID`='".$row['ChiqimMeneger']."'";
                    $res2222 = $conn->query($sql2222);
                    $row2222 = $res2222->fetch();
                    $sql3222 = "SELECT * FROM `users` WHERE `UserID`='".$row['TasdiqMeneger']."'";
                    $res3222 = $conn->query($sql3222);
                    $row3222 = $res3222->fetch();
                    echo "<tr>
                      <td>".$i."</td>
                      <td>".$row['Type']."</td>
                      <td>".$row['Summa']."</td>
                      <td>".$row['ChiqimIzoh']."</td>
                      <td>".$row2222['FIO']."</td>
                      <td>".$row['ChiqimData']."</td>
                      <td>".$row['TasdiqData']."</td>
                      <td>".$row3222['FIO']."</td>
                    </tr>";
                    $i++;
                  }
                ?>
              </tbody>
          </table>
          <?php
            }elseif($_POST['typing']==='Qaytarilgan_Tolovlar'){
          ?>
          <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tulov turi</th>
                  <th>Qaytarilgan summa</th>
                  <th>Qaytarish haqida</th>
                  <th>Qaytardi</th>
                  <th>Qaytarilgan vaqt</th>
                  <th>Tasdiqlandi</th>
                  <th>Tasdiqladi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sqla = "SELECT * FROM `moliya_qaytarildi` WHERE `Status`='true'";
                  $resa = $conn->query($sqla);
                  while ($row = $resa->fetch()) {
                    $sql2222 = "SELECT * FROM `users` WHERE `UserID`='".$row['Meneger']."'";
                    $res2222 = $conn->query($sql2222);
                    $row2222 = $res2222->fetch();
                    $sql3222 = "SELECT * FROM `users` WHERE `UserID`='".$row['Xisobchi']."'";
                    $res3222 = $conn->query($sql3222);
                    $row3222 = $res3222->fetch();
                    echo "<tr>
                      <td>".$i."</td>
                      <td>".$row['TulovTuri']."</td>
                      <td>".$row['TulovSumma']."</td>
                      <td style='text-align:left;'>".$row['Izoh']."</td>
                      <td>".$row2222['FIO']."</td>
                      <td>".$row['QaytarishVaqti']."</td>
                      <td>".$row['Tasdiqlandi']."</td>
                      <td>".$row3222['FIO']."</td>
                    </tr>";
                    $i++;
                  }
                ?>
                <tr>
                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                </tr>
              </tbody>
          </table>
          <?php } ?>
        </div>
      </div>
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
  <script src="./assets/js/table2excel.js"></script>
  <script>
    var table2excel = new Table2Excel();
    document.getElementById('export').addEventListener('click', function() {
      table2excel.export(document.getElementById('table'));
    });
  </script>
</body>
</html>