(function($){
	$(document).ready(function(){
		// console.log($("header"))

		var MainView = Backbone.View.extend({
			initialize:function(){
				_.bindAll(this, 'render')
				this.render();
				d($(this))
			},
			render: function(){
				d($.tpl['information']())
				$(this.el).append($.tpl['information']());
			}
		});
		var mainView = new MainView({el: $("article.article")});
		// var testView = new TestView();
	})
})(jQuery);