
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $UserID =$_GET['UserID'];
        $text =$_POST['text'];
        $Meneger = $_COOKIE['UserID'];
        echo $UserID;
        $sql = "INSERT INTO `eslatma`(`id`, `Type`, `TypeID`, `Comment`, `MenegerID`, `Data`)
        VALUES (NULL,'student',?,?,?,CURRENT_TIMESTAMP)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$UserID, $text, $Meneger]);
       

        header("location: ../../blog/tashrif_eye.php?UserID=".$UserID."&eslatmaplus=true");
    }else{
        header("location: ../../login.php");
    }

?>