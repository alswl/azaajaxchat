<?php


/*
 * Created on 2010-5-11
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class ChatController extends AppController {

	public $name = 'Chat';
	//去除Model关联，取消DB连接测试
	var $uses = array ();
	var $components = array (
		'RequestHandler'
	);
	var $helpers = array (
		'Javascript'
	);

	function beforeFilter() {
		$this->RequestHandler->setContent('json', 'text/x-json');
	}

	//ajax 轮询 json格式
	function getJson() {
		//		$this->layout = 'ajax';
		Configure :: write('debug', 0);
		$inputField = '';
		$userLoginName = '';
		$inputField = $_POST['input-field'];
		$userLoginName = $this->Session->read('AAC_USER_LOGIN_NAME');
		$this->set('message', $userLoginName . ' says: ' . $inputField);

	}

	function getXml() {
		$this->layout = "xml/stream";
		Configure :: write('debug', 0);
		
		$this->set(array (
			'streamTime' => date('Y-m-d'),
			'userId' => '0',
			'userLoginName' => 'alswl',
			'channelId' => '0',
			'messageFrom' => 'aUser',
			'messageTo' => 'bUser',
			'messageTime' => date('H:i'),
			'userLoginName' => 'text here'
		));
	}

	//测试XML格式输出
	function xml() {
		$this->layout = "xml/stream";
		// 禁止自动Render，免去为此Action去建View的烦扰
		//		$this->autoRender = false;
		// 手动定义为运营模式，去除debug信息
		Configure :: write('debug', 0);
		//以utf-8的文本模式输出
		//		header('Content-type: text/plain; charset=utf-8');

		$this->set(array (
			'streamTime' => date('Y-m-d'),
			'userId' => '0',
			'userLoginName' => 'alswl',
			'channelId' => '0',
			'messageFrom' => 'aUser',
			'messageTo' => 'bUser',
			'messageTime' => date('H:i'),
			'userLoginName' => 'text here'
		));
	}
}
?>
