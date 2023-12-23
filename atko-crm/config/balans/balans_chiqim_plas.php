
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../config.php");
    $Summa = str_replace(",","",$_POST['summa']);
    $izoh = $_POST['izoh'];
    $Type = 'Plastik';
    $Status = "Balansdan_Chiqim";
    if($_GET['max']>=$Summa){
        $sql ="INSERT INTO `user_admin_history`(`id`, `Status`, `Type`, `Summa`, `Izoh`, `Data`)
        VALUES (NULL,?,?,?,?,CURRENT_TIMESTAMP)";
        $stmt4= $conn->prepare($sql);
        $stmt4->execute([$Status, $Type, $Summa, $izoh ]);
        header("location: ../../kobinet_2.php?tasdiq=ok");
    }else{
        header("location: ../../kobinet_2.php?chiqim=min");
    }


?>