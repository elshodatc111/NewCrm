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
          <a href="./hisobot_guruh.php" class="btn btn-success w-100" style="border-radius:0;">GURUHLAR</a>
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
          <form action="hisobot_guruh.php" method="POST">
            <div class="row px-2">
              <div class="col-lg-6 py-2">
                <select name="typing" class="form-select" required style="border-radius:0;">
                  <option value="">Tanlang</option>
                  <option value="Guhuhlar">Guruhlar</option>
                  <option value="Qarzdor_talabalar">Qarzdor talabalar</option>
                  <option value="Haqdor_talabalar">Haqdor talabalar</option>
                  <option value="Oqituvchi_biriktirilmagan_guruhlar">O'qituvchi biriktirilmagan guruhlar</option>
                </select>
              </div>
              <div class="col-lg-6 py-2">
                <button class="btn btn-success w-100" name="guruh" style="border-radius:0;">FILTER</button>
              </div>
            </div>
          </form>
        </div>
        <div class="table-responsive" style='display:<?php if(!isset($_POST['guruh'])){echo 'none;';} ?>'>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><?php echo $_POST['typing']; ?></li>
            <li class="breadcrumb-item active" style="cursor:pointer">
              <i class="bi bi-printer-fill"></i>
              <a id='export' style='border-radius:0;'> EXCEL</a>
            </li>
          </ol>
          <?php
            if($_POST['typing']==='Guhuhlar'){
          ?>
          <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>GuruhID</th>
                  <th>Guruh Nomi</th>
                  <th>Guruh Narxi</th>
                  <th>O'qituvchi</th>
                  <th>O'qituvchiga to'lov</th>
                  <th>O'qituvchiga bonus</th>
                  <th>Boshlanish vaqti</th>
                  <th>Tugash vaqti</th>
                  <th>Xona</th>
                  <th>Dushanba</th>
                  <th>Seshanba</th>
                  <th>Chorshanba</th>
                  <th>Payshanba</th>
                  <th>Juma</th>
                  <th>Shanba</th>
                  <th>Meneger</th>
                  <th>Guruh yaratildi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sqlg = "SELECT * FROM `guruh`";
                  $resg = $conn->query($sqlg);
                  $i=1;
                  while ($row = $resg->fetch()) {
                    if($row['TecherID']==='NULL'){
                      $techer = 'O`qituvchi biriktirilmagan';
                    }else{
                      $sql1 = "SELECT * FROM `users` WHERE `UserID`='".$row['TecherID']."'";
                      $res1 = $conn->query($sql1);
                      $row1 = $res1->fetch();
                      $techer = $row1['FIO'];
                    }
                    $sql2 = "SELECT * FROM `rooms` WHERE `RoomID`='".$row['RoomID']."'";
                    $res2 = $conn->query($sql2);
                    $row2 = $res2->fetch();
                    $xona = $row2['Room'];
                    $sql2 = "SELECT * FROM `users` WHERE `UserID`='".$row['Meneger']."'";
                      $res2 = $conn->query($sql2);
                      $row2 = $res2->fetch();
                      $meneger = $row2['FIO'];
                    echo "<tr>
                      <td>".$i."</td>
                      <td>".$row['GuruhID']."</td>
                      <td>".$row['GuruhName']."</td>
                      <td>".$row['GuruhSumma']."</td>
                      <td>".$techer."</td>
                      <td>".$row['TechTulov']."</td>
                      <td>".$row['TechBonus']."</td>
                      <td>".$row['Start']."</td>
                      <td>".$row['End']."</td>
                      <td>".$xona."</td>
                      <td>".$row['Dushanba']."</td>
                      <td>".$row['Seshanba']."</td>
                      <td>".$row['Chorshanba']."</td>
                      <td>".$row['Payshanba']."</td>
                      <td>".$row['Juma']."</td>
                      <td>".$row['Shanba']."</td>
                      <td>".$meneger."</td>
                      <td>".$row['InsertData']."</td>
                      <td>3</td>
                    </tr>";
                    $i++;
                  }
                ?>
              </tbody>
          </table>
          <?php
            }elseif($_POST['typing']==='Qarzdor_talabalar'){
          ?>
          <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>FIO</th>
                  <th>Telefon raqam</th>
                  <th>Manzil</th>
                  <th>Guruhlar soni</th>
                  <th>Qarzdorlik summasi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sql222 = "SELECT * FROM `users` WHERE `Type`='student' ORDER BY `id` DESC";
                  $res222 = $conn->query($sql222);
                  $i=1;
                  while ($row=$res222->fetch()) {
                    $sql1333 = "SELECT * FROM `guruh_plus` WHERE guruh_plus.Status='true' AND guruh_plus.UserID='".$row['UserID']."'";
                    $res1333 = $conn->query($sql1333);
                    $row1 = $res1333->fetchColumn();
                    if($row1>=1){
                      #Guruhga qo'shilgan talabalar
                      $sql2 = "SELECT guruh.GuruhSumma FROM `guruh_plus` JOIN guruh on guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.Status='true' AND guruh_plus.UserID='".$row['UserID']."'";
                      $res2 = $conn->query($sql2);
                      $GuruhTulov = 0;
                      $guruhCount = 0;
                      while ($row2 = $res2->fetch()) {
                        $GuruhTulov = $GuruhTulov + $row2['GuruhSumma'];
                        $guruhCount = $guruhCount + 1;
                      }
                      #Talaba to'lovlari
                      $sql3 = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$row['UserID']."'";
                      $res3 = $conn->query($sql3);
                      $JamiTulov = 0;
                      while ($row3 = $res3->fetch()) {
                        if($row3['TulovType']==='Naqt'){
                          $JamiTulov = $JamiTulov + $row3['TulovSumma'];
                        }elseif($row3['TulovType']==='Plastik'){
                          $JamiTulov = $JamiTulov + $row3['TulovSumma'];
                        }elseif($row3['TulovType']==='Chegirma'){
                          $JamiTulov = $JamiTulov + $row3['TulovSumma'];
                        }elseif($row3['TulovType']==='Qaytarildi'){
                          $JamiTulov = $JamiTulov - $row3['TulovSumma'];
                        }
                      }
                      #Talaba jarimalari
                      $sql5 = "SELECT * FROM `guruh_user_del` WHERE `UserID`='".$row['UserID']."'";
                      $res5 = $conn->query($sql5);
                      $Jarima = 0;
                      while ($row5 = $res5->fetch()) {
                        $Jarima = $Jarima + $row5['GuruhSumma'];
                      }
                      #Umumiy qarzdorlik
                      $Qarzdor = $JamiTulov-$GuruhTulov-$Jarima;
                      if($Qarzdor<0){
                          echo "<tr>
                            <td>".$i."</td>
                            <td style='text-align:left;'>".$row['FIO']."</td>
                            <td>".$row['Phone']."</td>
                            <td style='text-align:left'>".$row['Manzil']."</td>
                            <td>".$guruhCount."</td>
                            <td>".number_format($Qarzdor, 0, '.', ' ')." so'm</td>
                        </tr>";
                        $i++;
                      }
                    }
                  }
                ?>
              </tbody>
          </table>
          <?php
            }elseif($_POST['typing']==='Haqdor_talabalar'){
          ?>
          <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>FIO</th>
                  <th>Telefon raqam</th>
                  <th>Manzil</th>
                  <th>Guruhlar soni</th>
                  <th>Ortiqcha to'lov</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  $sql222 = "SELECT * FROM `users` WHERE `Type`='student' ORDER BY `id` DESC";
                  $res222 = $conn->query($sql222);
                  $i=1;
                  while ($row=$res222->fetch()) {
                    $sql1333 = "SELECT * FROM `guruh_plus` WHERE guruh_plus.Status='true' AND guruh_plus.UserID='".$row['UserID']."'";
                    $res1333 = $conn->query($sql1333);
                    $row1 = $res1333->fetchColumn();
                    if($row1>=1){
                      #Guruhga qo'shilgan talabalar
                      $sql2 = "SELECT guruh.GuruhSumma FROM `guruh_plus` JOIN guruh on guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.Status='true' AND guruh_plus.UserID='".$row['UserID']."'";
                      $res2 = $conn->query($sql2);
                      $GuruhTulov = 0;
                      $guruhCount = 0;
                      while ($row2 = $res2->fetch()) {
                        $GuruhTulov = $GuruhTulov + $row2['GuruhSumma'];
                        $guruhCount = $guruhCount + 1;
                      }
                      #Talaba to'lovlari
                      $sql3 = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$row['UserID']."'";
                      $res3 = $conn->query($sql3);
                      $JamiTulov = 0;
                      while ($row3 = $res3->fetch()) {
                        if($row3['TulovType']==='Naqt'){
                          $JamiTulov = $JamiTulov + $row3['TulovSumma'];
                        }elseif($row3['TulovType']==='Plastik'){
                          $JamiTulov = $JamiTulov + $row3['TulovSumma'];
                        }elseif($row3['TulovType']==='Chegirma'){
                          $JamiTulov = $JamiTulov + $row3['TulovSumma'];
                        }elseif($row3['TulovType']==='Qaytarildi'){
                          $JamiTulov = $JamiTulov - $row3['TulovSumma'];
                        }
                      }
                      #Talaba jarimalari
                      $sql5 = "SELECT * FROM `guruh_user_del` WHERE `UserID`='".$row['UserID']."'";
                      $res5 = $conn->query($sql5);
                      $Jarima = 0;
                      while ($row5 = $res5->fetch()) {
                        $Jarima = $Jarima + $row5['GuruhSumma'];
                      }
                      #Umumiy qarzdorlik
                      $Qarzdor = $JamiTulov-$GuruhTulov-$Jarima;
                      if($Qarzdor>0){
                          echo "<tr>
                            <td>".$i."</td>
                            <td style='text-align:left;'>".$row['FIO']."</td>
                            <td>".$row['Phone']."</td>
                            <td style='text-align:left'>".$row['Manzil']."</td>
                            <td>".$guruhCount."</td>
                            <td>".number_format($Qarzdor, 0, '.', ' ')." so'm</td>
                        </tr>";
                        $i++;
                      }
                    }
                  }
                ?>
              </tbody>
          </table>
          <?php }elseif($_POST['typing']==='Oqituvchi_biriktirilmagan_guruhlar'){
          ?>
          <table class='table text-center align-baseline' id='table' style='font-size:12px;'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>GuruhID</th>
                  <th>Guruh nomi</th>
                  <th>Guruhga to'lov</th>
                  <th>O'qituvchiga to'lov</th>
                  <th>O'qituvchiga bonus</th>
                  <th>Boshlanish vaqti</th>
                  <th>Tugash vaqti</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  $sql222x = "SELECT * FROM `guruh` WHERE `TecherID`='NULL';";
                  $res222x = $conn->query($sql222x);
                  $i=1;
                  while ($row=$res222x->fetch()) {
                    echo "
                      <tr>
                        <td>".$i."</td>
                        <td>".$row['GuruhID']."</td>
                        <td style='text-align:left;'>".$row['GuruhName']."</td>
                        <td>".$row['GuruhSumma']."</td>
                        <td>".$row['TechTulov']."</td>
                        <td>".$row['TechBonus']."</td>
                        <td>".$row['Start']."</td>
                        <td>".$row['End']."</td>
                      </tr>
                    ";
                    $i++;
                  }
                ?>
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