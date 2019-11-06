<?php

require_once '../config.php';
if (!empty($_POST['datetime'])) {
    $date = $_POST['datetime'];
}
$startDate = $date . " 00:00:00";
$endDate = $date . " 23:59:59";
$zjdd_sql = "select awr,count(awr) as nums,'湛江' as gp from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0  and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}' group by awr";
$gzma_sql = "select awr,count(awr) as nums,'民安' as gp from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0  and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}' group by awr";
$szyd_sql = "select awr,count(awr) as nums,'远大' as gp from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('百度','QQ','qq','手机网','百度商桥','网站后台预约','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','神马','82348232','搜狗','回访组回访','网络其它','360','个人微信') and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}' group by awr";
$gzdd_sql = "select awr,count(awr) as nums,'东大' as gp from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0  and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}' group by awr";

$zjdd_jz_row = get_fetchAll_assoc($zjdd, $zjdd_sql);
$gzma_jz_row = get_fetchAll_assoc($gzma, $gzma_sql);
$szyd_jz_row = get_fetchAll_assoc($szyd, $szyd_sql);
$gzdd_jz_row = get_fetchAll_assoc($gzdd, $gzdd_sql);
$totalAwkNum = array_merge($zjdd_jz_row, $gzma_jz_row, $szyd_jz_row, $gzdd_jz_row);
usort($totalAwkNum, "my_sort");

echo json_encode($totalAwkNum);


