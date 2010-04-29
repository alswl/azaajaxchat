<?php
class MemberAction extends Action {
	
	

	public function index() {

		$this->testIsLogin();

		$type = $_GET['type'];

		//事先定义好的空message类型
		$message = '';
		switch ($type) {
			case "1" :
				$message = "当前用户未登录，请登录后继续操作";
				$goto = "Index/index";
				break;
			case "2" :
				$message = "当前用户未登录，请登录后继续操作";
				$goto = "./admin.php";
				break;
		}

		$tplData = array (
			'message' => $message,
			'goto' => $goto
		);
		$this->assign($tplData);
		$this->display();
	}

	//登录操作
	public function login() {

		//检查是否为Post方法
		if (!$this->isPost()) {
				header("Location: " . "index"); 
			
		}
		
		$this->testIsLogin();

		$userName = $_POST['name'];
		$userPassword = $_POST['password'];
		$rememberMe = $_POST['rememberme'];
		$goto = $_POST['goto'];

		$map['login_name'] = $userName;
		$map['user_password'] = $userPassword;

		$user = M("user")->where($map)->select();
//		dump($user);
		dump($goto);

		if(!$user) {
			$this->error("数据库连接错误！");
		}
		
		if (isset ($user)) {
			//用户状态为启用
			if ('1' === $user[0]['status']) {
				Session :: set(C('AAC_USER_AUTH_KEY'), $user[0]['id']);
				Session :: set('CURRENT_USER', $user[0]);
				$this->redirect($goto, null, 3, '登录成功，正在跳转到登录前页面');
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
		$this->redirect('Member/index');
	}
	
	/**
	 * 测试用户是否已经登录
	 */
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