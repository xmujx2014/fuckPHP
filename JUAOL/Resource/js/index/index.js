(function($){
	$(document).ready(function(){
		// console.log($("header"))
		var Item = Backbone.Model.extend({
			defaults: {
				part1: 'hello',
				part2: 'world'
			}
		});
		var List = Backbone.Collection.extend({
			model: Item
		});
		var ItemView = Backbone.View.extend({
			tagName: 'li',
			events: {
				'click span.swap': 'swap',
				'click span.delete': 'remove'
			},
			initialize: function(){
				_.bindAll(this, 'render', 'unrender', 'swap', 'remove');

				this.model.bind('change', this.render);
				this.model.bind('remove', this.unrender);
			},
			render: function(){
				$(this.el).html('<span>'+this.model.get('part1')+' '+
					this.model.get('part2')+'</span> &nbsp; &nbsp; <span class="swap" ' + 
					'style="font-family:sans-serif; color:blue; cursor:pointer;">[swap]</span>' + 
					' <span class="delete" style="cursor:pointer; color:red; font-family:sans-serif;">[delete]</span>');
				return this;
			},
			unrender: function(){
				$(this.el).remove();
			},
			swap: function(){
				var swapped = {
					part1: this.model.get('part2'),
					part2: this.model.get('part1')
				}
				this.model.set(swapped);
			}
		})
		var TestView = Backbone.View.extend({
			el: $("article.article"),
			// template: _.template($('#infomation').html()),
			events: {
				'click button.add': 'showInfo'
			},
			initialize:function(){
				_.bindAll(this, 'render', 'showInfo', 'appendItem');

				this.collection = new List();
				this.collection.bind('add', this.appendItem)

				this.counter = 0;
				this.render();
			},
			render: function(){
				var self = this;
				$(this.el).append($.tpl['information']());
				$(this.el).append("<h1>Welcome,backbone world!</h1><br /><button class='add'>Add</button>");
				$(this.el).append("<ul></ul>");
				_(this.collection.models).each(function(item){
					self.appendItem(item);
				}, this);
			},
			showInfo: function(){
				this.counter++;
				var item = new Item();
				item.set({
					part2: item.get('part2') + this.counter
				});
				this.collection.add(item);
				// $('ul', this.el).append("<li>hello world"+this.counter+"</li>");
				// $(this.el).append($)
			},
			appendItem: function(item){
				var itemView = new ItemView({
					model: item
				})
				$('ul', this.el).append(itemView.render().el);
			}
		});

		var MainView = Backbone.View.extend({
			initialize:function(){
				_.bindAll(this, 'render')
				this.render();
			},
			render: function(){
				$(this.el).append($.tpl['information']());
			}
		});
		var mainView = new MainView({el: $("article.article")});
		// var testView = new TestView();
	})
})(jQuery);