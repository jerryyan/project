<?php
session_start();
require_once '../config.php';
$doctor = $_SESSION['doctor'];
$data = $_POST;
$startDate = $data['startDate'];
$endDate = $data['endDate'];
$name = $data['name'];
$tel = $data['tel'];
$sql = "select  r.RegisterId,r.rname,rTel,r.OutpatientNumber,isAppointment,rMedia,rSymptom,rDepartment,a.awr,convert(varchar(100),r.ts,120) as ts,
                case when isAppointment=0 then '否' else '是' end as ysyy
                from dbo.Info_Registered r left join dbo.Info_Appointment a on r.AppointmentId = a.AppointmentId 
                where r.dr = 0   and r.cid = 1 ";
if ($doctor != "深圳天元") {
    $sql .= " and rDoctor = '{$doctor}'";
}
if (!empty($startDate)) {
    $startDate = $startDate . " 00:00:00";
    $endDate = $endDate . " 23:59:59";
    $sql .= "and (r.ts between '{$startDate}' and '{$endDate}') ";
}
if (!empty($name)) {
    $sql .= " and r.rname like '%{$name}%'";
}
if (!empty($tel)) {
    $sql .= " and r.rtel like '%{$tel}%'";
}
$sql .= " ORDER by ts  DESC";

$row = get_fetchAll_assoc($szty, $sql);

echo json_encode($row);
