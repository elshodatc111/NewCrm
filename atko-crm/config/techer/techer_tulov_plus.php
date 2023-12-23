
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $GuruhID = $_POST['GuruhID'];
        $TulovType = $_POST['TulovType'];
        $TulovSumma = str_replace(",","",$_POST['TulovSumma']);
        $Izoh = $_POST['Izoh'];
        $UserID = $_GET['UserID'];



        $sql1 = "INSERT INTO `user_techer_tulov`(`id`, `TecherID`, `GuruhID`, `TulovType`, `TulovSumma`, `Izoh`, `Meneger`, `Data`)
        VALUES (NULL,?,?,?,?,?,?,CURRENT_TIMESTAMP)";
        $stmt1= $conn->prepare($sql1);
        $stmt1->execute([$UserID, $GuruhID, $TulovType, $TulovSumma, $Izoh, $_COOKIE['UserID'] ]);

        $Status = "Techer_Tulov";
        $sql122 = "INSERT INTO `user_admin_history`(`id`, `Status`, `Type`, `Summa`, `Izoh`, `Data`)
        VALUES (NULL,?,?,?,?,CURRENT_TIMESTAMP)";
        $stmt122= $conn->prepare($sql122);
        $stmt122->execute([$Status, $TulovType, $TulovSumma, $Izoh]);


        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$UserID,$_COOKIE['UserID'],"O`qituvchiga ish haqi to`lov qildindi"]);
        header("location: ../../blog/oqituvchi_eye.php?UserID=".$UserID."&tulovplus=true");
    }else{
        header("location: ../../login.php");
    }
?>        