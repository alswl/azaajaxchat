$(function() {
	// 管理主页的下滑菜单
	$('#favorite-toggle, #favorite-inside').bind('mouseenter', function() {
		$('#favorite-inside').removeClass('slideUp').addClass('slideDown');
		setTimeout(function() {
			if ($('#favorite-inside').hasClass('slideDown')) {
				$('#favorite-inside').slideDown(100);
				$('#favorite-first').addClass('slide-down');
			}
		}, 200);
	}).bind('mouseleave', function() {
		$('#favorite-inside').removeClass('slideDown').addClass('slideUp');
		setTimeout(function() {
			if ($('#favorite-inside').hasClass('slideUp')) {
				$('#favorite-inside').slideUp(100, function() {
					$('#favorite-first').removeClass('slide-down');
				});
			}
		}, 300);
	});

	// 侧边栏菜单树形化
	$("#menu").treeview( {
		collapsed : true,
		animated : "medium"
	});
});
