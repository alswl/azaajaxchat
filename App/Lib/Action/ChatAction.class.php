<?php

class ChatAction extends BaseAction {

	public function index() {
		
		$this->success();
		$this->ajaxReturn('xx',"新增成功！",1);
	}
	

	//ajax 轮询
	public function get() {
		
		$inputField = $_POST['input-field'];
		$userName = Session :: get('CURRENT_USER');
		$this->ajaxReturn($userName['login_name'] . ' says: ' . $inputField);
	}

}
?>