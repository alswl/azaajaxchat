<?php
class LoginAction extends Action {
	public function index() {

		$this->display();
	}

	public function x() {
		$this->error('登录失败');
	}

	public function y() {
		$this->success('登录成功');
	}
}
?>