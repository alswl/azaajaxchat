<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="index.dev.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.3.2.min.js" type="text/javascript">
		</script>
<script src="js/ckeditor/ckeditor.js" type="text/javascript">
		</script>
<script src="js/ckeditor/adapters/jquery.js" type="text/javascript">
		</script>
<script src="js/index.dev.js" type="text/javascript">
		</script>
<title>AzaAjaxChat</title>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1>AzaAjaxChat</h1>
		<select>
			<option selected="selected">Public Room</option>
			<option>Private Room</option>
			<option>Create Room</option>
		</select>
		Welcome <a href="#"><?php echo $session->read('AAC_USER_LOGIN_NAME');?></a>
		<a class="sexybutton" href="<?php echo $html->url(array('controller'=>'Users', 'action'=>'logout')); ?>" tabindex="41"><span><span><span class="logout">Logout</span></span></span></a>
		<span id="connect-status">Connected</span>
		<select>
			<option selected="selected">Online</option>
			<option>Leave</option>
			<option>Busy</option>
		</select>
	</div>
	<div id="container">
		<div id="chat-list-container">
			<div id="chat-list">
			</div>
		</div>
		<div id="sidebar"> <span> </span>
			<h3>Current User Online</h3>
			<ul id="user-list" class="">
				<?php echo $onlineUsers; ?>
			</ul>
		</div>
		<div id="function-container" class="clear">
			<div id="input-container" tabindex="01">
				<textarea id="input-field" class="text-nofocus"></textarea>
				<button class="sexybutton sexylarge" id="submit" tabindex="11"> <span><span><span class="accept">Send</span></span></span> </button>
			</div>
			<div id="config-container">
				<ul>
					<li>
						<button  class="sexybutton" title="Lock Screen"  tabindex="31"><span><span><span class="lock"></span></span></span></button>
					</li>
					<li>
						<button  class="sexybutton" title="Group" tabindex="32"><span><span><span class="group"></span></span></span></button>
					</li>
					<li>
						<button  class="sexybutton" title="Sound" tabindex="33"><span><span><span class="sound"></span></span></span></button>
					</li>
					<li>
						<button  class="sexybutton" title="Config" tabindex="34"><span><span><span class="config"></span></span></span></button>
					</li>
					<li>
						<button  class="sexybutton" title="Help" tabindex="35"><span><span><span class="help"></span></span></span></button>
					</li>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div id="footer"> &copy;CopyRight 2010 AzaAjaxChat </div>
</div>
</body>
</html>
