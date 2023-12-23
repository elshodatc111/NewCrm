
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    $stmt = $conn->query("SELECT * FROM `users` WHERE `UserID`='".$_COOKIE['UserID']."'");
    $user = $stmt->fetch();
    $Username = $user['Username'];
    if(isset($_COOKIE['UserID'])){
        $UserID = $_GET['UserID'];
        $tulovType = "Chegirma";
        $summa = str_replace(",","",$_POST['summa']);
        $izoh = str_replace("'","`",$_POST['izoh']);
        $sql22 = "SELECT * FROM `users` WHERE `UserID`='".$_GET['UserID']."'";
        $res = $conn->query($sql22);
        $row = $res->fetch();
        $FIO = $row['FIO'];
        $Phone = $row['Phone'];
        $GuruhID = $_POST['GuruhID'];
        $sqlg = "SELECT * FROM `guruh` WHERE `GuruhID`='".$GuruhID."'";
        $resg = $conn->query($sqlg);
        $rowg = $resg->fetch();
        $Guruh_Name = $rowg['GuruhName'];
        echo $Guruh_Name;
        $sqlhis = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`) 
        VALUES (NULL,?,?,'Guruhga_Chegirma',?,?,CURRENT_TIMESTAMP,?)";
        $stmthis= $conn->prepare($sqlhis);
        $stmthis->execute([$UserID, $GuruhID,$Guruh_Name,$summa,$Username]);
        $sql = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`)
        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$UserID, $tulovType, $summa, $izoh, $_COOKIE['UserID']]);
        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $text = $FIO." talabaga ".$summa." so`m chegirma berildi";
        $stmt2->execute([$UserID, $_COOKIE['UserID'],$text]);

        
        header("location: ../../blog/tashrif_eye.php?UserID=".$UserID."&chegirmaplus=true");
        }else{
        header("location: ../../login.php");
    }
?>