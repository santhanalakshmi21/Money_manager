function validation(){
	var input_text = document.querySelector("#user");
	var input_password = document.querySelector("#pass");
	var error_msg = document.querySelector(".error_msg");

	if(user.value.length <= 3 || pass.value.length <= 3 ){
		error_msg.style.display = "inline-block";
		return false;
	}
	else{
		return true;
	}
	
}

var input_field = document.querySelectorAll(".input");
var btn = document.querySelector("#btn");

input_field.forEach(function(input_item){
	input_item.addEventListener("input", function(){
		if(input_item.value.length > 3){
			btn.disabled = false;
			btn.className = "btn enabled"
		}
	})
})