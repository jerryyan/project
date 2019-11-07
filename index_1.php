<!--<meta http-equiv="refresh" content="20">-->
<?php
require_once 'config.php';
//$date = date("Y-m-d");
$date = "2016-03-03";
$yy_sql = "select department,ts,awr from info_appointment where (department='肛肠外科' or department='肛肠科') and ts >'{$date}'";
$jz_sql = "select ts  from info_registered where ts >'{$date}'";

$zjdd_yy_row = get_fetchAll_assoc($zjdd, $yy_sql);

$zjdd_yyNum = getAllNum($zjdd_yy_row, $date);
$zjdd_awkNum = getAwrNum($zjdd_yy_row);

$zjdd_jz_row = get_fetchAll_assoc($zjdd, $jz_sql);
$zjdd_jzNum = getAllNum($zjdd_jz_row, $date);

$gzma_yy_row = get_fetchAll_assoc($gzma, $yy_sql);
$gzma_yyNum = getAllNum($gzma_yy_row, $date);
$gzma_awkNum = getAwrNum($gzma_yy_row);

$gzma_jz_row = get_fetchAll_assoc($gzma, $jz_sql);
$gzma_jzNum = getAllNum($gzma_jz_row, $date);

$szyd_yy_row = get_fetchAll_assoc($szyd, $yy_sql);
$szyd_yyNum = getAllNum($szyd_yy_row, $date);
$szyd_awkNum = getAwrNum($szyd_yy_row);

$szyd_jz_row = get_fetchAll_assoc($szyd, $jz_sql);
$szyd_jzNum = getAllNum($szyd_jz_row, $date);

$totalAwkNum = array_merge($zjdd_awkNum, $gzma_awkNum, $szyd_awkNum);
arsort($totalAwkNum);

var_dump($zjdd_yyNum);
echo "<br>";
var_dump($zjdd_jzNum);
echo "<br>";
var_dump($gzma_yyNum);
echo "<br>";
var_dump($gzma_jzNum);
echo "<br>";
var_dump($szyd_yyNum);
echo "<br>";
var_dump($szyd_jzNum);
echo "<br>";
//var_dump($zjdd_awkNum);
//echo "<br>";
//var_dump($gzma_awkNum);
//echo "<br>";
//var_dump($szyd_awkNum);
//echo "<br>";
var_dump($totalAwkNum);
echo "<br>";

//获取大夜班，早班和晚班的预约人数
function getAllNum($row, $date) {
    $dayeStart = $date . " 00:00:00";
    $zaoStart = $date . " 08:00:00";
    $wanStart = $date . " 16:00:00";
    $wanEnd = $date . " 24:00:00";
    $dayeArr = $zaoArr = $wanArr = array();
    foreach ($row as $v) {
        if ($v['ts'] > $dayeStart && $v['ts'] < $zaoStart) {
            $dayeArr[] = $v;
        }
        if ($v['ts'] > $zaoStart && $v['ts'] <= $wanStart) {
            $zaoArr[] = $v;
        }
        if ($v['ts'] > $wanStart && $v['ts'] < $wanEnd) {
            $wanArr[] = $v;
        }
    }
    $arrNum = array();
    $arrNum['dayeNum'] = count($dayeArr);
    $arrNum['zaoNum'] = count($zaoArr);
    $arrNum['wanNum'] = count($wanArr);
    $arrNum['totalNum'] = $arrNum['dayeNum'] + $arrNum['zaoNum'] + $arrNum['wanNum'];
    return $arrNum;
}

//获取咨询员预约的数量
function getAwrNum($row) {
    $arr = array();
    foreach ($row as $v) {
        $arr[] = $v['awr'];
    }
    $awrNum = array_count_values($arr);
    return $awrNum;
}