<?php if(!isset($_COOKIE['UserID'])){ header("location: ./login.php"); }?>
<!DOCTYPE html>
<html lang="en">

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Moliya</title>
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
            if(isset($_GET['naqtchiqim'])){echo "alert('Naqt summa chiqim qilindi. Tasdiqlanishi kutilmoqda.');";}
            if(isset($_GET['plastikchiqim'])){echo "alert('Plastik summa chiqim qilindi. Tasdiqlanishi kutilmoqda.');";}
            if(isset($_GET['xarajadplusss'])){echo "alert('Xarajat uchun summa tasdiqlanishi kutulmoqda.');";}
            if(isset($_GET['mavjudemas'])){echo "alert('Chiqim uchun mablag` yetarli emas. Kamroq summa kiriting.');";}
            if(isset($_GET['delete'])){echo "alert('Tasdiqlanmagan chiqim o`chirildi.');";}
            if(isset($_GET['chiqimtasdiq'])){echo "alert('Tasdiqlandi.');";}
            if(isset($_GET['tulovqaytarildi'])){echo "alert('Tulov qaytarish uchun tasdiqlash kutilmoqda.');";}
            if(isset($_GET['qaytardel'])){echo "alert('Talabaga qaytariladigan summa bekor qilindi');";}
            if(isset($_GET['qaytarishtasdiqlandi'])){echo "alert('Talabaga to`lov qaytarib berish tasdiqlandi');";}
            
            $date = date("Y-m-d");
        ?>
    </script>
</head>

