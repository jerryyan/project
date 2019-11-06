<?php
require_once '../config.php';
$id=$_POST['id'];
$sql = "select  r.AppointmentId,r.rname,rNumber,rAge,rSex,rTel,rAddress,aspecial,r.OutpatientNumber,isAppointment,rMedia,rDoctor,rSymptom,remark,rDepartment,a.awr,convert(varchar(100),r.ts,120) as ts               
                from dbo.Info_Registered r left join dbo.Info_Appointment a on r.AppointmentId = a.AppointmentId 
                where r.dr = 0   and r.cid = 1 and r.RegisterId={$id} ";
                
$row = get_fetchAll_assoc($szty, $sql);
echo json_encode($row[0]);
