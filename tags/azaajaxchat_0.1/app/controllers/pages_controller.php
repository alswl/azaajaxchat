<?php

/*
 * Created on 2010-5-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class PagesController extends AppController {

	var $name = 'Pages';
	var $uses = null;
	var $helpers = array('Ckeditor');
	
	var $components = array ('Html');
	
	function beforeFilter() {
		
		parent::beforeFilter();
		//判断是否有登录,没有登录跳转到登录窗口
		if (!$this->Session->check('AAC_USER')) {

			$this->Session->setFlash("当前用户未登录，请登录后继续操作");
			$this->Session->write('goto', array('controller' => '/'));
//			var_dump($this->Session->read('AAC_USER_AUTH_KEY'));
			$this->redirect("/Users/login");
			exit();
		}
	}

	function display() {
		
		//初始化在线用户列表
//		$this->loadModel('OnlineUser');
		
		$currentUser = $this->Session->read('AAC_USER');
//		$onlineUsers = $this->Html->getHtmlOnlineUsers($this->OnlineUser->find('all'));
		$this->set(array(
			'currentUserLoginName' => $currentUser["login_name"],
			'currentUserGroup' => $currentUser["user_group"]));
		$this->render('home');
	}
	
	function admin() {
		$this->layout = 'admin';
	}
}
?>