
<?php 
    date_default_timezone_set("Asia/Samarkand");
?><?php
    include("../config/config.php");
    if(empty($_POST['Username'])){}
    elseif(empty($_POST['Password'])){}
    else{
        $sql = "SELECT * FROM `users` WHERE `Username`='".$_POST['Username']."' AND `Password`='".md5($_POST['Password'])."' AND `Type`='techer'";
        $res = $conn->query($sql);
        $count = $res->fetchColumn();
        if($count>0){
            echo "techer";
            $stmt = $conn->query("SELECT * FROM `users` WHERE `Username`='".$_POST['Username']."' AND `Password`='".md5($_POST['Password'])."' AND `Type`='techer'");
            $user = $stmt->fetch();
            $UserID = $user['UserID'];
            setcookie('UserIDs', $UserID, time() + 3600, "/");
            header("location: ./index.php");
        }else{
            header("location: ../login.php?error=true");
        }
    }
?>