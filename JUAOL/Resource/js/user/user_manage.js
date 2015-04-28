var PersonModel = Backbone.Model

var AccountView = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['account_info']())

		var fillTable = function(){
			$.ajax({
				url: $(".account_info select[name=eventName]").attr('url'),
				type: 'GET',
				data: {
					eventId: $(".account_info select[name=eventName]").val()
				},
				success: function(data){
					$(".cat-table td.m-cat").each(function(){
						$(this).empty()
						if(data['m-cat'] != null)
							$(this).html(data['m-cat'][$(this).attr("num") - 1])
					})
					$(".cat-table td.f-cat").each(function(){
						$(this).empty()
						if(data['f-cat'] != null)
							$(this).html(data['f-cat'][$(this).attr("num") - 1])
					})
				}
			},'json')
		};
		fillTable()

		$(".account_info select[name=eventName] option").each(function(){
			if($(this).val() == $(this).parent().attr("data"))
				$(this).attr("selected", true)
		})
		$(".account_info select[name=eventName]").change(function(){
			fillTable()
		})
		$(".team-competition td.men_team").find("input[value=" 
			+ $(".team-competition td.men_team").attr("data") 
			+ "]").attr("checked", true)
		$(".team-competition td.women_team").find("input[value=" 
			+ $(".team-competition td.women_team").attr("data") 
			+ "]").attr("checked", true)

		$("form.accountInfo button[type=submit]").click(function(){
			d("ok")
			return false
		})
	}
})
var AddPersonView = Backbone.View.extend({
	events:{
		"click div.add_person img[name=img_url]": "chooseImg",
		// "change div.add_person input[type=file]": "showImg",
	},
	render: function(){
		$(this.el).html($.tpl['add_person']())
		//图片即时显示===找了好久
		$("div.add_person input[type=file]").change(function(){
			var file = this.files[0];
			var reader = new FileReader();
			reader.onload = function(){
				$("div.add_person img[name=img_url]").attr('src', reader.result)
			};
			reader.readAsDataURL(file);
		})
	},
	chooseImg: function(){
		$("div.add_person input[type=file]").click()
	},
	showPersonInfo: function(id){
		$addPerson = $("div.add_person")
		$.ajax({
			url: '/juaOL/index.php/User/getInfo',
			type: "post",
			data: {id: id},
			success: function(data){
				if(data['code'] == 200){
					for(var num in personInfo){
						tmp = personInfo[num]
						$addPerson.find("input[name=" + tmp + "]").val(data['person'][tmp])
					}
					$("select[name=groupe] option").each(function(){
						if($(this).val() == data['person']['groupe'])
							$(this).attr("selected", "")
					})
					$("select[name=gender] option").each(function(){
						if($(this).val() == data['person']['gender'])
							$(this).attr("selected", "")
					})
					$("select[name=category] option").each(function(){
						if($(this).val() == data['person']['category'])
							$(this).attr("selected", "")
					})
					$("div.add_person img[name=img_url]").attr('src', data['person']['img_url']);
					$addPerson.find("input[name=id]").val(id)
				}
			}
		}, "json")
	},
	showImg: function(){
		$("div.add_person img[name=img_url]").addClass('success')
	}
});
var UserInfo = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['person_list']())
		$(".person_info table a.edit").click(function(){
			$tr = $(this).parent().parent()
			var id = $tr.attr("data-id")

			location.hash = '#addPerson/' + id
		});
	},
});
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

var AppRouter = Backbone.Router.extend({
	routes:{
		"": "userInfo",
		"addPerson": "addPerson",
		"addPerson/:id": "addPerson",
		"accountInfo": "accountInfo",
		"passwdChange": "passwdChange",
	},
	accountInfo: function(){
		var accountInfoView = new AccountView({
			el: $("div.main")
		})
		accountInfoView.render()
	},
	userInfo: function(){
		var userInfoView = new UserInfo({
			el: $("div.main")
		})
		userInfoView.render()
	},
	addPerson: function(id){
		var addPersonView = new AddPersonView({
			el: $("div.main")
		})
		addPersonView.render()
		addPersonView.showPersonInfo(id)
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
		personInfo = new Array('family_name','given_name',
			'simple_name','identity_num','best_result','number_of_officials',
			'number_of_competitiors','federation','passport_no',
			'tel','email','adress','birth')

		app = new AppRouter()
		Backbone.history.start()		
	})
})(jQuery);