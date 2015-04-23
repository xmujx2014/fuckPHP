var EventListView = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['event_list']())
	}
})
var PasswdChangeView = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['passwd_change']())
		$(".passwd-change input[name=confirmPasswd]").change(function(){
			newPasswd = $(".passwd-change input[name=newPasswd]").val()
			if($(this).val() != newPasswd){
				$(".passwd-change label.error").show();
			}
			else{
				$(".passwd-change label.error").hide();
			}
		})
	},
});

var AppRouter = Backbone.Router.extend({
	routes:{
		"": "eventList",
		"passwdChange": "passwdChange"
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
	}
});

(function($){
	$(document).ready(function(){
		app = new AppRouter()
		Backbone.history.start()
	})
})(jQuery);