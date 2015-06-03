var d = function(el){
	console.log(el);
}

var checkInput = function($el){
	var flag = true;
	// d($el)
	$el.find("input.form-control").each(function(){
		// d($(this).val())
		$(this).removeClass("error")
		if($(this).val() == ""){
			$(this).addClass("error")
			flag = false;
		}
	})
	if(flag){
		$el.find("button[type=submit]").attr("disabled", false)
	}
}