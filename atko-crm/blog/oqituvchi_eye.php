<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>O'qituvchi haqida</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="../assets/img/icon.png" rel="icon">
  <link href="../assets/img/icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script>
    <?php
      if(isset($_GET['techereye'])){echo "alert('O`qituvchi ma`lumotlari yangilandi');";}
      if(isset($_GET['passwordedit'])){echo "alert('Parol bir xil kiritilmadi');";}
      if(isset($_GET['techpasss'])){echo "alert('O`qituvchi paroli yangilandi');";}
      if(isset($_GET['tulovplus'])){echo "alert('O`qituvchiga to`lov qilindi');";}
    ?>
  </script>
</head>

<body>
  <!-- ======= TOP START ======= -->
  <?php  include("../connect/top2.php"); ?>
  <!-- ======= TOP END ======= -->
  
  <?php
    $guruh = "techer";
    include("../connect/menu2.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>O'qituvchi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="../oqituvchi.php">O'qituvchilar</a></li>
          <li class="breadcrumb-item active">O'qituvchi haqida</li>
        </ol>
      </nav>
    </div>
    <?php
      $sql1 = "SELECT * FROM `users` JOIN `user_techer` ON users.UserID=user_techer.UserID WHERE users.UserID='".$_GET['UserID']."'";
      $res1 = $conn->query($sql1);
      $row1 = $res1->fetch();
    ?>
    <section class="section contact">
      <div class="info-box card ">
        <div class="row" style="<?php if($Type!='admin'){if($Type!='xisobchi'){echo "display:none;";}} ?>">
          <!-- O'qituvchi ish haqini to'lash -->
          <div class="col-lg-4">
            <button class="btn btn-success text-white mt-1 w-100" style="border-radius:0;<?php if($UIns==='off'){echo 'display:none;';} ?>" data-bs-toggle="modal" data-bs-target="#Ish_haqi">ISH HAQI TO'LOV QILISH</button>
            <div class="modal fade" id="Ish_haqi" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Ish haqi to'lash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="../config/techer/techer_tulov_plus.php?UserID=<?php echo $_GET['UserID']; ?>" method="post" id="form1">
                      <label class="mt-3">Guruhni tanlang<?php echo date('Y-m-d',strtotime('-31 day')); ?></label>
                      <select name="GuruhID" class='form-control' style='border-radius:0' required>
                        <option value="">Tanlang</option>
                        <?php
                          $sqlg = "SELECT * FROM `guruh` WHERE `TecherID`='".$_GET['UserID']."' AND `End`>='".date('Y-m-d',strtotime('-31 day'))."'";
                          $resg = $conn->query($sqlg);
                          while ($rowg = $resg->fetch()) {
                            echo "<option value=".$rowg['GuruhID'].">".$rowg['GuruhName']."</option>";
                          }
                        ?>
                      </select>
                      <label class="mt-3">To'lov Turi</label>
                      <select name="TulovType" class='form-control' style='border-radius:0' required>
                        <option value="">Tanlang</option>
                        <option value="Naqt">Naqt</option>
                        <option value="Plastik">Plastik</option>
                      </select>
                      <label class="mt-3">To'lov Summasi</label>
                      <input type='text' name="TulovSumma" id="summa1" class='form-control' style='border-radius:0' required>
                      <label class="mt-3">To'lov haqida izoh</label>
                      <textarea type='text' name="Izoh" class='form-control' style='border-radius:0' required></textarea>
                      <button type='submit' class="btn btn-outline-primary w-100 mt-3" style='border-radius:0;'>To'lov qilish</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- O'qituvchi parolini yangilash +++ -->
          <div class="col-lg-4">
            <button class="btn btn-primary text-white mt-1 w-100" style="border-radius:0;<?php if($UEdit==='off'){echo 'display:none;';} ?>" data-bs-toggle="modal" data-bs-target="#parol_edet">PAROLNI ALMASHTIRISH</button>
            <div class="modal fade" id="parol_edet" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Parolni yangilash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="../config/techer/techer_password_edit.php?UserID=<?php echo $_GET['UserID']; ?>" method="post">
                      <label class="mt-3">Yangi parol</label>
                      <input type='password' name="pass1" class='form-control' style='border-radius:0' required>
                      <label class="mt-3">Yangi parolni takrorlang</label>
                      <input type='password' name="pass2" class='form-control' style='border-radius:0' required>
                      <button type='submit' class="btn btn-outline-primary w-100 mt-3" style='border-radius:0;'>Parolni yangilsh</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- O'qituvchi malumotlarini yangilash ++++ -->
          <div class="col-lg-4">
            <button class="btn btn-info text-white mt-1 w-100" style="border-radius:0;<?php if($UEdit==='off'){echo 'display:none;';} ?>" data-bs-toggle="modal" data-bs-target="#profil_edet">MA`LUMOTLARNI YANGILASH</button>
            <div class="modal fade" id="profil_edet" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Malumotlarni yangilash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="../config/techer/techer_edit.php?UserID=<?php echo $_GET['UserID']; ?>" method="post">
                      <label class="mt-3">FIO</label>
                      <input type='text' class='form-control' name="FIO" style='border-radius:0' value="<?php echo $row1['FIO']; ?>" required>
                      <label class="mt-3">Telefon raqam</label>
                      <input type='text' class='form-control phone' name="Phone" style='border-radius:0' value="<?php echo $row1['Phone']; ?>" required>
                      <label class="mt-3">Mutahasilik</label>
                      <input type='text' class='form-control' name="Mutahasis" style='border-radius:0' value="<?php echo $row1['Mutahasilik']; ?>" required>
                      <label class="mt-3">O'qituvchi haqida</label>
                      <input type='text' class='form-control' name="About" style='border-radius:0' value="<?php echo $row1['About']; ?>" required>
                      <button type='submit' class="btn btn-outline-primary w-100 mt-3" style='border-radius:0;'>Ma`lumotlarni taxrirlash</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="info-box card p-1">
        <div class="accordion" id="accordionExample">
          <!-- O'qituvchi haqida +++ -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><h5>O'qituvchi haqida</h5></button></h2>
            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="row">
                  <div class="col-lg-6">
                    <table class="table">
                      <tr><th>FIO:</th><td style="text-align:right"><?php echo $row1['FIO']; ?></td></tr>
                      <tr><th>Telefon raqam:</th><td style="text-align:right"><?php echo $row1['Phone']; ?></td></tr>
                      <tr><th>Yashash manzil:</th><td style="text-align:right"><?php echo $row1['Manzil']; ?></td></tr>
                      <tr><th>Tug'ilgan kun:</th><td style="text-align:right"><?php echo $row1['TKun']; ?></td></tr>
                      <tr><th>Login:</th><td style="text-align:right"><?php echo $row1['Username']; ?></td></tr>
                    </table>
                  </div>
                  <div class="col-lg-6">
                    <table class="table">
                      <tr>
                        <th>Ro'yhatga olindi:</th><td style="text-align:right"><?php echo $row1['DateInsert']; ?></td>
                      </tr>
                      <tr>
                        <th>Ma`lumotlar taxrirlandi:</th><td style="text-align:right"><?php echo $row1['DateUpdate']; ?></td>
                      </tr>
                      <tr>
                        <th>Mutahasislik:</th><td style="text-align:right"><?php echo $row1['Mutahasilik']; ?></td>
                      </tr>
                      <tr>
                        <th>O'qituvchi haqida:</th><td style="text-align:right"><?php echo $row1['About']; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- O'qituvchi Guruhlari -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><h5>O'qituvchi guruhlari</h5></button></h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body p-0">
                <div class="table-responsive p-0">
                  <table class="table table-bordered text-center align-baseline table-striped" width="100%" cellspacing="0" style="font-size:14px;">
                    <thead>
                      <tr class="align-middle">
                        <th style="background-color: blue;color:white">#</th>
                        <th style="background-color: blue;color:white">Guruh</th>
                        <th style="background-color: blue;color:white">Boshlanish vaqti</th>
                        <th style="background-color: blue;color:white">Tugash vaqti</th>
                        <th style="background-color: blue;color:white">Talabalar soni</th>
                        <th style="background-color: blue;color:white">Yangi guruhdagi talabalar</th>
                        <th style="background-color: blue;color:white">O'qituvchi ish haqi</th>
                        <th style="background-color: blue;color:white">O'qituvchiga to'langan</th>
                        <th style="background-color: blue;color:white">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        #Barcha guruhlari
                        $thisday = date('Y-m-d',strtotime('-1 month'));
                        $sqla = "SELECT * FROM `guruh` WHERE `TecherID`='".$_GET['UserID']."' AND `End`>='".$thisday."' ORDER BY `id` DESC";
                        $resa = $conn->query($sqla);
                        $i=1;
                        while ($rowa = $resa->fetch()) {
                          #Guruh barcha aktiv talabalari
                          $sqlb = "SELECT * FROM `guruh_plus` WHERE `GuruhID`='".$rowa['GuruhID']."' AND `Status`='true'";
                          $resb = $conn->query($sqlb);
                          $talabalarsoni = 0;
                          $yangiTalaba = 0;
                          while ($rowb = $resb->fetch()) {
                            $talabalarsoni = $talabalarsoni + 1;
                            #Yangi guruhga o'tgan talabalar
                            $sqlc = "SELECT * FROM 
                              `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID WHERE 
                              guruh_plus.Status='true' AND 
                              guruh_plus.UserID='".$rowb['UserID']."' AND 
                              guruh.Start>='".$rowa['Start']."' AND guruh.GuruhID!='".$rowa['GuruhID']."'";
                            $resc = $conn->query($sqlc);
                            while ($rowc = $resc ->fetch()) {
                              $yangiTalaba = $yangiTalaba + 1;
                            }
                          }
                          if($yangiTalaba>$talabalarsoni){
                            $yangiTalaba = $talabalarsoni;
                          }
                          #O'qituvchiga hisoblangan ish haqi
                          $IshHaqi = $talabalarsoni*$rowa['TechTulov']+$yangiTalaba*$rowa['TechBonus'];
                          #Guruh holati
                          if($rowa['End']<date("Y-m-d")){$guruhholat="Yakunlangan";
                          }elseif($rowa['Start']>date("Y-m-d")){$guruhholat = "Yangi";
                          }else{$guruhholat = "Aktiv";}
                          #O'qituvchiga to'langan ish haqi
                          $sqld = "SELECT * FROM `user_techer_tulov` WHERE `GuruhID`='".$rowa['GuruhID']."' AND `TecherID`='".$_GET['UserID']."'";
                          $resd = $conn->query($sqld);
                          $Tolangan = 0;
                          while ($rowd = $resd ->fetch()) {
                            $Tolangan = $Tolangan + $rowd['TulovSumma'];
                          }
                          echo "<tr>
                            <td>".$i."</td>
                            <td style='text-align:left;'>".$rowa['GuruhName']."</td>
                            <td style='text-align:left;'>".$rowa['Start']."</td>
                            <td style='text-align:left;'>".$rowa['End']."</td>
                            <td>".$talabalarsoni."</td>
                            <td>".$yangiTalaba."</td>
                            <td>".number_format($IshHaqi, 0, '.', ' ')."</td>
                            <td>".number_format($Tolangan, 0, '.', ' ')."</td>
                            <td><a href=guruh_eye.php?GuruhID=".$rowa['GuruhID'].">".$guruhholat."</a></td>
                          </tr>";
                          $i++;
                        }
                        if($i===1){
                          echo "<tr><td>O'qituvchi guruhlari mavjud emas</td></tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- To'langan ish haqi +++ -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><h5>O'qituvchiga ish haqi to'lovlari</h5></button></h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="table-responsive">
                  <table class="table table-bordered text-center align-baseline table-striped" width="100%" cellspacing="0">
                    <thead>
                      <tr class="align-middle">
                        <th style="background-color: blue;color:white">#</th>
                        <th style="background-color: blue;color:white">Guruh</th>
                        <th style="background-color: blue;color:white">To'lov turi</th>
                        <th style="background-color: blue;color:white">To'lov summasi</th>
                        <th style="background-color: blue;color:white">Izoh</th>
                        <th style="background-color: blue;color:white">To'lov vaqti</th>
                        <th style="background-color: blue;color:white">Meneger</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $thisday2 = date('Y-m-d',strtotime('-1 month'))." 00:00:00";
                        $sqltulov = "SELECT * FROM `user_techer_tulov` WHERE `TecherID`='".$_GET['UserID']."' AND `Data`>='".$thisday2."' ORDER BY `id` DESC";
                        $restulov = $conn->query($sqltulov);
                        $i=1;
                        while ($row = $restulov->fetch()) {
                          $sqltechg = "SELECT * FROM `guruh` WHERE `GuruhID`='".$row['GuruhID']."'";
                          $restechg = $conn->query($sqltechg);
                          $rowtechg = $restechg->fetch();

                          $sqlte = "SELECT * FROM `users` WHERE `UserID`='".$row['Meneger']."'";
                          $reste = $conn->query($sqlte);
                          $rowte = $reste->fetch();

                          echo "<tr>
                            <td>".$i."</td>
                            <td style='text-align:left;'>".$rowtechg['GuruhName']."</td>
                            <td>".$row['TulovType']."</td>
                            <td>".number_format(($row['TulovSumma']), 0, '.', ' ')." so'm</td>
                            <td>".$row['Izoh']."</td>
                            <td>".$row['Data']."</td>
                            <td>".$rowte['Username']."</td>
                          </tr>";
                          $i++;
                        }
                        if($i===1){
                          echo "<tr><td colspan=7 class='text-center'>O'qituvchiga ish haqi to'lov qilinmagans</td></tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- O'qituvchi tarixi +++ -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tarixi" aria-expanded="false" aria-controls="collapseThree"><h5>O'qituvchiga tarixi</h5></button></h2>
            <div id="tarixi" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="table-responsive">
                  <table  class="table table-bordered text-center align-baseline table-striped" style='font-size:14px;' id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr class="align-middle">
                        <th style="background-color: blue;color:white">#</th>
                        <th style="background-color: blue;color:white">Izoh</th>
                        <th style="background-color: blue;color:white">Meneger</th>
                        <th style="background-color: blue;color:white">Vaqti</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql5 = "SELECT * FROM `user_history` WHERE `UserID`='".$_GET['UserID']."' ORDER BY user_history.id DESC";
                        $res5 = $conn->query($sql5);
                        $i=1;
                        while($row5 = $res5->fetch()){
                          $sqlh = "SELECT * FROM `users` WHERE `UserID`='".$row5['AdminID']."'";
                          $resh = $conn->query($sqlh);
                          $rowh = $resh->fetch();
                          echo "<tr>
                            <td>".$i."</td>
                            <td style='text-align:left;'>".$row5['Izoh']."</td>
                            <td>".$rowh['Username']."</td>
                            <td>".$row5['Data']."</td>
                          </tr>";
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
      </div>
    </section>
  </main>
  
  <<!-- ======= START FOOTER ======= -->
  <?php include("../connect/footer.php"); ?>
  <!-- ======= END FOOTER ======= -->

    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/jquery.masknumber.js"></script>
    <script src="../assets/js/jquery.masknumber.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/jquery.inputmask.min.js"></script>
    <script src="../assets/dselect.js"></script>
    <script src="../assets/js/script.js"></script>
    <script>
        (function($, undefined) {
            "use strict";
            $(function() {
                var $form1 = $( "#form1" );
                var $input1 = $form1.find( "#summa1" );
                $input1.on( "keyup", function( event ) {
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {return;}
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {return;}
                    var $this = $( this );
                    var input1 = $this.val();
                    var input1 = input1.replace(/[\D\s\._\-]+/g, "");
                    input1 = input1 ? parseInt( input1, 10 ) : 0;
                    $this.val( function() {return ( input1 === 0 ) ? "" : input1.toLocaleString( "en-US" );} );
                } );
                var $form2 = $( "#form2" );
                var $input2 = $form2.find( "#summa2" );
                $input2.on( "keyup", function( event ) {
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {return;}
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {return;}
                    var $this = $( this );
                    var input2 = $this.val();
                    var input2 = input2.replace(/[\D\s\._\-]+/g, "");
                    input2 = input2 ? parseInt( input2, 10 ) : 0;
                    $this.val( function() {return ( input2 === 0 ) ? "" : input2.toLocaleString( "en-US" );} );
                } );
                var $form3 = $( "#form3" );
                var $input3 = $form3.find( "#summa3" );
                $input3.on( "keyup", function( event ) {
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {return;}
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {return;}
                    var $this = $( this );
                    var input3 = $this.val();
                    var input3 = input3.replace(/[\D\s\._\-]+/g, "");
                    input3 = input3 ? parseInt( input3, 10 ) : 0;
                    $this.val( function() {return ( input3 === 0 ) ? "" : input3.toLocaleString( "en-US" );} );
                } );
                var $form4 = $( "#form4" );
                var $input4 = $form4.find( "#summa4" );
                $input4.on( "keyup", function( event ) {
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {return;}
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {return;}
                    var $this = $( this );
                    var input4 = $this.val();
                    var input4 = input4.replace(/[\D\s\._\-]+/g, "");
                    input4 = input4 ? parseInt( input4, 10 ) : 0;
                    $this.val( function() {return ( input4 === 0 ) ? "" : input4.toLocaleString( "en-US" );} );
                } );
                var $form5 = $( "#form5" );
                var $input5 = $form5.find( "#summa5" );
                $input5.on( "keyup", function( event ) {
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {return;}
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {return;}
                    var $this = $( this );
                    var input5 = $this.val();
                    var input5 = input5.replace(/[\D\s\._\-]+/g, "");
                    input5 = input5 ? parseInt( input5, 10 ) : 0;
                    $this.val( function() {return ( input5 === 0 ) ? "" : input5.toLocaleString( "en-US" );} );
                } );
                var $form6 = $( "#form6" );
                var $input6 = $form6.find( "#summa6" );
                $input6.on( "keyup", function( event ) {
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {return;}
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {return;}
                    var $this = $( this );
                    var input6 = $this.val();
                    var input6 = input6.replace(/[\D\s\._\-]+/g, "");
                    input6 = input6 ? parseInt( input6, 10 ) : 0;
                    $this.val( function() {return ( input6 === 0 ) ? "" : input6.toLocaleString( "en-US" );} );
                } );
            });
        })(jQuery);
  </script>
</body>
</html>