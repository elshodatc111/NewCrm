<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Hodim</title>
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
      if(isset($_GET['editpassword'])){echo "alert('Parol yangilandi')";}
      if(isset($_GET['tulovplus'])){echo "alert('Ish haqi to`lov qilindi')";}
    ?>
  </script>
</head>

<body>
  <!-- ======= TOP START ======= -->
  <?php  include("../connect/top2.php"); ?>
  <!-- ======= TOP END ======= -->
  
  <?php
    $guruh = "hodim";
    include("../connect/menu2.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Hodimlar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="../hodimlar.php">Hodimlar</a></li>
          <li class="breadcrumb-item active">Hodim</li>
        </ol>
      </nav>
    </div>
    <?php
      if(isset($_GET['UserID'])){
        $sql1 = "SELECT * FROM `users` JOIN `user_admin` ON users.UserID=user_admin.UserID WHERE users.UserID='".$_GET['UserID']."'";
        $res1 = $conn->query($sql1);
        $row1 = $res1->fetch();
        $FIO = $row1['FIO'];
        $Phone = $row1['Phone'];
        $TKun = $row1['TKun'];
        $Manzil = $row1['Manzil'];
        $Username = $row1['Username'];
        $EditDate = $row1['DateUpdate'];
        $Lavozim = $row1['Type'];
        $Kiritish = $row1['Plus'];
        $Taxrirlash = $row1['Edit'];
        $Ochirish = $row1['Trash'];
        $StartDate = $row1['DateInsert'];
      }else{
        $FIO = ""; $Phone = ""; $TKun = ""; $Manzil = ""; $Username = ""; $EditDate = ""; $Lavozim = ""; $Kiritish = ""; $Taxrirlash = ""; $Ochirish = ""; $StartDate = "";
      }
    ?>
    <section class="section contact">
      <div class="row">
        <div class="col-lg-6">
          <div class="info-box card" style="min-height:250px">
            <h3 class="text-center"><?php echo $FIO; ?></h3>
            <p><b>Manzil: </b><?php echo $Manzil; ?></p>
            <p><b>Telefon: </b><?php echo $Phone; ?></p>
            <p><b>Tug`ilgan kun: </b><?php echo $TKun; ?></p>
            <p><b>Login: </b><?php echo $Username; ?></p>
            <p><b>Ro'yhatga olindi: </b><?php echo $StartDate; ?></p><br>
            <button class="btn btn-outline-primary" style="border-radius:0;<?php if($UEdit==='off'){echo 'display:none';} ?>" data-bs-toggle="modal" data-bs-target="#edetparol"><i class='bi bi-lock' style='font-size:15px;color:blue'></i>Parolni yangilash</button>
            <div class="modal fade" id="edetparol" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Parolni yangilash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="../config/hodim_edit_password.php?UserID=<?php echo $_GET['UserID']; ?>" class="form" method="POST">
                      <label>Yangi parol kiriting</label>
                      <input type="password" name="password" class="form-control mt-2" style="border-radius:0;" required>
                      <button class="btn btn-outline-primary w-100 mt-2" style="border-radius:0;"><i class='bi bi-lock' style='font-size:15px;color:blue'></i> Parolni yangilash</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="info-box card" style="min-height:250px">
            <h3 class="text-center">Ruhsatlar</h3>
            <p><b>Lavozi,: </b><?php echo $Lavozim; ?></p>
            <p><b>Kiritish: </b><?php echo $Kiritish; ?></p>
            <p><b>Taxrirlash: </b><?php echo $Taxrirlash; ?></p>
            <p><b>O`chirish: </b><?php echo $Ochirish; ?></p>
            <p><b>Malumotlar yangilandi: </b><?php echo $EditDate; ?></p><br>
            <button class="btn btn-outline-primary" style="border-radius:0;<?php if($UIns==='off'){echo 'display:none';} ?>" data-bs-toggle="modal" data-bs-target="#ishhaqi">Ish haqi to'lov</button>
            <div class="modal fade" id="ishhaqi" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Ish haqini to'lash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="../config/hodim_tulov_plus.php?UserID=<?php echo $_GET['UserID']; ?>" method="POST" class="form" id="form1">
                      <label class="mt-2">To'lov turi</label>
                      <select class="form-control mt-2" name="Type" style="border-radius:0;" required>
                        <option value="">Tanlang</option>
                        <option value="Naqt">Naqt</option>
                        <option value="Plastik">Plastik</option>
                      </select>
                      <label class="mt-2">To'lov so'mmasi</label>
                      <input type="text" class="form-control mt-2" name="Summa" id="summa1" style="border-radius:0;" required>
                      <label class="mt-2">Izoh</label>
                      <input type="text" class="form-control mt-2" name="Izoh" style="border-radius:0;" required>
                      <button class="btn btn-outline-primary w-100 mt-3" style="border-radius:0;">To'lov qilish</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="info-box card">
            <h3 class="text-center">To'langan ish haqi</h3>
            <div class="table-responsive">
            <table class="table table-bordered text-center align-baseline table-striped" cellspacing="0">
                <thead>
                  <tr class="align-middle">
                    <th style="background-color: blue;color:white">#</th>
                    <th style="background-color: blue;color:white">To'lov vaqti</th>
                    <th style="background-color: blue;color:white">To'lov Turi</th>
                    <th style="background-color: blue;color:white">To'lov summasi</th>
                    <th style="background-color: blue;color:white">Izoh</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM `user_admin_tulov` WHERE `UserID`='".$_GET['UserID']."'";
                    $res = $conn->query($sql);
                    $i=1;
                    while($row = $res->fetch()){
                      echo "<tr>
                          <td>".$i."</td>
                          <td>".$row['Data']."</td>
                          <td>".$row['TulovType']."</td>
                          <td>".number_format(($row['Summa']), 0, '.', ' ')."</td>
                          <td style='text-align:left;'>".$row['Izoh']."</td>
                      </tr>";
                      $i++;
                    }
                    if($i===1){
                      echo "<tr><td colspan=5 class='text-center'>Hodimga ish haqi to`lanmagan</td></tr>";
                    }
                  ?>
                </tbody>
            </table> 
          </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="info-box card text-center">
            <h3>Hodimning qabul qilgan to'lovlari</h3>
            <div class="table-responsive">
              <form action="hodim_eye.php?UserID=<?php echo $_GET['UserID']; ?>" method="POST" class="row mb-2">
                <div class="col-lg-4">
                  <input type="date" name="Data1" style='border-radius:0;' required class="form-control">
                </div>
                <div class="col-lg-4">
                  <input type="date" name="Data2" style='border-radius:0;' required class="form-control">
                </div>
                <div class="col-lg-4">
                  <input type="submit" name="Filter" value="filter" style='border-radius:0;' required class="btn btn-primary w-100">
                </div>
              </form>
              <table  class="table table-bordered text-center align-baseline table-striped" style="font-size:14px" id="dataTable" cellspacing="0">
                  <thead>
                    <tr class="align-middle">
                      <th style="background-color: blue;color:white">#</th>
                      <th style="background-color: blue;color:white">Talaba</th>
                      <th style="background-color: blue;color:white">To'lov turi</th>
                      <th style="background-color: blue;color:white">To'lov summasi</th>
                      <th style="background-color: blue;color:white">To'lov vaqti</th>
                      <th style="background-color: blue;color:white">Izoh</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if(isset($_POST['Filter'])){
                        $sqltulov = "SELECT 
                        users.FIO,
                        user_student_tulov.TulovType,
                        user_student_tulov.TulovSumma,
                        user_student_tulov.Izoh,
                        user_student_tulov.InsertData FROM `user_student_tulov` 
                        JOIN `users` ON user_student_tulov.UserID = users.UserID 
                        WHERE user_student_tulov.MenegerID='".$_GET['UserID']."' AND
                        user_student_tulov.InsertData>='".$_POST['Data1']." 00:00:00' AND user_student_tulov.InsertData<='".$_POST['Data2']." 23:59:00'
                        ORDER BY user_student_tulov.id DESC";
                      }else{
                        $sqltulov = "SELECT 
                        users.FIO,
                        user_student_tulov.TulovType,
                        user_student_tulov.TulovSumma,
                        user_student_tulov.Izoh,
                        user_student_tulov.InsertData FROM `user_student_tulov` 
                        JOIN `users` ON user_student_tulov.UserID = users.UserID 
                        WHERE user_student_tulov.MenegerID='".$_GET['UserID']."' ORDER BY user_student_tulov.id DESC";
                      }
                      $resTulov = $conn->query($sqltulov);
                      $i=1;
                      $Naqt = 0;
                      $Plastik = 0;
                      while ($row = $resTulov->fetch()) {
                        if($row['TulovType'] === 'Naqt'){
                          $Naqt = $Naqt + $row['TulovSumma'];
                        }elseif ($row['TulovType'] === 'Plastik') {
                          $Plastik = $Plastik + $row['TulovSumma'];
                        }
                        echo "<tr>
                          <td>".$i."</td>
                          <td style='text-align:left;'>".$row['FIO']."</td>
                          <td>".$row['TulovType']."</td>
                          <td>".number_format(($row['TulovSumma']), 0, '.', ' ')."</td>
                          <td>".$row['InsertData']."</td>
                          <td style='text-align:left;'>".$row['Izoh']."</td>
                        </tr>";
                        $i++;
                      }
                      if($i===1){
                        echo "<tr><td colspan=6 class='text-center'>Hodim to'lovlar qabul qilmagan</td></tr>";
                      }
                      $Jami = $Naqt + $Plastik;
                    ?>
                  </tbody>
              </table>
              <hr>
              <?php
                if(isset($_POST['Filter'])){
                  echo $_POST['Data1']." - ".$_POST['Data2'];
                }
              ?>
              <table class="table table-bordered">
                <tr>
                  <th>Naqt To'lovlar</th>
                  <th>Plastik To'lovlar</th>
                  <th>Jami To'lovlar</th>
                </tr>
                <tr>
                  <td><?php echo number_format(($Naqt), 0, '.', ' '); ?></td>
                  <td><?php echo number_format(($Plastik), 0, '.', ' '); ?></td>
                  <td><?php echo number_format(($Jami), 0, '.', ' '); ?></td>
                </tr>
              </table>
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