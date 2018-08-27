function validate_job_form() {
	var validate = true;
	
	var input = document.forms["jobForm"]["name"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (input.value) {
		var regex = /^[a-zA-Z ]*$/;
		
		if (!regex.test(input.value)) {
			input.style.border = "1px solid red";
			input.setAttribute("title", "Only letters and white space are allowed");
			validate = false;
		}
	} else {
		input.style.border = "1px solid red";
		input.setAttribute("title", "Name is required");
		validate = false;
	}
	
	input = document.forms["jobForm"]["email"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (input.value) {
		var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		
		if (!regex.test(input.value)) {
			input.style.border = "1px solid red";
			input.setAttribute("title", "Invalid email format");
			validate = false;
		}
	} else {
		input.style.border = "1px solid red";
		input.setAttribute("title", "Email is required");
		validate = false;
	}
	
	input = document.forms["jobForm"]["experience"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (input.value) {
		var regex = /^[a-z0-9- ]+$/i;
		
		if (!regex.test(input.value)) {
			input.style.border = "1px solid red";
			input.setAttribute("title", "Only letters, numbers, and are white space allowed");
			validate = false;
		}
	} else {
		input.style.border = "1px solid red";
		input.setAttribute("title", "Experience is required");
		validate = false;
	}
	
	return validate;
}

function validate_order_form() {
	var validate = true;
	
	var input = document.forms["orderForm"]["name"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (input.value) {
		var regex = /^[a-zA-Z ]*$/;
		
		if (!regex.test(input.value)) {
			input.style.border = "1px solid red";
			input.setAttribute("title", "Only letters and white space are allowed");
			validate = false;
		}
	} else {
		input.style.border = "1px solid red";
		input.setAttribute("title", "Name is required");
		validate = false;
	}
	
	input = document.forms["orderForm"]["email"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (input.value) {
		var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		
		if (!regex.test(input.value)) {
			input.style.border = "1px solid red";
			input.setAttribute("title", "Invalid email format");
			validate = false;
		}
	} else {
		input.style.border = "1px solid red";
		input.setAttribute("title", "Email is required");
		validate = false;
	}
	
	input = document.forms["orderForm"]["address"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (input.value) {
		var regex = /^[a-z0-9- ]+$/i;
		
		if (!regex.test(input.value)) {
			input.style.border = "1px solid red";
			input.setAttribute("title", "Only letters, numbers, and are white space allowed");
			validate = false;
		}
	} else {
		input.style.border = "1px solid red";
		input.setAttribute("title", "Address is required");
		validate = false;
	}
	
	input = document.forms["orderForm"]["city"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (input.value) {
		var regex = /^[a-zA-Z ]*$/;
		
		if (!regex.test(input.value)) {
			input.style.border = "1px solid red";
			input.setAttribute("title", "Only letters and white space are allowed");
			validate = false;
		}
	} else {
		input.style.border = "1px solid red";
		input.setAttribute("title", "City is required");
		validate = false;
	}
	
	input = document.forms["orderForm"]["state"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (!input.value) {
		input.style.border = "1px solid red";
		input.setAttribute("title", "State is required");
		validate = false;
	}
	
	input = document.forms["orderForm"]["zip"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (input.value) {
		if (isNaN(input.value) || input.value.toString().length != 5) {
			input.style.border = "1px solid red";
			input.setAttribute("title", "Invalid Zip Code format");
			validate = false;
		}
	} else {
		input.style.border = "1px solid red";
		input.setAttribute("title", "Zip Code is required");
		validate = false;
	}
	
	input = document.forms["orderForm"]["credit"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (input.value) {
		if (isNaN(input.value) || input.value.toString().length != 16) {
			input.style.border = "1px solid red";
			input.setAttribute("title", "Invalid Credit Card Number");
			validate = false;
		}
	} else {
		input.style.border = "1px solid red";
		input.setAttribute("title", "Credit Card is required");
		validate = false;
	}
	
	input = document.forms["orderForm"]["expMon"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (!input.value) {
		input.style.border = "1px solid red";
		input.setAttribute("title", "Expiration Month is required");
		validate = false;
	}
	
	input = document.forms["orderForm"]["expYr"];
	input.style.border = "";
	input.setAttribute("title", "");
	
	if (input.value) {
		if (isNaN(input.value) || input.value.toString().length != 4) {
			input.style.border = "1px solid red";
			input.setAttribute("title", "Invalid Expiration Year");
			validate = false;
		}
	} else {
		input.style.border = "1px solid red";
		input.setAttribute("title", "Expiration Year is required");
		validate = false;
	}
	
	return validate;
}
