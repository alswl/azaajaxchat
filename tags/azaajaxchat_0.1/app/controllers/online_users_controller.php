<?php
class OnlineUsersController extends AppController {

	var $name = 'OnlineUsers';

	function index() {
		$this->OnlineUser->recursive = 0;
		$this->set('onlineUsers', $this->paginate());
	}
	
	/**
	 * 更新在线用户操作
	 */
	function refresh() {
		set_time_limit(0);
		ignore_user_abort (true);
		//不同用户同一URL操作能成功？
		while (true) {
			//如果写入refresh == stop，则停止工作
			if ($this->params['url']['refresh'] == 'stop') {
				exit();
			}
			sleep(60 * 3);//5秒
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'online user'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('onlineUser', $this->OnlineUser->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->OnlineUser->create();
			if ($this->OnlineUser->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'online user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'online user'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'online user'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OnlineUser->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'online user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'online user'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OnlineUser->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'online user'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OnlineUser->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Online user'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Online user'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->OnlineUser->recursive = 0;
		$this->set('onlineUsers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'online user'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('onlineUser', $this->OnlineUser->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->OnlineUser->create();
			if ($this->OnlineUser->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'online user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'online user'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'online user'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OnlineUser->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'online user'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'online user'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OnlineUser->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'online user'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OnlineUser->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Online user'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Online user'));
		$this->redirect(array('action' => 'index'));
	}
}
?>