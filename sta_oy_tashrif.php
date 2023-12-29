<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Oylik tashriflar</title>
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
    $menu = "Statistika";
    $blok = "ShowStatistika";
    $submenu = "oyliktashrif";
    include("./connect/menu.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Oylik tashriflar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Oylik tashriflar</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
    <div class="row">
        <!-- OYLIK TASHRIFLAR -->
        <div class="col-lg-12">
          <div class="info-box card ">
            <h3 class="w-100 text-center">OYLIK TASHRIFLAR</h3>
            <?php 
              $Tashriflar = array();
              $Guruhlarda = array();
              $Tulovlar = array();

              for($i=-5;$i<=0;$i++){
                $Start = date('Y-m',strtotime(''.$i.' month'))."-01 00:00:00";
                $End = date('Y-m',strtotime(''.$i.' month'))."-31 23:59:59";
                $Tashrif = 0;
                $Tashgur = 0;
                $Tulov = 0;
                $sqltt = "SELECT * FROM `users` WHERE `DateInsert`>='".$Start."' AND `DateInsert`<='".$End."' AND `Type`='student'";
                $restt = $conn->query($sqltt);
                while ($row = $restt->fetch()) {
                  $Tashrif = $Tashrif + 1;
                  $sqlg = "SELECT * FROM `guruh_plus` WHERE `Start`>='".$Start."' AND `Start`<='".$End."' AND `Status`='true' AND `UserID`='".$row['UserID']."'";
                  $resg = $conn->query($sqlg);
                  while ($rowg = $resg->fetch()) {
                    $Tashgur = $Tashgur + 1;
                  }
                  $sqlt = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$row['UserID']."' AND `InsertData`>='".$Start."' AND `InsertData`<='".$End."'";
                  $rest = $conn->query($sqlt);
                  while ($rowt=$rest->fetch()) {
                    $Tulov = $Tulov + 1;
                  }
                }
                array_push($Tashriflar,$Tashrif);
                array_push($Guruhlarda,$Tashgur);
                array_push($Tulovlar,$Tulov);
              }
            ?>
            <canvas id="lineChart" style="max-height: 300px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#lineChart'), {
                  type: 'line',
                  data: {
                    labels: [<?php for($i=-5;$i<=0;$i++){echo "'".date('Y-m-d',strtotime(''.$i.' month'))."', ";}?>],
                    datasets: [{
                      label: 'MARKAZGA TASHRIF',
                      data: [<?php foreach ($Tashriflar as $key) {
                        echo $key.", ";
                      } ?>],
                      fill: false,
                      borderColor: 'rgb(255, 99, 132)',
                      tension: 0.1
                    },{
                      label: 'GURUHGA BIRIKTIRILDI',
                      data: [<?php foreach ($Guruhlarda as $key) {
                        echo $key.", ";
                      } ?>],
                      fill: false,
                      borderColor: 'rgb(255, 205, 86)',
                      tension: 0.1
                    },{
                      label: 'TO`LOVLAR SONI',
                      data: [<?php foreach ($Tulovlar as $key) {
                        echo $key.", ";
                      } ?>],
                      fill: false,
                      borderColor: 'rgb(54, 162, 235)',
                      tension: 0.1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              });
            </script>
            <br>
            <div class="table-responsive">
              <table class="table table-bordered text-center mt-2">
                <tr>
                  <th style="text-align:left;">MARKAZGA TASHRIF</th>
                  <?php 
                    foreach ($Tashriflar as $key) {
                      echo "<td>".$key."</td>";
                    } 
                  ?>
                </tr>
                <tr>
                  <th style="text-align:left;">GURUHGA BIRIKTIRILDI</th>
                  <?php 
                    foreach ($Guruhlarda as $key) {
                      echo "<td>".$key."</td>";
                    } 
                  ?>
                </tr>
                <tr>
                  <th style="text-align:left;">TO'LOVLAR SONI</th>
                  <?php 
                    foreach ($Tulovlar as $key) {
                      echo "<td>".$key."</td>";
                    } 
                  ?>
                </tr>
                <tr>
                  <th style="text-align:left;">SANA</th>
                  <?php for($i=-5;$i<=0;$i++){echo "<td>".date('Y-m-d',strtotime(''.$i.' month'))."</td>";}?>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="info-box ">
          <canvas id="barChart" style="max-height: 400px;width:100%"></canvas>
          <?php
            $Chiroqchi=0;  $Dexqonobod=0;  $Guzor=0;  $Kasbi=0;  $Kitob=0; $Kokdala=0;  $Koson=0; 
            $Mirishkor=0;  $Muborak=0; $Nishon=0;  $Qamashi=0;  $QarshiSH=0;  $QarshiT=0; 
            $ShaxrizabzSH=0;  $SHaxrisabzT=0;  $Yakkabog=0;
            $S = date('Y-m-d',strtotime('-3 month'))." 00:00:00";
            $E = date('Y-m-d')." 23:59:59";
            $sqla1 = "SELECT * FROM `users` WHERE `Type`='student' AND `DateInsert`>='".$S."' AND `DateInsert`<='".$E."'";
            $resa1 = $conn->query($sqla1);
            while ($row = $resa1->fetch()) {
              if($row['Manzil']==='Chiroqchi tumani'){$Chiroqchi = $Chiroqchi + 1;
              }elseif($row['Manzil']==='Dexqonobor tumani'){$Dexqonobod = $Dexqonobod + 1;
              }elseif($row['Manzil']==='G`uzor tumani'){$Guzor = $Guzor + 1;
              }elseif($row['Manzil']==='Kasbi tumani'){$Kasbi = $Kasbi + 1;
              }elseif($row['Manzil']==='Kitob tumani'){$Kitob = $Kitob + 1;
              }elseif($row['Manzil']==='Ko`kdala tumani'){$Kokdala = $Kokdala + 1;
              }elseif($row['Manzil']==='Koson tumani'){$Koson = $Koson + 1;
              }elseif($row['Manzil']==='Nishon tumani'){$Nishon = $Nishon + 1;
              }elseif($row['Manzil']==='Qamashi tumani'){$Qamashi = $Qamashi + 1;
              }elseif($row['Manzil']==='Qarshi shahar'){$QarshiSH = $QarshiSH + 1;
              }elseif($row['Manzil']==='Qarshi tumani'){$QarshiT = $QarshiT + 1;
              }elseif($row['Manzil']==='Shaxrisabz Shaxar'){$ShaxrizabzSH = $ShaxrizabzSH + 1;
              }elseif($row['Manzil']==='Shaxrisabz tumani'){$SHaxrisabzT = $SHaxrisabzT + 1;
              }elseif($row['Manzil']==='Yakkabog` tumani'){$Yakkabog = $Yakkabog + 1;
              }elseif($row['Manzil']==='Mirishkor tumani'){$Mirishkor = $Mirishkor + 1;
              }elseif($row['Manzil']==='Muborak tumani'){$Muborak = $Muborak + 1;
              }
            }

          ?>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                      labels: ['Chiroqchi', 'Dexqonobod', 'G`uzor', 'Kasbi', 'Kitob','Ko`kdala', 'Koson', 'Mirishkor', 'Muborak','Nishon', 'Qamashi', 'QarshiSH', 'QarshiT', 'ShaxrizabzSH', 'SHaxrisabzT', 'Yakkabog`'],
                      datasets: [{
                        label: 'HUDUDLARDAN TASHRIFLAR (oxirgi 3 oy)',
                        data: [<?php echo $Chiroqchi.",".$Dexqonobod.",".$Guzor.",".$Kasbi.",".$Kitob.",".$Kokdala.",".$Koson.",".$Mirishkor.",".$Muborak.",".$Nishon.",".$Qamashi.",".$QarshiSH.",".$QarshiT.",".$ShaxrizabzSH.",".$SHaxrisabzT.",".$Yakkabog; ?>],
                        backgroundColor: ['rgba(255, 99, 132, 0.2)','rgba(255, 159, 64, 0.2)','rgba(255, 205, 86, 0.2)','rgba(75, 192, 192, 0.2)','rgba(54, 162, 235, 0.2)','rgba(153, 102, 255, 0.2)','rgba(75, 192, 192, 0.2)','rgba(54, 162, 235, 0.2)','rgba(153, 102, 255, 0.2)','rgba(75, 192, 192, 0.2)','rgba(54, 162, 235, 0.2)','rgba(153, 102, 255, 0.2)','rgba(75, 192, 192, 0.2)','rgba(54, 162, 235, 0.2)','rgba(153, 102, 255, 0.2)','rgba(201, 203, 207, 0.2)'],
                        borderColor: ['rgb(255, 99, 132)','rgb(255, 159, 64)','rgb(75, 192, 192)','rgb(54, 162, 235)','rgb(153, 102, 255)','rgb(255, 205, 86)','rgb(75, 192, 192)','rgb(54, 162, 235)','rgb(153, 102, 255)','rgb(75, 192, 192)','rgb(54, 162, 235)','rgb(153, 102, 255)','rgb(54, 162, 235)','rgb(153, 102, 255)','rgb(255, 205, 86)','rgb(201, 203, 207)' ],
                        borderWidth: 1
                      }]
                    },
                    options: {scales: { y: {beginAtZero: true}   }}
                  });
                });
              </script>
          </div>
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
</body>
</html>