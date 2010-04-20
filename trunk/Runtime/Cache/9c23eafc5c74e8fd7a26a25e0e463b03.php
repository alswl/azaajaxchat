<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">
	<!--
	* Created on 2010-4-20
	*
	-->
	<head>
		<title>Success</title>
	</head>
	<body>
		Success<br/>
		<?php echo ($msgTitle); ?>：操作标题<br/>
		<?php echo ($message); ?>：页面提示信息<br/>
		<?php echo ($status); ?>：操作状态  1表示成功 0 表示失败 具体还可以由项目本身定义规则<br/>
	</body>
</html>