var AddPersonView = Backbone.View.extend({
	el: $("div.main"),
	initialize:function(){
		_.bindAll(this, 'render')
		this.render();
	},
	render: function(){
		$(this.el).html($.tpl['add_person']())
	}
});
var UserInfo = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['person_info']())
	}
});

// var indexView = new AddUserView();
// var userInfo = new UserInfo({
// 	el: $("div.main"),
// });
// userInfo.render();
var AppRouter = Backbone.Router.extend({
	routes:{
		"": "userInfo",
		"addPerson": "addPerson",
	},
	userInfo: function(){
		var userInfoView = new UserInfo({
			el: $("div.main")
		})
		userInfoView.render()
	},
	addPerson: function(){
		var addPersonView = new AddPersonView()
	}
});
(function($){
	$(document).ready(function(){
		app = new AppRouter()
		Backbone.history.start()

		$(".person_info table a.edit").click(function(){
			id = $(this).parent().parent().attr("data-id")
			$("div.add_person input[name=team]").val(id)
			url = window.location.href + '#addPerson'
			location.href = url
		});
		
		$(".add_person button[type=submit]").click(function(){
			url = "/usermanage/addPerson"
			data = {
				"team": $(".add_person input[name=team]").val(),
			}
			$.ajax({
				url: url,
				type: "post",
				data: data,
				success: function(data){
					location.reload()
				}
			},"json");
		})
	})
})(jQuery);