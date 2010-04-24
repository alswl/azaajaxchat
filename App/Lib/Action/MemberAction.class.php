<?php
class MemberAction extends Action {
	public function index() {
	
		$hasMessage = $_GET['hasMessage'];
		$message = SESSION::get('loginMessage');
		$goto = $_GET['goto'];
		
//		dump($hasMessage);
//		dump($message);
//		dump($goto);
		
		$tplData = array('hasMessage' => $hasMessage,
			'message' => $message,
			'goto' => $goto);
		$this->assign($tplData);
		
		
		$this->display();
	}
	
	public function login() {
		
		$userName = $_POST['name'];
		$userPassword = $_POST['password'];
		$rememberMe = $_POST['rememberme'];
		$goto = $_POST['goto'];
		
		dump($userName);
		dump($userPassword);
		dump($rememberMe);
		dump($goto);
		
		$this->success('登录成功');
	}

	public function x() {
		$this->error('登录失败');
	}

	public function y() {
		$this->success('登录成功');
	}
}
?>