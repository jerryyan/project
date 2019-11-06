<?php

require_once 'config.php';
$startDate = $date . " 00:00:00";
$endDate = $date . " 23:59:59";
$zjdd_sql = "select awr,count(awr) as nums,'湛江' as gp from info_appointment where department not like '%未预约%' and dr=0 and ts >='{$startDate}' and ts <='{$endDate}' group by awr ";
$gzma_sql = "select awr,count(awr) as nums,'民安' as gp from info_appointment where department not like '%未预约%' and dr=0  and  ts >='{$startDate}' and ts <='{$endDate}' group by awr ";
$szyd_sql = "select awr,count(awr) as nums,'远大' as gp from info_appointment where (department='肛肠外科' or department='肛肠科') and dr=0 and media in ('百度','QQ','qq','手机网','百度商桥','网站后台预约','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','神马','搜狗','回访组回访','网络其它','360','个人微信') and ts >='{$startDate}' and ts <='{$endDate}' group by awr ";
$gzdd_sql = "select awr,count(awr) as nums,'东大' as gp from info_appointment where department not like '%未预约%' and dr=0 and ts >='{$startDate}' and ts <='{$endDate}' group by awr ";

$zjdd_yy_row = get_fetchAll_assoc($zjdd, $zjdd_sql);
$szyd_yy_row = get_fetchAll_assoc($szyd, $szyd_sql);
$gzdd_yy_row = get_fetchAll_assoc($gzdd, $gzdd_sql);
$totalAwkNum = array_merge($zjdd_yy_row, $szyd_yy_row, $gzdd_yy_row);
usort($totalAwkNum, "my_sort");
echo json_encode($totalAwkNum);




