<?php

//head
$redis = getRedis(); //comment it if not need
// $mysql = getMysql(); //comment it if not need
//base
$time = time();
$date = date("Y-m-d H:i:s");
$dateid = intval(date("Ymd"));
$weekid = intval(date("Ymd", time()-(date("N")-1)*86400));
//params
$types= array("add", "modify", "delete", "online", "offline");
$type = isset($_REQUEST['type']) ? trim($_REQUEST['type']) : '';
if ( !in_array($type, $types) ) {
	writelog('[error] request='.json_encode($_REQUEST));
	echo json_encode(array('errno'=>11,'error'=>"type=$type faild type=add|modify|delete|online|offline"));
	exit;
}
$data = isset($_REQUEST['data']) ? json_decode($_REQUEST['data'],1) : array();
if ( !$data ) {
	writelog('[error] request='.json_encode($_REQUEST));
	echo json_encode(array('errno'=>12,'error'=>"data=".json_encode($data)." faild"));
	exit;
}
$data['_type'] = $type;
$data['_file'] = 'data_tesk_list';
$data['_class'] = 'tesk';
//hosts
$hosts = getHosts($redis);
if ( !$hosts || !is_array($hosts) )
{
	writelog('[error] host='.json_encode($hosts));
	echo json_encode(array('errno'=>13,'error'=>"no server running, or redis connect faild"));
	exit;
}
//execute
$key_queue_file_ = "lord_queue_file_";
foreach ( $hosts as $hostId=>$v )
{
	$res = $redis->ladd($key_queue_file_.$hostId, $data);
}
//respond
writelog('[itsok] '.json_encode($_REQUEST));
echo json_encode(array('errno'=>0,'error'=>"done"));
exit;

