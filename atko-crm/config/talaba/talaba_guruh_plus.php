
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    $stmt = $conn->query("SELECT * FROM `users` WHERE `UserID`='".$_COOKIE['UserID']."'");
    $user = $stmt->fetch();
    $Username = $user['Username'];
    if(isset($_COOKIE['UserID'])){
        $Izoh = str_replace("'","`",$_POST['Izoh']); 
        $UserID = $_POST['UserID'];
        $GuruhID = $_GET['GuruhID'];
        echo $GuruhID;
        $MenegerID = $_COOKIE['UserID'];
        $Typing ="Guruhga_qoshildi";
        $sqlgg = "SELECT * FROM `guruh` WHERE `GuruhID`='".$GuruhID."'";
        $resgg = $conn->query($sqlgg);
        $rowgg = $resgg->fetch();
        $GuruhName = $rowgg['GuruhName'];
        $Summa = $rowgg['GuruhSumma'];

        $sql1 = "INSERT INTO `guruh_plus`(`id`, `GuruhID`, `UserID`, `Start`, `StartIzoh`, `StartMenegerID`, `End`, `EndIzoh`, `EndMenegerID`, `Status`)
        VALUES (NULL,?,?,CURRENT_TIMESTAMP,?,?,'NULL','NULL','NULL','true')";
        $stmt= $conn->prepare($sql1);
        $stmt->execute([$GuruhID,$UserID,$Izoh,$MenegerID]);
        
        $sql33 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
        $stmt33= $conn->prepare($sql33);
        $stmt33->execute([$UserID,$GuruhID,$Typing,$GuruhName,$Summa,$Username]);

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$UserID,$_COOKIE['UserID'],"Guruhga Talaba qo'shdi"]);

        header("location: ../../blog/guruh_eye.php?GuruhID=".$_GET['GuruhID']."&guruhgaqoshildi=true");



    }else{
        header("location: ../../login.php");
    }
?>