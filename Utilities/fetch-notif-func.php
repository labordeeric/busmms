<?php
include('dbcontext.php');
if (isset($_POST['view'])) {

    $sql = "SELECT bus.id,bus.regno,bus.kilometer,garage.name as garage,bus.last_maintenance,SUM(dailyservice.diff) as kmmade, bus.status, max(dailyservice.date) as notifdate FROM dailyservice 
                JOIN bus ON bus.id = dailyservice.busid
                JOIN garage ON bus.garageid=garage.id
                WHERE dailyservice.date >= 
                    CASE 
                        WHEN bus.last_maintenance != '' THEN bus.last_maintenance
                        ELSE bus.dateregistered
                    END
                AND dailyservice.date <= CURDATE() 
                GROUP BY bus.id
                HAVING SUM(dailyservice.diff) > 4500 LIMIT 5";
    $result = mysqli_query($conn, $sql);
    $output = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <div class="dropdown-divider"></div>
            <a href="busdailyaction.php?id=' . $row["id"] . '" class="dropdown-item">
            <i class="fas fa-bus mr-2"></i> Reg No. : ' . $row["regno"] . '
            <span class="float-right text-muted text-sm">' . $row["notifdate"] . '</span>
        </a>';
        }
    } else {
        $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
    }

    $output .= '<div class="dropdown-divider"></div>
    <a href="notification.php" class="dropdown-item dropdown-footer">See All Notifications</a>';
    $sql = "SELECT COUNT(*) AS totalcount
    FROM (
        SELECT bus.id
        FROM dailyservice 
        JOIN bus ON bus.id = dailyservice.busid 
        WHERE dailyservice.date >= 
            CASE 
                WHEN bus.last_maintenance != '' THEN bus.last_maintenance
                ELSE bus.dateregistered
            END
        AND dailyservice.date <= CURDATE() 
        GROUP BY bus.id
        HAVING SUM(dailyservice.diff) > 4500
    ) AS subquery
    ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $TotalCount = $row['totalcount'];
    $count = mysqli_num_rows($result);
    $data = array(
        'notification' => $output,
        'new_notification'  => $count,
        'totalcount' => $TotalCount
    );
    echo json_encode($data);
}
