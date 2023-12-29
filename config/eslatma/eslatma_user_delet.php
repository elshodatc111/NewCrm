
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $UserID =$_GET['UserID'];
        $id =$_GET['id'];
        $sql = "DELETE FROM `eslatma` WHERE `id`='".$id."'";
        $stmt= $conn->exec($sql);
        header("location: ../../blog/tashrif_eye.php?UserID=".$UserID."");
    }else{
        header("location: ../../login.php");
    }

?>