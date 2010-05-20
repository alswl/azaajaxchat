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
		'RequestHandler',
		'Xml'
	);
	var $helpers = array (
		'Javascript'
	);

	function beforeFilter() {
//		$this->RequestHandler->setContent('json', 'text/x-json');
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

	//ajax 轮询 XML格式
	function getXml() {
		$this->layout = "xml/stream";
		Configure :: write('debug', 0);

		//获取URL参数中的messageId参数
		$messageId = $this->params['url']['messageId'];

		//xml化在线用户列表
		$this->loadModel('OnlineUser');
		$users = $this->Xml->getXmlOnlineUsers($this->OnlineUser->find('all'));

		//xml化消息列表
		$this->loadModel('Message');
		//是否初始message == -1 传回空array
		if ($messageId == '-1') {
			$messages = array();
		} else {
			$messages = $this->Message->find('all', array('conditions' => array('Message.id >' => $messageId)));
		}
		//获取最后一条消息，产生responseId
		$endMessage = $this->Message->find('first', array('order' => array('Message.id DESC')));
//		var_dump($endMessage);
		$messagesXml = $this->Xml->getXmlMessages($messages, $this->Session->read('AAC_USER_ID'));
			
		$this->set(array (
			'userId' => $this->Session->read('AAC_USER_ID'),
			'userLoginName' => $this->Session->read('AAC_USER_LOGIN_NAME'),
			'streamTime' => date('Y-m-d'),
			'users' => $users,
			'channelId' => '1',
			'messages' => $messagesXml,
			'messagesQueryId' => $messageId,
			'messagesResponseId' => $endMessage['Message']['id']
		));
	}

	function post() {
		$this->layout = "ajax";
		//		Configure :: write('debug', 0);
		//载入Message 模型控制
		$this->loadModel('Message');
		$this->loadModel('User');

		$inputField = $this->params['form']['inputField'];
		$channelId = $this->Session->read('AAC_CHANNEL_ID');
		$isBoardcast = $this->params['form']['isBoardcast'];
		$toId = $this->params['form']['toId'];
		$toLoginName = '';
		$action = $this->params['form']['action'];
		if (isset($toId)) {
			$toUser = $this->User->findById($toId);
			$toLoginName = $toUser['User']['login_name'];
		}
		//添加一条聊天记录
		$this->Message->create();
		$this->Message->save(array (
			'Message' => array (
				'channel_id' => $channelId,
				'is_boardcast' => $isBoardcast,
				'message_from_id' => $this->Session->read('AAC_USER_ID'),
				'message_from_login_name' => $this->Session->read('AAC_USER_LOGIN_NAME'),
				'is_boardcast' => $isBoardcast,
				'message_to_id' => $toId,
				'message_to_login_name' => $toLoginName,
				'action' => $action,
				'message_time' => date('Y-m-d H:i:s'),
				'content' => $inputField
			)
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
