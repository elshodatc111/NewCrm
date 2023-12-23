
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){

        $sql = "DELETE FROM `moliya` WHERE `id`=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$_GET['id']]);

        header("location: ../../moliya.php?delete=true");
      

        

    }else{
        header("location: ../../login.php");
    }
?>