<?php
class MessagesController extends AppController {

	var $name = 'Messages';
	var $helpers = array('Javascript');

	function index() {
		$this->Message->recursive = 0;
		$this->set('messages', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'message'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('message', $this->Message->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Message->create();
			if ($this->Message->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'message'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'message'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'message'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Message->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'message'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'message'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Message->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'message'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Message->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Message'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Message'));
		$this->redirect(array('action' => 'index'));
	}

	function admin_index() {
		$this->layout = 'admin';
		$this->Message->recursive = 0;
		$this->set('messages', $this->paginate());
	}

	function admin_view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'message'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('message', $this->Message->read(null, $id));
	}

	function admin_add() {
		$this->layout = 'admin';
		if (!empty($this->data)) {
			$this->Message->create();
			if ($this->Message->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'message'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'message'));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'message'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Message->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'message'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'message'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Message->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'message'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Message->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Message'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Message'));
		$this->redirect(array('action' => 'index'));
	}
}
?>