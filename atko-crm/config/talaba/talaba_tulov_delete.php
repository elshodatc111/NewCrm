
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        echo "Tulov delete";






        
        
    }else{
        header("location: ../../login.php");
    }
?>