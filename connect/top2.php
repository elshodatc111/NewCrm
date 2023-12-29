
<?php 
    date_default_timezone_set("Asia/Samarkand");
?><?php
  include("../config/config.php");
  $sql00 = "SELECT * FROM `admin_time` WHERE `date`<'".date("Y-m-d")."'";
  $res00 = $conn->query($sql00);
  $typing = $res00->fetchColumn();
  if($typing>0){
    header("location: ../login.php?shartnoma=true");
  }
  if(!isset($_COOKIE['UserID'])){
    header("location: ../index.php");
  }else{
    $stmt = $conn->query("SELECT * FROM `users` WHERE `UserID`='".$_COOKIE['UserID']."'");
    $user = $stmt->fetch();
    $FIO = $user['FIO'];
    $Type = $user['Type'];
    $Manzil = $user['Manzil'];
    $Phone = $user['Phone'];
    $DateInsert = $user['DateInsert'];
    $DateUpdate = $user['DateUpdate'];
    $TKun = $user['TKun'];
    $Username = $user['Username'];

    $stmt2 = $conn->query("SELECT * FROM `user_admin` WHERE `UserID`='".$_COOKIE['UserID']."'");
    $user2 = $stmt2->fetch();
    $UIns = $user2['Plus'];
    $UEdit = $user2['Edit'];
    $UDel = $user2['Trash'];
    
    if($Type==='techer'){
      header("location: ./login.php");
    }
  }
?>
 <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="../index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-bezier"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="../tugilgan_kunlar.php">
            <i class="bi bi-bell"></i>
            <?php
              $sqltugilgankun = "SELECT * FROM  users WHERE  DATE_ADD(TKun, INTERVAL YEAR(CURDATE())-YEAR(TKun) + IF(DAYOFYEAR(CURDATE()) > (TKun),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY)";
              $restugilgankun = $conn->query($sqltugilgankun);$i=0;
              while ($row = $restugilgankun->fetch()) {$i++;}
            ?>
            <span class="badge bg-primary badge-number"><?php echo $i; ?></span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="../eslatma.php">
            <i class="bi bi-chat-left-text"></i>
            <?php
              $sqleslatma = "SELECT * FROM `eslatma`";
              $reseslatma = $conn->query($sqleslatma);
              $j=0;while ($rowj=$reseslatma->fetch()) {$j=$j+1;}
            ?>
            <span class="badge bg-success badge-number"><?php echo $j; ?></span>
          </a>
        </li>
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" data-bs-toggle="dropdown">
            <img src="../assets/img/ss.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php if(isset($_COOKIE['UserID'])){echo $Username;} ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php if(isset($_COOKIE['UserID'])){echo $FIO;} ?></h6>
              <span><?php if(isset($_COOKIE['UserID'])){echo $Username;} ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../kobinet.php">
                <i class="bi bi-person"></i>
                <span>Kabinet</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../login.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Chiqish</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>