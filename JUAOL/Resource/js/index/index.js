var MainView = Backbone.View.extend({
	// initialize:function(){
	// 	_.bindAll(this, 'render')
	// 	this.render();
	// },
	render: function(){
		$(this.el).html($.tpl['information']());
	}
});
var RegisterView = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['register']());
		$(".register input[name=confirmPasswd]").change(function(){
			passwd = $(".register input[name=passwd]").val()
			if($(this).val() != passwd){
				$(this).addClass("error")
				$(".register button").attr("disabled", true)
			}
			else{
				$(this).removeClass("error")
				$(".register button").attr("disabled", false)
			}
		})
		$(".register input").change(function(){
			checkInput($(".register"))
		})
		// checkInput($(".register"))
	}
});

var AppRouter = Backbone.Router.extend({
	routes:{
		"": "main",
		"register": "register",
	},
	main: function(){
		var mainView = new MainView({
			el: $("article.article")
		});
		mainView.render()
	},
	register: function(){
		var registerView = new RegisterView({
			el: $("article.article")
		})
		registerView.render()
	}
});

(function($){
	$(document).ready(function(){
		app = new AppRouter()	
		Backbone.history.start()
	})
})(jQuery);