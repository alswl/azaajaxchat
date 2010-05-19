<?php
/*
 * Created on 2010-05-17
 *
 */
class HtmlComponent extends Object {
	
	var $name = "Html"; // 组件名称

	/**
	 * Html化在线用户列表
	 */
	function getHtmlOnlineUsers($onlineUsers ,$channelId = -1) {
		$users = '';
////		var_dump($onlineUsers);
//		foreach ($onlineUsers as $onlineUser) {
//			$userId = $onlineUser['OnlineUser']['user_id'];
//			$userLoginName = $onlineUser['OnlineUser']['user_login_name'];
////			$users .= "<user userId=\"$userId\" userLoginName=\"$userLoginName\" />" . "\n";
//			$users .= 				"<li id=\"$userId\"> <span class=\"folder\">$userLoginName</span>" .
//				"	<ul>" .
//				"		<li><a href=\"#\"><span class=\"file\">Chat with him</span></a></li>" .
//				"		<li><a href=\"#\"><span class=\"file\">Action</span></a></li>" .
//				"		<li><a href=\"#\"><span class=\"file\">Voice Chat</span></a></li>" .
//				"		<li><a href=\"#\"><span class=\"file\">Send File</span></a></li>" .
//				"		<li><a href=\"#\"><span class=\"file\">Block him</span></a></li>" .
//				"	</ul>" .
//				"</li>";
//		}
		
		return $users;
	}
}
?>
