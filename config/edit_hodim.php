
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $FIO = strtoupper(str_replace("'","`",$_POST['FIO']));
        $Phone = str_replace("'","`",$_POST['phone']);
        $lovozim = str_replace("'","`",$_POST['lovozim']);
        if(isset($_POST['insert'])){$insert = str_replace("'","`",$_POST['insert']);}
        else{ $insert = 'off';}
        if(isset($_POST['edit'])){$edit = str_replace("'","`",$_POST['edit']);}
        else{ $edit = 'off';}
        if(isset($_POST['delete'])){$delete = str_replace("'","`",$_POST['delete']);}
        else{ $delete = 'off';}
        
        $sql = "UPDATE `users` SET `FIO`=?,`Phone`=?,`Type`=?,`DateUpdate`=CURRENT_TIMESTAMP WHERE `UserID`=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$FIO, $Phone, $lovozim, $_GET['UserID']]);

        $sql1 = "UPDATE `user_admin` SET `Plus`=?,`Edit`=?,`Trash`=? WHERE `UserID`=?";
        $stmt1= $conn->prepare($sql1);
        $stmt1->execute([$insert, $edit, $delete, $_GET['UserID']]);

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$_GET['UserID'],$_COOKIE['UserID'],'Meneger ma`lumotlarini yangilash']);

        header("location: ../hodimlar.php");

    }else{
        header("location: ../login.php");
    }
?>