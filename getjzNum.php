<?php

require_once 'config.php';
$startDate = $date . " 00:00:00";
$endDate = $date . " 23:59:59";
$zjdd_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
$gzma_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
$szyd_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('百度','QQ','qq','手机网','百度商桥','网站后台预约','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','神马','82348232','搜狗','回访组回访','网络其它','360','个人微信') and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
$gzdd_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
$zjdd_jz_row = get_fetchAll_assoc($zjdd, $zjdd_sql);
$zjdd_jzNum = getAllNum($zjdd_jz_row, $date);

$gzma_jz_row = get_fetchAll_assoc($gzma, $gzma_sql);
$gzma_jzNum = getAllNum($gzma_jz_row, $date);

$szyd_jz_row = get_fetchAll_assoc($szyd, $szyd_sql);
$szyd_jzNum = getAllNum($szyd_jz_row, $date);

$gzdd_jz_row = get_fetchAll_assoc($gzdd, $gzdd_sql);
$gzdd_jzNum = getAllNum($gzdd_jz_row, $date);

$data = array();
$data['zjdd_jzNum'] = $zjdd_jzNum;
$data['gzma_jzNum'] = $gzma_jzNum;
$data['szyd_jzNum'] = $szyd_jzNum;
$data['gzdd_jzNum'] = $gzdd_jzNum;
echo json_encode($data);


