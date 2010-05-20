//全局变量
var aacGlobal = {
	isChatListEven: true,
	isScrollMessages: true,
	isSoundOn : true,
	currentMessageId: -1,
	ckeditor: null,
	isAutoFlash: true,
	flashInterval: 3000,
	dialog: null
};
//XML帮助类
var XmlHelper = {
	/**
	 * 处理XML
	 * @param {Object} xmlDoc
	 */
	doXmlDoc: function(xmlDoc){
		this.rebuitOnlineUser(xmlDoc);
		this.updateMessages(xmlDoc);
	},
	
	/**
	 * 重建在线用户列表
	 * @param {Object} xmlDoc
	 */
	rebuitOnlineUser: function(xmlDoc){
		var onlineUsers = xmlDoc.getElementsByTagName("user");
		var usersHtml = "";
		for (var i = 0; i < onlineUsers.length; i++) {
			usersHtml += "<li id=\"user-" + onlineUsers[i].getAttribute('userId') + "\" name=" +
			onlineUsers[i].getAttribute('userLoginName') +
			" class='user-in-list'> " +
			onlineUsers[i].getAttribute('userLoginName') +
			"	<ul>" +
			'		<li><button class="sexybutton chat-dm" title="私聊" ><span><span><span class="mail">私聊</span></span></span></button></li>' +
			'		<li><button class="sexybutton chat-nudge" title="动Ta" ><span><span><span class="heart">动Ta</span></span></span></button></li>' +
			'		<li><button class="sexybutton chat-voice" title="语音" ><span><span><span class="phone">语音</span></span></span></button></li>' +
			'		<li><button class="sexybutton chat-file" title="文件" ><span><span><span class="page">文件</span></span></span></button></li>' +
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
	
	/**
	 * 更新聊天记录
	 * @param {Object} xmlDoc
	 */
	updateMessages: function(xmlDoc){
		var messagesResponseId = xmlDoc.getElementsByTagName("messages")[0].getAttribute('responseId');
		if (messagesResponseId != "") {
			var messages = xmlDoc.getElementsByTagName("message");
			for (var i = 0; i < messages.length; i++) {
				if (messages[i].getAttribute('action') == '' || messages[i].getAttribute('action') == 'null') {
					var messageContent = "";
					if (messages[i].childNodes[0] != undefined) {
						messageContent = messages[i].childNodes[0].nodeValue;
					}
					this.insertMessage(messages[i].getAttribute('fromLoginName'), messages[i].getAttribute('isBoardast'), messages[i].getAttribute('toLoginName'), messages[i].getAttribute('messageTime'), messageContent);
				} else if (messages[i].getAttribute('action') == 'nudge') {
					$("#dialog").empty();
					$("#dialog").append(messages[i].getAttribute('fromLoginName') + ' 动了' 
					+ messages[i].getAttribute('toLoginName') + '一下');
					aacGlobal.dialog.dialog('open');
				}
				
			}
			aacGlobal.currentMessageId = messagesResponseId;
		}
	},
	/**
	 * 处理消息插入操作
	 * @param message
	 * @return
	 */
	insertMessage: function(fromLoginName, isBoardast, toLoginName, messageTime, messageContent){
		var row_color = '';
		if (aacGlobal.isChatListEven) {
			row_color = 'row-even';
		}
		else {
			row_color = 'row-odd';
		}
		var messageHtml = '<div class="chat-row ' + row_color + '">' + ' [' +
		messageTime +
		']     ' +
		fromLoginName;
		if (isBoardast == '1') {
			messageHtml += ' -> 所有人';
		}
		else {
			messageHtml += ' -> ' + toLoginName;
		}
		messageHtml += '<div class="chat-content">' + messageContent + '</div></div>';
		$('#chat-list').append(messageHtml);
		
		// 聊天窗口自动下滚
		if (aacGlobal.isScrollMessages) {
			$('#chat-list').scrollTop(99999);
			$('#input-field').focus();
		}
		//修改Message奇偶数 CSS效果
		aacGlobal.isChatListEven = !aacGlobal.isChatListEven;
		
		//重新设定群聊
		$('#is-boardcast').val('1');
		$('#message-to-id').val('');
	}
};
//聊天帮助类
var ChatHelper = {
	//聊天系统按钮绑定
	initJQueryBind: function(){
		//私聊
		$('.chat-dm').click(function(){
		
			$('#is-boardcast').val('0');
			$('#message-to-id').val($(this).parent().parent().parent().attr('id').substring(5));
			aacGlobal.ckeditor.val('@' + $(this).parent().parent().parent().attr('name') + ' : ');
			aacGlobal.ckeditor.focus();//TODO: focus() 存在问题
		})
		$('.chat-nudge').click(function(){
		
			$('#message-to-id').val($(this).parent().parent().parent().attr('id').substring(5));
			postData($(this).parent().parent().parent().attr('id').substring(5),
				0, null, "nudge");
		})
	}
};
$(function(){

	/* ----- 数据初始化 ----- */
	aacGlobal.isChatListEven = false;
	
	/* ----- 界面初始化 ----- */
	aacGlobal.ckeditor = $('#input-field').ckeditor(function(){
	}, {
		skin: 'kama',
		width: 500,
		height: 60,
		removePlugins: 'elementspath',
		resize_enabled: false,
		//修改输入模式为br
		enterMode: CKEDITOR.ENTER_BR,
		shiftEnterMode: CKEDITOR.ENTER_P,
		startupFocus: true
	});
	aacGlobal.dialog = $("#dialog").dialog({
		bgiframe: true,
		modal: true,
		buttons: {
			Ok: function() {
				$(this).dialog('close');
			}
		},
		autoOpen:false,
		resizable : false
	});
	$("#aac-info").dialog({
		bgiframe: true,
		modal: true,
		buttons: {
			Ok: function() {
				$(this).dialog('close');
			}
		},
		autoOpen:false
	});
	//屏幕锁定Bind
	$('#btn-lock').click(function(){
		aacGlobal.isScrollMessages = !aacGlobal.isScrollMessages;
		$(this).find('span span span').toggleClass('lock-open');
	});
	//群组显示隐藏Bind
	$('#btn-group').toggle(function(){
		$('#sidebar').fadeOut('fast');
		$('#chat-list-container').css("width", "97%");
	}, function() {
		$('#sidebar').fadeIn('slow');
		$('#chat-list-container').css("width", "");
	});
	//声音开关Bind
	$('#btn-sound').click(function(){
		aacGlobal.isSoundOn = !aacGlobal.isSoundOn;
		$(this).find('span span span').toggleClass('sound-off');
	});
	//Info Bind
	$('#btn-info').click(function(){
		$("#aac-info").dialog('open');
	});
	/* ----- 特效函数绑定 ----- */
	
	//用户列表滑动效果
	//	$('#user-list > li').click(function() {
	//		this.fadeIn("slow");
	//	});
	
	/* ----- 逻辑函数绑定 ----- */
	
	// 聊天框回复按钮点击
	$("#submit").click(postMessageData);
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
	
	
	
	
	/* ----- Flash函数调用 -----*/
	if (aacGlobal.isAutoFlash) {
		setInterval("getRemoteData()", aacGlobal.flashInterval);
	}
	else {
		getRemoteData();
	}
	
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
	$('#connect-status').css('background', 'none repeat scroll 0 0 #FF0000');
	jQuery.get("http://localhost/AzaAjaxChat/src/Chat/getXml", {
		messageId: aacGlobal.currentMessageId,
		version: Math.random()
	}, getRemoteDataCallBack);
	return;
}

/**
 * 发送聊天数据
 */
function postMessageData(){
	postData($('#message-to-id').val(),
		$('#is-boardcast').val(),
		aacGlobal.ckeditor.val(),
		null);
	aacGlobal.ckeditor.val('');
}

/**
 * 发送原始数据
 */
function postData(toId, isBoardcast, inputField, action){
	var postData = {
		'toId': toId,
		'isBoardcast': isBoardcast,
		'inputField': inputField,
		'action': action
	};
	jQuery.post("http://localhost/AzaAjaxChat/src/Chat/post", postData);
}

/**
 * ajax获取远程聊天数据 回调函数
 * @param {Object} xmlDoc
 */
function getRemoteDataCallBack(xmlDoc){
	XmlHelper.doXmlDoc(xmlDoc);
	$('#connect-status').css('background', '');
	ChatHelper.initJQueryBind();
}
