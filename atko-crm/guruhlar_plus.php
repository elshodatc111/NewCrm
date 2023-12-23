<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Yangi guruh qo'shish</title>
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
      if(isset($_GET['guruhband'])){echo "alert('Guruh oldin ochilgan.')";}
    ?>
  </script>
</head>

<body>
  <!-- ======= TOP START ======= -->
  <?php  include("./connect/top.php"); ?>
  <!-- ======= TOP END ======= -->
  <?php
    $menu = "Guruhlar";
    $blok = "GuruhShow";
    $submenu = "guruhPlus";
    include("./connect/menu.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Yangi guruh qo'shish</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Yangi guruh qo'shish</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
      <div class="col-lg-12 col-12">
        <div class="info-box card ">
          <h5 class="card-title w-100 text-center pb-0 mb-1">Yangi guruh qo'shish</h5>
          <form action="./config/guruh/guruh_plus.php" method="POST" class="row" id="form1">
            <div class="col-lg-6">
              <label class="form-label mt-1 mb-0" style="font-weight:600;">Guruh nomi</label>
              <input type="text" class="form-control mb-3 mt-0" name="GuruhNomi" style="border-radius:0;" required>
              <label class="form-label mt-1 mb-0" style="font-weight:600;">To'lov summasi</label>
              <input type="text" name="GuruhSumma" class="form-control mb-3 mt-0" id="summa1" style="border-radius:0;" required>
              <div class="row">
                <div class="col-lg-6 col-12">
                  <label class="form-label mt-1 mb-0" style="font-weight:600;">O'qituvchiga to'lov</label>
                  <input type="text" name="TechTulov" class="form-control mb-3 mt-0" id="summa2" style="border-radius:0;" required>
                </div>
                <div class="col-lg-6 col-12">
                  <label class="form-label mt-1 mb-0" style="font-weight:600;">O'qituvchiga bonus</label>
                  <input type="text" name="TechBonus" class="form-control mb-3 mt-0" VALUE="0" id="summa3" style="border-radius:0;" required>
                </div>
                <div class="col-lg-6 col-12">
                  <label class="form-label mt-1 mb-0" style="font-weight:600;">Boshlanish vaqti</label>
                  <input type="date" id="date1" name="Start" class="form-control mb-3 mt-0" style="border-radius:0;" required>
                </div>
                <div class="col-lg-6 col-12">
                  <label class="form-label mt-1 mb-0" style="font-weight:600;">Yakunlanish vaqti</label>
                  <input type="date" id="date2" name="End" class="form-control mb-3 mt-0" style="border-radius:0;" required>
                </div>
              </div>
              <script>
                let data01 = document.getElementById('date1');
                let data02 = document.getElementById('date2');
              </script>
            </div>
            <div class="col-lg-6">
              <label class="form-label mt-1 mb-0" style="font-weight:600;">Xonani tanlang</label>
              <select class="form-control mb-3 mt-0" name="RoomID" onchange="showUser(this.value, data01.value, data02.value)" style="border-radius:0;" required>
                <option value=''>Tanlang</option>
                <?php
                  $sql = $conn->query("SELECT * FROM `rooms`");
                  foreach ($sql as $row) {
                     echo "<option value=".$row['RoomID'].">".$row['Room']."</option>";
                  }
                ?>
              </select>
              <script>
                function showUser(str,date1,date2) {
                  if (str == "") {
                    document.getElementById("txtHint").style.display='block';
                    return;
                  } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                      }
                    };
                    xmlhttp.open("GET","./config/guruh/guruh_rooms.php?RoomID="+str+"&Start="+date1.toString()+"&End="+date2.toString(),true);
                    xmlhttp.send();
                  }
                }
              </script>
              <div class="row" id="txtHint"></div>
            </div>
            <div class="col-lg-12 text-center">
                <button class="btn btn-primary w-50" style="border-radius:0;">YANGI GURUHNI SAQLASH</button>
            </div>
          </form>
        <div>
      <div>
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
                var $form2 = $( "#form1" );
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
                var $form3 = $( "#form1" );
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