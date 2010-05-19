//全局变量
var aacGlobal = {
	isChatListEven: true,
	currentMessageId: 0
};
//XML帮助类
var XmlHelper = {
	//处理XML
	doXmlDoc: function(xmlDoc) {
		this.rebuitOnlineUser(xmlDoc);
		this.updateMessages(xmlDoc);
	},
	//重建在线用户列表
	rebuitOnlineUser: function (xmlDoc){
		var onlineUsers = xmlDoc.getElementsByTagName("user");
		var usersHtml = "";
		for (var i = 0; i < onlineUsers.length; i++) {
			usersHtml += "<li id=\"user-"+onlineUsers[i].getAttribute('userId')+"\" class='user-in-list'> " + onlineUsers[i].getAttribute('userLoginName') +
				"	<ul>" +
				"		<li><a href='#' class='chat-dm'>私聊</a>|</li>" +
				"		<li><a href=\"#\">动作</a>|</li>" +
				"		<li><a href=\"#\">语聊</a>|</li>" +
				"		<li><a href=\"#\">文件</a>|</li>" +
				"		<li><a href=\"#\">屏蔽</a></li>" +
				"	</ul>" +
				"</li>\n";
		}
		usersHtml += "";
		$('#user-list').empty().append(usersHtml);
//		$("#user-list").treeview({
//			collapsed: true,
//			animated: "medium"
//		});
	},
	//更新聊天记录
	updateMessages: function (xmlDoc) {
		var messagesResponseId = xmlDoc.getElementsByTagName("messages")[0].getAttribute('responseId');
		if (messagesResponseId != "") {
			var messages = xmlDoc.getElementsByTagName("message");
			for (var i = 0; i < messages.length; i++) {
				var messageContent = "";
				if (messages[i].childNodes[0] != undefined) {
					messageContent = messages[i].childNodes[0].nodeValue;
				}
				insertMessage(messages[i].getAttribute('fromLoginName'),
					messages[i].getAttribute('isBoardast'),
					messages[i].getAttribute('toLoginName'),
					messages[i].getAttribute('messageTime') ,messageContent);
				
			}
			aacGlobal.currentMessageId = messagesResponseId;
		}
	}
};
//聊天帮助类
var ChatHelper = {
	initJQueryBind : function() {
		//TODO:私聊
		$('.chat-dm').click(function() {
			alert($(this).parent());
		})
	},
	directMessage: function(userId, userLoginName) {
		aacGlobal.ckeditor.val('@' + userLoginName);
	}
};
$(function(){

	/* ----- 数据初始化 ----- */
	
	aacGlobal.isChatListEven = false;
	
	/* ----- 界面初始化 ----- */
	
	aacGlobal.ckeditor = $('#input-field').ckeditor(function() {
		}, {
		skin : 'kama',
		width: 500,
		height: 60,
		removePlugins : 'elementspath',
		resize_enabled : false,
		//修改输入模式为br
//		enterMode : CKEDITOR.ENTER_BR,
		shiftEnterMode : CKEDITOR.ENTER_P,
		startupFocus : true
		});
	
	/* ----- 特效函数绑定 ----- */
	
	// 输入框的颜色切换
//	$("#cke_input-field").focus(function(){
//		$("#cke_input-field").addClass("text-focus").removeClass("text-nofocus");
//	});
//	$("#cke_input-field").blur(function(){
//		$("#cke_input-field").addClass("text-nofocus").removeClass("text-focus");
//	});

	//用户列表滑动效果
//	$('#user-list > li').click(function() {
//		this.fadeIn("slow");
//	});

	/* ----- 逻辑函数绑定 ----- */
	
	// 聊天框回复按钮点击
	$("#submit").click(postData);
	// 聊天框Ctrl+Enter回复
//	aacGlobal.ckeditor.key('key', function(e){
//		if (e.ctrlKey && e.which == 13 || e.which == 10) {
//			$("#submit").click();
//		}
//	});
//	keypress(function(e){
//		if (e.ctrlKey && e.which == 13 || e.which == 10) {
//			$("#submit").click();
//		}
//	})



	
	/* ----- 函数调用 -----*/
	
//	setInterval("getRemoteData()", 3000);
	getRemoteData();
	
});

/**
 * 获取XML数据
 * @param xmlUrl
 * @return
 */
function getXmlData(xmlUrl){
	var xmlDoc;
	if (window.ActiveXObject) {
		// code for IE
		xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
	}
	else 
		if (document.implementation.createDocument) {
			// code for Firefox, Mozilla, Opera, etc.
			xmlDoc = document.implementation.createDocument("", "", null);
		}
		else {
			alert('Your browser cannot handle this script');
		}
	xmlDoc.async = false;
	xmlDoc.load(xmlUrl);
	return xmlDoc;
}

/**
 * ajax刷新远程聊天数据
 * @return
 */
function getRemoteData(){
	//获取当前最后一条消息id
//	aacGlobal.currentMessageId = aacGlobal.currentMessageId === NaN ? aacGlobal.currentMessageId + 1 : 0;
	$('#connect-status').css('background', 'none repeat scroll 0 0 #FF0000');
	jQuery.get("http://localhost/AzaAjaxChat/src/Chat/getXml", {
		messageId: aacGlobal.currentMessageId,
		version: Math.random()
	}, getRemoteDataCallBack);
	return;
}

function postData(){

	var postData = {'inputField' :aacGlobal.ckeditor.val(), 
		'isBoardcast': 'true'};
	jQuery.post("http://localhost/AzaAjaxChat/src/Chat/post", postData);
	aacGlobal.ckeditor.val('');
}

/**
 * ajax获取远程聊天数据 回调函数
 * @param data
 * @return
 */
function getRemoteDataCallBack(xmlDoc){
	// var jsonData = eval("(" + data + ")");
	// insertMessage(jsonData.data);
	
	// get xml data
	//	var xmlData = getXmlData(data);
	
	XmlHelper.doXmlDoc(xmlDoc);
	$('#connect-status').css('background', '');
	ChatHelper.initJQueryBind();
}

/**
 * 处理消息插入操作
 * @param message
 * @return
 */
function insertMessage(fromLoginName, isBoardast, toLoginName, messageTime, messageContent){
	var row_color = '';
	if (aacGlobal.isChatListEven) {
		row_color = 'row-even';
	}
	else {
		row_color = 'row-odd';
	}
	var messageHtml = '<div class="chat-row ' + row_color + '">' + fromLoginName +' 在 ['
		+ messageTime + '] ';
	messageHtml += '向大家说： ';
	messageHtml += '<div class="chat-content">' + messageContent + '</div></div>';
	$('#chat-list').append(messageHtml);
	// 聊天窗口自动下滚
	$('#chat-list').scrollTop(99999);
	$('#input-field').focus();
	aacGlobal.isChatListEven = !aacGlobal.isChatListEven;
}
