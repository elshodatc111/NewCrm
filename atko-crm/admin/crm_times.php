<?php
    include("../config/config.php");
    include("./lest.php");
    $Password = md5($_POST['password']);
    if(isset($_POST['times'])){
        if($Password === $API_KEY){
            $date = $_POST['data'];
            $matm = $_POST['matn'];
            $sql = "INSERT INTO `admin_time`(`id`, `text`, `date`, `Status`) VALUES (NULL,?,?,'true')";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$matm, $date]);
            header("location: ./crm_time.php?crm_time=true");
        }else{
            header("location: ./crm_time.php");
        }
    }else{
        header("location: ./crm_time.php");
    }
?>