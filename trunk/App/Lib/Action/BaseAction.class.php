<?php
class BaseAction extends Action {

	function _initialize() {

		if (!Session::is_set(C('AAC_USER_AUTH_KEY'))) {

			$goto = base64_encode($_SERVER['REQUEST_URI']);
			Session::set('loginMessage', '当前用户未登录，请登录后继续操作');

			$this->redirect("Member/login", array (
				'goto' => $goto,
				'hasMessage' => '1'
			));
		}
	}
}
?>