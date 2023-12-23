<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Guruh haqida</title>
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
  <script>
    <?php
      if(isset($_GET['guruhedet'])){echo "alert('Guruh malumotlari o`zgartitildi')";}
      if(isset($_GET['techerplus'])){echo "alert('Guruhga o`qituvchi biriktirildi')";}
      if(isset($_GET['guruhgaqoshildi'])){echo "alert('Guruhga yangi talaba qo`shildi')";}
      if(isset($_GET['talabatolovplus'])){echo "alert('Talaba to`lov qabul qilindi')";}
      if(isset($_GET['chegirmaplus'])){echo "alert('Chegirma kiritildi')";}
      if(isset($_GET['eslatmaplus'])){echo "alert('Eslatma qoldirildi')";}
      if(isset($_GET['guruhdeltalabaerror'])){echo "alert('Guruhdan talaba chiqarilmadi. Talabaga qaytormoqchi bo`lgan summa guruh narxidan baland.')";}
    ?>
  </script>
</head>

<body>
  <!-- ======= TOP START ======= -->
  <?php  include("../connect/top2.php"); ?>
  <!-- ======= TOP END ======= -->
  
  <?php
    $guruh = "guruh";
    include("../connect/menu2.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Guruh</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="../guruhlar.php">Guruhlar</a></li>
          <li class="breadcrumb-item"><a href="./guruh_eye.php?GuruhID=<?php echo $_GET['GuruhID']; ?>">Guruh haqida</a></li>
          <li class="breadcrumb-item active">Guruhni davom etish</li>
        </ol>
      </nav>
    </div>
    <?php
        $sqlg = "SELECT * FROM `guruh` WHERE `GuruhID`='".$_GET['GuruhID']."'";
        $resg = $conn->query($sqlg);
        $rowg = $resg->fetch();
        $sqlr = "SELECT * FROM `rooms` WHERE `RoomID`='".$rowg['RoomID']."'";
        $resr = $conn->query($sqlr);
        $rowr = $resr->fetch();
    ?>
    <section class="section contact">
        <div class="row">
            <div class="info-box card">
                <form action="../config/guruh/guruh_plus_new.php?GuruhID=<?php echo $_GET['GuruhID']; ?>" method="POST" class="row" id="form1">
                    
                    <div class="col-lg-6">
                        <h5 class="w-100 text-center">Guruh haqida</h5>
                        <label class="form-label mt-1 mb-0" style="font-weight:600;">Guruh nomi</label>
                        <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['GuruhName']; ?>" disabled>
                        <label class="form-label mt-1 mb-0" style="font-weight:600;">To'lov summasi</label>
                        <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['GuruhSumma']; ?>" disabled>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">O'qituvchiga to'lov</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['TechTulov']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">O'qituvchiga bonus</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['TechBonus']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                                <?php
                                    $start = explode("-",$rowg['Start']);
                                    $ends = explode("-",$rowg['End']);
                                ?>
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Boshlanish vaqti</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $start['2']."-".$start['1']."-".$start['0']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Yakunlanish vaqti</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $ends['2']."-".$ends['1']."-".$ends['0'];; ?>" disabled>
                            </div>
                        </div>
                        <label class="form-label mt-1 mb-0" style="font-weight:600;">Xona</label>
                        <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowr['Room']; ?>" disabled>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Dushanba</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Dushanba']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Seshanba</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Seshanba']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Chorshanba</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Chorshanba']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Payshanba</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Payshanba']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Juma</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Juma']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Shanba</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Shanba']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="w-100 text-center mt-2">Yangi guruh</h5>
                        <label class="form-label mt-1 mb-0" style="font-weight:600;">Guruh nomi</label>
                        <input type="text" class="form-control mt-0" name="GuruhNomi" style="border-radius:0;" required>
                        <label class="form-label mt-1 mb-0" style="font-weight:600;">To'lov summasi</label>
                        <input type="text" name="GuruhSumma" class="form-control mt-0" id="summa01" style="border-radius:0;" required>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">O'qituvchiga to'lov</label>
                            <input type="text" name="TechTulov" class="form-control mt-0" id="summa02" style="border-radius:0;" required>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">O'qituvchiga bonus</label>
                            <input type="text" name="TechBonus" class="form-control mt-0" id="summa03" value="0" style="border-radius:0;" required>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Boshlanish vaqti</label>
                            <input type="date" id="date1" name="Start" class="form-control mt-0" style="border-radius:0;" required>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Yakunlanish vaqti</label>
                            <input type="date" id="date2" name="End" class="form-control mt-0" style="border-radius:0;" required>
                            </div>
                        </div>
                        <label class="form-label mt-1 mb-0" style="font-weight:600;">Xonani tanlang</label>
                        <select class="form-control mt-0" name="RoomID" style="border-radius:0;" required>
                            <option value=<?php echo $rowg['RoomID']; ?>><?php echo $rowr['Room']; ?></option>
                        </select>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Dushanba</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Dushanba']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Seshanba</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Seshanba']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Chorshanba</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Chorshanba']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Payshanba</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Payshanba']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Juma</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Juma']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                            <label class="form-label mt-1 mb-0" style="font-weight:600;">Shanba</label>
                            <input type="text" class="form-control mt-0" style="border-radius:0;" value="<?php echo $rowg['Shanba']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 mt-5">
                        <h5 class="w-100 text-center mt-2">Yangi guruhga talabalarni qo'shish uchun talabalarni tanlang</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center align-baseline table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr class="align-middle">
                                    <th style="background-color: blue;color:white">#</th>
                                    <th style="background-color: blue;color:white">Talaba</th>
                                    <th style="background-color: blue;color:white">Guruhga qo'shildi</th>
                                    <th style="background-color: blue;color:white">Talaba balansi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sqlt = "SELECT users.FIO,guruh_plus.UserID, guruh_plus.Start FROM `guruh_plus` JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh_plus.GuruhID='".$_GET['GuruhID']."' AND guruh_plus.Status='true'";
                                    $rest = $conn->query($sqlt);
                                    $i = 1;
                                    while ($rowt = $rest->fetch()) {
                                        #Talaba Balansi
                                        $Balans = 0;
                                        # Talaba jami to'lovlar
                                        $sqltul = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$rowt['UserID']."'";
                                        $restul = $conn->query($sqltul);
                                        while ($rowtul = $restul->fetch()) {
                                            if($rowtul['TulovType']==='Qaytarildi'){
                                                $Balans = $Balans - $rowtul['TulovSumma'];
                                            }else{
                                                $Balans = $Balans + $rowtul['TulovSumma'];
                                            }
                                        }
                                        #Talaba jarimalar
                                        $sqlj = "SELECT * FROM `guruh_user_del` WHERE `UserID`='".$rowt['UserID']."'";
                                        $resj = $conn->query($sqlj);
                                        while ($rowj = $resj->fetch()) {
                                            $Balans = $Balans - $rowj['GuruhSumma'];
                                        }
                                        #Talaba guruhga to'lovlari
                                        $sqljg = "SELECT guruh.GuruhSumma FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.Status='true' AND guruh_plus.UserID='".$rowt['UserID']."'";
                                        $resjg = $conn->query($sqljg);
                                        while ($rowjg = $resjg->fetch()) {
                                            $Balans = $Balans - $rowjg['GuruhSumma'];
                                        }
                                        echo "<tr>
                                            <td>
                                                <input type='checkbox' name=".$rowt['UserID'].">
                                            </td>
                                            <td style='text-align:left'>".$rowt['FIO']."</td>
                                            <td>".$rowt['Start']."</td>
                                            <td>".number_format(($Balans), 0, '.', ' ')."</td>
                                        </tr>";
                                        $i++;
                                    }
                                    if($i===1){
                                        echo "<tr><td>Talagalar biriktirilmagan</td></tr>";
                                    }
                                ?>
                                
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-primary" style="border-radius:0;">Yangi guruh ochish</button>
                    </div>
                </form>
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
                var $input1 = $form1.find( "#summa01" );
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
                var $input2 = $form1.find( "#summa02" );
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
                var $input3 = $form1.find( "#summa03" );
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
 
            });
        })(jQuery);
  </script>
</body>
</html>