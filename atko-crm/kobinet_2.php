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
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="./kobinet.php">Kobinet</a></li>
                <li class="breadcrumb-item active">Balans</li>
            </ol>
        </nav>
    </div>
    <section class="section contact">
        <div class="col-xl-12">
            <div class="card" style="min-height:350px">
                <div class="card-body pt-3">
                    <?php
                        $sqlall = "SELECT * FROM `user_admin_history` WHERE 1";
                        $resall = $conn->query($sqlall);
                        $MaxNaqt = 0;
                        $MaxPlastik = 0;
                        while ($row=$resall->fetch()) {
                            if($row['Status']==='Kassadan_Chiqim'){
                                if($row['Type']==='Naqt'){
                                    $MaxNaqt = $MaxNaqt + $row['Summa'];
                                }elseif($row['Type']==='Plastik'){
                                    $MaxPlastik = $MaxPlastik + $row['Summa'];
                                }
                            }elseif($row['Status']==='Balansdan_Chiqim'){
                                if($row['Type']==='Naqt'){
                                    $MaxNaqt = $MaxNaqt - $row['Summa'];
                                }elseif($row['Type']==='Plastik'){
                                    $MaxPlastik = $MaxPlastik - $row['Summa'];
                                }
                            }elseif($row['Status']==='Techer_Tulov'){
                                if($row['Type']==='Naqt'){
                                    $MaxNaqt = $MaxNaqt - $row['Summa'];
                                }elseif($row['Type']==='Plastik'){
                                    $MaxPlastik = $MaxPlastik - $row['Summa'];
                                }
                            }elseif($row['Status']==='Hodim_Tulov'){
                                if($row['Type']==='Naqt'){
                                    $MaxNaqt = $MaxNaqt - $row['Summa'];
                                }elseif($row['Type']==='Plastik'){
                                    $MaxPlastik = $MaxPlastik - $row['Summa'];
                                }
                            }
                        }
                        $MaxSumma = $MaxNaqt + $MaxPlastik;
                    ?>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <td>Mening balansim</td>
                                <td>Naqt Summa</td>
                                <td>Plastik Summa</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b><?php echo number_format($MaxSumma, 0, '.', ' '); ?></b></td>
                                <td><b><?php echo number_format($MaxNaqt, 0, '.', ' '); ?></b></td>
                                <td><b><?php echo number_format($MaxPlastik, 0, '.', ' '); ?></b></td>
                            </tr>
                        </tbody>
                    </table><hr>
                    <div class="row text-center">
                        <div class="col-6">
                            <button class="btn btn-primary" style="border-radius:0;" data-bs-toggle="modal" data-bs-target="#tolovnaqt">NAQT CHIQIM QILISH</button>
                            <div class="modal fade" id="tolovnaqt" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">NAQT CHIQIM QILISH</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./config/balans/balans_chiqim.php?max=<?php echo $MaxNaqt; ?>" id="form1" method="post">
                                                <label class="col-sm-12 col-form-label">Chiqim summasi (<b>Max: <?php echo number_format($MaxNaqt, 0, '.', ' '); ?></b>)</label>
                                                <input type="text" name="summa" class="form-control" id="summa1" required>
                                                <label class="col-sm-12 col-form-label">Chiqim haqida</label>
                                                <textarea type="text" name='izoh' class="form-control" required></textarea>
                                                <button class='btn btn-primary mt-3' style='border-radius:0;'>CHIQIM QILISH</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary" style="border-radius:0;"  data-bs-toggle="modal" data-bs-target="#tolovplastik">PLASTIK CHIQIM QILISH</button>
                            <div class="modal fade" id="tolovplastik" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">PLASTIK CHIQIM QILISH</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./config/balans/balans_chiqim_plas.php?max=<?php echo $MaxPlastik; ?>" id="form2" method="post">
                                                <label class="col-sm-12 col-form-label">Chiqim summasi (<b>Max: <?php echo number_format($MaxPlastik, 0, '.', ' '); ?></b>)</label>
                                                <input type="text" name="summa" class="form-control" id="summa2" required>
                                                <label class="col-sm-12 col-form-label">Chiqim haqida</label>
                                                <textarea type="text" name='izoh' class="form-control" required></textarea>
                                                <button class='btn btn-primary mt-3' style='border-radius:0;'>CHIQIM QILISH</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <hr>
                    <h5 class='w-100 text-center'>Mening balansim tarixi</h5><hr>
                    <div>
                        <nav class="btn btn-success text-white">
                            <a href="kobinet_2.php?all=true" style='border-radius:0;color:#fff;'> Barchasi </a>
                        </nav>
                        <nav class="btn btn-primary text-white">
                            <i class="bi bi-printer-fill"></i><a id='export' style='border-radius:0;'> EXCEL</a>
                        </nav>
                    </div>
                    <table class="table text-center table-bordered table-striped" id='table'>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Status</td>
                                <td>Type</td>
                                <td>Summa</td>
                                <td>Izoh</td>
                                <td>Data</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_GET['all'])){
                                    $sql11 = "SELECT * FROM `user_admin_history` ORDER BY `id` DESC";
                                }else{
                                    $sql11 = "SELECT * FROM `user_admin_history` ORDER BY `id` DESC LIMIT 10";
                                }
                                $res11 = $conn->query($sql11);
                                $i=1;
                                while ($row11 = $res11->fetch()) {
                                    if($row11['Status']==='Techer_Tulov'){
                                        $sql = "SELECT guruh.GuruhName FROM `user_techer_tulov` JOIN `guruh` ON user_techer_tulov.GuruhID=guruh.GuruhID WHERE user_techer_tulov.Data='".$row11['Data']."'";
                                        $res = $conn->query($sql);
                                        $row = $res -> fetch();
                                        $techers = " <b style='color:red;'> ( ".$row['GuruhName']." ) </b>";
                                    }elseif($row11['Status']==='Hodim_Tulov'){
                                        $sql22 = "SELECT * FROM `user_admin_tulov` JOIN `users` on users.UserID=user_admin_tulov.UserID WHERE user_admin_tulov.Data='".$row11['Data']."'";
                                        $res22 = $conn->query($sql22);
                                        $row22 = $res22 -> fetch();
                                        $techers = "<b class='text-success'> ( ".$row22['FIO']."</b> ) ";
                                    }else{
                                        $techers = "";
                                    }

                                    if($row11['Status']==='Kassadan_Chiqim'){
                                        $Status0111 = "Kassadan kirim";
									}elseif($row11['Status']==='Hodim_Tulov'){
                                        $Status0111 = "Ish haqi";
                                    }elseif($row11['Status']==='Techer_Tulov'){
                                        $Status0111 = "O`qituvchiga to`lov ";
                                    }else{
                                        $Status0111 = $row11['Status'];
                                    }

                                    echo "<tr>
                                        <td>".$i."</td>
                                        <td style='text-align:left;'>".$Status0111." ".$techers."</td>
                                        <td style='text-align:left;'>".$row11['Type']."</td>
                                        <td style='text-align:right;'>".number_format($row11['Summa'], 0, '.', ' ')."</td>
                                        <td style='text-align:left;'>".$row11['Izoh']."</td>
                                        <td>".$row11['Data']."</td>
                                    </tr>";
                                    $i++;
                                }
                            ?>
                        </tbody>
                    </table>
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
  <script src="./assets/js/table2excel.js"></script>
  <script>
    var table2excel = new Table2Excel();
    document.getElementById('export').addEventListener('click', function() {
      table2excel.export(document.getElementById('table'));
    });
  </script>
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