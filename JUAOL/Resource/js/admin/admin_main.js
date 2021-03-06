var EventListView = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['event_list']())
		$(".event-list a.edit").click(function(){
			id = $(this).parent().parent().attr("data-id")
			location.hash = "#addEvent/" + id
		})
		$(".event-list table a.remove").click(function(){
			$tr = $(this).parent().parent()
			var id = $tr.attr("data-id")
			var name = $tr.children().eq(0).html()

			if (confirm("Are you sure remove: " + name + "？")) {
				$.ajax({
					url: $tr.attr("data-remove"),
					type: "POST",
					data: {id: id},
					success: function(data){
						$tr.hide()
					}
				})
			}
		});
		// $(".event-list table a.download").click(function(){
		// 	$tr = $(this).parent().parent()
		// 	var id = $tr.attr("data-id")
		// 	// $.ajax({
		// 	// 	url: $tr.attr("data-download"),
		// 	// 	type: "POST",
		// 	// 	data: {id: id},
		// 	// 	success: function(data){
		// 	// 		d(data)
					
		// 	// 		// location.href = data.url
		// 	// 		// $tr.hide()
		// 	// 	}
		// 	// })
		// });
	}
})
var PasswdChangeView = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['passwd_change']())
		$(".passwd-change input[name=confirmPasswd]").change(function(){
			newPasswd = $(".passwd-change input[name=newPasswd]").val()
			if($(this).val() != newPasswd){
				$(".passwd-change label.error").show()
				$(".passwd-change button").attr("disabled", true)
			}
			else{
				$(".passwd-change label.error").hide()
				$(".passwd-change button").attr("disabled", false)
			}
		})
		$(".passwd-change input[name=newPasswd]").change(function(){
			if($(this).val() != '')
				$(".passwd-change button").attr("disabled", false)
		})
	},
});
var UserConfirmView = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['user_confirm']())
		$(".user-confirm a").click(function(){
			$tr = $(this).parent().parent()
			operate = $(this).attr("operate").trim();
			data = {}
			data['id'] = $tr.attr("data-id")
			data['operate'] = operate
			url = $tr.attr("data-url")
			$.ajax({
				url: url,
				data: data,
				'type': 'post',
				'data-type': 'json',
				success: function(data){
					if(data.code = 200){
						$tr.hide()
					}
				}
			})
		})
	},
	
});
var AddEventView = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['add_event']())
	},
	fillData: function(id){
		$addEvent = $(".add-event")
		$.ajax({
			url: '/juaOL/index.php/Admin/getEvent',
			type: "post",
			data: {id: id},
			'data-type': 'json',
			success: function(data){
				if(data['code'] == 200){
					for(var num in data['fields']){
						tmp = data['fields'][num]
						$addEvent.find("input[name=" + tmp + "]").val(data['event'][tmp])
					}
				}
			}
		});
	},
})
var AppRouter = Backbone.Router.extend({
	routes:{
		"": "eventList",
		"passwdChange": "passwdChange",
		"userConfirm": "userConfirm",
		"addEvent": "addEvent",
		"addEvent/:id": "addEvent"
	},
	eventList: function(){
		var eventListView = new EventListView({
			el: ($("div.main"))
		})
		eventListView.render()
	},
	passwdChange: function(){
		var passwdChangeView = new PasswdChangeView({
			el: $("div.main")
		})
		passwdChangeView.render()
	},
	userConfirm: function(){
		var userConfirmView = new UserConfirmView({
			el: ($("div.main"))
		})
		userConfirmView.render()
	},
	addEvent: function(id){
		var addEventView = new AddEventView({
			el: $("div.main")
		})
		addEventView.render()
		if(id != null)
			addEventView.fillData(id)
	}
});

(function($){
	$(document).ready(function(){
		app = new AppRouter()
		Backbone.history.start()
	})
})(jQuery);
