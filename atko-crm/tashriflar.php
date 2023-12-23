<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tashriflar</title>
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
            if(isset($_GET['teshrifplus'])){echo "alert('Yangi talaba qo`shildi');";}
            if(isset($_GET['pluserror'])){echo "alert('Siz kiritgan talaba oldin ro`yhatdan o`tgan');";}
            if(isset($_GET['phoneerror'])){echo "alert('Siz kiritgan telefon raqam oldin ro`yhatdan o`tgan');";}
        ?>
    </script>
</head>

<body>
  <!-- ======= TOP START ======= -->
  <?php  include("./connect/top.php"); ?>
  <!-- ======= TOP END ======= -->
  <?php
    $menu = "Tashriflat";
    $blok = "ShowTashrif";
    $submenu = "tashriflarim";
    include("./connect/menu.php");
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Tashriflar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Tashriflar</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
        <div class="row text-center" style="<?php if(isset($UIns)){if($UIns==='off'){echo 'display:none';}} ?>">
            <div class="col-lg-12 col-12" style="display:<?php if($Type==='mexmon'){echo 'none;';}else{ echo 'block';} ?>">
                <div class="info-box card">
                    <div class="row">
                        <div class="col-lg-6"><h5 class="card-title w-100 text-center m-0 p-0 mt-1 mb-2 pt-1">TASHRIFLAR</h5></div>
                        <div class="col-lg-6">
                            <button class="btn btn-success text-white" style="border-radius: 0;" data-bs-toggle="modal" data-bs-target="#techerplus"><i class="bi bi-plus-square text-white" style="font-size:18px"></i> YANGI TASHRIF QO'SHISH</button>
                            <div class="modal fade" id="techerplus" tabindex="-1" data-bs-backdrop="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Yangi tashrif qo'shish</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./config/talaba/talaba_plus.php" method="POST" >
                                                <script>
                                                    function showUser2(str) {
                                                    if (str == "") {
                                                        document.getElementById2("txtHint2").innerHTML = "";
                                                        return;
                                                    } else {
                                                            var xmlhttp = new XMLHttpRequest();
                                                            xmlhttp.onreadystatechange = function() {
                                                            if (this.readyState == 4 && this.status == 200) {
                                                                document.getElementById("txtHint2").innerHTML = this.responseText;
                                                            }
                                                            };
                                                            xmlhttp.open("GET","./config/fioeye.php?q="+str,true);
                                                            xmlhttp.send();
                                                        }
                                                    }
                                                </script>
                                                <div id="txtHint2"></div>
                                                <div class="mb-3">
                                                    <label class="form-label">FIO</label>
                                                    <input type="text" name="FIO" onchange="showUser2(this.value)" class="form-control" style="border-radius: 0;" required>
                                                </div>
                                                <script>
                                                    function showUser(str) {
                                                    if (str == "") {
                                                        document.getElementById("txtHint").innerHTML = "";
                                                        return;
                                                    } else {
                                                            var xmlhttp = new XMLHttpRequest();
                                                            xmlhttp.onreadystatechange = function() {
                                                            if (this.readyState == 4 && this.status == 200) {
                                                                document.getElementById("txtHint").innerHTML = this.responseText;
                                                            }
                                                            };
                                                            xmlhttp.open("GET","./config/teleye.php?q="+str,true);
                                                            xmlhttp.send();
                                                        }
                                                    }
                                                </script>
                                                <div id="txtHint"></div>
                                                <div class="mb-3">
                                                    <label class="form-label">Telefon raqam</label>
                                                    <input type="text" name="Phone" onchange="showUser(this.value)" class="form-control phone" value="998" placeholder="Telefon raqami" style="border-radius: 0;" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Yaqin tanishi</label>
                                                    <input type="text" name="Tanish" class="form-control" style="border-radius: 0;" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Yaqin tanishi telefon raqami</label>
                                                    <input type="text" name="TanishPhone" class="form-control phone" value="998" placeholder="Telefon raqami" style="border-radius: 0;" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Yashash manzil</label>
                                                    <select name="Manzil" class="form-control" style="border-radius: 0;" required>
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
                                                    <label class="form-label">Biz haqimizda</label>
                                                    <select name="Haqimizda" class="form-control" style="border-radius: 0;" required>
                                                        <option value="">Tanlang</option>
                                                        <option value="Telegram">Telegram</option>
                                                        <option value="Instagram">Instagram</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="Bannerlar">Bannerlar</option>
                                                        <option value="Tanishlar">Tanishlar</option>
                                                        <option value="Boshqa">Boshqa</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tashrif haqida</label>
                                                    <input type="text" name="TashrifHaqida" class="form-control" style="border-radius: 0;" required>
                                                </div>
                                                <button type="submit" class="btn btn-success w-100" style="border-radius: 0;"><i class="bi bi-plus-square" style="font-size:18px"></i></i> SAQLASH</button>
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
                                <th style="background-color: blue;color:white">FIO</th>
                                <th style="background-color: blue;color:white">Telefon raqami</th>
                                <th style="background-color: blue;color:white">Yashash manzili</th>
                                <th style="background-color: blue;color:white">Tug'ilgan kuni</th>
                                <th style="background-color: blue;color:white">Tashrif vaqti</th>
                                <th style="background-color: blue;color:white">Guruhlar soni</th>
                                <th style="background-color: blue;color:white">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql3 = $conn->query("SELECT * FROM `users` JOIN `user_student` ON users.UserID=user_student.UserID WHERE users.Type='student' ORDER BY users.id DESC");
                                $i=1;
                                foreach ($sql3 as $row) { 
                                    $Datas = str_split($row['DateInsert'],10);
                                    $guruhlarSoni = 0;
                                    $sql4 = "SELECT * FROM `guruh_plus` WHERE `UserID`='".$row['UserID']."' AND `Status`='true'";
                                    $res4 = $conn->query($sql4);
                                    while ($row4 = $res4->fetch()) {
                                        $guruhlarSoni = $guruhlarSoni + 1;
                                    }
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td style='text-align:left;'><?php echo $row['FIO']; ?></td>
                                <td><?php echo $row['Phone']; ?></td>
                                <td style='text-align:left;'><?php echo $row['Manzil']; ?></td>
                                <td><?php echo $row['TKun']; ?></td>
                                <td><?php echo $Datas['0']; ?></td>
                                <td><?php echo $guruhlarSoni; ?></td>
                                <td>
                                    <a href='./blog/tashrif_edit.php?UserID=<?php echo $row['UserID']; ?>' class='btn btn-success py-0 px-1 mr-2' style='border-radius: 0;<?php if(isset($UEdit)){if($UEdit==='off'){echo 'display:none';}elseif($Type='mexmon'){echo 'display:none;';}} ?>'>
                                        <i class='bi bi-pencil-square' style='font-size:15px;color:white'></i>
                                    </a>
                                    <a href='./blog/tashrif_eye.php?UserID=<?php echo $row['UserID']; ?>' class='btn btn-danger py-0 px-1' style='border-radius: 0;'>
                                        <i class='bi bi-eye-fill' style='font-size:15px;color:white'></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
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