// JavaScript Document
var last_task_id = 0;

function get_new_tasks() {
	var post_data = $.extend(searchFilters, {
		action: 'get_last_tasks',
		last_id: last_task_id
	});
	
	$.post("ajax.php", post_data, function (result) {
		if (result.length == 0) {
			$("#mobile-task-alam i.n-count").text('');
			$("#web-task-alam i.n-count").text('');
			
			$("#new-web-tasks .listview .overflow").html('');
			$("#new-mobile-tasks .listview .overflow").html('');
			return;
		}
				
		last_task_id = result[0].id;
		
		var web_count = 0;
		var mobile_count = 0;
		
		var web_news_body = $("#new-web-tasks .listview .overflow");
		var mobile_news_body = $("#new-mobile-tasks .listview .overflow");
		
		for (var i = 0; i < result.length; i ++) {
			var task = result[i];
			if (task.category == 'web') {
				web_count ++;
			} else {
				mobile_count ++;
			}
		}
		
		if (web_count > 0) {
			$("#web-task-alam i.n-count").text(web_count);
			
			web_news_body.html('');
			
			for (var i = 0; i < result.length; i ++) {
				var task = result[i];
				if (task.category == 'mobile') continue;
				
				var new_task = '<div class="media">';
				
				new_task += '<div class="pull-left">';
				if (task.is_paymented == 1) {
					new_task += '<i class="fa fa-check-square-o" style="font-size: 60px; color: green;"></i>';
				} else {
					new_task += '<i class="fa fa-square-o" style="font-size: 60px;"></i>';
				}
				new_task += '</div>';
				
				new_task += '<div class="media-body">'
                              + '<small class="text-muted">' + task.pubdate + '</small><br>'
                              + '<a class="t-overflow" href="'+task.link+'">' + task.title + '</a><br/>'
							 // + task.description
                              + '</div>'
                              + '</div>';
				
				web_news_body.append(new_task);
			}
		} else {
			$("#web-task-alam i.n-count").text('');
		}
		
		if (mobile_count > 0) {
			$("#mobile-task-alam i.n-count").text(mobile_count);
			
			for (var i = 0; i < result.length; i ++) {
				var task = result[i];
				if (task.category == 'web') continue;
				
				var new_task = '<div class="media">';
				
				new_task += '<div class="pull-left">';
				if (task.is_paymented == 1) {
					new_task += '<i class="fa fa-check-square-o" style="font-size: 60px; color: green;"></i>';
				} else {
					new_task += '<i class="fa fa-square-o" style="font-size: 60px;"></i>';
				}
				new_task += '</div>';
				
				new_task += '<div class="media-body">'
                              + '<small class="text-muted">' + task.pubdate + '</small><br>'
                              + '<a class="t-overflow" href="'+task.link+'">' + task.title + '</a><br/>'
							//  + task.description
                              + '</div>'
                              + '</div>';
				
				mobile_news_body.append(new_task);
			}
		} else {
			$("#mobile-task-alam i.n-count").text('');
		}
	}, 'json');
}

function getAvgBudget() {
	$.post("ajax.php", {action: "get_avg_budget"}, function(result) {
		$("#mobile-avg-budget").html(result.mobile);
		$("#web-avg-budget").html(result.web);
	}, 'json');
}