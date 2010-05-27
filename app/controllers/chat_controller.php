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
		
		parent::beforeFilter();
		//判断是否有登录,没有登录跳转到登录窗口
		if (!$this->Session->check('AAC_USER')) {

			$this->Session->setFlash("当前用户未登录，请登录后继续操作");
			$this->Session->write('goto', array('controller' => '/'));
			$this->redirect("/Users/login");
			exit();
		}
	}

	//ajax 轮询 json格式
//	function getJson() {
//		//		$this->layout = 'ajax';
//		Configure :: write('debug', 0);
//		$inputField = '';
//		$userLoginName = '';
//		$inputField = $_POST['input-field'];
//		$userLoginName = $this->Session->read('AAC_USER_LOGIN_NAME');
//		$this->set('message', $userLoginName . ' says: ' . $inputField);
//
//	}

	//ajax 轮询 XML格式
	function getXml() {
		$this->layout = "xml/stream";
		Configure :: write('debug', 0);
		$currentUser = $this->Session->read('AAC_USER');

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
		$messagesXml = $this->Xml->getXmlMessages($messages, $currentUser["id"]);
			
		$this->set(array (
			'userId' => $currentUser["id"],
			'userLoginName' => $currentUser["login_name"],
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
		//载入其他模型控制
		$this->loadModel('Message');
		$this->loadModel('User');
		$this->loadModel('OnlineUser');
		
		$currentUser = $this->Session->read('AAC_USER');

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
				'message_from_id' => $currentUser["id"],
				'message_from_login_name' => $currentUser["login_name"],
				'message_to_id' => $toId,
				'message_to_login_name' => $toLoginName,
				'action' => $action,
				'message_time' => date('Y-m-d H:i:s'),
				'content' => $inputField
			)
		));
		var_dump($currentUser);
		var_dump($this->OnlineUser->find('count', array(
			'user_id' => $currentUser["id"]
		)));
		var_dump($this->OnlineUser->find('count', array(
			'user_id' => $currentUser["id"]
		)) != 1);
		//更新在线用户最后时间
		//由于缓存的使用，这里将带来一点问题，不能手动修改数据库，必须自然失效，否则Count缓存数据有问题
		//加上condition即可解决
		if ($this->OnlineUser->find('count', array(
			'user_id' => $currentUser["id"],
			'conditions' => '1 =1'
		)) != 1) {
			$this->OnlineUser->save(array(
				'OnlineUser'=>array(
					'user_id'=>$currentUser['id'],
					'user_login_name'=>$currentUser['login_name'],
					'user_group'=>$currentUser['user_group'],
					'channel_id'=>-1,
					'last_login_time'=>date("Y-m-d H:i:s"),
					'last_login_ip'=>$this->RequestHandler->getClientIP()
				)
			));
		} else {
			echo "save";
			$this->OnlineUser->id = $currentUser["id"];
			$this->OnlineUser->saveField('last_login_time', date('Y-m-d H:i:s'));
		}
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
