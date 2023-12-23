<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
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
          <a href="./hisobot.php" class="btn btn-success w-100" style="border-radius:0;">TASHRIFLAR</a>
        </div>
        <div class="col-lg-2 col-4 py-2">
          <a href="./hisobot_guruh.php" class="btn btn-primary w-100" style="border-radius:0;">GURUHLAR</a>
        </div>
        <div class="col-lg-4 col-4 py-2">
          <a href="./hisobot_moliya.php" class="btn btn-primary w-100" style="border-radius:0;">MOLIYA</a>
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
          <form action="hisobot.php?tashrif=true" method="POST">
            <div class="row px-2">
              <div class="col-lg-3 py-2">
                <select name="typing" class="form-select" required style="border-radius:0;">
                  <option value="">Tanlang</option>
                  <option value="Tashriflar">Tashriflar</option>
                  <option value="Aktiv_Guruh_Talabalari">Aktiv guruh talabalari</option>
                  <option value="Yangi_Guruh_Talabalari">Yangi guruh talabalar</option>
                  <option value="Yakunlangan_Guruh_Talabalari">Yakunlagan guruh talabalar</option>
                  <option value="Guruhga_Biriktirilmagan_Tashriflar">Guruhga biriktirilmagan tashriflar</option>
                  <option value="Talaba_Tolovlari">Talaba to'lovlari</option>
                </select>
              </div>
              <div class="col-lg-3 py-2">
                <input type="date" name="data01" class="form-control" required style="border-radius:0;">
              </div>
              <div class="col-lg-3 py-2">
                <input type="date" name="data02" class="form-control" required style="border-radius:0;">
              </div>
              <div class="col-lg-3 py-2">
                <button class="btn btn-success w-100" name="Button" style="border-radius:0;">FILTER</button>
              </div>
            </div>
          </form>
        </div>

        <div class="table-responsive" style="display:<?php if(!isset($_POST['Button'])){echo 'none;';} ?>">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><?php if(isset($_POST['typing'])){echo $_POST['typing'];} ?></li>
            <li class="breadcrumb-item"><?php if(isset($_POST['data01'])){echo $_POST['data01'];} ?></li>
            <li class="breadcrumb-item"><?php if(isset($_POST['data02'])){echo $_POST['data02'];} ?></li>
            <li class="breadcrumb-item active" style="cursor:pointer">
              <i class="bi bi-printer-fill"></i>
              <a id='export' style='border-radius:0;'> EXCEL</a>
            </li>
          </ol>
          <!-- Tashriflar -->
          <?php
            if(isset($_POST['typing'])){
            if($_POST['typing']==='Tashriflar'){
          ?>
          <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>UserID</th>
                  <th>FIO</th>
                  <th>Telefon raqam</th>
                  <th>Manzil</th>
                  <th>Tug'ilgan kun</th>
                  <th>Tashrif vaqti</th>
                  <th>Taqin Tanishi</th>
                  <th>Telefon</th>
                  <th>About</th>
                  <th>Haqimizda</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sqlTashrif = "SELECT * FROM `users` JOIN `user_student` ON users.UserID=user_student.UserID WHERE users.Type='student' AND users.DateInsert>='".$_POST['data01']."' AND users.DateInsert<='".$_POST['data02']."'";
                  $resTashrif = $conn->query($sqlTashrif);
                  $i=1;
                  while ($row=$resTashrif->fetch()) {
                    echo "<tr>
                    <td>".$i."</td>
                    <td>".$row['UserID']."</td>
                    <td style='text-align:left;'>".$row['FIO']."</td>
                    <td>".$row['Phone']."</td>
                    <td>".$row['Manzil']."</td>
                    <td>".$row['TKun']."</td>
                    <td>".$row['DateInsert']."</td>
                    <td>".$row['Tanish']."</td>
                    <td>".$row['TanishPhone']."</td>
                    <td>".$row['About']."</td>
                    <td>".$row['Haqimizda']."</td>
                  </tr>";
                  $i++;
                  }
                ?>
              </tbody>
          </table>
          <!-- Activ guruh talanalari -->
          <?php
            }
            elseif($_POST['typing']==='Aktiv_Guruh_Talabalari'){
          ?>
              <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>GuruhID</th>
                    <th>GuruhNomi</th>
                    <th>Boshlanish vaqti</th>
                    <th>Tugash vaqti</th>
                    <th>UserID</th>
                    <th>FIO</th>
                    <th>Guruhga qo'shildi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql_activ_guruh = "SELECT guruh_plus.Start as 'Started',guruh_plus.GuruhID,users.FIO,guruh_plus.UserID,guruh.GuruhName,guruh.Start,guruh.End FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh.Start<'".$_POST['data01']."' AND guruh.End>'".$_POST['data02']."' AND guruh_plus.Status='true';";
                    $res_activ_guruh = $conn->query($sql_activ_guruh);
                    $i=1;
                    while ($row = $res_activ_guruh->fetch()) {
                      ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['GuruhID']; ?></td>
                            <td><?php echo $row['GuruhName']; ?></td>
                            <td><?php echo $row['Start']; ?></td>
                            <td><?php echo $row['End']; ?></td>
                            <td><?php echo $row['UserID']; ?></td>
                            <td><?php echo $row['FIO']; ?></td>
                            <td><?php echo $row['Started']; ?></td>
                        </tr>
                        <?php
                          $i++;
                        }
                      ?>
                  </tbody>
              </table>
          <?php
            }
            elseif($_POST['typing']==='Yangi_Guruh_Talabalari'){
          ?>
              <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>GuruhID</th>
                    <th>GuruhNomi</th>
                    <th>Boshlanish vaqti</th>
                    <th>Tugash vaqti</th>
                    <th>UserID</th>
                    <th>FIO</th>
                    <th>Guruhga qo'shildi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql_new_guruh = "SELECT guruh_plus.Start as 'Started',guruh_plus.GuruhID,users.FIO,guruh_plus.UserID,guruh.GuruhName,guruh.Start,guruh.End FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh.Start>'".date("Y-m-d")."' AND guruh_plus.Status='true';";
                    $res_new_guruh = $conn->query($sql_new_guruh);
                    $i=1;
                    while ($row = $res_new_guruh->fetch()) {
                      ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['GuruhID']; ?></td>
                            <td><?php echo $row['GuruhName']; ?></td>
                            <td><?php echo $row['Start']; ?></td>
                            <td><?php echo $row['End']; ?></td>
                            <td><?php echo $row['UserID']; ?></td>
                            <td><?php echo $row['FIO']; ?></td>
                            <td><?php echo $row['Started']; ?></td>
                        </tr>
                        <?php
                          $i++;
                        }
                      ?>
                  </tbody>
              </table>
          <?php
            }
            elseif ($_POST['typing']==='Yakunlangan_Guruh_Talabalari') {
          ?>
              <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>GuruhID</th>
                    <th>GuruhNomi</th>
                    <th>Boshlanish vaqti</th>
                    <th>Tugash vaqti</th>
                    <th>UserID</th>
                    <th>FIO</th>
                    <th>Guruhga qo'shildi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql_new_guruh = "SELECT guruh_plus.Start as 'Started',guruh_plus.GuruhID,users.FIO,guruh_plus.UserID,guruh.GuruhName,guruh.Start,guruh.End FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh.End<'".date("Y-m-d")."' AND guruh_plus.Status='true';";
                    $res_new_guruh = $conn->query($sql_new_guruh);
                    $i=1;
                    while ($row = $res_new_guruh->fetch()) {
                      ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['GuruhID']; ?></td>
                            <td><?php echo $row['GuruhName']; ?></td>
                            <td><?php echo $row['Start']; ?></td>
                            <td><?php echo $row['End']; ?></td>
                            <td><?php echo $row['UserID']; ?></td>
                            <td><?php echo $row['FIO']; ?></td>
                            <td><?php echo $row['Started']; ?></td>
                        </tr>
                        <?php
                          $i++;
                        }
                      ?>
                  </tbody>
              </table>
          <?php
            }elseif($_POST['typing']==='Guruhga_Biriktirilmagan_Tashriflar'){
              $sql22 = "SELECT * FROM `users` WHERE `DateInsert`>'".$_POST['data01']."' AND `DateInsert`<'".$_POST['data02']."'";
              $res22 = $conn->query($sql22);
              ?>
              <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>FIO</th>
                    <th>Telefon raqam</th>
                    <th>Yashash manzili</th>
                    <th>Tug'ilgan kuni</th>
                    <th>Tashrif vaqti</th>
                  </tr>
                </thead>
              <tbody>
              <?php
              $i=1;
              while ($row = $res22->fetch()) {
                $sql = "SELECT COUNT(*) FROM `guruh_plus` WHERE `UserID`='".$row['UserID']."' AND `Status`='true'";
                $res = $conn->query($sql);
                $count = $res->fetchColumn();
                if($count>0){}
                else{
                ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td style='text-align:left'><?php echo $row['FIO']; ?></td>
                        <td><?php echo $row['Phone']; ?></td>
                        <td><?php echo $row['Manzil']; ?></td>
                        <td><?php echo $row['TKun']; ?></td>
                        <td><?php echo $row['DateInsert']; ?></td>
                      </tr>
                <?php
                  $i++;
                }
              }
            }elseif ($_POST['typing']==='Talaba_Tolovlari') {
          ?>
            <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>UserID</th>
                    <th>FIO</th>
                    <th>To'lov turi</th>
                    <th>To'lov summasi</th>
                    <th>To'lov haqida</th>
                    <th>To'lov vaqti</th>
                    <th>MenegerID</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql_new_guruh = "SELECT * FROM `user_student_tulov` JOIN `users` ON user_student_tulov.UserID=users.UserID WHERE user_student_tulov.InsertData>'".$_POST['data01']." 00:00:00' AND user_student_tulov.InsertData<='".$_POST['data02']." 23:59:59'";
                    $res_new_guruh = $conn->query($sql_new_guruh);
                    $i=1;
                    while ($row = $res_new_guruh->fetch()) {
                      ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['UserID']; ?></td>
                            <td style='text-align:left;'><?php echo $row['FIO']; ?></td>
                            <td><?php echo $row['TulovType']; ?></td>
                            <td><?php echo $row['TulovSumma']; ?></td>
                            <td><?php echo $row['Izoh']; ?></td>
                            <td><?php echo $row['InsertData']; ?></td>
                            <td><?php echo $row['MenegerID']; ?></td>
                        </tr>
                        <?php
                          $i++;
                        }
                      ?>
                  </tbody>
              </table>
              </tbody>
            </table>
            <?php }} ?>
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