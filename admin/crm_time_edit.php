<?php
    include("../config/config.php");
    include("./lest.php");
    $Password = md5($_POST['password']);
    if(isset($_POST['delete'])){
        if($Password === $API_KEY){
            $sql = "UPDATE `admin_time` SET `Status`='false' WHERE `id`='".$_GET['id']."'";
            $stmt= $conn->prepare($sql);
            $stmt->execute();
            header("location: ./crm_time.php?crm_time=true");
        }else{
            header("location: ./crm_time.php");
        }
    }else{
        header("location: ./crm_time.php");
    }
?>