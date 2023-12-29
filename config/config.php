<?php
    date_default_timezone_set("Asia/Samarkand");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "atko_crm";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>