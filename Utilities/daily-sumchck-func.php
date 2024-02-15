<?php

$sql = "SELECT SUM(diff) AS total 
FROM dailyservice 
JOIN bus ON bus.id = dailyservice.busid 
WHERE dailyservice.busid = '$id' 
AND dailyservice.date >= 
    CASE 
        WHEN bus.last_maintenance != '' THEN bus.last_maintenance
        ELSE bus.dateregistered
    END
AND dailyservice.date <= CURDATE()";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total = $row['total'];
