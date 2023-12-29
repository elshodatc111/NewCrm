
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>

<?php
    include("../../config/config.php");
        if(isset($_COOKIE['UserID'])){

        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $renewpassword = md5($_POST['renewpassword']);

        if($newpassword===$renewpassword){
            $sql = "SELECT COUNT(*) FROM `users` WHERE `Username`='".$_GET['Username']."' AND `Password`='".$password."'";
            $res = $conn->query($sql);
            $count = $res->fetchColumn();
            if($count>0){
                $sql = "UPDATE `users` SET `Password`=? WHERE `UserID`=?";
                $stmt= $conn->prepare($sql);
                $stmt->execute([$renewpassword, $_COOKIE['UserID']]);
                
                header("location: ../../kobinet.php?loginedit=true");
            }else{
                header("location: ../../kobinet.php?passworderror=true");
            }
        }else{
            header("location: ../../kobinet.php?parolxarxil=true");
        }



    }else{
        header("location: ../../login.php");
    }
?>