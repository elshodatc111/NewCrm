<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Oylik to'lovlar</title>
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
    $submenu = "oyliktulovlar";
    include("./connect/menu.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Oylik to'lovlar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Oylik to'lovlar</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
        <div class="info-box card ">
            <h5 class="card-title w-100 text-center pb-0 mb-1">Oylik to'lovlar</h5>
            <canvas id="barChart" style="max-height: 300px;"></canvas>
                <?php 
                $NaqtOy = array();
                $PlastikOy = array();
                $ChegirmaOy = array();
                $ChegirmaQ = array();
                $TulovlarA = array();
                $Xarajatlar = array();
                $Daromad = array();
                for($i=-5;$i<=0;$i++){
                    $Start = date('Y-m',strtotime(''.$i.' month'))."-01 00:00:00";
                    $End = date('Y-m',strtotime(''.$i.' month'))."-31 23:59:59";
                    $sqlNaqt = "SELECT * FROM `user_student_tulov` WHERE `TulovType`='Naqt' AND `InsertData`>='".$Start."' AND `InsertData`<='".$End."'";
                    $resNaqt = $conn->query($sqlNaqt);
                    $summaN = 0;
                    while ($row = $resNaqt->fetch()) {$summaN = $summaN + $row['TulovSumma'];}
                    array_push($NaqtOy, $summaN);
                    $sqlPlastik = "SELECT * FROM `user_student_tulov` WHERE `TulovType`='Plastik' AND `InsertData`>='".$Start."' AND `InsertData`<='".$End."'";
                    $resPlastik = $conn->query($sqlPlastik);
                    $summaP = 0;
                    while ($row = $resPlastik->fetch()) {$summaP = $summaP + $row['TulovSumma'];}
                    array_push($PlastikOy, $summaP);
                    $sqlChegirma = "SELECT * FROM `user_student_tulov` WHERE `TulovType`='Chegirma' AND `InsertData`>='".$Start."' AND `InsertData`<='".$End."'";
                    $resChegirma = $conn->query($sqlChegirma);
                    $summaCH = 0;
                    while ($row = $resChegirma->fetch()) {$summaCH = $summaCH + $row['TulovSumma'];}
                    array_push($ChegirmaOy, $summaCH);
                    $sqlChegirma = "SELECT * FROM `user_student_tulov` WHERE `TulovType`='Qaytarildi' AND `InsertData`>='".$Start."' AND `InsertData`<='".$End."'";
                    $resChegirma = $conn->query($sqlChegirma);
                    $summaQ = 0;
                    while ($row = $resChegirma->fetch()) {$summaQ = $summaQ + $row['TulovSumma'];}
                    array_push($ChegirmaQ, $summaQ);
                    $sqlTulov01 = "SELECT * FROM `user_techer_tulov` WHERE `Data`>='".$Start."' AND `Data`<='".$End."'";
                    $resTulov01 = $conn->query($sqlTulov01);
                    $Tulov01 = 0;
                    while ($row = $resTulov01->fetch()) {
                    $Tulov01 = $Tulov01 + $row['TulovSumma'];
                    }
                    $sqlTulov02 = "SELECT * FROM `user_admin_tulov` WHERE `Data`>='".$Start."' AND `Data`<='".$End."'";
                    $resTulov02 = $conn->query($sqlTulov02);
                    while ($row = $resTulov02->fetch()) {
                    $Tulov01 = $Tulov01 + $row['Summa'];
                    }
                    array_push($TulovlarA, $Tulov01);
                    $sqlXarajat = "SELECT * FROM `moliya` WHERE `Typing`='Xarajat' AND `TasdiqData`>='".$Start."' AND `TasdiqData`<='".$End."' AND `Status`='true'";
                    $resXarajat = $conn->query($sqlXarajat);
                    $Xarajat = 0;
                    while ($row = $resXarajat->fetch()) {
                    $Xarajat = $Xarajat + $row['Summa'];
                    }
                    array_push($Xarajatlar, $Xarajat);
                    $Daromats = $summaN+$summaP-$summaQ-$Tulov01-$Xarajat;
                    array_push($Daromad, $Daromats);
                }
                ?>
                <script>
                document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                        labels: [<?php for($i=-5;$i<=0;$i++){echo "'".date('Y-m',strtotime(''.$i.' month'))."', ";}?>],
                        datasets: [{
                        label: 'Naqt (so`m)',data: [
                            <?php foreach ($NaqtOy as $val) {
                            echo $val.",";} ?>],
                            backgroundColor: ['#50C878','#50C878','#50C878','#50C878','#50C878','#50C878'],
                            borderWidth: 1
                            },{
                        label: 'Plastik (So`m)',data: [<?php foreach ($PlastikOy as $val) {echo $val.",";} ?>],backgroundColor: ['#02B300','#02B300','#02B300','#02B300','#02B300','#02B300','#02B300'],borderWidth: 1},{
                        label: 'Chegirmalar (So`m)',data: [<?php foreach ($ChegirmaOy as $val) {echo $val.",";} ?>],backgroundColor: ['#FEFF0C','#FEFF0C','#FEFF0C','#FEFF0C','#FEFF0C','#FEFF0C','#FEFF0C'],borderWidth: 1},{
                        label: 'Qaytarilgan (So`m)',data: [<?php foreach ($ChegirmaQ as $val) {echo $val.",";} ?>],backgroundColor: ['red','red','red','red','red','red','red'],borderWidth: 1},{
                        label: 'To`langan ish haqi (So`m)',data: [<?php foreach ($TulovlarA as $val) {echo $val.",";} ?>],backgroundColor: ['blue','blue','blue','blue','blue','blue','blue'],borderWidth: 1},{
                        label: 'Xarajatlar (So`m)',data: [<?php foreach ($Xarajatlar as $val) {echo $val.",";} ?>],
                        backgroundColor: ['#CC397B','#CC397B','#CC397B','#CC397B','#CC397B','#CC397B','#CC397B'],borderWidth: 1},{
                        label: 'Daromad (So`m)',data: [<?php foreach ($Daromad as $val) {echo $val.",";} ?>],backgroundColor: ['#25FF2F','#25FF2F','#25FF2F','#25FF2F','#25FF2F','#25FF2F','#25FF2F'],borderWidth: 1
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
            <div class="table-responsive">
                <table class="table table-bordered text-center mt-2">
                <tr>
                    <th style="text-align:left;">NAQT</th>
                    <?php foreach ($NaqtOy as $val) {echo "<td><b style='color:white;background-color:#50C878;padding:0 5px;'>".number_format($val, 0, '.', ' ')."</b></td>";} ?>
                </tr>
                <tr>
                    <th style="text-align:left;">PLASTIK</th>
                    <?php foreach ($PlastikOy as $val) {echo "<td><b style='color:white;background-color:orange;padding:0 5px;'>".number_format($val, 0, '.', ' ')."</td></b>";} ?>
                </tr>
                <tr>
                    <th style="text-align:left;">CHEGIRMA</th>
                    <?php foreach ($ChegirmaOy as $val) {echo "<td><b style='color:#000;background-color:yellow;padding:0 5px;'>".number_format($val, 0, '.', ' ')."</td></b>";} ?>
                </tr>
                <tr>
                    <th style="text-align:left;">QAYTARILDI</th>
                    <?php foreach ($ChegirmaQ as $val) {echo "<td><b style='color:white;background-color:red;padding:0 5px;'>".number_format($val, 0, '.', ' ')."</td></b>";} ?>
                </tr>
                <tr>
                    <th style="text-align:left;">XARAJATLAR</th>
                    <?php foreach ($Xarajatlar as $val) {echo "<td><b style='color:white;background-color:#CC397B;padding:0 5px;'>".number_format($val, 0, '.', ' ')."</td></b>";} ?>
                </tr>
                <tr>
                    <th style="text-align:left;">ISH HAQI</th>
                    <?php foreach ($TulovlarA as $val) {echo "<td><b style='color:white;background-color:blue;padding:0 5px;'>".number_format($val, 0, '.', ' ')."</td></b>";} ?>
                </tr>
                <tr>
                    <th style="text-align:left;">DAROMAD</th>
                    <?php foreach ($Daromad as $val) {echo "<td><b style='color:white;background-color:green;padding:0 5px;'>".number_format($val, 0, '.', ' ')."</td></b>";} ?>
                </tr>
                <tr>
                    <th style="text-align:left;">SANA</th>
                    <?php for($i=-5;$i<=0;$i++){echo "<th><b>".date('Y-m',strtotime(''.$i.' month'))."</th></b>";}?>
                </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class='col-lg-6'>
            <div class="info-box card ">
                <h5 class="card-title w-100 text-center pb-0 mb-1">Oylik to'lovlar (So'm)</h5>
                <canvas id="pieChart" style="max-height: 300px;"></canvas>
                <?php
                    $date = date("Y-m");
                    $sqltul = "SELECT * FROM `user_student_tulov` WHERE `InsertData`>='".date("Y-m")."-01 00:00:00' AND `InsertData`<='".date("Y-m")."-31 23:59:59'";
                    $restul = $conn->query($sqltul);
                    $Naqt = 0;
                    $Plastik = 0;
                    $Chegirma = 0;
                    $Qaytar = 0;
                    while ($row = $restul->fetch()) {
                    if($row['TulovType']==='Naqt'){
                        $Naqt = $Naqt + $row['TulovSumma'];
                    }elseif($row['TulovType']==='Plastik'){
                        $Plastik = $Plastik + $row['TulovSumma'];
                    }elseif($row['TulovType']==='Chegirma'){
                        $Chegirma = $Chegirma + $row['TulovSumma'];
                    }elseif($row['TulovType']==='Qaytarildi'){
                        $Qaytar = $Qaytar + $row['TulovSumma'];
                    }
                    }
                    $Jami = $Naqt+$Plastik+$Chegirma+$Qaytar;
                    if($Jami===0){
                    $Naqt1 = 0;
                    $Plastik1 = 0;
                    $Chegirma1 = 0;
                    $Qaytar1 = 0;
                    }else{
                    $Naqt1 = ($Naqt*100)/$Jami;
                    $Plastik1 = ($Plastik*100)/$Jami;
                    $Chegirma1 = ($Chegirma*100)/$Jami;
                    $Qaytar1 = ($Qaytar*100)/$Jami;
                    }
                ?>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#pieChart'), {
                        type: 'pie',
                        data: {
                        labels: ['Naqt','Plastik','Qaytarildi','Chegirma'],
                        datasets: [{
                            label: 'So`m',
                            data: [<?php echo $Naqt.",".$Plastik.",".$Qaytar.",".$Chegirma; ?>],
                            backgroundColor: [
                            'rgb(0, 255, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(250, 0, 0)',
                            'rgb(255, 255, 0)'
                            ],
                            hoverOffset: 4
                        }]
                        }
                    });
                    });
                </script>
            </div>
            </div>
            <div class='col-lg-6'>
            <div class="info-box card ">
                <h5 class="card-title w-100 text-center pb-0 mb-1">Oylik to'lovlar (%)</h5>
                <canvas id="doughnutChart" style="max-height: 300px;"></canvas>
                <script>
                document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#doughnutChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Naqt','Plastik','Qaytarildi','Chegirma'],
                        datasets: [{
                        label: '%',
                        data: [<?php echo $Naqt1.",".$Plastik1.",".$Chegirma1.",".$Qaytar1; ?>],
                        backgroundColor: [
                            'rgb(0, 255, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(250, 0, 0)',
                            'rgb(255, 255, 0)'
                            ],
                        hoverOffset: 4
                        }]
                    }
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