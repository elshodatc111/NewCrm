
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    $stmt = $conn->query("SELECT * FROM `users` WHERE `UserID`='".$_COOKIE['UserID']."'");
    $user = $stmt->fetch();
    $Username = $user['Username'];
    if(isset($_COOKIE['UserID'])){
        $GuruhID = $_GET['GuruhID'];
        $UserID = $_POST['UserID'];
        $TulovType = $_POST['TulovType'];
        $TulovSumma = str_replace(",","", $_POST['TulovSumma']);
        $TulovIzoh = $_POST['TulovIzoh'];
        $MenegerID = $_COOKIE['UserID'];
        $sqlP = "SELECT * FROM `users` WHERE `UserID`='".$UserID."'";
        $resP = $conn->query($sqlP);
        $rowP = $resP->fetch();
        $Typing = "Guruhga_tulov";
        $sqlgg = "SELECT * FROM `guruh` WHERE `GuruhID`='".$GuruhID."'";
        $resgg = $conn->query($sqlgg);
        $rowgg = $resgg->fetch();
        $GuruhName = $rowgg['GuruhName'];
        
        $sql33 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
        $stmt33= $conn->prepare($sql33);
        $stmt33->execute([$UserID,$GuruhID,$Typing,$TulovType,$TulovSumma,$Username]);

        $sql1 = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`) 
        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $stmt= $conn->prepare($sql1);
        $stmt->execute([$UserID, $TulovType, $TulovSumma, $TulovIzoh,$MenegerID]);
        

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$UserID,$MenegerID,"$TulovSumma Talabaga to`lov qoldi"]);

        $Phone = $rowP['Phone'];
        $phone1 = str_replace(" ","",$rowP['Phone']);
        $phone = substr($phone1,3);
        $Text = $rowP['FIO']."\nHisobingizga ".$TulovSumma." so'm to'lov qabul qilindi. \nATKO koreys tili markazi\n(91) 950 1101";
        include("../sms/sendMessehe.php");
        sendMessege2($Text,$phone,$conn);
        $checkID = time();
        $checkData = date("Y-m-d h:i:sa");
        header("location: ../../blog/guruh_eye.php?GuruhID=".$_GET['GuruhID']."&talabatolovplus=true&checkData=".$checkData."&checkID=".$checkID."&pay=true&type=".$TulovType."&summa=".$TulovSumma."&UserID=".$UserID."&chegirma=0&izoh=".$TulovIzoh."");
    }else{
        header("location: ../../login.php");
    }
?>