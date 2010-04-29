<?php
$db_config = require 'db_config.php';
$user_config = require 'user_config.php';
$sys_config = array (

	//	'APP_GROUP_LIST' => 'Admin,Home',

	//	'DEFAULT_GROUP' => 'Home'
//	'APP_DEBUG' => true,
//	'DEBUG_MODE' => true,
);

return array_merge($db_config, $user_config, $sys_config);
?>