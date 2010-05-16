<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>AzaAjaxChat Admin Center</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php echo $scripts_for_layout ?>
		<?php echo $html->css(array('../style.dev', '../admin/admin.dev')); ?>
		<?php echo $javascript->link(array('jquery-1.3.2.min',
			'jquery.treeview.min', '../admin/js/admin.dev')); ?>
		<title>AzaAjaxChat Admin Center</title>
	</head>
	<body>
		<div id="header">
			<?php echo $html->image('logo-small.png', array('id'=>'header-logo')); ?><h1><a title="查看站点" href="<?php echo $html->url('/'); ?>"><span id="site-title">AzaAjaxChat Admin Center</span><em id="site-visit-button">查看站点</em></a></h1>
			<div id="header-info">
				<div id="user-info" class="split">
					<p>
						<a title="Edit your profile" href="#"><?php echo $session->read('AAC_USER_LOGIN_NAME');?></a>
						<span class="turbo-nag hidden">| <a href="#">Help</a></span>
						|<?php echo $html->link('退出', '/Users/logout', array('title'=>'退出')); ?>
					</p>
				</div>
				<div id="favorite-actions">
					<div id="favorite-first">
						<a href="<?php echo $html->url('/admin/Users/add'); ?>">添加新用户</a>
					</div>
					<span id="favorite-toggle">↓</span>
					<div id="favorite-inside">
						<div class="favorite-action">
							<a href="#">添加新频道</a>
						</div>
						<div class="favorite-action">
							<a href="#">系统参数设定</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper">
			<div id="sidebar">
				<ul id="menu" class="filetree treeview-famfamfam">
					<li>
						<span class="folder">基础资料管理</span>
						<ul>
							<li>
								<a href="<?php echo $html->url('/admin/Users/'); ?>"><span class="file">用户信息管理</span></a>
							</li>
							<li>
								<a href="<?php echo $html->url('/admin/Users/add'); ?>"><span class="file">添加新用户</span></a>
							</li>
							<li>
								<a href="<?php echo $html->url('/admin/Messages/'); ?>"><span class="file">聊天记录管理</span></a>
							</li>
						</ul>
					</li>
					<li>
						<span class="folder">Group</span>
						<ul>
							<li>
								<a href="#"><span class="file">Function 1</span></a>
							</li>
							<li>
								<a href="#"><span class="file">Function 1</span></a>
							</li>
							<li>
								<a href="#"><span class="file">Function 1</span></a>
							</li>
						</ul>
					</li>
					<li>
						<span class="folder">Group</span>
						<ul>
							<li>
								<a href="#"><span class="file">Function 1</span></a>
							</li>
							<li>
								<a href="#"><span class="file">Function 1</span></a>
							</li>
							<li>
								<a href="#"><span class="file">Function 1</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div id="container">
				<?php echo $content_for_layout ?>
			</div>
		</div>
	</body>
</html>
