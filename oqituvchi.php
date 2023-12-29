<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>O'qituvchilar</title>
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
    $menu = "Techer";
    $blok = "false";
    $submenu = "false";
    include("./connect/menu.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>O'qituvchilar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">O'qituvchilar</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
        <div class="row text-center" style="<?php if($UIns==='off'){echo 'display:none';} ?>">
            <div class="col-lg-12 col-12" style="display:<?php if($Type==='mexmon'){echo 'none;';} ?>">
                <div class="info-box card px-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="card-title w-100 text-center m-0 p-0 mt-1 mb-2 pt-1">O'QITUVCHILAR</h5>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-primary my-1" style="border-radius: 0;" data-bs-toggle="modal" data-bs-target="#techerplus"><i class="bi bi-plus-square text-white" style="font-size:18px"></i> YANGI O'QITUVCHI QO'SHISH</button>
                            <div class="modal fade" id="techerplus" tabindex="-1" data-bs-backdrop="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Yangi o'qituvchi qo'shish</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./config/techer/techer_plus.php" method="POST">
                                                <div class="mb-3">
                                                    <label class="form-label">FIO</label>
                                                    <input type="text" name="FIO" class="form-control" style="border-radius: 0;" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Telefon raqam</label>
                                                    <input type="text" name="Phone" class="form-control phone" value="998" placeholder="Telefon raqami" style="border-radius: 0;" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Yashash manzil</label>
                                                    <select name="Address" class="form-control" style="border-radius: 0;" required>
                                                        <option value="">Tanlang</option>
                                                        <option value="10242">Chiroqchi tuman</option>
                                                        <option value="10212">Dexqonobod tuman</option>
                                                        <option value="10207">G'uzor tuman</option>
                                                        <option value="10237">Kasbi tuman</option>
                                                        <option value="10232">Kitob tuman</option>
                                                        <option value="10240">Ko'kdala tuman</option>
                                                        <option value="10229">Koson tuman</option>
                                                        <option value="10233">Mirishkor tuman</option>
                                                        <option value="10234">Muborak tuman</option>
                                                        <option value="10235">Nishon tuman</option>
                                                        <option value="10220">Qamashi tuman</option>
                                                        <option value="10401">Qarshi shahar</option>
                                                        <option value="10224">Qarshi tuman</option>
                                                        <option value="10246">Shaxrisabz shahar</option>
                                                        <option value="10245">Shaxrisabz tuman</option>
                                                        <option value="10250">Yakkabog' tuman</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tug'ilgan kuni</label>
                                                    <input type="date" name="TKun" class="form-control" style="border-radius: 0;" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mutahasisligi</label>
                                                    <input type="text" name="Mutahasis" class="form-control" style="border-radius: 0;" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">O'qituvchi haqida</label>
                                                    <input type="text" name="About" class="form-control" style="border-radius: 0;" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Login</label>
                                                    <input type="text" name="Login" class="form-control" style="border-radius: 0;" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Parol</label>
                                                    <input type="password" name="Parol" class="form-control" style="border-radius: 0;" required>
                                                </div>
                                                <button type="submit" class="btn btn-outline-primary w-100" style="border-radius: 0;"><i class="bi bi-plus-square" style="font-size:18px"></i></i> Saqlash</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
              
        <div class="col-lg-12 col-12">
            <div class="info-box card px-2">
                <div class="table-responsive">
                    <table  class="table table-bordered text-center align-baseline table-striped" style="font-size:14px;" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="align-middle">
                                <th style="background-color: blue;color:white">#</th>
                                <th style="background-color: blue;color:white">O'qituvchilar</th>
                                <th style="background-color: blue;color:white">Telefon raqami</th>
                                <th style="background-color: blue;color:white">Yashash manzili</th>
                                <th style="background-color: blue;color:white">Tug'ilgan kuni</th>
                                <th style="background-color: blue;color:white">Login</th>
                                <th style="background-color: blue;color:white">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `users` WHERE `Type` = 'techer'";
                                $res = $conn->query($sql);
                                $i=1;
                                if($UEdit==='off'){$edit='display:none';}else{$edit="";}
                                while($row = $res->fetch()){
                                    echo "<tr>
                                        <td>".$i."</td>
                                        <td>".$row['FIO']."</td>
                                        <td>".$row['Phone']."</td>
                                        <td>".$row['Manzil']."</td>
                                        <td>".$row['TKun']."</td>
                                        <td>".$row['Username']."</td>
                                        <td>
                                            <a href='./blog/oqituvchi_eye.php?UserID=".$row['UserID']."' class='btn btn-danger py-0 px-1' style='border-radius: 0;'>
                                                <i class='bi bi-eye-fill' style='font-size:15px;color:white'></i>
                                            </a>
                                        </td>
                                    </tr>";
                                    $i++;
                                }
                            ?>
                            
                        </tbody>
                    </table> 
                  </div>
            </div>
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
</body>
</html>