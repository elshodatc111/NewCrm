
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $Type = $_POST['Type'];
        $Summa = str_replace(",","",$_POST['Summa']);
        $Izoh = $_POST['Izoh'];
        $UserID = $_GET['UserID'];

        $sql3 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt3= $conn->prepare($sql3);
        $stmt3->execute([$UserID,$_COOKIE['UserID'],"$Type $Summa so`m hodimga ish haqi to`lov qildi"]);

        $sql4 = "INSERT INTO `user_admin_tulov`(`id`, `UserID`, `TulovType`, `Summa`, `Izoh`, `Data`) VALUES (NULL,?,?,?,?,CURRENT_TIMESTAMP)";
        $stmt4= $conn->prepare($sql4);
        $stmt4->execute([$UserID, $Type, $Summa, $Izoh ]);

        $Status = "Hodim_Tulov";
        $sql122 = "INSERT INTO `user_admin_history`(`id`, `Status`, `Type`, `Summa`, `Izoh`, `Data`)
        VALUES (NULL,?,?,?,?,CURRENT_TIMESTAMP)";
        $stmt122= $conn->prepare($sql122);
        $stmt122->execute([$Status, $Type, $Summa, $Izoh]);

        header("location: ../blog/hodim_eye.php?UserID=".$UserID."&tulovplus=true");

    }else{
        header("location: ../login.php");
    }
?>