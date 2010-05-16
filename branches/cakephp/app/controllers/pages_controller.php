<?php

/*
 * Created on 2010-5-7
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class PagesController extends AppController {

	public $name = 'Pages';
	public $uses = null;
	
	function beforeFilter() {
		
		parent::beforeFilter();
		//判断是否有登录,没有登录跳转到登录窗口
		if (!$this->Session->check('AAC_USER_ID')) {

			$this->Session->setFlash("当前用户未登录，请登录后继续操作");
			$this->Session->write('goto', array('controller' => '/'));
//			var_dump($this->Session->read('AAC_USER_AUTH_KEY'));
			$this->redirect("/Users/login");
			exit();
		}
	}

	function display() {
		$this->render('home');
	}
	
	function admin_index() {
		$this->render('home');
		
		$this->layout = 'admin';
	}
}
?>
