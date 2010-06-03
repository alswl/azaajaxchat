
		<div id="login">
			<h1><a href="<?php echo $html->url(array('controller' => '/')); ?>">AzaAjaxChat</a></h1>
			<?php echo $this->Session->flash(); ?>
			<form method="post" action="<?php echo $html->url(array('controller' => 'Users', 'action' => 'Regist')); ?>" id="loginform">
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
				<p>
					<label>
						请再次输入密码：<input type="password" tabindex="20" size="20" value="" id="user_pass2" name="password2"/>
					</label>
				</p>
				<p>
					<label>
						真实姓名：<input type="text" tabindex="20" size="20" value="" id="real_name" name="real_name"/>
					</label>
				</p>
				<p class="right">
					<button type="submit" class="sexybutton" tabindex="100" id="submit" name="submit">
						<span><span><span class="accept">注册</span></span></span>
					</button>
				</p>
			</form>
		</div>