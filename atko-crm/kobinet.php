<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Kabinet</title>
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
  <script>
        <?php
            if(isset($_GET['passworderror'])){echo "alert('Siz joriy parolingizni noto`g`ri kiritdingiz.');";}
            if(isset($_GET['parolxarxil'])){echo "alert('Siz kiritgan yangi parol bir xil emas.');";}
            if(isset($_GET['loginedit'])){echo "alert('Sizning parolingiz yangilandi.');";}
        ?>
    </script>
</head>

<body>
  <!-- ======= TOP START ======= -->
  <?php  include("./connect/top.php"); ?>
  <!-- ======= TOP END ======= -->
  <?php
    $menu = "";
    $blok = "";
    $submenu = "";
    include("./connect/menu.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Kobinet</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Kobinet</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
      <div class="row">
        <div class="col-xl-4">
          <div class="card" style="min-height:350px">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center text-center">
              <img src="assets/img/ss.jpg" alt="Profile" class="rounded-circle">
              <h2><?php if(isset($_COOKIE['UserID'])){echo $FIO;}?></h2>
              <h3><?php if(isset($_COOKIE['UserID'])){echo $Username;}?></h3>
              <div class="social-links mt-2">Lavozim: <?php if(isset($_COOKIE['UserID'])){echo $Type;}?></div>
              <hr>
              <?php
                $sqlN = "SELECT * FROM `guruh_chegirma` WHERE `id`='1'";
                $resN = $conn->query($sqlN);
                $rowN = $resN->fetch();
              ?>
              <form action="./config/kobinet/chegirma_edit.php" method="post" id="form1" style="display:<?php if($Type!='admin'){echo 'none;';} ?>">
                <label class='mt-2 mb-1'>Maksimal chegirmas summasi</label>
                <input type="text" name="Summa" class="form-control" id="summa1" style='border-radius:0;' value="<?php echo $rowN['Chegirma']; ?>" required>
                <label class='mt-2 mb-1'>Maksimal Chegirma muddati</label>
                <input type="number" name="Days" class="form-control" style='border-radius:0;' value="<?php echo $rowN['Days']; ?>" required>
                <button type='submit' class='btn btn-primary w-100 mt-2' style='border-radius:0;'>Saqlash</button>
              </form>
            </div>
          </div>
        </div>

        <div class="col-xl-8">
          <div class="card" style="min-height:350px">
            <div class="card-body pt-3">
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"><i class="bi bi-person-bounding-box"></i> MALUMOTLARIM</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings"><i class="bi bi-clock-history"></i> OXIRGI TO'LOVLAR</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"><i class="bi bi-shield-lock"></i> PAROL YANGILASH</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <!-- Mening malumotlarim -->
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Mening ma`lumotlarim</h5>
                  <div class="row">
                    <div class="col-lg-5 col-md-4 label ">FIO</div>
                    <div class="col-lg-7 col-md-8"><?php if(isset($_COOKIE['UserID'])){echo $FIO;}?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-5 col-md-4 label">Telefon raqam</div>
                    <div class="col-lg-7 col-md-8"><?php if(isset($_COOKIE['UserID'])){echo $Phone;}?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-5 col-md-4 label">Yashash manzilingiz</div>
                    <div class="col-lg-7 col-md-8"><?php if(isset($_COOKIE['UserID'])){echo $Manzil;}?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-5 col-md-4 label">Lovozimingiz</div>
                    <div class="col-lg-7 col-md-8"><?php if(isset($_COOKIE['UserID'])){echo $Type;}?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-5 col-md-4 label">Tug`ilgan kuningiz</div>
                    <div class="col-lg-7 col-md-8"><?php if(isset($_COOKIE['UserID'])){echo $TKun;}?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-5 col-md-4 label">Login</div>
                    <div class="col-lg-7 col-md-8"><?php if(isset($_COOKIE['UserID'])){echo $Username;}?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-5 col-md-4 label">Ro`yhatdan olindi</div>
                    <div class="col-lg-7 col-md-8"><?php if(isset($_COOKIE['UserID'])){echo $DateInsert;}?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-5 col-md-4 label">Malumotlar taxrirlandi</div>
                    <div class="col-lg-7 col-md-8"><?php if(isset($_COOKIE['UserID'])){echo $DateUpdate;}?></div>
                  </div>
                  <div class="text-center">
                    <hr>
                    <a href="./kobinet_2.php" class="btn btn-warning" style='display:<?php if($Type==='admin'){echo 'block;';}elseif($Type==='xisobchi'){echo 'block;';}else{echo 'none;';} ?>'>MENING BALANSIM</a>
                  </div>
                </div>
                <!-- Qilgan ishlarim -->
                <div class="tab-pane fade pt-3" id="profile-settings">
                  <h5 class="card-title">Oxirgi to'lovlar</h5>
                  <div class="table-responsive">
                    <table  class="table table-bordered text-center align-baseline table-striped" style="font-size:12px;" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <td>#</td>
                          <td>FIO</td>
                          <td>To'lov Turi</td>
                          <td>To'lov Summasi</td>
                          <td>To'lov Vaqti</td>
                          <td>To'lov Haqida</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sqla = "SELECT * FROM `user_student_tulov` JOIN `users` ON user_student_tulov.UserID=users.UserID WHERE user_student_tulov.MenegerID='".$_COOKIE['UserID']."' ORDER BY user_student_tulov.id DESC LIMIT 50";
                          $resa = $conn->query($sqla);
                          $i=1;
                          while ($row = $resa->fetch()) {
                            echo "<tr>
                              <td>".$i."</td>
                              <td style='text-align:left;'>".$row['FIO']."</td>
                              <td>".$row['TulovType']."</td>
                              <td>".$row['TulovSumma']."</td>
                              <td>".$row['InsertData']."</td>
                              <td>".$row['Izoh']."</td>
                            </tr>";
                            $i++;
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- Parolni yangilash -->
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <form action="./config/kobinet/kobinetEdetParol.php?Username=<?php echo $Username; ?>" method="POST">
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Joriy Parolingiz</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" style="border-radius:0;" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Yangi parol</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" style="border-radius:0;" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Parolni takrorlang</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" style="border-radius:0;" required>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-outline-primary w-100" style="border-radius:0;">Parolni yangilash</button>
                    </div>
                  </form>
                </div>
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
            var $input2 = $form1.find( "#summa22" );
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
        });
    })(jQuery);
  </script>
</body>
</html>