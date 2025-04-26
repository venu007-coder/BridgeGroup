function isnumeric(field)
   //  check for valid numeric strings	
{
	var strValidChars = "0123456789.-";
	var strChar;
	var blnResult = true;

   //  test strString consists of valid characters listed above
	for (i = 0; i < field.value.length && blnResult == true; i++)
	{
		strChar = field.value.charAt(i);
		if (strValidChars.indexOf(strChar) == -1)
		{
			blnResult = false;
		}
	}
	return blnResult;
}


function isemail(object_value) 
{
	if(object_value.value=="")
	{
		return false;
	}
	var txtobject_value = object_value.value;
	var Atsign = txtobject_value.indexOf("@");
	var Atend= txtobject_value.lastIndexOf("@");
	var subst = txtobject_value.substring(Atsign + 1, txtobject_value.length );
	var checkdot = subst.indexOf( "." );
	var sMessageValid = "Please provide a valid email address like user@abc.com";

	/* Validate existence of the @ sign. */

	if ( Atsign < 1 ) {
		alert(sMessageValid);  
		object_value.value="";                                                                                                                                                                                                                                                                                                             
		object_value.focus();
		return false;
	}

	if ( Atsign != Atend ) {
		alert(sMessageValid);  
		object_value.value="";                                                                                                                                                                                                                                                                                                               
		object_value.focus();
		return false;
	}                               

	/* Validate that after the @ sign there is at least x.x */
	if ( ( subst.length < 3 ) || ( checkdot <= 0 ) || ( checkdot == subst.length - 1 )) 
	{
		alert( sMessageValid );
		object_value.value=""; 
		object_value.focus();
		return false; 
	}
	return true;
}

function isDate(dtStr){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strDay=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("The date format should be : dd-mm-yyyy")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("Please enter a valid month")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("Please enter a valid day")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Please enter a valid date")
		return false
	}
return true
}

function ValFloat(ObjectValue,AllowComma)
{
		//alert(ObjectValue);
	// Used Internally by ValidateInt, ValidateFloat

	//Returns true if value is a number or is NULL
	//otherwise returns false	
	
	if (ObjectValue.length == 0) return true;
	
	//Returns true if value is a number defined as
	//   having an optional leading + or -.
	//   having at most 1 decimal point.
	//   otherwise containing only the characters 0-9.
	var start_format = " .+-0123456789";
	var number_format = " .0123456789";
	if (AllowComma == 1) number_format=number_format + ',';
	var check_char;
	var decimal = false;
	var trailing_blank = false;
	var digits = false;
	
	//The first character can be + - .  blank or a digit.
	check_char = start_format.indexOf(ObjectValue.charAt(0))
	//Was it a decimal?
	if (check_char == 1)
		decimal = true;
	else if (check_char < 1)
		return false;
	
	//Remaining characters can be only . or a digit, but only one decimal.
	for (var i = 1; i < ObjectValue.length; i++)
	{
		check_char = number_format.indexOf(ObjectValue.charAt(i))
		if (check_char < 0)
			return false;
		else if (check_char == 1)
		{
			if (decimal)		// Second decimal.
				return false;
			else
				decimal = true;
		}
		else if (check_char == 0)
		{
			if (decimal || digits) trailing_blank = true;
			// ignore leading blanks
		}
		else if (trailing_blank)
			return false;
		else
			digits = true;
	}	
	//All tests passed, so...
	return true
}
