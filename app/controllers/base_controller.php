<?php

/*
 * Created on 2010-5-10
 *
 */
class BaseController extends AppController {

	public $name = 'Base';
	
	/**
	 * 初始化，安全检测+用户信息初始化
	 */
	function _initialize() {
		//判断是否有登录,没有登录跳转到登录窗口
		if (isset($this->Session->read('AAC_USER_AUTH_KEY'))) {

			$goto = base64_encode($_SERVER['REQUEST_URI']);
			$this->redirect("account/login?type=");
		}
	}
}
?>
