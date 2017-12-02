function formatPounds(field) {
	/*Declare variables*/
	var ld_value;
	var li_decPoint;
	var lo_arraySplit;
	var ls_newValue = new String();
	
	/*Get the string value*/
	ld_value=field.value;
	
	/*Check for a decimal point*/
	li_decPoint = ld_value.indexOf(".");
	if (li_decPoint == -1) {
		ld_value = ld_value + ".00";
		ls_newValue = ld_value.toString();
	}
	else {
		/*Round to 2dp*/
		ld_value = Math.round(ld_value*100.0)/100.0;
		ls_newValue = ld_value.toString();
		
		if (ls_newValue.length-li_decPoint == 2) {
			ls_newValue = ls_newValue + '0';
		}
	}
	
	/*Write the string back*/
	field.value = "£" + ls_newValue;
}

function calc_price(form) {
	/*Declare variables*/
	var lo_arraySplit;
	var ld_start;
	var ld_end;
	var ld_hours;
	
	/*Declare constants*/
	var ld_hourlyRate = 4.5;
	
	/*Clear any exisitg values*/
	form.cp_day.value = "";
	form.cp_week.value = "";
	form.cp_mnth.value = "";
	
	/*Check the number of days is a number*/
	if ( isNaN(form.days.value) ) {
		alert("Please enter a valid number of days");
		form.days.value="";
		return;
	}
	
	/*Split start time*/
	lo_arraySplit = form.start.value.split(":");
	ld_start = (lo_arraySplit[0]/1.0) + (lo_arraySplit[1]/60.0);

	/*Split end time*/
	lo_arraySplit = form.end.value.split(":");
	ld_end = (lo_arraySplit[0]/1.0) + (lo_arraySplit[1]/60.0);
	
	/*Check start is not after finish*/
	if (ld_start > ld_end) {
		alert("The start time appears to be after the finish time");
		return;
	}
	
	/*Calc the price*/
	ld_hours = ld_end-ld_start;
	form.cp_day.value = ld_hours * ld_hourlyRate;
	form.cp_week.value = (form.cp_day.value/1.0) * (form.days.value/1.0);
	form.cp_mnth.value = form.cp_week.value * 52.0 / 12.0;
	
	/*Show value to user correctly*/
	formatPounds(form.cp_day);
	formatPounds(form.cp_week);
	formatPounds(form.cp_mnth);
}