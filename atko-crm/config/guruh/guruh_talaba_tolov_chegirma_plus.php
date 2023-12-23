
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $GuruhID = $_GET['GuruhID'];
        $UserID = $_POST['UserID'];
        $TulovSumma = str_replace(",","", $_POST['ChegirmaSumma']);
        $TulovIzoh = $_POST['ChegirmaIzoh'];
        $MenegerID = $_COOKIE['UserID'];

        $sql1 = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`) 
        VALUES (NULL,?,'Chegirma',?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $stmt= $conn->prepare($sql1);
        $stmt->execute([$UserID, $TulovSumma, $TulovIzoh,$MenegerID]);
        

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$UserID,$MenegerID,"$TulovSumma so`m chegirma kiritildi"]);

        header("location: ../../blog/guruh_eye.php?GuruhID=".$_GET['GuruhID']."&chegirmaplus=true");



    }else{
        header("location: ../../login.php");
    }
?>