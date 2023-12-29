
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $GuruhNomi = strtoupper($_POST['GuruhNomi']);
        $GuruhSumma =str_replace(",","",$_POST['GuruhSumma']);
        $TechTulov =str_replace(",","",$_POST['TechTulov']);
        $TechBonus =str_replace(",","",$_POST['TechBonus']);
        $Meneger = $_COOKIE['UserID'];
        $GuruhID = $_GET['GuruhID'];

        $sql = "UPDATE `guruh` SET `GuruhName`=?,`GuruhSumma`=?,`TechTulov`=?,`TechBonus`=?, `UpdateData`=CURRENT_TIMESTAMP WHERE `GuruhID`=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$GuruhNomi, $GuruhSumma, $TechTulov, $TechBonus, $GuruhID]);
        
        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $text = $GuruhNomi." Guruh malumotlari yangilandi";
        $stmt2->execute([$GuruhID, $Meneger,$text]);

        header("location: ../../blog/guruh_eye.php?GuruhID=".$GuruhID."&guruhedet=true");

    }else{
        header("location: ../../login.php");
    }

?>