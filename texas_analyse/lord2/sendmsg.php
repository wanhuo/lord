﻿<?php
require_once '../manage/checkPriv.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>系统消息 d</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
</head>
<body>
<div class="container">
	<fieldset>
		<legend>发送系统消息：</legend>	
		 <div class="row">
			<div class="span2">
				<form action="saveMsg.php" method="post">
				<textarea cols="50" rows="10" name="msg" style="width:800px;"></textarea><br>
				<input type="hidden" name="type" value="add" />
				<input type="hidden" name="level" value="1" />
				<input type="submit" value="发送公告" class="btn"/>
				</form>
			</div>
		</div>
	</fieldset>
</div>
</body>
</html>