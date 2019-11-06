<?php

try {
    $username = "sa";
    $pwd = "OYr%ZbxNY#!V*T0O";
    $dsn1 = "sqlsrv:Server=120.25.95.93;database=iSoftZJDD";
    // $dsn2 = "sqlsrv:Server=120.25.95.93;database=iSoftGZMA";
    $dsn3 = "sqlsrv:Server=120.25.95.93;database=iSoftSZYD";
    $dsn4 = "sqlsrv:Server=120.25.95.93;database=XL_new_reservation";
    $dsn5 = "sqlsrv:Server=120.25.95.93;database=iSoftNNDD";
    $dsn7 = "sqlsrv:Server=120.25.95.93;database=iSoftSZTY";
    $dsn6 = "mysql:host=localhost;dbname=project";
    $date = date("Y-m-d");
    //  $date = "2016-03-28";
    //    $username = "sa";
    //    $pwd = "123456";
    //    $dsn1 = "sqlsrv:Server=192.168.3.143\SQLEXPRESS;database=iSoftZJDD";
    //    $dsn2 = "sqlsrv:Server=192.168.3.143\SQLEXPRESS;database=iSoftGZMA";
    //    $dsn3 = "sqlsrv:Server=192.168.3.143\SQLEXPRESS;database=iSoftSZYD";
    $zjdd = new PDO($dsn1, $username, $pwd);
    //$gzma = new PDO($dsn2, $username, $pwd);
    $szyd = new PDO($dsn3, $username, $pwd);
    
    $gzdd = new PDO($dsn4, $username, $pwd);
    $nndd = new PDO($dsn5, $username, $pwd);
    $szty = new PDO($dsn7, $username, $pwd);
    $project = new PDO($dsn6, 'root', 'root');
} catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
}

/**
 * 
 * @param string $db
 * @param string $sql
 * @return string $row
 */
function get_fetchAll_assoc($db, $sql)
{
    $result = $db->query($sql);
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
/**
 * 
 *插入单条数据到数据库
 * @param string $db
 * @param string $sql
 * @return string $res
 */
function insert($db, $sql)
{
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $res = $db->exec($sql);
    return $res;
}

/**
 * 获取客户端IP
 */
function getClientIp()
{
    $ip = 'unknown';
    $unknown = 'unknown';

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
        // 使用透明代理、欺骗性代理的情况
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
        // 没有代理、使用普通匿名代理和高匿代理的情况
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // 处理多层代理的情况
    if (strpos($ip, ',') !== false) {
        // 输出第一个IP
        $ip = reset(explode(',', $ip));
    }

    return $ip;
}

function get_fetchAll_row($db, $sql)
{
    $result = $db->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row['number'];
}

//获取大夜班，早班和晚班的预约人数
function getAllNum($row)
{
    $dayeStart = "00:00:00";
    $zaoStart = "08:00:00";
    $wanStart = "16:00:00";
    $wanEnd = "24:00:00";
    $dayeArr = $zaoArr = $wanArr = array();
    foreach ($row as $v) {
        if ($v['tstime'] >= $dayeStart && $v['tstime'] < $zaoStart) {
            $dayeArr[] = $v;
        }
        if ($v['tstime'] >= $zaoStart && $v['tstime'] < $wanStart) {
            $zaoArr[] = $v;
        }
        if ($v['tstime'] >= $wanStart && $v['tstime'] < $wanEnd) {
            $wanArr[] = $v;
        }
    }
    $arrNum = array();
    $arrNum['dayeNum'] = count($dayeArr);
    $arrNum['zaoNum'] = count($zaoArr);
    $arrNum['wanNum'] = count($wanArr);
    $arrNum['totalNum'] = count($row);
    $arrNum['workNum'] = getWorkNum($arrNum);
    return $arrNum;
}

function getWorkNum($data)
{
    $nowtime = date("H:i:s");
    $dayeStart = "00:00:00";
    $zaoStart = "08:00:00";
    $wanStart = "16:00:00";
    $wanEnd = "24:00:00";

    if ($nowtime > $dayeStart && $nowtime < $zaoStart) {
        $workNum = $data['dayeNum'];
    }
    if ($nowtime > $zaoStart && $nowtime <= $wanStart) {
        $workNum = $data['zaoNum'];
    }
    if ($nowtime > $wanStart && $nowtime < $wanEnd) {
        $workNum = $data['wanNum'];
    }
    return $workNum;
}

//排序
function my_sort($a, $b)
{
    if ($a['nums'] == $b['nums']) {
        return 0;
    }
    return ($a['nums'] > $b['nums']) ? -1 : 1;
}

//排序
function ts_sort($a, $b)
{
    if ($a['tstime'] == $b['tstime']) {
        return 0;
    }
    return ($a['tstime'] < $b['tstime']) ? -1 : 1;
}
