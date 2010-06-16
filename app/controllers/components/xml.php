<?php
/*
 * Created on 2010-5-17
 *
 */
class XmlComponent extends Object {
	
	var $name = "Xml"; // 组件名称

	/**
	 * xml化在线用户列表
	 */
	function getXmlOnlineUsers($onlineUsers ,$channelId = -1) {
		$usersXml = '';
//		var_dump($onlineUsers);
		foreach ($onlineUsers as $onlineUser) {
			$userId = $onlineUser['OnlineUser']['user_id'];
			$userLoginName = $onlineUser['OnlineUser']['user_login_name'];
			$usersXml .= "<user userId=\"$userId\" userLoginName=\"$userLoginName\" />" . "\n";
		}
		
		return $usersXml;
	}
	
	function getXmlMessages($messages , $userId, $channelId = -1) {
		
		$messagesXml = '';
		foreach ($messages as $message) {
			
			$messageId = $message['Message']['id'];
			$messageFromId = $message['Message']['message_from_id'];
			$messageFromLoginName = $message['Message']['message_from_login_name'];
			$isBoardcast = $message['Message']['is_boardcast'];
			$messageToId = $message['Message']['message_to_id'];
			$messageToLoginName = $message['Message']['message_to_login_name'];
			$action = $message['Message']['action'];
			$messageTime = $message['Message']['message_time'];
			$messageContent = htmlentities($message['Message']['content'], ENT_COMPAT, 'UTF-8');
			if ($isBoardcast == 1 || $messageFromId ==$userId || $messageToId ==$userId) {
				$messagesXml .= "<message id=\"$messageId\" fromId=\"$messageFromId\" fromLoginName=\"$messageFromLoginName\" isBoardast=\"$isBoardcast\" toId=\"$messageToId\"  toLoginName=\"$messageToLoginName\"  action=\"$action\" messageTime=\"$messageTime\">"
					. "$messageContent" . "</message>\n";
			}
		}
		return $messagesXml;

	}
}
?>
