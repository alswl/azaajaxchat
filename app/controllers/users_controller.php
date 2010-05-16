<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Javascript');
	var $components = array('RequestHandler');

	function login() {
		if (!empty($this->params['form'])) {
			$user = $this->User->findByLoginName($this->params['form']['name']);
			if (!empty($user) && $user['User']['user_password'] == $this->params['form']['password']) {
				if ($user['User']['status'] == 1) {
					$this -> Session -> write('AAC_USER_ID', $user['User']['id']);
					$this -> Session -> write('AAC_USER_LOGIN_NAME', $user['User']['login_name']);
					$user['User']['last_login_time'] = date("Y-m-d H:i:s");
					$user['User']['last_login_ip'] = $this->RequestHandler->getClientIP();
					$this->User->save($user);
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
	
	function logout() {
		$this->Session->delete('AAC_USER_ID');
		$this->Session->delete('AAC_USER_LOGIN_NAME');
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