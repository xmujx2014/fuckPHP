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
		// fillTable()

		$(".account_info select[name=eventName] option").each(function(){
			if($(this).val() == $(this).parent().attr("data"))
				$(this).attr("selected", true)
		})
		$(".account_info select[name=eventName]").change(function(){
			fillTable()
		})
		$(".account_info table.cat-table td.m-cat").each(function(){
			$(this).parent().find("input[name=m-choose-" 
				+ $(this).attr("num") 
				+ "][value="
				+ $(this).attr("data") 
				+ "]").attr("checked", true)
		})
		$(".account_info table.cat-table td.f-cat").each(function(){
			$(this).parent().find("input[name=f-choose-" 
				+ $(this).attr("num") 
				+ "][value="
				+ $(this).attr("data") 
				+ "]").attr("checked", true)
		})
		$(".team-competition td.men_team").find("input[value=" 
			+ $(".team-competition td.men_team").attr("data") 
			+ "]").attr("checked", true)
		$(".team-competition td.women_team").find("input[value=" 
			+ $(".team-competition td.women_team").attr("data") 
			+ "]").attr("checked", true)
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
		$(".add_person img").height($(".add_person img").width() * 9 / 7)
		window.onresize = function(){
			$(".add_person img").height($(".add_person img").width() * 9 / 7)
		}
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
		$(".person_info table a.remove").click(function(){
			$tr = $(this).parent().parent()
			var id = $tr.attr("data-id")
			var name = $tr.children().eq(2).html()

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

var EventListView = Backbone.View.extend({
	render: function(){
		$(this.el).html($.tpl['event_list']())
		$(".event-list a.join button").each(function(){
			if($(this).attr("data-join") == 1){
				$(this).html("Change")
				$(this).css({
					"background": "green"
				})
			}
		})
		$(".event-list a.remove button").each(function(){
			if($(this).attr("data-join") == 0){
				$(this).attr("disabled", true)
			}
		})
		$(".event-list a.join").click(function(){
			id = $(this).parent().parent().attr("data-id")
			location.hash = "#joinEvent/" + id
		})
		$(".event-list table a.remove").click(function(){
			$tr = $(this).parent().parent()
			var id = $tr.attr("data-id")

			if (confirm("Are you sure remove？")) {
				$.ajax({
					url: $tr.attr("data-remove"),
					type: "POST",
					data: {id: id},
					success: function(data){
						d(data)
						// $tr.hide()
						$(this).find("button").attr("disabled", false)
						location.reload()
					}
				})
			}
			
		});
	}
});

var JoinEventView = Backbone.View.extend({
	events:{
		"click div.join-event button[type=submit]": "submit",
		"change div.join-event div.person_info th input[type=checkbox]": "chooseAll"
	},
	render: function(id){
		$(this.el).html($.tpl['join_event']({id: id}))
		data_url = $(".join-event").attr("user-event-info-url")
		$.ajax({
			url: data_url,
			type: "POST",
			data: {"id": id},
			success: function(data){
				d(data)
				for(i = 0; i < 7; i++){
					$(".join-event td.m-cat[num=" + i + "]").html(data['cat']['mcat'][i] + 'kg')
					$(".join-event td.f-cat[num=" + i + "]").html(data['cat']['fcat'][i] + 'kg')

					$(".join-event select.personCat option.female-cat-" 
						+ i).html(data['cat']['fcat'][i] + 'kg').val(data['cat']['fcat'][i])

					$(".join-event select.personCat option.male-cat-" 
						+ i).html(data['cat']['mcat'][i] + 'kg').val(data['cat']['mcat'][i])

					if(data['data'] != null){
						$(".join-event td input[name=m-choose-" 
							+ i + "][value=" 
							+ data['data']['cat'][i]['mcat'] 
							+ "]").attr("checked", true)
						$(".join-event td input[name=f-choose-" 
							+ i + "][value=" 
							+ data['data']['cat'][i]['fcat'] 
							+ "]").attr("checked", true)
						$(".join-event td.men_team input[name=men_team][value=" 
							+ data['data']['men_team']
							+ "]").attr("checked", true)
						$(".join-event td.women_team input[name=women_team][value=" 
							+ data['data']['women_team']
							+ "]").attr("checked", true)
					}
				}
				if(data['data'] != null){
					for(num in data['data']['persons']){
						$tr = $(".join-event div.person_info tr[data-id=" + data['data']['persons'][num][0] + "]")
						// d($tr)
						$tr.find("input[type=checkbox]").attr("checked", true)
						$tr.find("select.personCat option[value=" + data['data']['persons'][num][1] + "]").attr("selected",true)
					}
				}

			}
		},'json')
	},
	submit: function(){
		event_id = $(".join-event").attr("id")
		mcat = ''
		fcat = ''
		for(i = 0; i < 6; i++){
			mcat += $("input[name=m-choose-"+ i +"]:checked").val() + ','
			fcat += $("input[name=f-choose-"+ i +"]:checked").val() + ','
		}
		mcat += $("input[name=m-choose-6]:checked").val() + ';'
		fcat += $("input[name=f-choose-6]:checked").val()
		catInfo = mcat + fcat
		men_team = $("input[name=men_team]:checked").val()
		women_team = $("input[name=women_team]:checked").val()
		personIds = ''
		$("div.join-event div.person_info td input[type=checkbox]:checked").each(function(){
			// if($(this).attr("checked"))
				personIds += $(this).val() + ':'+ $(this).parent().parent().find("select.personCat").val() + ','
		})

		data = {
			event_id: event_id,
			category_info: catInfo,
			men_team: men_team,
			women_team: women_team,
			person_ids: personIds.substring(0, personIds.length - 1),
		}
		url = $("div.join-event button[type=submit]").attr("data-url")
		// d(data)
		$.ajax({
			url: url,
			data: data,
			type: "POST",
			success: function(data){
				// d(data);
				location.hash = "#eventList"
				location.reload()
			}
		},'json')
		d(data)
	},
	chooseAll: function(e){
		flag = e.currentTarget.checked
		$("div.join-event div.person_info td input[type=checkbox]").each(function(){
			$(this).attr("checked", flag)
			// d($(this).checked)
		})
	}
})

var AppRouter = Backbone.Router.extend({
	routes:{
		"": "userInfo",
		"addPerson": "addPerson",
		"addPerson/:id": "addPerson",
		"accountInfo": "accountInfo",
		"passwdChange": "passwdChange",
		"eventList": "eventList",
		"joinEvent/:id": "joinEvent",
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
		if(id != null)
			addPersonView.showPersonInfo(id)
	},
	passwdChange: function(){
		var passwdChangeView = new PasswdChangeView({
			el: $("div.main")
		})
		passwdChangeView.render()
	},
	eventList: function(){
		var eventListView = new EventListView({
			el: ($("div.main"))
		})
		eventListView.render()
	},
	joinEvent: function(id){
		var joinEventView = new JoinEventView({
			el: $("div.main")
		})
		joinEventView.render(id)
	},
});


(function($){
	$(document).ready(function(){
		personInfo = new Array('family_name','given_name',
			'simple_name','identity_num','best_result','number_of_officials',
			'number_of_competitiors','federation','passport_no',
			'tel','email','adress','birth','local_name')

		app = new AppRouter()
		Backbone.history.start()		
	})
})(jQuery);