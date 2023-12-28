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
      if(isset($_GET['send'])){echo "alert('Qarzdorlarga SMS yuborildi')";}
      if(isset($_GET['sendMesseg'])){echo "alert('SMS yuborildi')";}
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
          <li class="breadcrumb-item active">Guruh haqida</li>
        </ol>
      </nav>
    </div>
    <?php
      $sql1 = "SELECT * FROM `guruh` WHERE `GuruhID`='".$_GET['GuruhID']."'";
      $res1 = $conn->query($sql1);
      $row1 = $res1->fetch();
      $date = date("Y-m-d");
      $Start = $row1['Start'];
      $End = $row1['End'];
      if($End<$date){$Status = "Yakunlangan";}elseif($Start<=$date AND $End>=$date){$Status = "Aktiv";}else{$Status = "Yangi";}
      $RoomID = $row1['RoomID'];
      $sql2 = "SELECT * FROM `rooms` WHERE `RoomID`='".$RoomID."'";
      $res2 = $conn->query($sql2);
      $row2 = $res2->fetch();

      
    ?>
    <section class="section contact">
      <div class="row text-center">
        <div class="col-lg-4 col-12">
          <div class="info-box card" style="min-height:435px;<?php if($Type==='mexmon'){echo 'display:none;';} ?>">
            <!-- Guruh malumotlarini yangilash  +++ -->
            <button class="btn btn-danger w-100 text-center mt-2" style="border-radius:0;font-weight:700;<?php if($Type!='admin'){echo 'display:none';}elseif($End<$date){echo 'display:none;';} ?>" data-bs-toggle="modal" data-bs-target="#guruhnitaxrirlash">GURUHNI TAXRIRLASH</button>
            <div class="modal fade" id="guruhnitaxrirlash" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header"><h5 class="modal-title">Guruhni taxrirlash</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                  <div class="modal-body">
                    <form action="../config/guruh/guruh_edet.php?GuruhID=<?php echo $_GET['GuruhID']; ?>" method="POST" id="formEdit">
                      <label style="font-weight:700;width:100%;text-align:left;">Guruh nomi</label>
                      <input type="text" name="GuruhNomi" class="form-control" style="border-radius:0;" value="<?php echo $row1['GuruhName']; ?>" required>
                      <label style="font-weight:700;width:100%;text-align:left;" class="mt-3 mb-1">To'lov summasi</label>
                      <input type="text" name="GuruhSumma" class="form-control" id="bonus1" style="border-radius:0;" value="<?php echo $row1['GuruhSumma']; ?>" required>
                      <label style="font-weight:700;width:100%;text-align:left;" class="mt-3 mb-1">O'qituvchiga to'lov</label>
                      <input type="text" name="TechTulov" class="form-control" id="bonus2" style="border-radius:0;" value="<?php echo $row1['TechTulov']; ?>" required>
                      <label style="font-weight:700;width:100%;text-align:left;" class="mt-3 mb-1">O'qituvchiga bonus</label>
                      <input type="text" name="TechBonus" class="form-control" id="bonus333" style="border-radius:0;" value="<?php echo $row1['TechBonus']; ?>" required>
                      <button class="btn btn-primary mt-3 w-100" type="submit" style="border-radius:0;">O'zgarishlarni saqlash</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- To'lov qilish ++++++ -->
            <script>
                  function button(id){
                    document.getElementById(id).style.display='none';
                  }
                  function onbutton(id){
                    document.getElementById(id).style.display='block';
                  }
            </script>
            <button class="btn btn-success w-100 text-center mt-2" style="border-radius:0;font-weight:700;" data-bs-toggle="modal" data-bs-target="#tolovqilish">TO'LOV QILISH</button>
            <div class="modal fade" id="tolovqilish" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header"><h5 class="modal-title">To'lov qilish</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                  <div class="modal-body">
                    <form action="../config/guruh/guruh_student_tolov.php?GuruhID=<?php echo $_GET['GuruhID']; ?>" method="post" id="formSS">
                      <label style="font-weight:700;" class="mb-1">Talabani tanlang</label>
                      <select name="UserID" onclick="onbutton('mytulovlar')" class="form-control w-100" style="border-radius:0;" required>
                        <option value=>Tanlang</option>
                        <?php
                          $sqlSS = "SELECT users.FIO,users.UserID FROM `guruh_plus` JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh_plus.GuruhID='".$_GET['GuruhID']."' AND guruh_plus.Status='true'";
                          $resSS = $conn->query($sqlSS);
                          while($row = $resSS->fetch()){
                              echo "<option value=".$row['UserID'].">".$row['FIO']."</option>";
                          }
                        ?>
                      </select>
                      <label style="font-weight:700;" class="mt-2 mb-1">To'lov turi</label>
                      <select name="TulovType" onclick="onbutton('mytulovlar')" class="form-control w-100" style="border-radius:0;" required>
                        <option value="">Tanlang</option>
                        <option value="Naqt">Naqt</option>
                        <option value="Plastik">Plastik</option>
                      </select>
                      <label style="font-weight:700;" class="mt-2 mb-1">To'lov summasi</label>
                      <input type="text" class="form-control" onclick="onbutton('mytulovlar')" name="TulovSumma" id="summaSS" style="border-radius:0;" required>
                      <label style="font-weight:700;" class="mt-2 mb-1">To'lov haqida</label>
                      <textarea class="form-control"  onclick="onbutton('mytulovlar')" name="TulovIzoh" style="border-radius:0;"></textarea>
                      <button class="btn btn-primary w-100 mt-2" id='mytulovlar' onclick="button('mytulovlar')" style="border-radius:0;">To'lov qilish</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Guruhga talaba qo'shish +++ -->
            <button class="btn btn-primary w-100 text-center mt-2" style="border-radius:0;font-weight:700;<?php if($End<$date){echo 'display:none;';} ?>" data-bs-toggle="modal" data-bs-target="#talabaqoshish">TALABA QO'SHISH</button>
            <div class="modal fade" id="talabaqoshish" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header"><h5 class="modal-title">Talaba qo'shish</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                  <div class="modal-body">
                    <form action="../config/talaba/talaba_guruh_plus.php?GuruhID=<?php echo $_GET['GuruhID']; ?>" method="POST">
                      <label style="width:100%;text-align:left;font-weight:700;">Talabani tanlang</label>
                      <select name="UserID" id="select_box" class="mt-2" style="border-radius:0;" required>
                        <option value="">Tanlang</option>
                        <?php
                          $sql11 = "SELECT * FROM `users` WHERE `Type`='student'";
                          $res11 = $conn->query($sql11);
                          while($row = $res11->fetch()){
                            $sql111 = "SELECT COUNT(*) FROM `guruh_plus` WHERE `GuruhID`='".$_GET['GuruhID']."' AND `UserID`='".$row['UserID']."' AND `Status`='true'";
                            $res111 = $conn->query($sql111);
                            $count = $res111->fetchColumn();
                            if($count>0){}else{
                              echo "<option value=".$row['UserID'].">".$row['FIO']."</option>";
                            }
                          }
                        ?>
                      </select>
                      <label style="width:100%;text-align:left;font-weight:700;"class="mt-2">Talabani guruhga qo'shish izohi</label>
                      <textarea name="Izoh" class="form-control mt-2" style="border-radius:0;" required></textarea>
                      <button class="w-100 btn btn-primary mt-2" id="Myguruhlar" onclick="button('Myguruhlar');" style="border-radius:0;">Talabani guruhga qo'shish</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Guruhdan talabani o`chirish ++++ -->
            <button class="btn btn-warning w-100 text-center mt-2 text-white" style="border-radius:0;font-weight:700;<?php if($Type==='mexmon'){echo 'display:none';}elseif($Type==='meneger'){echo 'display:none';} ?>" data-bs-toggle="modal" data-bs-target="#talabadelete">TALABANI O'CHIRISH</button>
            <div class="modal fade" id="talabadelete" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header"><h5 class="modal-title">Talabani o'chirish</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                  <div class="modal-body">
                  <form action="../config/talaba/talaba_guruh_delete.php?GuruhID=<?php echo $_GET['GuruhID']; ?>&summasi=<?php echo $row1['GuruhSumma']; ?>" id="form04" method="POST">
                      <label style="width:100%;text-align:left;font-weight:700;">Talabani tanlang</label>
                      <select name="UserID" id="" class="mt-2 mb-1 form-control" style="border-radius:0;" required>
                        <option value="">Tanlang</option>
                        <?php
                          $sql1111 = "SELECT * FROM `guruh_plus` JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh_plus.Status='true' AND guruh_plus.GuruhID='".$_GET['GuruhID']."'";
                          $res1111 = $conn->query($sql1111);
                          while($row11 = $res1111->fetch()){
                              echo "<option value=".$row11['UserID'].">".$row11['FIO']."</option>";
                          }
                        ?>
                      </select>
                      <label style="width:100%;text-align:left;font-weight:700;">Qaytariladigan summa (max: <?php echo $row1['GuruhSumma']; ?> so`m)</label>
                      <input name="qautarilgan" id="summa04" class="mt-2 form-control" value=0 style="border-radius:0;" required>

                      <label style="width:100%;text-align:left;font-weight:700;"class="mt-2">Talabani guruhga o`chirish izohi</label>
                      <textarea name="Izoh" class="form-control mt-2" required style="border-radius:0;"></textarea>
                      <button class="w-100 btn btn-primary mt-2" style="border-radius:0;">Talabani guruhga o`chirish</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- O'qituvchi qo'shish +++ -->
            <button class="btn btn-dark w-100 text-center mt-2" style="border-radius:0;font-weight:700;<?php if($row1['TecherID']!='NULL'){echo 'display:none;';}elseif($UIns==='off'){echo 'display:none';}elseif($UEdit==='UIns'){echo 'display:none';} ?>" data-bs-toggle="modal" data-bs-target="#techerplus">O'QITUVCHI QO'SHISH</button>
            <div class="modal fade" id="techerplus" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header"><h5 class="modal-title">O'qituvchi qo'shish</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                  <div class="modal-body">
                    <form action="../config/guruh/guruh_techer_plus.php?GuruhID=<?php echo $_GET['GuruhID']; ?>&GuruhName=<?php echo $row1['GuruhName']; ?>" method="post">
                      <h6 class='text-danger'>O'qituvchi qo'shgandan so'ng o'qituvchini almashtirib bo'lmaydi.</h6 class='text-danger'>
                      <label class="my-2 w-100" style="text-align:left;font-weight:700;">O'qituvchini tanlang</label>
                      <select name="UserID" class="form-control mb-2" style="border-radius:0" required>
                        <option value=''>Tanlang</option>
                        <?php
                          $sql3 = "SELECT * FROM `users` WHERE `Type`='techer'";
                          $res3 = $conn->query($sql3);
                          while($row3 = $res3->fetch()){
                            echo "<option value=".$row3['UserID'].">".$row3['FIO']."</option>";
                          }
                        ?>
                      </select>
                      <button class="btn btn-primary w-100 mt-2" style="border-radius:0"> O`qituvchi qo'shish </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- SMS yuborish -->
            <button class="btn btn-info w-100 text-center mt-2 text-white" style="border-radius:0;font-weight:700;" data-bs-toggle="modal" data-bs-target="#smsyuborish">SMS YUBORISH</button>
            <div class="modal fade" id="smsyuborish" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header"><h5 class="modal-title">SMS yuborish</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                  <div class="modal-body">
                    <form action="../config/guruh/send_Messege.php?GuruhID=<?php echo $_GET['GuruhID']; ?>" method="post">
                      <table class="table">
                        <tr><th>FIO</th><th>SMS yuborish</th></tr>
                        <?php
                          $sqlSms = "SELECT guruh_plus.UserID, users.FIO FROM `guruh_plus` JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh_plus.GuruhID='".$_GET['GuruhID']."'";
                          $resSms = $conn->query($sqlSms);
                          $i=0;
                          while ($rowSms = $resSms->fetch()) {
                            echo "<tr>
                              <td style='text-align:left;'>".$rowSms['FIO']."</td>
                              <td><input type='checkbox' name=".$rowSms['UserID']." class='form-check-input'></td>
                            </tr>";
                            $i++;
                          }
                        ?>
                        <tr style="display:<?php if($i===0){echo 'none;';} ?>">
                          <td colspan=2>
                            <label>SMS matni</label>
                            <textarea name="text" class="form-control"  onclick="onbutton('mysms');" required style="border-radius:0;"></textarea>
                            <button class="btn btn-primary mt-2 w-100" id="mysms" onclick="button('mysms');" style="border-radius:0;">SMS YUBORISH</button>
                          </td>
                        </tr>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Eslatma qoldirish -->
            <button class="btn btn-secondary w-100 text-center mt-2" style="border-radius:0;font-weight:700;" data-bs-toggle="modal" data-bs-target="#eslatmaqoldirish">ESLATMA QOLDIRISH</button>
            <div class="modal fade" id="eslatmaqoldirish" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header"><h5 class="modal-title">Eslatma qoldirish</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                  <div class="modal-body">
                    <form action="../config/eslatma/eslatma_guruh_plus.php?GuruhID=<?php echo $_GET['GuruhID']; ?>" method="post" id="form1">
                      <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-12 col-form-label">Eslatma matni</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" name="text" style="height: 100px;border-radius:0;" required></textarea>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-warning w-100" style="border-radius:0;">Eslatmani saqlash</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Guruhdagi qarzdorlarga SMS xabar yuborish -->
            <a href="../config/sms/debit_sms.php?GuruhID=<?php echo $_GET['GuruhID']; ?>"; class="btn btn-success w-100 text-center mt-2" style="border-radius:0;font-weight:700;">QARZDORLARGA SMS</a>
            <!-- Guruhni davom ettirish -->
            <?php
              $sqlnew = "SELECT * FROM `guruh_end` WHERE `GuruhID`='".$_GET['GuruhID']."' AND `Status`='true'";
              $resnew = $conn->query($sqlnew);
              $count = $resnew->fetchColumn();
              if($count>0){
                $sqlnew1 = "SELECT guruh.GuruhName,guruh_end.NewGuruh FROM `guruh_end` JOIN `guruh` ON guruh_end.NewGuruh=guruh.GuruhID WHERE guruh_end.GuruhID='".$_GET['GuruhID']."'";
                $resnew1 = $conn->query($sqlnew1);
                $rownew1 = $resnew1->fetch();
                echo "<b class='mt-2'>Guruh davomi: </b><a href='guruh_eye.php?GuruhID=".$rownew1['NewGuruh']."'>".$rownew1['GuruhName']."</a>";
              }else{
            ?>
            <a href="guruh_eye_new.php?GuruhID=<?php echo $_GET['GuruhID']; ?>"; class="btn btn-success w-100 text-center mt-2" style="border-radius:0;font-weight:700;">GURUHNI DAVOM ETISH</a>
            <?php } ?>
          </div>
        </div>
        
        <!-- Guruh haqida malumot +++ -->
        <div class="col-lg-4 col-12">
          <div class="info-box card pt-2" style="text-align:left;min-height:435px;">
            <div class="pt-2" style="border-bottom: 1px dashed red;font-weight:600;">
              <h5 style="font-weight:600">Guruh nomi:</h5>
              <p style="text-align:right;"><?php echo $row1['GuruhName']; ?></p>
            </div>
            <div class="pt-1" style="border-bottom: 1px dashed red;font-weight:600;">
              <h5 style="font-weight:600">Guruh To'lov Summasi:</h5>
              <p style="text-align:right;"><?php echo number_format(($row1['GuruhSumma']), 0, '.', ' '); ?> so'm</p>
            </div>
            <div class="pt-1" style="border-bottom: 1px dashed red;font-weight:600;">
              <h5 style="font-weight:600">O'qituvchi:</h5>
              <p style="text-align:right;">
                <?php 
                  if($row1['TecherID']==='NULL'){
                    echo "O'qituvchi biriktirilmagan";
                  }else{
                    $sql44 = "SELECT * FROM `users` WHERE `UserID`='".$row1['TecherID']."'";
                    $res44 = $conn->query($sql44);
                    $row44 = $res44->fetch();
                    echo $row44['FIO'];
                    if($Type==='admin'){
                      echo "<a href='../config/techer/techer_delete.php?GuruhID=".$_GET['GuruhID']."' class='btn p-0 px-1' title='O`qituvchini o`chirish'>
                        <i class='bi bi-trash' style='font-size:15px;color:red;'></i>
                      </a>";
                    }
                  }
                ?>
              </p>
            </div>
            <div class="pt-1" style="border-bottom: 1px dashed red;font-weight:600;">
              <h5 style="font-weight:600">O'qituvchiga to'lov:</h5>
              <p style="text-align:right;"><?php echo number_format(($row1['TechTulov']), 0, '.', ' '); ?> so'm</p>
            </div>
            <div class="pt-1" style="border-bottom: 1px dashed red;font-weight:600;">
              <h5 style="font-weight:600">O'qituvchiga bonus:</h5>
              <p style="text-align:right;"><?php echo number_format(($row1['TechBonus']), 0, '.', ' '); ?> so'm</p>
            </div>
            <div class="pt-1" style="border-bottom: 1px dashed red;font-weight:600;">
              <h5 style="font-weight:600">Guruh xolati:</h5>
              <p style="text-align:right;"><?php echo $Status; ?></p>
            </div>
          </div>
        </div>
        <!-- Guruh haqida malumot +++ -->
        <div class="col-lg-4 col-12">
          <div class="info-box card pt-2" style="text-align:left;min-height:435px;">
            <div class="pt-2" style="border-bottom: 1px dashed red;font-weight:600;">
              <h5 style="font-weight:600">Boshlanish vaqti:</h5>
              <p style="text-align:right;"><?php echo $row1['Start']; ?></p>
            </div>
            <div class="pt-1" style="border-bottom: 1px dashed red;font-weight:600;">
              <h5 style="font-weight:600">Yakunlanish vaqti:</h5>
              <p style="text-align:right;"><?php echo $row1['End']; ?></p>
            </div>
            <div class="pt-1" style="border-bottom: 1px dashed red;font-weight:600;">
              <h5 style="font-weight:600">Dars xonasi:</h5>
              <p style="text-align:right;"><?php echo $row2['Room']; ?></p>
            </div>
            <?php
              if($row1['Dushanba']!='NULL'){echo "<div class='pt-1' style='border-bottom: 1px dashed red;font-weight:600;'><h5 style='font-weight:600;color:blue'>Dushanba:</h5><p style='text-align:right;color:blue;'>".$row1['Dushanba']."</p></div>";}
              if($row1['Seshanba']!='NULL'){echo "<div class='pt-1' style='border-bottom: 1px dashed red;font-weight:600;'><h5 style='font-weight:600;color:blue'>Seshanba:</h5><p style='text-align:right;color:blue;'>".$row1['Seshanba']."</p></div>";}
              if($row1['Chorshanba']!='NULL'){echo "<div class='pt-1' style='border-bottom: 1px dashed red;font-weight:600;'><h5 style='font-weight:600;color:blue'>Chorshanba:</h5><p style='text-align:right;color:blue;'>".$row1['Chorshanba']."</p></div>";}
              if($row1['Payshanba']!='NULL'){echo "<div class='pt-1' style='border-bottom: 1px dashed red;font-weight:600;'><h5 style='font-weight:600;color:blue'>Payshanba:</h5><p style='text-align:right;color:blue;'>".$row1['Payshanba']."</p></div>";}
              if($row1['Juma']!='NULL'){echo "<div class='pt-1' style='border-bottom: 1px dashed red;font-weight:600;'><h5 style='font-weight:600;color:blue'>Juma:</h5><p style='text-align:right;color:blue;'>".$row1['Juma']."</p></div>";}
              if($row1['Shanba']!='NULL'){echo "<div class='pt-1' style='border-bottom: 1px dashed red;font-weight:600;'><h5 style='font-weight:600;color:blue'>Shanba:</h5><p style='text-align:right;color:blue;'>".$row1['Shanba']."</p></div>";}
            ?>
          </div>
        </div>
      </div>
      
      <div class="row text-center">
        <!-- Guruh talabalari ++ -->
        <div class="col-lg-12 col-12">
          <div class="info-box card px-1">
            <h5 class="card-title w-100 text-center pb-0 mb-1">Guruh talabalari</h5>
            <div class="table-responsive">
            <table class="table table-bordered text-center align-baseline table-striped" width="100%" cellspacing="0">
              <thead>
                <tr class="align-middle">
                  <th style="background-color: blue;color:white">#</th>
                  <th style="background-color: blue;color:white">FIO</th>
                  <th style="background-color: blue;color:white">Guruhga qo'shildi</th>
                  <th style="background-color: blue;color:white">Izoh</th>
                  <th style="background-color: blue;color:white">Meneger</th>
                  <th style="background-color: blue;color:white">Talaba balansi</th>
                  <th style="background-color: blue;color:white">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sqla = "SELECT users.FIO,guruh_plus.Start,guruh_plus.StartIzoh,guruh_plus.StartMenegerID,users.UserID FROM `guruh_plus` JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh_plus.EndMenegerID='NULL' AND guruh_plus.GuruhID='".$_GET['GuruhID']."' AND guruh_plus.Status='true'";
                  $resa = $conn->query($sqla);
                  $i=1;
                  while($rowa = $resa->fetch()){
                    $resa1 = $conn->query("SELECT * FROM `users` WHERE `UserID`='".$rowa['StartMenegerID']."'");
                    $rowa1 = $resa1->fetch();
                    $UserTalaba = $rowa['UserID'];
                    $sqltul = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$UserTalaba."'";
                    $restul = $conn->query($sqltul);
                    $TalTul = 0;
                    while ($rowtul=$restul->fetch()) {
                      if($rowtul['TulovType']==='Qaytarildi'){
                        $TalTul = $TalTul - $rowtul['TulovSumma'];
                      }else{
                        $TalTul = $TalTul + $rowtul['TulovSumma'];
                      }
                    }
                    $sqlaaa = "SELECT * FROM `guruh_plus` JOIN `guruh_user_del` ON guruh_plus.GuruhID=guruh_user_del.GuruhID WHERE `Status`='false' AND guruh_plus.UserID='".$UserTalaba."'";
                    $resaaa = $conn->query($sqlaaa);
                    while ($rowaaa = $resaaa->fetch()) {
                      $TalTul = $TalTul - $rowaaa['GuruhSumma'];
                    }
                    $sqlba = "SELECT * FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.Status='true' AND guruh_plus.UserID='".$UserTalaba."'";
                    $resba = $conn->query($sqlba);
                    while ($rowtalaba=$resba->fetch()) {
                      $TalTul = $TalTul - $rowtalaba['GuruhSumma'];
                    }
                      echo "<tr>
                        <td>".$i."</td>
                        <td style='text-align:left'>".$rowa['FIO']."</td>
                        <td>".$rowa['Start']."</td>
                        <td>".$rowa['StartIzoh']."</td>
                        <td>".$rowa1['Username']."</td>
                        <td>".number_format(($TalTul), 0, '.', ' ')." so`m</td>
                        <td>
                          <a href='./tashrif_eye.php?UserID=".$rowa['UserID']."' class='btn btn-danger py-0 px-1' style='border-radius: 0;'>
                            <i class='bi bi-eye-fill' style='font-size:15px;color:white'></i>
                          </a>
                        </td>
                      </tr>";
                      $i++;
                  }
                  if($i===1){
                    echo "<tr><td colspan=7 class='text-center'>Guruhga talabalar biriktirilmagan.</td></tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Guruh talabalarning davomadi -->
        <div class="col-lg-12 col-12">
          <div class="info-box card px-1">
            <h5 class="card-title w-100 text-center pb-0 mb-1">Davomad</h5>
              <div class="table-responsive">
                <table class="table table-bordered text-center align-baseline table-striped" width="100%" cellspacing="0"">
                    <?php
                        $dates = array();
                        $sqldata = "SELECT DISTINCT `Date` FROM `guruh_davomad` WHERE `GuruhID`='".$_GET['GuruhID']."' ORDER BY `Date` ASC";
                        $resdata = $conn->query($sqldata);
                        while ($rowdata = $resdata->fetch()) {
                            array_push($dates,$rowdata['Date']);
                        }
                    ?>
                    <thead>
                        <tr>
                            <th>#</th><th>FIO</th><?php foreach ($dates as $data) {echo "<th>".$data."</th>";} ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sqldav = "SELECT * FROM `guruh_plus` JOIN `users` ON guruh_plus.UserID=users.UserID WHERE guruh_plus.Status='true' AND guruh_plus.GuruhID='".$_GET['GuruhID']."'";
                            $resdav = $conn->query($sqldav);
                            $i=1;
                            while ($rowdav = $resdav->fetch()) {
                                echo "<tr><td class='text-center'>".$i."</td><td style='text-align:left'>".$rowdav['FIO']."</td>";
                                    foreach ($dates as $data) {
                                    $sqld = "SELECT * FROM `guruh_davomad` WHERE `UserID`='".$rowdav['UserID']."' AND `GuruhID`='".$_GET['GuruhID']."' AND `Date`='".$data."'";
                                    $resd = $conn->query($sqld);
                                    if($resd->fetchColumn()>0){
                                        echo "<td class='text-center'><span class='badge bg-success'>+</span></td>";
                                    }else{
                                        echo "<td class='text-center'><span class='badge bg-danger'>-</span></td>";
                                    }
                                    }
                                echo "</tr>";
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
              </div>
          </div>
        <!-- Eslatmalar -->
        <div class="info-box card p-2">
          <h5 class="card-title w-100 text-center pb-0 mb-2">Eslatmalar</h5>
          <div class="table-responsive">
            <table  class="table table-bordered text-center align-baseline table-striped" style="font-size:14px;" width="100%" cellspacing="0">
              <thead>
                <tr class="align-middle">
                  <th style="background-color: blue;color:white">#</th>
                  <th style="background-color: blue;color:white">Eslatna vaqti</th>
                  <th style="background-color: blue;color:white">Eslatma matni</th>
                  <th style="background-color: blue;color:white">Meneger</th>
                  <th style="background-color: blue;color:white">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sql2l = "SELECT * FROM `eslatma` WHERE `TypeID`='".$_GET['GuruhID']."'";
                  $resl2l = $conn->query($sql2l);
                  $i=1;
                  while ($rowl1l=$resl2l->fetch()) {
                    $sqlM = "SELECT * FROM `users` WHERE `UserID`='".$rowl1l['MenegerID']."'";
                    $resM = $conn->query($sqlM);
                    $rowM = $resM->fetch();
                    echo "<tr>
                      <td>".$i."</td>
                      <td>".$rowl1l['Data']."</td>
                      <td>".$rowl1l['Comment']."</td>
                      <td>".$rowM['Username']."</td>
                      <td>
                        <a href='../config/eslatma/eslatma_guruh_del.php?id=".$rowl1l['id']."&GuruhID=".$_GET['GuruhID']."' class='btn btn-danger py-0 px-1' style='border-radius: 0;'>
                          <i class='bi bi-trash' style='font-size:15px;color:white'></i>
                        </a>
                      </td>
                    </tr>";
                    $i++;
                  }
                  if($i===1){
                    echo "<tr><td colspan=5 class='text-center'>Eslatma qoldirilmagan</td></tr>";
                  }
                ?>
              </tbody>
            </table> 
          </div>
        </div>
        <!-- Guruhdan o'chirilgan talabalar  ++ -->
        <div class="col-lg-12 col-12">
          <div class="info-box card px-1">
            <h5 class="card-title w-100 text-center pb-0 mb-1">Guruhni tark etgan talabalar</h5>
            <div class="table-responsive">
            <table class="table table-bordered text-center align-baseline table-striped" width="100%" cellspacing="0">
              <thead>
                <tr class="align-middle">
                  <th style="background-color: blue;color:white">#</th>
                  <th style="background-color: blue;color:white">FIO</th>
                  <th style="background-color: blue;color:white">Guruhga qo'shildi</th>
                  <th style="background-color: blue;color:white">Guruhga qo'shish izoh</th>
                  <th style="background-color: blue;color:white">Meneger</th>
                  <th style="background-color: blue;color:white">Guruhni tark etdi</th>
                  <th style="background-color: blue;color:white">Guruhdan o`chirish izoh</th>
                  <th style="background-color: blue;color:white">Meneger 2</th>
                  <th style="background-color: blue;color:white">Jarima</th>
                  <th style="background-color: blue;color:white">Balansiga qaytarildi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sqldelgur = "SELECT DISTINCT guruh_plus.UserID, guruh_user_del.GuruhSumma,guruh_user_del.UserSumma,guruh_plus.Start,guruh_plus.StartIzoh,guruh_plus.StartMenegerID,guruh_plus.End,guruh_plus.EndIzoh,guruh_plus.EndMenegerID 
                  FROM `guruh_plus` JOIN `guruh_user_del` ON guruh_plus.GuruhID=guruh_user_del.GuruhID 
                  WHERE guruh_plus.GuruhID='".$_GET['GuruhID']."' AND guruh_plus.Status='false'";
                  $resdelgur = $conn->query($sqldelgur);
                  $i=1;
                  while ($rowdelgur = $resdelgur->fetch()) {
                    $sqldelall = "SELECT * FROM `users` WHERE `UserID`='".$rowdelgur['UserID']."'";
                    $resdelall = $conn->query($sqldelall);
                    $rowdelall = $resdelall->fetch();
                    $sqla1 = "SELECT * FROM `users` WHERE `UserID`='".$rowdelgur['StartMenegerID']."'";
                    $resa1 = $conn->query($sqla1);
                    $rowa1 = $resa1->fetch();
                    $sqla2 = "SELECT * FROM `users` WHERE `UserID`='".$rowdelgur['EndMenegerID']."'";
                    $resa2 = $conn->query($sqla2);
                    $rowa2 = $resa2->fetch();
                    echo "<tr>
                      <td>".$i."</td>
                      <td>".$rowdelall['FIO']."</td>
                      <td>".$rowdelgur['Start']."</td>
                      <td>".$rowdelgur['StartIzoh']."</td>
                      <td>".$rowa1['Username']."</td>
                      <td>".$rowdelgur['End']."</td>
                      <td>".$rowdelgur['EndIzoh']."</td>
                      <td>".$rowa2['Username']."</td>
                      <td>".number_format(($rowdelgur['GuruhSumma']), 0, '.', ' ')." so`m</td>
                      <td>".number_format(($rowdelgur['UserSumma']), 0, '.', ' ')." so`m</td>
                    </tr>";
                    $i++;
                  }
                  if($i===1){
                    echo "<tr><td colspan=10>Guruhdan o'chirilgan talabalar mavjud emas.</td></tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <?php date_default_timezone_set("Asia/Tashkent"); ?>
      <div class="info-box card px-2" style="display:none;font-size:9px">
        <h5 class="card-title w-100 text-center pb-0 mb-2">To'lov cheki</h5>
          <table class="table text-center w-100" id="tulovTable" style="font-size:10px;width:170px">
            <tr><td colspan="2" style="text-align: center;">
            <h1 id="logo" class="text-center" style="background-color: black;color: #fff;margin: 0;padding: 10px 0;">ATKO</h1>
            </td></tr>
            <tr><td colspan="2" style="text-align: center;">
            <h3 id="logo" class="text-center" style="">Qarshi sh. Mustaqillik shox ko'chasi 2-uy</h3>
            </td></tr>
            <tr><td><b>Tel:</b></td><td style="text-align: right;">(91) 950 1101</td></tr>
            <tr><td colspan="2"><hr></td></tr>
            <tr><td><b>Chek raqami:</b></td><td style="text-align: right;"><?php if(isset($_GET['checkID'])){echo $_GET['checkID'];} ?></td></tr>
            <tr><td><b>To'lov vaqti:</b></td><td style="text-align: right;"><?php if(isset($_GET['checkData'])){echo $_GET['checkData'];} ?></td></tr>
            <tr><td><b>To'lov turi:</b></td><td style="text-align: right;"><?php if(isset($_GET['checkData'])){echo $_GET['type'];} ?></td></tr>
            <?php
              $sqlres = "SELECT * FROM `users` WHERE `UserID`='".$_GET['UserID']."'";
              $rescon = $conn->query($sqlres);
              $rowres = $rescon->fetch();
            ?>
            <tr><td><b>FIO:</b></td><td style="text-align: right;"><?php echo $rowres['FIO']; ?></td></tr>
            <tr><td><b>Meneger:</b></td><td style="text-align: right;"><?php echo $Username; ?></td></tr>
            <tr><td><b>To'lov:</b></td><td style="text-align: right;"><b><?php if(isset($_GET['summa'])){echo number_format(($_GET['summa']), 0, '.', ' ');} ?> SO'M</b></td></tr>
            <tr><td><b>Chegirma:</b></td><td style="text-align: right;"><b><?php if(isset($_GET['chegirma'])){{echo number_format(($_GET['chegirma']), 0, '.', ' ');}} ?> SO'M</b></td></tr>
            <tr><td><b>Jami to'lov:</b></td><td style="text-align: right;"><b><?php if(isset($_GET['checkData'])){echo number_format(($_GET['chegirma']+$_GET['summa']), 0, '.', ' ');} ?> SO'M</b></td></tr>
            <tr><td colspan=2><hr></td></tr>
            <tr>
              <td style="text-align:center;">
                <b style="width:100%;text-align:center;margin:0 avto;">Telegram</b>
                <img src="../assets/img/telegram.jpg" style="width:80px;" alt="Telegram">
              </td>
              <td style="text-align:center;">
                <b style="width:100%;text-align:center;margin-bootom:0;">Manzilimiz</b>
                <img src="../assets/img/location.jpg" style="width:80px" alt="Telegram">
              </td>
            </tr>
          </table>
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
      function printDatasss(){
        var divToPrint=document.getElementById("tulovTable");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
      }
      <?php
        if(isset($_GET['pay'])){
          echo "printDatasss();";
        }
      ?>
        (function($, undefined) {
            "use strict";
            $(function() {
                var $form1 = $( "#formEdit" );
                var $input1 = $form1.find( "#bonus1" );
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
                var $form4 = $( "#form04" );
                var $input4 = $form4.find( "#summa04" );
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
                var $input2 = $form1.find( "#bonus2" );
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
                var $input3 = $form1.find( "#bonus3" );
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
                var $form4 = $( "#formSS" );
                var $input4 = $form4.find( "#summaSS" );
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
                var $form5 = $( "#formCH" );
                var $input5 = $form5.find( "#summaCH" );
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