
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $UserID =$_GET['GuruhID'];
        $id =$_GET['id'];
        $sql = "DELETE FROM `eslatma` WHERE `id`='".$id."'";
        $stmt= $conn->exec($sql);
        header("location: ../../blog/guruh_eye.php?GuruhID=".$UserID."");
    }else{
        header("location: ../../login.php");
    }

?>