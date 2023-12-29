<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Kunlik tashriflar</title>
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
    $submenu = "kunliktashrif";
    include("./connect/menu.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Kunlik tashriflar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Kunlik tashriflar</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
      <div class="row">
        <?php
          $S = date('Y-m-d',strtotime('-3 month'))." 00:00:00";
          $E = date('Y-m-d')." 23:59:59";
          $sqldiag = "SELECT * FROM `users` JOIN `user_student` ON users.UserID=user_student.UserID WHERE `DateInsert`>='".$S."' AND `DateInsert`<='".$E."'";
          $resdiag = $conn->query($sqldiag);
          $Telegram = 0;
          $Facebook = 0;
          $Instagram = 0;
          $Bannerlar = 0;
          $Tanishlar = 0;
          while ($row = $resdiag->fetch()) {
            if($row['Haqimizda']==='Telegram'){
              $Telegram = $Telegram + 1;
            }elseif($row['Haqimizda']==='Instagram'){
              $Facebook = $Facebook + 1;
            }elseif($row['Haqimizda']==='Facebook'){
              $Instagram = $Instagram + 1;
            }elseif($row['Haqimizda']==='Bannerlar'){
              $Bannerlar = $Bannerlar + 1;
            }elseif($row['Haqimizda']==='Tanishlar'){
              $Tanishlar = $Tanishlar + 1;
            }
          }
        ?>
        <div class="col-lg-12">
          <div class="info-box card px-1">
            <h3 class="w-100 text-center">KUNLIK TASHRIFLAR</h3>
            <canvas id="lineChart" style="max-height: 250px;"></canvas>
            <?php 
              $Tashriflar = array();
              $Guruhlarda = array();
              $Tulovlar = array();

              for($i=-5;$i<=0;$i++){
                $Start = date('Y-m-d',strtotime(''.$i.' day'))." 00:00:00";
                $End = date('Y-m-d',strtotime(''.$i.' day'))." 23:59:59";
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
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#lineChart'), {
                  type: 'line',
                  data: {
                    labels: [<?php for($i=-5;$i<=0;$i++){echo "'".date('m-d',strtotime(''.$i.' day'))."', ";}?>],
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
                  <?php
                    for($i=-5;$i<=0;$i++){
                      echo "<td>".date('m-d',strtotime(''.$i.' day'))."</td>";
                    }
                  ?>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div id="pieChart" style="min-height: 400px;" class="echart"></div>
          <script>
            document.addEventListener("DOMContentLoaded", () => {
              echarts.init(document.querySelector("#pieChart")).setOption({
                title: {text: 'MARKAZIMIZ HAQIDA',subtext: 'Oxirgi 3 oy mobaynida',left: 'center'},
                tooltip: {trigger: 'item'},
                legend: {orient: 'vertical',left: 'left'},
                series: [{
                  name: 'Tashriflar soni',
                  type: 'pie',
                  radius: '70%',
                  data: [
                    {value: <?php echo $Facebook; ?>, name: 'Facebook'},
                    {value: <?php echo $Bannerlar; ?>, name: 'Bannerlar'},
                    {value: <?php echo $Tanishlar; ?>, name: 'Tanishlar'},
                    {value: <?php echo $Instagram; ?>, name: 'Instagram'},
                    {value: <?php echo $Telegram; ?>, name: 'Telegram'}
                  ],
                  emphasis: {
                    itemStyle: {
                      shadowBlur: 10,
                      shadowOffsetX: 0,
                      shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                  }
                }]
              });
            });
          </script>
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