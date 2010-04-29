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
	
	$("#chat-list div:even").addClass("row-even");
	$("#chat-list div:odd").addClass("row-odd");

	//聊天框Ctrl+Enter回复
	$("#input-field").keypress(function(e) {
		if (e.ctrlKey && e.which == 13 || e.which == 10) {
			$("#submit").click();
		} 
//		else if (e.shiftKey && e.which == 13 || e.which == 10) {
//			$("#submit").click();
//		}
	})

	// 获取服务器数据
	$('#submit').click(
			function() {
				var postData = 'input-field=' + $('#input-field').val();
				jQuery.post("http://localhost/AzaAjaxChat/src/Chat/get",
						postData, getData);
				$('#input-field').val('');
			});

});

var isChatListEven = false;

function getData(data) {
	var jsonData = eval("(" + data + ")");
	insertMessage(jsonData.data);
}

function insertMessage(message) {
	var row_color = '';
	if (isChatListEven) {
		row_color = 'row-even';
	} else {
		row_color = 'row-odd';
	}
	$('#chat-list').append('<div class="chat-row ' + row_color + '">' + message + '</div>');
	// 聊天窗口自动下滚
	$('#chat-list').scrollTop(99999);
	$('#input-field').focus();
	isChatListEven = !isChatListEven;
}

