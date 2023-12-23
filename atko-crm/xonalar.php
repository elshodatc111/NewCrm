<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Xonalar</title>
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
    $menu = "Xonalar";
    $blok = "false";
    $submenu = "false";
    include("./connect/menu.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Xonalar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Xonalar</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
      <div class="row text-center p-0 m-0" <?php if($UIns==='off'){echo 'style="display:none;"';} if($Type==='mexmon'){echo 'style="display:none;"';} ?>>
        <div class="info-box card px-3">
          <div class="row">
            <div class="col-12">
              <button class="btn btn-primary my-1" style="border-radius: 0;" data-bs-toggle="modal" data-bs-target="#YANGIXONA"><i class="bi bi-patch-plus text-white" style="font-size:18px"></i> YANGI XONA QO'SHISH</button>
              <div class="modal fade" id="YANGIXONA" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Yangi xona qo'shish</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="./config/room/room_plus.php" method="POST">
                        <div class="form-group mt-1">
                          <label for="exampleInputEmail1">Xonaning nomi</label>
                          <input type="text" class="form-control" name="Nomi" style="border-radius:0;" required>
                        </div>
                        <div class="form-group mt-1">
                          <label for="exampleInputEmail1">Xonaning sig'imi</label>
                          <input type="number" class="form-control" name="Sigim" style="border-radius:0;" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary mt-3 w-100" style="border-radius:0;">Saqlash</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="info-box card px-3">
          <div class="table-responsive">
            <table  class="table table-bordered text-center align-baseline table-striped" style="font-size:14px;" width="100%" cellspacing="0">
              <thead>
                <tr class="align-middle">
                    <th style="background-color: blue;color:white">#</th>
                    <th style="background-color: blue;color:white">Xona nomi</th>
                    <th style="background-color: blue;color:white">Xonaning sig'imi</th>
                    <th style="background-color: blue;color:white">Xona qo'shildi</th>
                    <th style="background-color: blue;color:white">Xona tamirlandi</th>
                    <th style="background-color: blue;color:white">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if($UEdit==='off'){$text='display:none;';}else{$text='';}

                  $sql = "SELECT * FROM `rooms`";
                  $res = $conn->query($sql);
                  $i=1;
                  $Mexmon = "";
                  if($Type='mexmon'){
                    $Mexmon='display:none;';
                  }
                  while($row = $res->fetch()){
                      echo "<tr>
                        <td>".$i."</td>
                        <td>".$row['Room']."</td>
                        <td>".$row['Sigim']."</td>
                        <td>".$row['InsertData']."</td>
                        <td>".$row['UpateData']."</td>
                        <td>
                            <a href='./blog/xona_edit.php?RoomID=".$row['RoomID']."' class='btn btn-primary py-0 px-1' style='border-radius: 0;".$Mexmon."".$text."'>
                                <i class='bi bi-pencil-square' style='font-size:15px;color:white'></i>
                            </a>
                        </td>
                    </tr>";$i++;
                  }
                ?>
                
              </tbody>
            </table> 
              
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