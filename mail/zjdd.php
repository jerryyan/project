<?php

require_once 'datasource.php';
$mail->Subject = "{$nowDate}湛江数据日报"; //邮件标题 
$mail->FromName = "湛江数据日报系统";  //发件人姓名 

//$address1 = "277978150@qq.com"; //收件人email 
//$mail->AddAddress($address1, "罗泉"); //添加收件人（地址，昵称） 

$address2 = "1121452301@qq.com"; //收件人email 
$mail->AddAddress($address2, "夏芳"); //添加收件人（地址，昵称）

$mail->IsHTML(true); //支持html格式内容 
$contents = <<<EOF
         <html>
    <head>   
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>预约通知</title>
        <style>
           tr td:first-child{width: 300px;text-align:left;}
        </style>
    </head>

    <body>
        <div style="text-align: center;font-size: 18px;">{$nowDate}湛江数据日报</div>
        <table width="100%" border="1" cellpadding="0" cellspacing="0" align="center" class="tbtitle" style="background:#FBFCE2;margin-bottom:5px;">    
            <tbody>
                <tr align="center" bgcolor="#CFCFCF" height="26">
                    <td></td>             
                    <td>湛江</td>     
                </tr>
                <tr align="center">
                    <td >预约到今天</td>              
                    <td>$zjdd_yyl_row</td>
                </tr>
                <tr align="center">
                    <td>预约到今天（纯网）</td>             
                    <td>$zjdd_cw_row</td>
                </tr>
                <tr align="center">
                    <td>今天大夜班预约</td>              
                    <td>$zjdd_yydy_row</td>
                </tr>
                <tr align="center">
                    <td>昨日预约到今天</td>           
                    <td>$zjdd_yyy_row</td>
                </tr>        
                <tr align="center">
                    <td>昨日预约</td>            
                    <td>$zjdd_lrl_row</td>
                </tr>
                <tr align="center">
                    <td>昨日预约（纯网）</td>     
                    <td>$zjdd_lcw_row</td>
                </tr>
                <tr align="center">
                    <td>昨日预约到昨日</td>             
                    <td>$zjdd_zrdzr_row</td>
                </tr>
                <tr align="center">
                    <td>昨日预约到昨日（纯网）</td>        
                    <td>$zjdd_zrdzrcw_row</td>
                </tr>
                <tr align="center">
                    <td>昨日预约昨日就诊</td>              
                    <td>$zjdd_jz_row</td>
                </tr>
                <tr align="center">
                    <td>昨日预约昨日就诊（纯网）</td>                  
                    <td>$zjdd_jzcw_row</td>
                </tr>
                <tr align="center">
                    <td>昨日就诊(纯网)</td>             
                    <td>$zjdd_yjzcw_row</td>
                </tr>
                            <tr align="center">
                    <td>本月纯网总到诊</td>         
                    <td>$zjdd_mjzcw_row</td>
                </tr>
            </tbody>
        </table>
           <div>
            <p>预约到今天:按预约时间查询，预约时间是今天的数量</p>
            <p>预约到今天（纯网）:按预约时间查询，预约时间是今天的数量（纯网）</p>
            <p>今天大夜班预约:按录入时间查询，昨日大夜班录入的数量</p>
            <p>昨日预约到今天:按预约时间查询，预约时间是今天，录入时间是昨天的数量</p>
            <p>昨日预约:按录入时间查询，昨日录入的数量</p>
            <p>昨日预约（纯网）:按录入时间查询，昨日录入的数量（纯网）</p>
            <p>昨日预约到昨日:录入时间是昨天，预约时间也是昨天的数量</p>
            <p>昨日预约到昨日（纯网）:录入时间是昨天，预约时间也是昨天的数量（纯网）</p>
            <p>昨日预约昨日就诊:录入时间是昨天，就诊时间也是昨天的数量</p>
            <p>昨日预约昨日就诊（纯网）:录入时间是昨天，就诊时间也是昨天的数量（纯网按照就诊数据的媒体算）</p>
            <p>昨日就诊(纯网):就诊时间是昨天的数量（纯网）</p>                
        </div>
    </body> 
</html>  
EOF;
$mail->Body = $contents;
//echo $contents;
//发送 
if (!$mail->Send()) {
    echo "error: " . $mail->ErrorInfo;
} else {
    echo "success";
}



