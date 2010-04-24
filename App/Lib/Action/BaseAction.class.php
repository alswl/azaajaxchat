<?php
class BaseAction extends Action {

	/**
	 * 空操作,对于未定义的操作进行报错
	 */
	function _empty() {
		$this->error("请求的页面不存在");
	}

	/**
	 * 初始化，安全检测+用户信息初始化
	 */
	function _initialize() {
		//判断是否有登录,没有登录跳转到登录窗口
		if (!Session :: is_set(C('AAC_USER_AUTH_KEY'))) {

			$goto = base64_encode($_SERVER['REQUEST_URI']);
			Session :: set('loginMessage', '当前用户未登录，请登录后继续操作');

			$this->redirect("Member/index", array ('goto' => $goto, 'hasMessage' => '1'));
		}
	}
}
?>