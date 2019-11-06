<?php
try {
 
    $hostname = "120.25.95.93";
    $dbname = "iSoftZJDD";
    $username = "sa";
    $pwd = "OYr%ZbxNY#!V*T0O";
    $dsn = "sqlsrv:Server=$hostname;database=$dbname";
    $conn = new PDO($dsn, $username, $pwd);
    $sql = "select * from user";
    $result = $conn->query($sql);
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    var_dump($row);
} catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
}
