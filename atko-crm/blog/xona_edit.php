<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Xonani taxrirlash</title>
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
</head>

<body>
  <!-- ======= TOP START ======= -->
  <?php  include("../connect/top2.php"); ?>
  <!-- ======= TOP END ======= -->
  
  <?php
    $guruh = "xona";
    include("../connect/menu2.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Taxrirlash</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="../xonalar.php">Xonalar</a></li>
          <li class="breadcrumb-item active">Xonani taxrirlash</li>
        </ol>
      </nav>
    </div>
    <?php
      $sql = "SELECT * FROM `rooms` WHERE `RoomID`='".$_GET['RoomID']."'";
      $res = $conn->query($sql);
      $row = $res->fetch();
    ?>
    <section class="section contact">
        <div class="row text-center">
            <div class="col-lg-12 col-12">
                <div class="info-box card ">
                  <form action="../config/room/room_edit.php?RoomID=<?php echo $_GET['RoomID']; ?>" method="POST">
                    <div class="form-group mt-1">
                      <label for="exampleInputEmail1">Xonaning nomi</label>
                      <input type="text" class="form-control" name="Nomi" value="<?php echo $row['Room']; ?>" style="border-radius:0;" required>
                    </div>
                    <div class="form-group mt-1">
                      <label for="exampleInputEmail1">Xonaning sig'imi</label>
                      <input type="number" class="form-control" name="Sigim" value="<?php echo $row['Sigim']; ?>"  style="border-radius:0;" required>
                    </div>
                    <button type="submit" class="btn btn-outline-primary mt-3 w-100" style="border-radius:0;">Saqlash</button>
                  </form>
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