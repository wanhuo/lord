<?php

$ud = $user['uid'];
$rd = $user['roomId'];
$td = $user['tableId'];
$sd = $user['seatId'];

$cmd = 4; $code = 404; $send = array( 'errno' => 0, 'error' => '', 'list' => $this->model->ListGetTopicLobby($user['channel']) );
sendToFd($fd, $cmd, $code, $send);


end:{
	// $this->model->getRecord()->action($accode, $rd, $td, $ud, $user);
}
