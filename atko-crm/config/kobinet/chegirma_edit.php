
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>

<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $Summa = str_replace(",","",$_POST['Summa']);
        $Days = $_POST['Days'];
        $sql = "UPDATE `guruh_chegirma` SET `Chegirma`=?,`Days`=? WHERE `id`=1";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$Summa, $Days]);
        header("location: ../../kobinet.php");
    }else{
        header("location: ../../login.php");
    }
?>