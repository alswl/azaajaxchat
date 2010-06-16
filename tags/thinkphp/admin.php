<?php

/*
 * Created on 2010-04-19 20:04
 * Author: alswl
 */

//显示所有错误
error_reporting(E_ALL);

define("THINK_PATH", "ThinkPHP/");
define("APP_NAME", "Admin");
define("APP_PATH", "./Admin");

define("NO_CACHE_RUNTIME", true);

require (THINK_PATH . "/ThinkPHP.php");
APP :: run();
?>