<body>
  <!-- ======= TOP START ======= -->
  <?php  include("./connect/top.php"); ?>
  <!-- ======= TOP END ======= -->
  
  <?php
    $menu = "Moliya";
    $blok = "false";
    $submenu = "false";
    include("./connect/menu.php");
    # JAMI TO'LOVLAR
    $sqlTulov = "SELECT * FROM `user_student_tulov` WHERE 1";
    $resTulov = $conn->query($sqlTulov);
    $NaqtTulov = 0;
    $PlastikTulov = 0;
    $Chegirma = 0;
    $Qaytarildi = 0;
    while ($rowTulov = $resTulov->fetch()) {
        if($rowTulov['TulovType']==='Naqt'){
            $NaqtTulov = $NaqtTulov + $rowTulov['TulovSumma'];
        }elseif($rowTulov['TulovType']==='Plastik'){
            $PlastikTulov = $PlastikTulov + $rowTulov['TulovSumma'];
        }
    }
    # JAMI chiqim bo'lganlat
    $sqlmoliya = "SELECT * FROM `moliya`";
    $resmoliya = $conn->query($sqlmoliya);
    $NaqtTasdiq = 0;
    $PlastikTasdiq = 0;
    $NaqtKutulmoqda = 0;
    $PlastikKutilmoqda = 0;
    $chiqimNaqtKutilmoqda = 0;
    $chiqimPlastikKutilmoqda = 0;
    $xarajatNaqtKutilmoqda = 0;
    $xarajatPlastikKutilmoqda = 0;
    while ($rowm = $resmoliya->fetch()) {
        if($rowm['Status']==='true'){
            if($rowm['Type']==='Naqt'){
                $NaqtTasdiq = $NaqtTasdiq + $rowm['Summa'];
            }else{
                $PlastikTasdiq = $PlastikTasdiq + $rowm['Summa'];
            }
        }else{
            if($rowm['Type']==='Naqt'){
                if($rowm['Typing']==='Xarajat'){
                    $xarajatNaqtKutilmoqda = $xarajatNaqtKutilmoqda + $rowm['Summa'];
                }else{
                    $chiqimNaqtKutilmoqda = $chiqimNaqtKutilmoqda + $rowm['Summa'];
                }
                $NaqtKutulmoqda = $NaqtKutulmoqda + $rowm['Summa'];
            }else{
                if($rowm['Typing']==='Xarajat'){
                    $xarajatPlastikKutilmoqda = $xarajatPlastikKutilmoqda + $rowm['Summa'];
                }else{
                    $chiqimPlastikKutilmoqda = $chiqimPlastikKutilmoqda + $rowm['Summa'];
                }
                $PlastikKutilmoqda = $PlastikKutilmoqda + $rowm['Summa'];
            }
        }
    }
    # Jami qaytarilganlar
    $sqlqaytarildi = "SELECT * FROM `moliya_qaytarildi`";
    $resqaytarildi = $conn->query($sqlqaytarildi);
    $NaqtQaytar = 0;
    $PlastikQaytar = 0;
    $NaqtQaytarKutmoqda = 0;
    $PlastikQaytarKutilmoqda = 0;
    while ($rowm = $resqaytarildi->fetch()) {
        if($rowm['Status']==='true'){
            if($rowm['TulovTuri']==='Naqt'){
                $NaqtQaytar = $NaqtQaytar + $rowm['TulovSumma'];
            }else{
                $PlastikQaytar = $PlastikQaytar + $rowm['TulovSumma'];
            }
        }else{
            if($rowm['TulovTuri']==='Naqt'){
                $NaqtQaytarKutmoqda = $NaqtQaytarKutmoqda + $rowm['TulovSumma'];
            }else{
                $PlastikQaytarKutilmoqda = $PlastikQaytarKutilmoqda + $rowm['TulovSumma'];
            }
        }
    }

    $mavjudNaqt = $NaqtTulov-$NaqtTasdiq-$NaqtKutulmoqda-$NaqtQaytar-$NaqtQaytarKutmoqda;
    $mavjudPlastik = $PlastikTulov-$PlastikTasdiq-$PlastikKutilmoqda-$PlastikQaytar-$PlastikQaytarKutilmoqda;
  ?>
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Moliya</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Moliya</li>
        </ol>
      </nav>
    </div>
    <section class="section contact">
        <div class="row text-center">
            <div class="col-lg-12 col-12" style="display:<?php if($Type==='mexmon'){echo 'none;';} ?>">
                <div class="info-box card ">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <button class="btn btn-primary w-100 my-1" style="border-radius: 0;" data-bs-toggle="modal" data-bs-target="#naqtchiqim"><i class="bi bi-currency-dollar text-white" style="font-size:18px"></i> NAQT CHIQIM</button>
                            <button class="btn btn-primary w-100 my-1" style="border-radius: 0;" data-bs-toggle="modal" data-bs-target="#plastikchiqim"><i class="bi bi-credit-card-2-front text-white" style="font-size:18px"></i> PLASTIK CHIQIM</button>
                            <!-- Naqt summa chiqim qilish -->
                            <div class="modal fade" id="naqtchiqim" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Naqt pul chiqim</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./config/moliya/naqt_chiqim.php?mavjud=<?php echo $mavjudNaqt; ?>" method="POST" style="text-align: left;" id="form1">
                                                <h6 class="text-center" style="color:red"><b>Mavjud:</b> <?php echo number_format($mavjudNaqt, 0, '.', ' '); ?> so'm</h6>
                                                <div class="form-group">
                                                  <label class="mb-1" style="font-size:14px">Chiqim summasi</label>
                                                  <input type="text" name="chiqimsumma" class="form-control" id="summa1" style="border-radius:0" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                  <label class="mb-1" style="font-size:14px">Chiqim uchun izoh</label>
                                                  <textarea class="form-control" name="chiqimizoh" style="border-radius:0" required></textarea>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button class="btn btn-outline-primary w-100" style="border-radius:0">Chiqim Qilish</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Plastik chiqim qilish -->
                            <div class="modal fade" id="plastikchiqim" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Plastik pul chiqim</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./config/moliya/plastik_chiqim_plus.php?mavjudPlastik=<?php echo $mavjudPlastik; ?>" method="POST" style="text-align: left;" id="form2">
                                                <h6 class="text-center" style="color:red"><b>Mavjud:</b> <?php echo number_format($mavjudPlastik, 0, '.', ' '); ?> so'm</h6>
                                                <div class="form-group">
                                                  <label class="mb-1" style="font-size:14px">Chiqim summasi</label>
                                                  <input type="text" class="form-control" name="summa" id="summa2" style="border-radius:0" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                  <label class="mb-1" style="font-size:14px">Chiqim uchun izoh</label>
                                                  <textarea class="form-control" name="izoh" style="border-radius:0" required></textarea>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button class="btn btn-outline-primary w-100" style="border-radius:0">Chiqim Qilish</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <button class="btn btn-info w-100 my-1 text-white" style="border-radius: 0;" data-bs-toggle="modal" data-bs-target="#naqtxarajat"><i class="bi bi-currency-dollar text-white" style="font-size:18px"></i> NAQT XARAJAT</button>
                            <button class="btn btn-info w-100 my-1 text-white" style="border-radius: 0;" data-bs-toggle="modal" data-bs-target="#plastikxarajat"><i class="bi bi-credit-card-2-front text-white" style="font-size:18px"></i> PLASTIK XARAJAT</button>
                            <!-- Naqt summa xarajat qilish -->
                            <div class="modal fade" id="naqtxarajat" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Naqt pul xarajat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./config/moliya/naqt_xarajat_plus.php?mavjud=<?php echo $mavjudNaqt; ?>" method="POST" style="text-align: left;"id="form3">
                                                <h6 class="text-center" style="color:red"><b>Mavjud:</b> <?php echo number_format($mavjudNaqt, 0, '.', ' '); ?> so'm</h6>
                                                <div class="form-group">
                                                  <label class="mb-1" style="font-size:14px">Chiqim summasi</label>
                                                  <input type="text" name="Summa" class="form-control" id="summa3" style="border-radius:0" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                  <label class="mb-1" style="font-size:14px">Chiqim uchun izoh</label>
                                                  <textarea class="form-control" name="Izoh" style="border-radius:0" required></textarea>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button class="btn btn-outline-primary w-100" style="border-radius:0">Xarajat Qilish</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Plastik summa xarajat qilish -->
                            <div class="modal fade" id="plastikxarajat" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Plastik pul xarajat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./config/moliya/plastik_xarajat_plus.php?mavjudPlastik=<?php echo $mavjudPlastik; ?>" method="POST" style="text-align: left;" id="form4">
                                                <h6 class="text-center" style="color:red"><b>Mavjud:</b> <?php echo number_format($mavjudPlastik, 0, '.', ' '); ?> so'm</h6>
                                                <div class="form-group">
                                                  <label class="mb-1" style="font-size:14px">Chiqim summasi</label>
                                                  <input type="text" name="Summa" id="summa4" class="form-control summa" style="border-radius:0" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                  <label class="mb-1" style="font-size:14px">Chiqim uchun izoh</label>
                                                  <textarea class="form-control" name="Izoh" style="border-radius:0" id="summa4" required></textarea>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button class="btn btn-outline-primary w-100" style="border-radius:0">Xarajat Qilish</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <!-- Naqt qaytarilgan to'lov -->
                            <button class="btn btn-danger w-100 my-1" style="border-radius: 0;" data-bs-toggle="modal" data-bs-target="#naqtqaytar"><i class="bi bi-currency-dollar text-white" style="font-size:18px"></i> NAQT TO'LOV QAYTARISH</button>
                            <button class="btn btn-danger w-100 my-1" style="border-radius: 0;" data-bs-toggle="modal" data-bs-target="#plastikqaytar"><i class="bi bi-credit-card-2-front text-white" style="font-size:18px"></i> PLASTIK TO'LOV QAYTARISH</button>
                            <div class="modal fade" id="naqtqaytar" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Naqt to'lovni qaytarish</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./config/moliya/tulov_qaytarish_naqt.php?mavjudNaqt=<?php echo $mavjudNaqt; ?>" method="POST" style="text-align: left;" id="form5">
                                                <h6 class="text-center" style="color:red"><b>Mavjud:</b> <?php echo number_format($mavjudNaqt, 0, '.', ' '); ?> so'm</h6>
                                                <div class="form-group">
                                                  <label class="mb-1" style="font-size:14px">Talabani tanlang</label>
                                                  <select id="select_box" name="select_box" class="form-select" style="border-radius:0" required>
                                                    <option value="">Tanlang</option>
                                                    <?php
                                                        $sql01 = "SELECT * FROM `users` WHERE `Type`='student'";
                                                        $res01 = $conn->query($sql01);
                                                        while ($row01=$res01->fetch()) {
                                                            $sql001 = "SELECT COUNT(*) FROM `user_student_tulov` WHERE `UserID`='".$row01['UserID']."' AND `TulovType`='Naqt'";
                                                            $res001 = $conn->query($sql001);
                                                            $count001 = $res001->fetchColumn();
                                                            $sql0011 = "SELECT COUNT(*) FROM `user_student_tulov` WHERE `UserID`='".$row01['UserID']."' AND `TulovType`='Plastik'";
                                                            $res0011 = $conn->query($sql0011);
                                                            $count0011 = $res0011->fetchColumn();
                                                            $bbbbbb = $count001 + $count0011;
                                                            if($bbbbbb>0){
                                                                echo "<option value=".$row01['UserID'].">".$row01['FIO']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                  </select>
                                                </div>
                                                <div class="form-group mt-2">
                                                  <label class="mb-1" style="font-size:14px">Qaytariladigan summa</label>
                                                  <input type="text" name="summa" class="form-control" id="summa5" style="border-radius:0" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                  <label class="mb-1" style="font-size:14px">Qaytarish uchun izoh</label>
                                                  <textarea class="form-control" name='izoh' style="border-radius:0" required></textarea>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button class="btn btn-outline-primary w-100" style="border-radius:0">To'lovni qaytarish</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Plastik qaytarilgan to'lov -->
                            <div class="modal fade" id="plastikqaytar" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Plastik to'lovni qaytarish</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./config/moliya/tulov_qaytaris_plastik.php?mavjudPlastik=<?php echo $mavjudPlastik; ?>" method="POST" style="text-align: left;" id="form6">
                                                <h6 class="text-center" style="color:red"><b>Mavjud:</b> <?php echo number_format($mavjudPlastik, 0, '.', ' '); ?> so'm</h6>
                                                <div class="form-group">
                                                  <label class="mb-1" style="font-size:14px">Talabani tanlang</label>
                                                  <select id="select_box2" name="select_box2" class="form-select" style="border-radius:0" required>
                                                    <option value="">Tanlang</option>
                                                    <?php
                                                        $sql02 = "SELECT * FROM `users` WHERE `Type`='student'";
                                                        $res02 = $conn->query($sql02);
                                                        while ($row02=$res02->fetch()) {
                                                            $sql002 = "SELECT COUNT(*) FROM `user_student_tulov` WHERE `UserID`='".$row02['UserID']."' AND `TulovType`='Naqt'";
                                                            $res002 = $conn->query($sql002);
                                                            $count002 = $res002->fetchColumn();

                                                            $sql0022 = "SELECT COUNT(*) FROM `user_student_tulov` WHERE `UserID`='".$row02['UserID']."' AND `TulovType`='Plastik'";
                                                            $res0022 = $conn->query($sql0022);
                                                            $count0022 = $res0022->fetchColumn();
                                                            $aaaaa = $count002 + $count0022;
                                                            if($aaaaa>0){
                                                                echo "<option value=".$row02['UserID'].">".$row02['FIO']."</option>";
                                                            }
                                                        }
                                                    ?>
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                  <label class="mb-1" style="font-size:14px">Qaytariladigan summa</label>
                                                  <input type="text" name="summa" class="form-control" id="summa6" style="border-radius:0" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                  <label class="mb-1" style="font-size:14px">Qaytarish uchun izoh</label>
                                                  <textarea class="form-control" name="izoh" style="border-radius:0" required></textarea>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button class="btn btn-outline-primary w-100" style="border-radius:0">To'lovni qaytarish</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-12">
                <div class="info-box card" style="min-height:270px;">
                    <i class="bi bi-geo-alt"></i>
                    <h5 style="font-size:18px;" class="py-2">Mavjud summa</h5>
                    <?php if($mavjudNaqt>0){ ?>
                        <h5 style="color:red;font-weight:700;"><b style="color:blue;">NAQT: </b> <?php echo number_format($mavjudNaqt, 0, '.', ' '); ?> so'm</h5>
                    <?php }else{ ?>
                        <h5 style="color:green;font-weight:700;"><b style="color:blue;">NAQT: </b> <?php echo number_format($mavjudNaqt, 0, '.', ' '); ?> so'm</h5>
                    <?php } if($mavjudPlastik>0){ ?>
                        <h5 style="color:red;font-weight:700;"><b style="color:blue;">PLASTIK: </b><?php echo number_format($mavjudPlastik, 0, '.', ' '); ?> so'm</h5>
                    <?php }else{ ?>
                        <h5 style="color:green;font-weight:700;"><b style="color:blue;">PLASTIK: </b><?php echo number_format($mavjudPlastik, 0, '.', ' '); ?> so'm</h5>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="info-box card" style="min-height:270px;">
                    <i class="bi bi-clock-history"></i>
                    <h5 style="font-size:18px;" class="py-2">Chiqimlar kutilmoqda</h5>
                    <?php if($chiqimNaqtKutilmoqda>0){ ?>
                        <h5 style="color:red;font-weight:700;"><b style="color:blue;">NAQT: </b> <?php echo number_format($chiqimNaqtKutilmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php }else{ ?>
                        <h5 style="color:green;font-weight:700;"><b style="color:blue;">NAQT: </b> <?php echo number_format($chiqimNaqtKutilmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php } if($chiqimPlastikKutilmoqda>0){ ?>
                        <h5 style="color:red;font-weight:700;"><b style="color:blue;">PLASTIK: </b><?php echo number_format($chiqimPlastikKutilmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php }else{ ?>
                        <h5 style="color:green;font-weight:700;"><b style="color:blue;">PLASTIK: </b><?php echo number_format($chiqimPlastikKutilmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="info-box card" style="min-height:270px;">
                    <i class="bi bi-clock-history"></i>
                    <h5 style="font-size:18px;" class="py-2">Xarajatlar kutilmoqda</h5>
                    <?php if($xarajatNaqtKutilmoqda>0){ ?>
                        <h5 style="color:red;font-weight:700;"><b style="color:blue;">NAQT: </b> <?php echo number_format($xarajatNaqtKutilmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php }else{ ?>
                        <h5 style="color:green;font-weight:700;"><b style="color:blue;">NAQT: </b> <?php echo number_format($xarajatNaqtKutilmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php } if($xarajatPlastikKutilmoqda>0){ ?>
                        <h5 style="color:red;font-weight:700;"><b style="color:blue;">PLASTIK: </b><?php echo number_format($xarajatPlastikKutilmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php }else{ ?>
                        <h5 style="color:green;font-weight:700;"><b style="color:blue;">PLASTIK: </b><?php echo number_format($xarajatPlastikKutilmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="info-box card" style="min-height:270px;">
                    <i class="bi bi-clock-history"></i>
                    <h5 style="font-size:18px;" class="py-2">To'lov qaytarish kutilmoqda</h5>
                    <?php if($NaqtQaytarKutmoqda>0){ ?>
                        <h5 style="color:red;font-weight:700;"><b style="color:blue;">NAQT: </b> <?php echo number_format($NaqtQaytarKutmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php }else{ ?>
                        <h5 style="color:green;font-weight:700;"><b style="color:blue;">NAQT: </b> <?php echo number_format($NaqtQaytarKutmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php } if($PlastikQaytarKutilmoqda>0){ ?>
                        <h5 style="color:red;font-weight:700;"><b style="color:blue;">PLASTIK: </b><?php echo number_format($PlastikQaytarKutilmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php }else{ ?>
                        <h5 style="color:green;font-weight:700;"><b style="color:blue;">PLASTIK: </b><?php echo number_format($PlastikQaytarKutilmoqda, 0, '.', ' '); ?> so'm</h5>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
              <div class="accordion accordion-flush" id="faq-group-3">
                <!-- Tasdiqlanmagan chiqimlar -->
                <div class="accordion-item pt-3">
                    <h6 class="accordion-header"><button class="accordion-button collapsed" style="font-weight:700;" data-bs-target="#faqsThree-1" type="button" data-bs-toggle="collapse">TASDIQLANMAGAN CHIQIMLAR</button></h6>
                    <div id="faqsThree-1" class="accordion-collapse collapse show" data-bs-parent="#faq-group-3">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-baseline table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th style="background-color: blue;color:white">#</th>
                                        <th style="background-color: blue;color:white">Chiqim Turi</th>
                                        <th style="background-color: blue;color:white">Chiqim Summasi</th>
                                        <th style="background-color: blue;color:white">Chiqim Vaqti</th>
                                        <th style="background-color: blue;color:white">Tulov turi</th>
                                        <th style="background-color: blue;color:white">Izoh</th>
                                        <th style="background-color: blue;color:white">Manager</th>
                                        <th style="background-color: blue;color:white">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sqlsel = "SELECT * FROM `moliya` WHERE `Status`='false' ORDER BY `id` DESC";
                                            $ressql = $conn->query($sqlsel);
                                            $i=1;
                                            while ($row=$ressql->fetch()) {
                                                $sqlmen = "SELECT * FROM `users` WHERE `UserID`='".$row['ChiqimMeneger']."'";
                                                $resmen = $conn->query($sqlmen);
                                                $rowmen = $resmen->fetch();
                                                echo "<tr>
                                                    <td>".$i."</td>
                                                    <td>".$row['Typing']."</td>
                                                    <td>".number_format(($row['Summa']), 0, '.', ' ')." so`m</td>
                                                    <td>".$row['ChiqimData']."</td>
                                                    <td>".$row['Type']."</td>
                                                    <td>".$row['ChiqimIzoh']."</td>
                                                    <td>".$rowmen['Username']."</td>
                                                    <td>";?>
                                                    <?php
                                                        if($Type==='admin'){
                                                            echo "<a href='./config/moliya/chiqimtasdiq.php?id=".$row['id']."' class='btn btn-success py-0 px-1 mr-2' style='border-radius: 0;'>
                                                                <i class='bi bi-check-circle' style='font-size:15px;color:white'></i>
                                                            </a>";
                                                        }elseif($Type==='xisobchi'){
                                                            echo "<a href='./config/moliya/chiqimtasdiq.php?id=".$row['id']."' class='btn btn-success py-0 px-1 mr-2' style='border-radius: 0;'>
                                                                <i class='bi bi-check-circle' style='font-size:15px;color:white'></i>
                                                            </a>";
                                                        }
                                                        if($Type!='mexmon'){
                                                            echo "<a href='./config/moliya/chiqimdelet.php?id=".$row['id']."' class='btn btn-danger mx-2 py-0 px-1' style='border-radius: 0;'>
                                                                <i class='bi bi-trash' style='font-size:15px;color:white'></i>
                                                            </a>";
                                                        }
                                                        
                                                    echo "</td>
                                                </tr>";
                                                $i++;
                                            }
                                            if($i===1){
                                                echo "<tr><td colspan=8 class='text-center'>Tasdiqlanmagan chiqimlar mavjud emas</td></tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
                <!--  QAYTARILGAN TO'LOVLAR-->
                <div class="accordion-item" style="<?php if($Type==='mexmon'){echo 'display:none;';} ?>">
                    <h6 class="accordion-header">
                        <button class="accordion-button collapsed" style="font-weight:700;" data-bs-target="#faqsThree-2" type="button" data-bs-toggle="collapse">
                            QAYTARILGAN TO'LOVLAR</button></h6>
                    <div id="faqsThree-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-baseline table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="background-color: blue;color:white">#</th>
                                            <th style="background-color: blue;color:white">Talaba</th>
                                            <th style="background-color: blue;color:white">To'lov turi</th>
                                            <th style="background-color: blue;color:white">Qaytarilgan summa</th>
                                            <th style="background-color: blue;color:white">Qaytarilgan vaqti</th>
                                            <th style="background-color: blue;color:white">Izoh</th>
                                            <th style="background-color: blue;color:white">Meneger</th>
                                            <th style="background-color: blue;color:white">Tasdiqlandi</th>
                                            <th style="background-color: blue;color:white">Xisobchi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sqlq1 = "SELECT * FROM `moliya_qaytarildi` ORDER BY `id` DESC";
                                            $resq1 = $conn->query($sqlq1);
                                            $i=1;
                                            while ($row=$resq1->fetch()) {
                                                # Talaba
                                                $sqlqt = "SELECT * FROM `users` WHERE `UserID`='".$row['UserID']."'";
                                                $resqt = $conn->query($sqlqt);
                                                $rowqt = $resqt->fetch();
                                                # Meneger
                                                $sqlqm = "SELECT * FROM `users` WHERE `UserID`='".$row['Meneger']."'";
                                                $resqm = $conn->query($sqlqm);
                                                $rowqm = $resqm->fetch();
                                                # Xisobchi 
                                                $sqlqx = "SELECT * FROM `users` WHERE `UserID`='".$row['Xisobchi']."'";
                                                $resqx = $conn->query($sqlqx);
                                                $rowqx = $resqx->fetch();
                                                #Tasdiqlash
                                                if($row['Status']==='false'){
                                                    if($Type==='admin'){
                                                    $Tasdiq = "<a href='./config/moliya/qaytar_tasdiq.php?id=".$row['id']."' class='btn btn-success py-0 px-1 mr-2' style='border-radius: 0;'>
                                                        <i class='bi bi-check-circle' style='font-size:15px;color:white'></i>
                                                    </a>";
                                                    }elseif($Type==='xisobchi'){
                                                        $Tasdiq = "<a href='./config/moliya/qaytar_tasdiq.phpid=".$row['id']."' class='btn btn-success py-0 px-1 mr-2' style='border-radius: 0;'>
                                                            <i class='bi bi-check-circle' style='font-size:15px;color:white'></i>
                                                        </a>";
                                                    }else{
                                                        $Tasdiq = "";
                                                    }
                                                    $Meneger = "<a href='./config/moliya/qaytar_del.php?id=".$row['id']."' class='btn btn-danger mx-2 py-0 px-1' style='border-radius: 0;'>
                                                            <i class='bi bi-trash' style='font-size:15px;color:white'></i>
                                                        </a>";
                                                }else{
                                                    $Meneger = $rowqx['Username'];
                                                    $Tasdiq = $row['Tasdiqlandi'];
                                                }
                                                echo "<tr>
                                                    <td>".$i."</td>
                                                    <td>".$rowqt['FIO']."</td>
                                                    <td>".$row['TulovTuri']."</td>
                                                    <td>".number_format(($row['TulovSumma']), 0, '.', ' ')." so`m</td>
                                                    <td>".$row['QaytarishVaqti']."</td>
                                                    <td>".$row['Izoh']."</td>
                                                    <td>".$rowqm['Username']."</td>
                                                    <td>".$Tasdiq."</td>
                                                    <td>".$Meneger."</td>
                                                </tr>";
                                                $i++;
                                            }
                                            if($i===1){
                                                echo "<tr><td colspan=8 class='text-center'>Qaytarilgan to`lovlar mavjud emas</td></tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tasdiqlangan chiqimlar -->                            
                <div class="accordion-item">
                    <h6 class="accordion-header">
                        <button class="accordion-button collapsed" style="font-weight:700;" data-bs-target="#faqsThree-3" type="button" data-bs-toggle="collapse">
                            TASDIQLANGAN CHIQIMLAR</button></h6>
                    <div id="faqsThree-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-baseline table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th style="background-color: blue;color:white">#</th>
                                        <th style="background-color: blue;color:white">Chiqim Summasi</th>
                                        <th style="background-color: blue;color:white">Chiqim Vaqti</th>
                                        <th style="background-color: blue;color:white">Chiqim Turi</th>
                                        <th style="background-color: blue;color:white">Izoh</th>
                                        <th style="background-color: blue;color:white">Meneger</th>
                                        <th style="background-color: blue;color:white">Tasdiqlandi</th>
                                        <th style="background-color: blue;color:white">Xisobchi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sqlsel = "SELECT * FROM `moliya` WHERE `Status`='true' ORDER BY `id` DESC";
                                            $ressql = $conn->query($sqlsel);
                                            $i=1;
                                            while ($row=$ressql->fetch()) {
                                                $sqla1 = "SELECT * FROM `users` WHERE `UserID`='".$row['ChiqimMeneger']."'";
                                                $resa1 = $conn->query($sqla1);
                                                $rowa1 = $resa1->fetch();
                                                $sqla2 = "SELECT * FROM `users` WHERE `UserID`='".$row['TasdiqMeneger']."'";
                                                $resa2 = $conn->query($sqla2);
                                                $rowa2 = $resa2->fetch();
                                                echo "<tr>
                                                    <td>".$i."</td>
                                                    <td>".number_format(($row['Summa']), 0, '.', ' ')." so'm</td>
                                                    <td>".$row['ChiqimData']."</td>
                                                    <td>".$row['Type']."</td>
                                                    <td>".$row['ChiqimIzoh']."</td>
                                                    <td>".$rowa1['Username']."</td>
                                                    <td>".$row['TasdiqData']."</td>
                                                    <td>".$rowa2['Username']."</td>
                                                    </td>
                                                </tr>";
                                                $i++;
                                            }
                                            if($i===1){
                                                echo "<tr><td colspan=8 class='text-center'>Tasdiqlangan chiqimlar mavjud emas</td></tr>";
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
          </div>
    </section>
  </main>
  
  <<!-- ======= START FOOTER ======= -->
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