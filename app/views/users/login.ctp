
		<div id="login">
			<h1><a href="<?php echo $html->url(array('controller' => '')); ?>">AzaAjaxChat</a></h1>
			<?php echo $this->Session->flash(); ?>
			<form method="post" action="<?php echo $html->url(array('controller' => 'Users', 'action' => 'Login')); ?>" id="loginform">
				<p>
					<label>
						用户名：<input type="text" tabindex="10" size="20" value="" id="user_name" name="name"/>
					</label>
				</p>
				<p>
					<label>
						密　码：<input type="password" tabindex="20" size="20" value="" id="user_pass" name="password"/>
					</label>
				</p>
				<p class="left">
					<label>
						<input type="checkbox" tabindex="30" value="true" id="rememberme" name="rememberme"/>记住我的登录信息
					</label>
				</p>
				<input type="hidden" name="goto" value="<?php echo $session->read('goto'); ?>"/>
				<p class="right">
					<button type="submit" class="sexybutton" tabindex="100" id="submit" name="submit">
						<span><span><span class="accept">登录</span></span></span>
					</button>
				</p>
			</form>
			<p id="nav">
				<a title="找回密码" href="#">忘记密码？</a>
			</p>
		</div>