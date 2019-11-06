<?php

$sql = "select name,atime,status,ip from login_history";
$history = get_fetchAll_assoc($project, $sql);
$title=["用户","时间","状态","ip"];
self::toExcel($history,￥);

/**
 * 导出Excel数据表格
 * @param  array    $dataList     要导出的数组格式的数据
 * @param  array    $headList     导出的Excel数据第一列表头
 * @param  string   $fileName     输出Excel表格文件名
 * @param  string   $exportUrl    直接输出到浏览器or输出到指定路径文件下
 * @return bool|false|string
 */
function toExcel($dataList, $headList, $fileName, $exportUrl)
{
    //set_time_limit(0);//防止超时
    //ini_set("memory_limit", "512M");//防止内存溢出
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
    header('Cache-Control: max-age=0');
    //打开PHP文件句柄,php://output 表示直接输出到浏览器,$exportUrl表示输出到指定路径文件下
    $fp = fopen($exportUrl, 'a');

    //输出Excel列名信息
    foreach ($headList as $key => $value) {
        //CSV的Excel支持GBK编码，一定要转换，否则乱码
        $headList[$key] = iconv('utf-8', 'gbk', $value);
    }

    //将数据通过fputcsv写到文件句柄
    fputcsv($fp, $headList);

    //计数器
    $num = 0;

    //每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
    $limit = 100000;

    //逐行取出数据，不浪费内存
    $count = count($dataList);
    for ($i = 0; $i < $count; $i++) {

        $num++;

        //刷新一下输出buffer，防止由于数据过多造成问题
        if ($limit == $num) {
            ob_flush();
            flush();
            $num = 0;
        }

        $row = $dataList[$i];
        foreach ($row as $key => $value) {
            $row[$key] = iconv('utf-8', 'gbk', $value);
        }
        fputcsv($fp, $row);
    }
    return $fileName;
}
