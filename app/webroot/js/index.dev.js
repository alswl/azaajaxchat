var aacGlobal = {};
$(function(){

	/* ----- 数据初始化 ----- */
	
	aacGlobal.isChatListEven = false;
	
	/* ----- 界面初始化 ----- */
	
	// 侧边栏菜单树形化
	$("#user-list").treeview({
		collapsed: true,
		animated: "medium"
	});
	
	/* ----- 函数绑定 ----- */
	
	// 输入框的颜色切换
	$("#input-field").focus(function(){
		$("#input-field").addClass("text-focus").removeClass("text-nofocus");
	});
	$("#input-field").blur(function(){
		$("#input-field").addClass("text-nofocus").removeClass("text-focus");
	});
	
	$("#chat-list div:even").addClass("row-even");
	$("#chat-list div:odd").addClass("row-odd");
	
	// 聊天框回复按钮点击
	$("#submit").click(postData);
	// 聊天框Ctrl+Enter回复
	$("#input-field").keypress(function(e){
		if (e.ctrlKey && e.which == 13 || e.which == 10) {
			$("#submit").click();
		}
	})
	
	/* ----- 函数调用 -----*/
	
	// setInterval("getRemoteData()", 3000);
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
	//TODO: 获取当前最后一条消息id
	aacGlobal.currentMessageId = aacGlobal.currentMessageId === NaN ? aacGlobal.currentMessageId + 1 : 0;
	var postData = 'input-field=' + $('#input-field').val();
	jQuery.get("http://localhost/AzaAjaxChat/src/Chat/getXml", {
		messageId: aacGlobal.currentMessageId
	}, getRemoteDataCallBack);
	
}

function postData(){

	var postData = 'inputField=' + $('#input-field').val() +
		'&isBoardcast=true' +
		'';
	jQuery.post("http://localhost/AzaAjaxChat/src/Chat/post", postData);
	$('#input-field').val('');
}

/**
 * ajax获取远程聊天数据 回调函数
 * @param data
 * @return
 */
function getRemoteDataCallBack(data){
	// var jsonData = eval("(" + data + ")");
	// insertMessage(jsonData.data);
	
	// get xml data
	//	var xmlData = getXmlData(data);
	
	insertMessage(data.getElementsByTagName("message")[0].childNodes[0].nodeValue);
}

/**
 * 处理消息插入操作
 * @param message
 * @return
 */
function insertMessage(message){
	var row_color = '';
	if (aacGlobal.isChatListEven) {
		row_color = 'row-even';
	}
	else {
		row_color = 'row-odd';
	}
	$('#chat-list').append('<div class="chat-row ' + row_color + '">' + message + '</div>');
	// 聊天窗口自动下滚
	$('#chat-list').scrollTop(99999);
	$('#input-field').focus();
	aacGlobal.isChatListEven = !aacGlobal.isChatListEven;
}
