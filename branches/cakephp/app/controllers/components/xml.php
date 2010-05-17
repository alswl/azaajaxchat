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
		$users = '';
//		var_dump($onlineUsers);
		foreach ($onlineUsers as $onlineUser) {
			$userId = $onlineUser['OnlineUser']['user_id'];
			$userLoginName = $onlineUser['OnlineUser']['user_login_name'];
			$users .= "<user userId=\"$userId\" userLoginName=\"$userLoginName\" />" . "\n";
		}
		
		return $users;
	}
}
?>
