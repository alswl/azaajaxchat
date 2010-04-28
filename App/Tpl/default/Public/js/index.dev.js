$(function() {

	// 侧边栏菜单树形化
	$("#user-list").treeview( {
		collapsed : true,
		animated : "medium"
	});
	
	// 输入框的颜色切换
	$("#input-field").focus(function() {
		$("#input-field").addClass("text-focus").removeClass("text-nofocus");
	});
	$("#input-field").blur(function() {
		$("#input-field").addClass("text-nofocus").removeClass("text-focus");
	});

	//获取服务器数据
	$('#submit').click(function() {
		var postData = 'input-field=' + $('#input-field').val();
		jQuery.post("http://localhost/AzaAjaxChat/src/Chat/get", postData ,getData);
		$('#input-field').val('');
	});
	
	
});

function getData(data) {
	var jsonData = eval("(" + data + ")");
	insertMessage(jsonData.data);
}

function insertMessage(message) {
	$('#chat-list').append('<div class="chat-row">' + message + '</div>');
	//聊天窗口自动下滚
	$('#chat-list').scrollTop(99999);
	$('#input-field').focus();
}
