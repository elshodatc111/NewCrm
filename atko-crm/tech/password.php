
<?php 
    date_default_timezone_set("Asia/Samarkand");
?><?php
    include("../config/config.php");
    if(empty($_POST['pass1'])){}
    elseif(empty($_POST['pass2'])){}
    elseif(empty($_POST['pass3'])){}
    else{
        $sql = "SELECT * FROM `users` WHERE `UserID`='".$_COOKIE['UserIDs']."' AND `Password`='".md5($_POST['pass1'])."' AND `Type`='techer'";
        $res = $conn->query($sql);
        $count = $res->fetchColumn();
        if($count>0){
            echo "Bor";
            if($_POST['pass2']===$_POST['pass3']){
                $sql = "UPDATE `users` SET `Password`=? WHERE `UserID`='".$_COOKIE['UserIDs']."'";
                $stmt= $conn->prepare($sql);
                $pass = md5($_POST['pass3']);
                $stmt->execute([$pass]);
                header("location: ./kobinet.php?edet=true");
            }else{
                header("location: ./kobinet.php?birxil=true");
            }
        }else{
            header("location: ./kobinet.php?error=true");
        }
    }
?>