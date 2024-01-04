<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Talaba</title>
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
  <script>
    <?php
      if(isset($_GET['chegirmaplus'])){echo "alert('Chegirma qabul qilindi');";}
      if(isset($_GET['guruhgaqoshildi'])){echo "alert('Talaba guruhga qo`shildi.');";}
      if(isset($_GET['tashrifedit'])){echo "alert('Talaba malumotlari yangilandi');";}
      if(isset($_GET['eslatmaplus'])){echo "alert('Talabaga eslatma qoldirildi');";}
      if(isset($_GET['tulovguruhplus22'])){echo "alert('Talaba to`lovi qabul qilindi. Talaba guruhga qo`shildi.');";}
      if(isset($_GET['chegirmaplus22'])){echo "alert('Talaba guruhga qo`shildi. To`lov qildindi. Chegirma kiritildi.');";}
      if(isset($_GET['tulovsummaerror'])){echo "alert('To`lov kiritishda xatolik mavjud. Qaytadan urinib ko`ring.');";}
      if(isset($_GET['tulovplus'])){echo "alert('To`lov qabul qilindi.');";}
      if(isset($_GET['tulovguruhplus'])){echo "alert('To`lov qabul qilindi. Talaba guruhga qo`shildi.');";}
      if(isset($_GET['tulovguruhchegirmakattaplus'])){echo "alert('To`lov qabul qilindi. Chegirma summasi katta Admin bilan bog`laning.');";}
      if(isset($_GET['tulovguruhchegirmaplus'])){echo "alert('To`lov qabul qilindi. Guruh uchun chegirma muddati tugagan.');";}
      if(isset($_GET['tulovchegirmaplus'])){echo "alert('To`lov va chegirma qabul qilindi.');";}
      if(isset($_GET['chegirmaminus'])){echo "alert('To`lov qabul qilindi. Siz tanlagan guruh uchun talaba chegirma olgan.');";}
      if(isset($_GET['sendsms'])){echo "alert('SMS yuborildi.');";}
      if(isset($_GET['sendPaket'])){echo "alert('SMS paketi tugagan');";}
      $date = date("Y-m-d");
    ?>
    function printData(){
      var divToPrint=document.getElementById("tulovTable");
      newWin= window.open("");
      newWin.document.write(divToPrint.outerHTML);
      newWin.print();
      newWin.close();
    }
    </script>
