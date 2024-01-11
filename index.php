<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Hodimlar</title>
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
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- ======= TOP START ======= -->
  <?php  include("./connect/top.php"); ?>
  <!-- ======= TOP END ======= -->

  <!-- ======= START MENU ======= -->
  <?php
    $menu = "Home";
    $blok = "false";
    $submenu = "false";
    include("./connect/menu.php");
  ?>
  <!-- ======= END MENU ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Bosh sahifa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Bosh sahifa</li>
        </ol>
      </nav>
    </div>




    <!-- Ogohlantirish -->
    <?php
      $sqloo = "SELECT * FROM `admin_eslatma` WHERE `Data`='".date("Y-m-d")."'";
      $resoo = $conn->query($sqloo);
      $i=0;
      while ($row=$resoo->fetch()) {
        echo "<div class='alert border-danger bg-white alert-dismissible fade show' role='alert'>
        ".$row['Test']."
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      $i++;
      if($i===1){
        break;
      }
      }
    ?>
    

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <!-- O'qituvchilar -->
            <div class="col-lg-4 text-center">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <?php
                    #O'qituvchilar
                    $sqltech = "SELECT * FROM `users` WHERE `Type`='techer';";
                    $restech = $conn->query($sqltech);
                    $tech = 0;
                    $techactiv = 0;
                    while ($row = $restech->fetch()) {
                      $tech = $tech + 1;
                      $sqltecha = "SELECT * FROM `guruh` WHERE `End`>='".date("Y-m-d")."' AND `TecherID`='".$row['UserID']."'";
                      $restecha = $conn->query($sqltecha);
                      $i=0;
                      while ($rowa = $restecha->fetch()) {
                        $i++;
                      }
                      if($i>0){
                        $techactiv = $techactiv + 1;
                      }
                    }
                  ?>
                  <h5 class="card-title">O'QITUVCHILAR</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-bounding-box"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $tech; ?></h6>
                      <span class="text-success small pt-1 fw-bold">
                        <?php echo $techactiv; ?>
                      </span> <span class="text-muted small pt-2 ps-1">AKTIV O'QITUVCHILAR</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Tashriflar -->
            <div class="col-lg-4 text-center">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">TASHRIFLAR</h5>
                  <?php
                    #Barcha tashriflar
                    $sqlt = "SELECT * FROM `users` WHERE `Type`='student'";
                    $rest = $conn->query($sqlt);
                    $tashriflar = 0;
                    $activtashrif = 0;
                    while($row=$rest->fetch()){
                      $tashriflar = $tashriflar + 1;
                      #AKTIV tashriflar
                      $sqlg2 = "SELECT DISTINCT guruh_plus.UserID FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.Status='true' AND guruh.End>='".date("Y-m-d")."' AND guruh_plus.UserID='".$row['UserID']."'";
                      $res2 = $conn->query($sqlg2);
                      $i=0;
                      while ($row2 = $res2->fetch()) {
                        $i++;
                      }
                      if($i>0){
                        $activtashrif = $activtashrif + 1;
                      }
                    }
                  ?>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $tashriflar; ?></h6>
                      <span class="text-danger small pt-1 fw-bold"><?php echo $activtashrif; ?></span> <span class="text-muted small pt-2 ps-1">AKTIV TASHRIFLAR</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Guruhlar -->
            <div class="col-lg-4 text-center">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">GURUHLAR</h5>
                  <?php
                    #Barcha guruhlar
                    $sqlg33 = "SELECT * FROM `guruh` WHERE `END`>='".date("Y-m-d")."'";
                    $resg33 = $conn->query($sqlg33);
                    $guruhlar = 0;
                    $activgur = 0;
                    while ($row = $resg33->fetch()) {
                      $guruhlar = $guruhlar + 1;
                      if($row['Start']<=date("Y-m-d")){
                        $activgur = $activgur + 1;
                      }
                    }
                  ?>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-diagram-3-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $guruhlar; ?></h6>
                      <span class="text-success small pt-1 fw-bold"><?php echo $activgur; ?></span> <span class="text-muted small pt-2 ps-1">AKTIV GURUHLAR</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Dars jadvali</h5>
                <?php
                  $sql = "SELECT * FROM `rooms`";
                  $res = $conn->query($sql);
                  $date = date("Y-m-d");
                  while($row = $res->fetch()){
                ?>
                  <h4 class="w-100 text-center"><?php echo $row['Room']; ?></h4>
                  <hr>
                  <div class="table-responsive">
                    <table class="table table-bordered border-primary text-center" style='font-size:14px;'>
                      <thead>
                        <tr>
                          <th scope="col">Dars vaqti / Hafta kuni</th>
                          <th scope="col">Dushanba</th>
                          <th scope="col">Seshanba</th>
                          <th scope="col">Chorshanba</th>
                          <th scope="col">Payshanba</th>
                          <th scope="col">Juma</th>
                          <th scope="col">Shanba</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $clock = array("08:00-09:30","09:30-11:00","11:00-12:30","12:30-14:00","14:00-15:30","15:30-17:00","17:00-18:30","18:30-20:00","20:00-21:30");
                          foreach ($clock as $value) {      
                            echo "<tr>
                              <th scope='row'>".$value."</th>"; 
                              #Dushanba
                              echo "<td>";$sqlDu = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Dushanba`='".$value."' AND `END`>'".$date."'";
                              $resDu = $conn->query($sqlDu);
                              $countDu = $resDu->fetchColumn();
                              if($countDu>0){
                                $sqlDu2 = "SELECT * FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Dushanba`='".$value."' AND `END`>'".$date."'";
                                $resDu2 = $conn->query($sqlDu2);
                                while($rowDu2 = $resDu2->fetch()){
                                  if($rowDu2['Start']<= $date){
                                    echo "<button 
                                      class='btn btn-outline-success' 
                                      style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                      title=".$rowDu2['GuruhName']." >AKTIV</button>";
                                  }else{echo "<button 
                                      class='btn btn-outline-primary' 
                                      style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                      title=".$rowDu2['GuruhName']." >YANGI</button>";}}
                              }else{echo "<button 
                                class='btn btn-outline-danger' 
                                style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                title='Dars qo`yilmagan' >BO`SH</button>";}echo "</td>";
                              #Seshanba
                              echo "<td>";$sqlSE = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Seshanba`='".$value."' AND `END`>'".$date."'";
                              $resSE = $conn->query($sqlSE);
                              $countSE = $resSE->fetchColumn();
                              if($countSE>0){
                                  $sqlSE2 = "SELECT * FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Seshanba`='".$value."' AND `END`>'".$date."'";
                                  $resSE2 = $conn->query($sqlSE2);
                                  while($rowSE2 = $resSE2->fetch()){
                                  if($rowSE2['Start']<= $date){
                                      echo "<button class='btn btn-outline-success' 
                                      style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                      title=".$rowSE2['GuruhName']." >AKTIV</button>";
                                  }else{
                                    echo "<button class='btn btn-outline-primary' 
                                    style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                    title=".$rowSE2['GuruhName']." >YANGI</button>";
                                  }
                                }
                              }else{echo "<button 
                                class='btn btn-outline-danger' 
                                style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                title='Dars qo`yilmagan' >BO`SH</button>";}echo "</td>";
                              #Chorshanba
                              echo "<td>";$sqlCHor = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Chorshanba`='".$value."' AND `END`>'".$date."'";
                              $resCHor = $conn->query($sqlCHor);
                              $countCHor = $resCHor->fetchColumn();
                              if($countCHor>0){
                                  $sqlchor = "SELECT * FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Chorshanba`='".$value."' AND `END`>'".$date."'";
                                  $reschor = $conn->query($sqlchor);
                                  while($rowchor = $reschor->fetch()){
                                  if($rowchor['Start']<= $date){
                                      echo "<button class='btn btn-outline-success' 
                                      style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                      title=".$rowchor['GuruhName']." >AKTIV</button>";
                                  }else{
                                    echo "<button class='btn btn-outline-primary' 
                                    style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                    title=".$rowchor['GuruhName']." >YANGI</button>";
                                  }
                                }
                              }else{echo "<button class='btn btn-outline-danger' 
                                style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                title='Dars qo`yilmagan' >BO`SH</button>";}echo "</td>";
                              #Payshanba
                              echo "<td>";$sqlPa = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Payshanba`='".$value."' AND `END`>'".$date."'";
                              $resPa = $conn->query($sqlPa);
                              $countPa = $resPa->fetchColumn();
                              if($countPa>0){
                                  $sqlPa2 = "SELECT * FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Payshanba`='".$value."' AND `END`>'".$date."'";
                                  $resPa2 = $conn->query($sqlPa2);
                                  while($rowPa2 = $resPa2->fetch()){
                                  if($rowPa2['Start']<= $date){
                                      echo "<button class='btn btn-outline-success' 
                                      style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                      title=".$rowPa2['GuruhName']." >AKTIV</button>";
                                  }else{echo "<button class='btn btn-outline-primary' 
                                    style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                    title=".$rowPa2['GuruhName']." >YANGI</button>";}}
                              }else{echo "<button class='btn btn-outline-danger' 
                                style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                title='Dars qo`yilmagan' >BO`SH</button>";}echo "</td>";
                              #Juma
                              echo "<td>";$sqlJu = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Juma`='".$value."' AND `END`>'".$date."'";
                              $resJu = $conn->query($sqlJu);
                              $countJu = $resJu->fetchColumn();
                              if($countJu>0){
                                  $sqlJu2 = "SELECT * FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Juma`='".$value."' AND `END`>'".$date."'";
                                  $resJu2 = $conn->query($sqlJu2);
                                  while($rowJu2 = $resJu2->fetch()){
                                  if($rowJu2['Start']<= $date){
                                      echo "<button class='btn btn-outline-success' 
                                      style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                      title=".$rowJu2['GuruhName']." >AKTIV</button>";
                                  }else{echo "<button class='btn btn-outline-primary' 
                                    style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                    title=".$rowJu2['GuruhName']." >YANGI</button>";}}
                              }else{echo "<button class='btn btn-outline-danger' 
                                style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                title='Dars qo`yilmagan' >BO`SH</button>";}echo "</td>";
                              #Shanba
                              echo "<td>";$sqlShab = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Shanba`='".$value."' AND `END`>'".$date."'";
                              $resShan = $conn->query($sqlShab);
                              $countShan = $resShan->fetchColumn();
                              if($countShan>0){
                                  $sqlShan2 = "SELECT * FROM guruh WHERE `RoomID`='".$row['RoomID']."' AND `Shanba`='".$value."' AND `END`>'".$date."'";
                                  $resShan2 = $conn->query($sqlShan2);
                                  while($rowShan22 = $resShan2->fetch()){
                                  if($rowShan22['Start']<= $date){
                                      echo "<button class='btn btn-outline-success' 
                                      style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                      title=".$rowShan22['GuruhName']." >AKTIV</button>";
                                  }else{echo "<button class='btn btn-outline-primary' 
                                    style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                    title=".$rowShan22['GuruhName']." >YANGI</button>";}}
                              }else{echo "<button class='btn btn-outline-danger' 
                                style='padding:1px 2px;border-radius:0;margin:0 2px;' 
                                title='Dars qo`yilmagan' >BO`SH</button>";}echo "</td>";
                              echo "</tr>";  
                            }
                        ?>
                      </tbody>
                    </table>
                    <hr>
                  </div>
                 <?php } ?>
              </div>
            </div>
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
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>

</body>
</html>