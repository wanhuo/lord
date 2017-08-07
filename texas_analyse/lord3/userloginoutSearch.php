<?php
require_once '../manage/checkPriv.php';
require_once '../include/database.class.php';
$pageIndex = 10*$_REQUEST['pageIndex'];
$pageSize = $_REQUEST['pageSize'];
$uid = intval($_REQUEST['uid']);
$cool_num = intval($_REQUEST['cool_num']);
if(strtotime($_SESSION['time'])>strtotime($_REQUEST['start'])){
    $start = $_SESSION['time'];
}else{
    $start = trim($_REQUEST['start']);
}
$data = $_REQUEST['data'];

$where = array();

if($start != ''){
    $where[]=" dateid=" . $start . " ";
}

if ( $uid ) {
    $where[]= " uid = $uid";
} elseif ( $cool_num ) {
    $sql = "select uid from lord_game_user where cool_num = $cool_num";
    $res = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    if ( count($res) > 1 ) {
        $uids = array();
        foreach ( $res as $row ) {
            $uids[]= " uid = ".$row['uid'];
        }
        $where[]= " ( ".join(' or ', $uids)." )";
    } elseif ( $res ) {
        $where[]= " uid = ".intval($res[0]['uid']);
    }
}

if($where!=array()){
    $where="where".join("and",$where);
}
else{
    $where="";
}

$c=substr($start,0,strlen($start)-2);


$sql = "select * from lord_game_loginout_$c ".$where." limit ".$pageIndex.",".$pageSize ;
//var_dump($sql);
$res = $db -> query($sql)-> fetchAll(PDO::FETCH_ASSOC);
$array['data'] = $res;

$sql = "SELECT count(*) as cn from lord_game_loginout_$c ".$where." ";
$res = $db -> query($sql) ->fetch(PDO::FETCH_ASSOC);
$array['cn'] = $res['cn'];

echo json_encode($array);


?>
