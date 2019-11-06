<?php

//$lifeTime = 24 * 3600;  // 保存一天 
//session_set_cookie_params($lifeTime);
session_start();
$action = $_GET['action'];
if ($action == 's') {
    require_once 'config.php';
    $startDate = $date . " 00:00:00";
    $endDate = $date . " 23:59:59";
    $nowDate = date("Y-m-d H:i:s");
    if (empty($_SESSION['date'])) {
        $sql = "select registerid,awr,rname,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where  a.dr=0 and  awr is not null and a.ts >'{$nowDate}' and a.ts <='{$endDate}'";
    } else {
        $sql = "select registerid,awr,rname,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where a.dr=0 and awr is not null and a.ts >'{$_SESSION['date']}' and a.ts <='{$endDate}'";
    }
    $zjdd_jz_row = get_fetchAll_assoc($zjdd, $sql);
    $gzma_jz_row = get_fetchAll_assoc($gzma, $sql);
    $szyd_jz_row = get_fetchAll_assoc($szyd, $sql);
    $gzdd_jz_row = get_fetchAll_assoc($gzdd, $sql);

    $_SESSION['date'] = $nowDate;
    $totalNew = array_merge($zjdd_jz_row, $gzma_jz_row, $szyd_jz_row, $gzdd_jz_row);
    if (count($totalNew) > 1) {
        usort($totalNew, "ts_sort");
    }
    echo json_encode($totalNew);
} elseif ($action == 'd') {  
    unset($_SESSION);
    session_destroy();
    echo '1';
}