</head>
<body>
  <?php  
    include("../connect/top2.php"); 
    $guruh = "student";
    include("../connect/menu2.php");
  ?>
  <main id="main" class="main">
    <?php
      $sql = "SELECT * FROM `users` JOIN `user_student` ON users.UserID=user_student.UserID WHERE users.UserID='".$_GET['UserID']."'";
      $res = $conn->query($sql);
      $row = $res->fetch();
      $insert = str_split($row['DateInsert'],10);
      $update = str_split($row['DateUpdate'],10);
      $sqlttt = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$_GET['UserID']."'";
      $resttt = $conn->query($sqlttt);
      $NaqtPastik = 0;
      $Chegirma = 0;
      $Qaytarildi = 0;
      while ($rowttt = $resttt->fetch()) {
        if($rowttt['TulovType']==='Chegirma'){
          $Chegirma = $Chegirma + $rowttt['TulovSumma'];
        }elseif($rowttt['TulovType']==='Qaytarildi'){
          $Qaytarildi = $Qaytarildi + $rowttt['TulovSumma'];
        }else{
          $NaqtPastik = $NaqtPastik + $rowttt['TulovSumma'];
        }
      }
      $sqlgg = "SELECT guruh.GuruhSumma FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.Status='true' AND guruh_plus.UserID='".$_GET['UserID']."'";
      $resgg = $conn->query($sqlgg);
      $guruhSumma = 0;
      while ($rowgg = $resgg->fetch()) {
        $guruhSumma = $guruhSumma + $rowgg['GuruhSumma'];
      }
      $sqlgurdelss = "SELECT * FROM `guruh_user_del` WHERE `UserID`='".$_GET['UserID']."'";
      $resgurdelss = $conn->query($sqlgurdelss);
      $guruhdellll = 0;
      while ($rowss = $resgurdelss->fetch()) {
        $guruhdellll = $guruhdellll + $rowss['GuruhSumma'];
      }
      $Balans = $Chegirma+$NaqtPastik-$Qaytarildi-$guruhSumma-$guruhdellll;
      $sqlDay = "SELECT * FROM `guruh_chegirma` WHERE `id`=1";
      $resDay = $conn->query($sqlDay);
      $rowDay = $resDay->fetch();
      $days = date('Y-m-d',strtotime('-'.$rowDay['Days'].' day'));
      $MaxChegirma = number_format($rowDay['Chegirma'], 0, '.', ' ');
    ?>
    <section class="section contact">
      <div class="row  text-center">
        <div class="col-lg-12 col-12">
          <div class="row">
            <div class="col-lg-3">
              <div class="info-box card" style="min-height:445px;<?php if($UIns==='off'){echo 'display:none;';}elseif($Type==='mexmon'){echo 'display:none;';} ?>">
                <!-- To'lov qilish ++++++ -->
                <script>
                  function button(id){
                    document.getElementById(id).style.display='none';
                  }
                  function onbutton(id){
                    document.getElementById(id).style.display='block';
                  }
                </script>
                <?php 
                  echo $Username;
                ?>
                <button class="btn btn-success w-100 my-1 px-0 text-white" style="border-radius:0;" data-bs-toggle="modal" data-bs-target="#tolovqilish">TO'LOV QILISH</button>  
                <div class="modal fade" id="tolovqilish" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">To'lov qilish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="../config/talaba/talaba_tulov_plus.php?UserID=<?php echo $_GET['UserID']; ?>" id="form1" method="post">
                          <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Guruhni tanlang</label>
                            <div class="col-sm-12">
                              <select class="form-select" onclick="onbutton('tulov');" name="GuruhID" style="border-radius:0;">
                                <?php
                                  $sqlg11 = "SELECT * FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.UserID='".$_GET['UserID']."'";
                                  $resg11 = $conn->query($sqlg11);
                                  $i=1;
                                  echo "<option value='NULL'>Tanlang</option>";
                                  while ($row01=$resg11->fetch()) {
                                    echo "<option value=".$row01['GuruhID'].">".$row01['GuruhName']."</option>";
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">To'lov turi</label>
                            <div class="col-sm-12">
                              <select class="form-select" onclick="onbutton('tulov');" name="tulovType" style="border-radius:0;" required>
                                <option value="">Tanlang</option>
                                <option value="Naqt">Naqt</option>
                                <option value="Plastik">Plastik</option>
                              </select>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">To'lov summasi</label>
                            <div class="col-sm-12">
                              <input type="text"  onclick="onbutton('tulov');" class="form-control" name="summa" id="summa1" style="border-radius:0;" required>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Chegirma summasi(Mak: <?php echo $MaxChegirma; ?>)</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="Chegirma" value="0" id="summa22" style="border-radius:0;">
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-12 col-form-label">To'lov haqida izoh</label>
                            <div class="col-sm-12">
                              <textarea class="form-control" name="izoh" style="height: 100px;border-radius:0;"></textarea>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-sm-12">
                              <button type="submit" id='tulov' onclick="button('tulov');" class="btn btn-success w-100" style="border-radius:0;">To'lovni saqlash</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Chegirma +++++ -->
                <button class="btn btn-danger w-100 my-1 px-0 text-white" style="border-radius:0;<?php if($Type!='admin'){echo 'display:none;';} ?>" data-bs-toggle="modal" data-bs-target="#chegirma">CHEGIRMA</button>  
                <div class="modal fade" id="chegirma" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Chegirma</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="../config/talaba/talaba_chegirma_plus.php?UserID=<?php echo $_GET['UserID']; ?>" method="post" id="form2">
                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Chegirma summasi</label>
                            <div class="col-sm-12">
                              <input type="text" name="summa" onclick="onbutton('chegirmass');" class="form-control" id="summa2" style="border-radius:0;" required>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Chegirma uchun guruhni tanlang</label>
                            <div class="col-sm-12">
                              <select class="form-select" onclick="onbutton('chegirmass');" name="GuruhID" style="border-radius:0;" required>
                                <option value=''>Tanlang</option>
                                <?php
                                  $sqlgg = "SELECT * FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.UserID='".$_GET['UserID']."'";
                                  $resgg = $conn->query($sqlgg);
                                  while ($rowgg=$resgg->fetch()) {
                                    echo "<option value=".$rowgg['GuruhID'].">".$rowgg['GuruhName']."</option>";
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-12 col-form-label">Chegirma haqida izoh</label>
                            <div class="col-sm-12">
                              <textarea class="form-control" onclick="onbutton('chegirmass');" name="izoh" style="height: 100px;border-radius:0;" required></textarea>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-sm-12">
                              <button type="submit" id='chegirmass' onclick="button('chegirmass');" class="btn btn-danger w-100" style="border-radius:0;">Chegirmani saqlash</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Guruhga qo'shish -->
                <button class="btn btn-info w-100 my-1 px-0 text-white" style="border-radius:0;" data-bs-toggle="modal" data-bs-target="#guruhplus">GURUHGA QO'SHISH</button>  
                <div class="modal fade" id="guruhplus" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Guruhga qo'shish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="../config/talaba/guruh_talaba_plus2.php?UserID=<?php echo $_GET['UserID']; ?>" method="post">
                          <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Guruhni tanlang</label>
                            <div class="col-sm-12">
                              <select class="form-select" onclick="onbutton('guruhPluss');" name="GuruhID" style="border-radius:0;" required>
                                <option value="">Tanlang</option>
                                <?php
                                  $sqlgur = "SELECT * FROM `guruh` WHERE `End`>'".$date."' ORDER BY `GuruhName` DESC";
                                  $resgur = $conn->query($sqlgur);
                                  while($rowgur = $resgur->fetch()){
                                    $sqlGp = "SELECT * FROM `guruh_plus` WHERE `GuruhID`='".$rowgur['GuruhID']."' AND `UserID`='".$_GET['UserID']."' AND `Status`='true'";
                                    $resGp = $conn->query($sqlGp);
                                    $count = $resGp->fetchColumn();
                                    if($count>1){}else{
                                      echo "<option value=".$rowgur['GuruhID'].">".$rowgur['GuruhName']."</option>";
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-12 col-form-label">Izoh</label>
                            <div class="col-sm-12">
                              <textarea class="form-control" onclick="onbutton('guruhPluss');" name="Izoh" style="height: 100px;border-radius:0;" required></textarea>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-sm-12">
                              <button type="submit" id="guruhPluss" onclick="button('guruhPluss');" class="btn btn-info w-100" style="border-radius:0;">Guruhga qo'shish</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- SMS yuborish -->
                <button class="btn btn-primary w-100 my-1 px-0 text-white" style="border-radius:0;" data-bs-toggle="modal" data-bs-target="#sendSMS">SMS YUBORISH</button>
                <div class="modal fade" id="sendSMS" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">SMS yuborish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php
                          $phone = str_replace(" ","",$row['Phone']);
                        ?>
                        <form action="https://atko.tech/sms/Send.php?" method="GET">
                          <div class="row mb-3">
                            <input type="hidden" name="Url" value="https://crm-atko.uz/blog/tashrif_eye.php?UserID=<?php echo $_GET['UserID'];?>">
                            <input type="hidden" name="Phone" value="<?php echo $phone; ?>">
                            <label for="inputPassword" class="col-sm-12 col-form-label">SMS matni</label>
                            <div class="col-sm-12">
                              <textarea class="form-control" onclick="onbutton('sendSMS');" name="Text" style="height: 100px;border-radius:0;" required></textarea>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-sm-12">
                              <button type="submit" id="sendSMS" onclick="button('sendSMS');" name="SendMesseg" class="btn btn-primary w-100" style="border-radius:0;">SMS yuborish</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Eslatma qoldirish -->  
                <button class="btn btn-warning w-100 my-1 px-0 text-white" style="border-radius:0;" data-bs-toggle="modal" data-bs-target="#eslatmaqoldirish">ESLATMA QOLDIRISH</button>  
                <div class="modal fade" id="eslatmaqoldirish" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Eslatma qoldirish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="../config/eslatma/eslatma_user.php?UserID=<?php echo $_GET['UserID']; ?>" method="post" id="form1">
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
                <button class="btn btn-primary w-100 my-1 px-0 text-white" style="border-radius:0;" data-bs-toggle="modal" data-bs-target="#taxrirlash">TAXRIRLASH</button>  
                <div class="modal fade" id="taxrirlash" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Malumotlarini yangilash</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="../config/talaba/talaba_edit_fio_plone.php?UserID=<?php echo $_GET['UserID']; ?>" method="POST" id="form1">
                          <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-12 col-form-label">FIO</label>
                            <input type="text" name="FIO" class="form-control" value="<?php echo $row['FIO']; ?>" required>
                            <label for="inputPassword" class="col-sm-12 col-form-label">Telefon raqam</label>
                            <input type="text" name="Phone" class="form-control phone" value="<?php echo $row['Phone']; ?>" required>
                          </div>
                          <div class="row mb-3">
                            <div class="col-sm-12">
                              <button type="submit" class="btn btn-warning w-100" style="border-radius:0;">O'zgarishlarni saqlash</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="info-box card" style="min-height:350px">
                <div class="row">
                  <div class="col-lg-6"><h5 class="w-100"><b><?php echo $row['FIO']; ?></b></h5></div>
                  <div class="col-lg-6"><h5 style="color:green;"><b style="color:blue">Balans:</b> <?php if($Balans<0){echo "<b style='color:red;'>".number_format($Balans, 0, '.', ' ')."</b>";}else{echo "<b style='color:green;'>".number_format($Balans, 0, '.', ' ')."</b>";} ?> so'm</b></h5></div>
                  <div class="col-lg-6">
                    <table class="table">
                      <tr><td style="text-align:left;font-weight:600;">Telefon:</td><td style="text-align:right;"><?php echo $row['Phone']; ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Manzil:</td><td style="text-align:right;"><?php echo $row['Manzil']; ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Tug'ilgan kun:</td><td style="text-align:right;"><?php echo $row['TKun']; ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Tanishi:</td><td style="text-align:right;"><?php echo $row['Tanish']; ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Tanishi Tel:</td><td style="text-align:right;"><?php echo $row['TanishPhone']; ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Messegerlar:</td><td style="text-align:right;"><?php echo $row['Haqimizda']; ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Talaba haqida:</td><td style="text-align:right;"><?php echo $row['About']; ?></td></tr>
                      <tr><td colspan=2><button class="btn btn-outline-info" style='border-radius:0;' data-bs-toggle="modal" data-bs-target="#guruhlari">TALABA GURUHLARI</button></td></tr>
                    </table>
                    <div class="modal fade" id="guruhlari" tabindex="-1">
                      <div class="modal-dialog  modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Talaba guruhlari</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Guruh</th>
                                  <th>Boshlanish vaqti</th>
                                  <th>Tugash vaqti</th>
                                  <th>To'lov summasi</th>
                                  <th>Guruhga qo'shildi</th>
                                  <th>Izoh</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $sqlguruhlar = "SELECT guruh_plus.Start AS `Qoshildi`,guruh_plus.StartIzoh,guruh_plus.StartMenegerID,guruh.Start,guruh.End,guruh.GuruhSumma,guruh.GuruhName,guruh.GuruhID FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.UserID='".$_GET['UserID']."' AND guruh_plus.Status='true'";
                                  $resguruhlar = $conn->query($sqlguruhlar);
                                  $i=1;
                                  while ($row001=$resguruhlar->fetch()) {
                                    echo "<tr>
                                      <td>".$i."</td>
                                      <td style='text-align:left'><a href=guruh_eye.php?GuruhID=".$row001['GuruhID'].">".$row001['GuruhName']."</a></td>
                                      <td>".$row001['Start']."</td>
                                      <td>".$row001['End']."</td>
                                      <td>".number_format($row001['GuruhSumma'], 0, '.', ' ')."</td>
                                      <td>".$row001['Qoshildi']."</td>
                                      <td>".$row001['StartIzoh']."</td>
                                    </tr>";
                                    $i++;
                                  }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <table class="table">
                      <tr><td style="text-align:left;font-weight:600;">To'lovlar:</td><td style="text-align:right;"><?php echo number_format($NaqtPastik, 0, '.', ' '); ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Chegirma:</td><td style="text-align:right;"><?php echo number_format($Chegirma, 0, '.', ' '); ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Qaytarilgan to'lovlar:</td><td style="text-align:right;"><?php echo number_format($Qaytarildi, 0, '.', ' '); ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Jarima:</td><td style="text-align:right;"><?php echo number_format($guruhdellll, 0, '.', ' '); ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Guruhlarha to'lovlar:</td><td style="text-align:right;"><?php echo number_format($guruhSumma, 0, '.', ' '); ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Tashrif vaqti:</td><td style="text-align:right;"><?php echo $insert['0']; ?></td></tr>
                      <tr><td style="text-align:left;font-weight:600;">Taxrirlandi:</td><td style="text-align:right;"><?php echo $update['0']; ?></td></tr>
                      <tr><td colspan=2><button class="btn btn-outline-info" style='border-radius:0;' data-bs-toggle="modal" data-bs-target="#delguruxlar">O'CHIRILGAN GURUHLARI</button></td></tr>
                    </table>
                    <div class="modal fade" id="delguruxlar" tabindex="-1">
                      <div class="modal-dialog  modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">O'chirilgan guruhlar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Guruh</th>
                                  <th>Guruhga qo'shildi</th>
                                  <th>Izoh</th>
                                  <th>Meneger</th>
                                  <th>Guruhga o'chirildi</th>
                                  <th>Izoh</th>
                                  <th>Meneger</th>
                                  <th>Jarima</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $sqldelgur = "SELECT guruh.GuruhID,guruh.GuruhName,guruh_plus.Start,guruh_plus.StartIzoh,guruh_plus.StartMenegerID,guruh_plus.End,guruh_plus.EndIzoh,guruh_plus.EndMenegerID FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.Status='false' AND guruh_plus.UserID='".$_GET['UserID']."'";
                                  $resdelgur = $conn->query($sqldelgur);
                                  $i=1;
                                  while ($Rowgd=$resdelgur->fetch()) {
                                    $sqljj = "SELECT * FROM `guruh_user_del` WHERE `GuruhID`='".$Rowgd['GuruhID']."' AND `UserID`='".$_GET['UserID']."'";
                                    $resjj = $conn->query($sqljj);
                                    $rpwjj = $resjj->fetch();

                                    $sqlm11 = "SELECT * FROM `users` WHERE `UserID`='".$Rowgd['StartMenegerID']."'";
                                    $resm11 = $conn->query($sqlm11);
                                    $rowm11 = $resm11->fetch();

                                    $sqlm112 = "SELECT * FROM `users` WHERE `UserID`='".$Rowgd['EndMenegerID']."'";
                                    $resm112 = $conn->query($sqlm112);
                                    $rowm112 = $resm112->fetch();

                                    echo "<tr>
                                      <td>".$i."</td>
                                      <td>".$Rowgd['GuruhName']."</td>
                                      <td>".$Rowgd['Start']."</td>
                                      <td>".$Rowgd['StartIzoh']."</td>
                                      <td>".$rowm11['Username']."</td>
                                      <td>".$Rowgd['End']."</td>
                                      <td>".$Rowgd['EndIzoh']."</td>
                                      <td>".$rowm112['Username']."</td>
                                      <td>".number_format($rpwjj['GuruhSumma'], 0, '.', ' ')."</td>
                                    </tr>";
                                    $i++;
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
            </div>
          </div>
        </div>
      </div>
      <!-- Talaba balansi haqida malumot -->
      <div class="info-box card px-2">
        <div class="table-responsive">
          <table  class="table table-bordered text-center align-baseline table-striped" width="100%" cellspacing="0" style="font-size:14px;">
            <thead>
              <tr class="align-middle">
                <th style="background-color: blue;color:white">#</th>
                <th style="background-color: blue;color:white">Vaqt</th>
                <th style="background-color: blue;color:white">Izoh</th>
                <th style="background-color: blue;color:white">Guruh</th>
                <th style="background-color: blue;color:white">Meneger</th>
                <th style="background-color: blue;color:white">Summa</th>
                <th style="background-color: blue;color:white">Balans</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $vaqtlar = array();
                $Izohlar = array();
                $Guruhlar = array();
                $Summalar = array();
                $Balanslar = array();
                $Menegers = array();
                $sqlax = "SELECT * FROM `user_student_history` WHERE `UserID`='".$_GET['UserID']."' ORDER BY `Data` ASC;";
                $resax = $conn->query($sqlax);
                $i=0;
                $Balans = 0;
                $Meneger = "";
                while ($rowax = $resax->fetch()) {
                  if($rowax['Type']==='Guruhga_qoshildi'){
                    $Balans = $Balans - $rowax['Summa'];
                    $Typing = "Guruhga qo'shildi";
                  }elseif($rowax['Type']==='Guruhga_tulov'){
                    $Balans = $Balans + $rowax['Summa'];
                    $Typing = "To'lov";
                  }elseif($rowax['Type']==='Tulov_Qaytarildi'){
                    $Balans = $Balans - $rowax['Summa'];
                    $Typing = "To'lov qaytarildi";
                  }elseif($rowax['Type']==='Guruh_talabaga'){
                    $Balans = $Balans + $rowax['Summa'];
                    $Typing = "Guruhdan o`chirildi";
                  }elseif($rowax['Type']==='Guruhga_jarima'){
                    $Balans = $Balans - $rowax['Summa'];
                    $Typing = "Jarima";
                  }elseif($rowax['Type']==='Guruhga_Chegirma'){
                    $Balans = $Balans + $rowax['Summa'];
                    $Typing = "Chegirma";
                  }
                  $Meneger = $rowax['Meneger'];
                  array_push($vaqtlar,$rowax['Data']);
                  array_push($Izohlar,$Typing);
                  array_push($Guruhlar,$rowax['Status']);
                  array_push($Summalar,$rowax['Summa']);
                  array_push($Balanslar,$Balans);
                  array_push($Menegers,$Meneger);
                  $i++;
                }
                $k=1;
                for ($i=$i-1; $i >=0 ; $i--) { 
                  echo "<tr>
                    <td>".$k."</td>
                    <td style='text-align:left;'>".$vaqtlar[$i]."</td>
                    <td style='text-align:left;'>".$Izohlar[$i]."</td>
                    <td style='text-align:left;'>".$Guruhlar[$i]."</td>
                    <td style='text-align:left;'>".$Menegers[$i]."</td>
                    <td style='text-align:right;'>".number_format($Summalar[$i], 0, '.', ' ')."</td>
                    <td style='text-align:right;'>".number_format($Balanslar[$i], 0, '.', ' ')."</td>
                  </tr>";
                  $k++;
                }
              ?>
            </tbody>
          </table> 
        </div>
      </div>


      <!-- Talaba eslatmalari -->
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
                $sql1 = "SELECT eslatma.Data,eslatma.Comment,eslatma.id,eslatma.MenegerID FROM `eslatma` JOIN `users` ON eslatma.TypeID=users.UserID WHERE eslatma.TypeID='".$_GET['UserID']."' ORDER BY eslatma.id DESC";
                $res1 = $conn->query($sql1);
                $i=1;
                while ($row1 = $res1->fetch()) {
                  $sqlM = "SELECT * FROM `users` WHERE `UserID`='".$row1['MenegerID']."'";
                  $resM = $conn->query($sqlM);
                  $rowM = $resM->fetch();
                  echo "<tr>
                    <td>".$i."</td>
                    <td>".$row1['Data']."</td>
                    <td>".$row1['Comment']."</td>
                    <td>".$rowM['Username']."</td>
                    <td>
                      <a href='../config/eslatma/eslatma_user_delet.php?id=".$row1['id']."&UserID=".$_GET['UserID']."' class='btn btn-danger py-0 px-1' style='border-radius: 0;'>
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

      
      <div class="info-box card px-2" style="display:none;">
        <h5 class="card-title w-100 text-center pb-0 mb-2">To'lov cheki</h5>
          <table class="table text-center w-100" id="tulovTable" style="font-size:10px;width:100%">
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
            <tr><td><b>To'lov turi:</b></td><td style="text-align: right;"><?php if(isset($_GET['type'])){echo $_GET['type'];} ?></td></tr>
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
      <?php
        if(isset($_GET['pay'])){
          echo "printData();";
        }
      ?>
    
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