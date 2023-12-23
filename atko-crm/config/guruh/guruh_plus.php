
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $GuruhID = time();
        $GuruhNomi = strtoupper($_POST['GuruhNomi']);
        $GuruhSumma =str_replace(",","",$_POST['GuruhSumma']);
        $TechTulov =str_replace(",","",$_POST['TechTulov']);
        $TechBonus =str_replace(",","",$_POST['TechBonus']);
        $Start = $_POST['Start'];
        $End = $_POST['End'];
        $RoomID = $_POST['RoomID'];
        $Dushanba = $_POST['Dushanba'];
        $Seshanba = $_POST['Seshanba'];
        $Chorshanba = $_POST['Chorshanba'];
        $Payshanba = $_POST['Payshanba'];
        $Juma = $_POST['Juma'];
        $Shanba = $_POST['Shanba'];
        $Meneger = $_COOKIE['UserID'];
        $TecherID = "NULL";

        $sqltest = "SELECT * FROM `guruh` WHERE `GuruhName`='".$GuruhNomi."'";
        $restest = $conn->query($sqltest);
        $i=0;
        while ($rowtest = $restest->fetch()) {
            $i = $i+1;
        }
        if($i>0){
            header("location: ../../guruhlar_plus.php?guruhband=true");
        }else{
            $sql = "INSERT INTO `guruh`(`id`, `GuruhID`, `GuruhName`, `GuruhSumma`, `TecherID`, `TechTulov`, `TechBonus`, `Start`, `End`, `RoomID`, `Dushanba`, `Seshanba`, `Chorshanba`, `Payshanba`, `Juma`, `Shanba`, `Meneger`, `InsertData`, `UpdateData`)
            VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$GuruhID, $GuruhNomi, $GuruhSumma, $TecherID, $TechTulov, $TechBonus, $Start, $End, $RoomID, $Dushanba, $Seshanba, $Chorshanba, $Payshanba, $Juma, $Shanba, $Meneger]);

            $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
            $stmt2= $conn->prepare($sql2);
            $text = $GuruhNomi." Yangi guruh qo'shildi";
            $stmt2->execute([$RoomID, $Meneger,$text]);

            header("location: ../../guruhlar.php?guruhplus=true");
        }
    }else{
        header("location: ../../login.php");
    }

?>