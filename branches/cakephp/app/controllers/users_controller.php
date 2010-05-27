<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Javascript');
	var $components = array('RequestHandler');
	

	function login() {
		if (!empty($this->params['form'])) {
			$user = $this->User->findByLoginName($this->params['form']['name']);
			//用户存在并且密码正确
			if (!empty($user) && $user['User']['user_password'] == $this->params['form']['password']) {
				//用户状态为启用
				if ($user['User']['status'] == 1) {
					//刷新在线用户
					$this->removeInactiveUser();
					//更新在线用户列表
					$this->loadModel('OnlineUser');
					$this->OnlineUser->create();
					$this->OnlineUser->save(array(
						'OnlineUser'=>array(
							'user_id'=>$user['User']['id'],
							'user_login_name'=>$user['User']['login_name'],
							'user_group'=>$user['User']['user_group'],
							'channel_id'=>-1,
							'last_login_time'=>date("Y-m-d H:i:s"),
							'last_login_ip'=>$this->RequestHandler->getClientIP()
						)
					));
					//写用户登录信息入数据库
					$user['User']['last_login_time'] = date("Y-m-d H:i:s");
					$user['User']['last_login_ip'] = $this->RequestHandler->getClientIP();
					$this->User->save($user);
					//写SESSION相关内容
					$this -> Session -> write('AAC_USER', $user['User']);
					$this -> Session -> write('AAC_CHANNEL_ID', 1);
					//系统通知
					$this->botMessage($user['User']['login_name'], "上线了");
					
//					$this->render("users/login");
					$this->redirect(array('controller' => '/'));
					exit();
				} else {
					$this->Session->setFlash("登录失败, 用户帐号已经停用");
					$this->redirect("/Users/login");
					exit();
				}
			} else {
				$this->Session->setFlash("登录失败, 用户不存在或者密码错误");
				$this->redirect("/Users/login");
				exit();
			}
			
		}
		$this->layout = "login";
		
	}
	
	function removeInactiveUser() {
		$this->loadModel("OnlineUser");
		$this->OnlineUser->deleteAll("NOW() > DATE_ADD(last_login_time, interval " . Configure::read("AAConlineTimeout") ." MINUTE)");
	}
	
	private function botMessage($userLoginName, $message) {
		$this->loadModel('Message');
		$this->Message->create();
		$this->Message->save(array (
			'Message' => array (
				'channel_id' => -1,
				'is_boardcast' => 'true',
				'message_from_id' => '-1',
				'message_from_login_name' => '系统提示',
				'is_boardcast' => 'true',
				'message_to_id' => '',
				'message_to_login_name' => '',
				'action' => 'bot',
				'message_time' => date('Y-m-d H:i:s'),
				'content' => $userLoginName . $message
			)
		));
	}
	
	function logout() {
		//删除当前用户 in 在线用户列表
		$this->loadModel('OnlineUser');
		$currentUser = $this->Session->read('AAC_USER');
//		var_dump($this -> Session -> read('AAC_USER_ID'));
		$this->OnlineUser->delete((int)($currentUser["id"]));
		$this->Session->delete('AAC_USER');
		$this->botMessage($currentUser["login_name"], "下线了");
		$this->redirect(array('controller' => '/'));
		exit();
	}
	
	function admin_index() {
		$this->layout = 'admin';
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		
		$this->layout = 'admin';
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user'));
			}
		}
	}

	function admin_edit($id = null) {
		
		$this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'user'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'User'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'User'));
		$this->redirect(array('action' => 'index'));
	}
	
}
?>