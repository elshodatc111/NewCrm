
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("./config.php");
    if(empty($_POST['Username'])){}
    elseif(empty($_POST['Password'])){}
    else{
        $sql = "SELECT * FROM `users` WHERE `Username`='".$_POST['Username']."' AND `Password`='".md5($_POST['Password'])."' AND `Type`!='techer'";
        $res = $conn->query($sql);
        $count = $res->fetchColumn();

        $sql1 = "SELECT * FROM `users` WHERE `Username`='".$_POST['Username']."' AND `Password`='".md5($_POST['Password'])."' AND `Type`='techer'";
        $res1 = $conn->query($sql1);
        $count1 = $res1->fetchColumn();
        if($count>0){
            echo "Bor";
            $stmt = $conn->query("SELECT * FROM `users` WHERE `Username`='".$_POST['Username']."' AND `Password`='".md5($_POST['Password'])."' AND `Type`!='techer'");
            $user = $stmt->fetch();
            $UserID = $user['UserID'];
            setcookie('UserID', $UserID, time() + 3600, "/");
            header("location: ../index.php");
        }elseif($count1>0){
            echo "techer";
            $stmt1 = $conn->query("SELECT * FROM `users` WHERE `Username`='".$_POST['Username']."' AND `Password`='".md5($_POST['Password'])."' AND `Type`='techer'");
            $user1 = $stmt1->fetch();
            $UserID1 = $user1['UserID'];
            setcookie('UserIDs', $UserID1, time() + 3600, "/");
            header("location: ../tech/index.php");
        }else{
            header("location: ../login.php?error=true");
        }
    }
?>