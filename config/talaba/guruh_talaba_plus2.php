
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
        $GuruhID = $_POST['GuruhID'];
        $UserID = $_GET['UserID'];
        echo $GuruhID;
        $MenegerID = $_COOKIE['UserID'];

        $sql1 = "INSERT INTO `guruh_plus`(`id`, `GuruhID`, `UserID`, `Start`, `StartIzoh`, `StartMenegerID`, `End`, `EndIzoh`, `EndMenegerID`, `Status`)
        VALUES (NULL,?,?,CURRENT_TIMESTAMP,?,?,'NULL','NULL','NULL','true')";
        $stmt= $conn->prepare($sql1);
        $stmt->execute([$GuruhID,$UserID,$Izoh,$MenegerID]);
        

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$UserID,$_COOKIE['UserID'],"Talaba guruhga qo'shdi"]);

        $sql3 = "SELECT * FROM `guruh` WHERE `GuruhID`='".$GuruhID."'";
        $res3 = $conn->query($sql3);
        $row3 = $res3->fetch();
        $guruSumma = $row3['GuruhSumma'];
        $GuruhName = $row3['GuruhName'];

        $sql4 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
        VALUES (NULL,?,?,'Guruhga_qoshildi',?,?,CURRENT_TIMESTAMP,?)";
        $stmt4= $conn->prepare($sql4);
        $stmt4->execute([$UserID,$GuruhID,$GuruhName, $guruSumma,$Username]);

        header("location: ../../blog/tashrif_eye.php?UserID=".$_GET['UserID']."&guruhgaqoshildi=true");



    }else{
        header("location: ../../login.php");
    }
?>