var PersonModel = Backbone.Model

var AddPersonView = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['add_person']())
	};
	showPersonInfo: function(id, url){
			$addPerson = $('div.add_person')
			d($addPerson)
			$.ajax({
				url: url,
				type: "post",
				data: {id: id},
				success: function(data){
					if(data['code'] == 200){
						d('ok')
						for(var num in personInfo){
							tmp = personInfo[num]
							d($addPerson.find("input[name=" + tmp + "]"))
							$addPerson.find("input[name=" + tmp + "]").val(data[tmp])
						}
					}
				}
			}, "json")
		};
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
		var addPersonView = new AddPersonView({
			el: $("div.main")
		})
		addPersonView.render()
	}
});


(function($){
	$(document).ready(function(){
		
		person = new PersonModel()
		app = new AppRouter()
		Backbone.history.start()

		personInfo = new Array('team','family_name','given_name',
			'simple_name','identity_num','gender',
			'groupe','category','best_result','number_of_officials',
			'number_of_competitiors','federation','passport_no',
			'tel','email','adress')

		$(".person_info table a.edit").click(function(){
			$tr = $(this).parent().parent()
			id = $tr.attr("data-id")
			// showPersonInfo($tr.attr("data-id"), $tr.attr("data-url"))
			$("div.add_person input[name=team]").val(id)
			url = window.location.href + '#addPerson'
			location.href = url
			showPersonInfo($tr.attr("data-id"), $tr.attr("data-url"))
		});

		var showPersonInfo = function(id, url){
			$addPerson = $('div.add_person')
			d($addPerson)
			$.ajax({
				url: url,
				type: "post",
				data: {id: id},
				success: function(data){
					if(data['code'] == 200){
						d('ok')
						for(var num in personInfo){
							tmp = personInfo[num]
							d($addPerson.find("input[name=" + tmp + "]"))
							$addPerson.find("input[name=" + tmp + "]").val(data[tmp])
						}
					}
				}
			}, "json")
		}
	})
})(jQuery);