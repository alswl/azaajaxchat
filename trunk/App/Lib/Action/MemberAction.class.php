<?php
class MemberAction extends Action {
	
	

	public function index() {

		$this->testIsLogin();

		$type = $_GET['type'];
		$goto = $_GET['goto'];

		//事先定义好的message类型
		$message = '';
		switch ($type) {
			case "1" :
				$message = "当前用户未登录，请登录后继续操作";
		}

		dump($message);
		$tplData = array (
			'message' => $message,
			'goto' => $goto
		);
		$this->assign($tplData);
		$this->display();
	}

	public function login() {
		
		$this->testIsLogin();

		$userName = $_POST['name'];
		$userPassword = $_POST['password'];
		$rememberMe = $_POST['rememberme'];
		$goto = $_POST['goto'];

		dump($rememberMe);
		dump($goto);

		$map['login_name'] = $userName;
		$map['user_password'] = $userPassword;

		$user = M("User")->where($map)->select();
		dump($user);
		dump($user[0]['status']);
		dump(base64_decode($goto));

		if (isset ($user)) {
			//用户状态为启用
			if ('1' === $user[0]['status']) {
				Session :: set(C('AAC_USER_AUTH_KEY'), $user[0]['id']);
								$this->redirect(base64_decode($goto));
			} else {
				$tplData = array (
					'hasMessage' => 1,
					'message' => '登录失败, 用户帐号已经停用',
					'goto' => $goto
				);
			}
		} else {
			$tplData = array (
				'hasMessage' => 1,
				'message' => '登录失败, 用户不存在或者密码错误',
				'goto' => $goto
			);
		}
		$this->assign($tplData);
		$this->display('index');

	}
	
	public function logout() {
		Session :: clear();
		$this->redirect('Index/index');
	}
	
	private function testIsLogin() {
		if (Session :: is_set(C('AAC_USER_AUTH_KEY'))) {

			$this->redirect("Index/index", null, 3, '当前用户已登录，正在跳转至首页');
		}
	}

	public function x() {
		$this->error('登录失败');
	}

	public function y() {
		$this->success('登录成功');
	}
}
?>