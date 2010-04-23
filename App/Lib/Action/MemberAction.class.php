<?php
class MemberAction extends Action {
	public function login() {
	
		$hasMessage = $_GET['hasMessage'];
		$message = SESSION::get('loginMessage');
		$goto = $_GET['goto'];
		
		dump($hasMessage);
		dump($message);
		dump($goto);
		
		$tplData = array('hasMessage' => $hasMessage,
			'message' => $message);
		$this->assign($tplData);
		
		$this->assign('hasMessage',$hasMessage);
		$this->assign('message',$message);
		
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