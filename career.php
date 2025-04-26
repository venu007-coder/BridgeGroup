<?php 
include("includes/bridge_cmn_header.php");
?>
<script language="javascript" src="includes/sys_js_validate.js"></script>

<script language="javascript">
function dosubmit(form)
{
if(form.txtcandidate_name.value =="")
{
alert("Enter the Name");
form.txtfirst_name.focus();
return false;
}

if(form.txtcandidate_no.value =="")
{
alert("Enter the Contact No");
form.txtlast_name.focus();
return false;
}


if(form.txtemail.value == "")
{
alert("Enter the email Address");
form.txtemail.focus();
return false;
}

if(isemail(form.txtemail) == false)
{
form.txtemail.value == "";
form.txtemail.focus();
return false;
}


form.submit();


}

function cancel()
{
document.location="index.php";
}
function dosubmit1(form)
{
	if(form.txtcandidate_name.value =="")
	{
		alert("Enter the Name");
		form.txtfirst_name.focus();
		return false;
	}
	
	if(form.txtcandidate_no.value =="")
	{
		alert("Enter the Contact No");
		form.txtlast_name.focus();
		return false;
	}
	if(form.txtemail.value == "")
	{
		alert("Enter the email Address");
		form.txtemail.focus();
		return false;
	}

	if(isemail(form.txtemail) == false)
	{
		form.txtemail.value == "";
		form.txtemail.focus();
		return false;
	}
	if (form.cbodepartment.value == "")
	{
		alert("Please Select The Department");
		form.cbodepartment.focus();
		return false;
	}
	form.submit();
}

function cancel1()
{
		document.location="index.php";
}
</script>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="18" height="26"><img src="images/content-rose-box_01.jpg"></td>
<td background="images/rose-box_02.jpg"  class="blackbox-head"><font size="+1" class="carrer">2</font> <font class="career">MINUTES CV	</fomt>
</td>
<td width="18" height="26"><img src="images/content-rose-box_03.jpg"></td>
</tr>
<tr>
<td background="images/rose-box_04.jpg"></td>
<td bgcolor="#FFFFFF" height="5"></td>
<td background="images/rose-box_06.jpg"></td>
</tr>
<tr>
<td background="images/rose-box_04.jpg">&nbsp;</td>
<td background="images/center-logo-bg 1.jpg">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="center_part2">



<form name="frmcareer" action="careeraddcfm.php"  enctype="multipart/form-data" method="post">
<table width="90%" align="center">
<tr>
<td class="labels">Name</td>
<td>
<input type="text" name="txtcandidate_name" class="textbox_name">
<label class="mandatory">*</label>
</td>
</tr>
<tr>
<td class="labels">Contact No</td>
<td>
<input type="text" name="txtcandidate_no" class="textbox_name">
<label class="mandatory">*</label>
</td>
</tr>
<tr>
<td class="labels">Email</td>
<td>
<input type="text" name="txtemail" class="textbox_name">
<label class="mandatory">*</label>
</td>
</tr>
<tr>
<td class="labels">Qualification</td>
<td>
<input type="text" name="txtcandidate_qualification" class="textbox_name">

</td>
</tr>

<tr>
<td class="labels">Name of the Current Company Working</td>
<td>
<input type="text" name="txtcandidate_working" class="textbox_name" >

</td>
</tr>
<tr>
<td width="50%" class="labels">Department</td>
<td width="50%">
<select name="cbodepartment" class="cbobox">
<option  value="" selected="">Please Select</option>
<option  value="Fresher">Fresher </option>
<option  value="Sales">Sales </option>
<option  value="Software/Hardware">Software/Hardware </option>
<option  value="Marketing/Communication">Marketing/Communication </option>
<option  value="HR,Admin,Recruitment">HR,Admin,Recruitment </option>
<option  value="Finance & Accounts">Finance & Accounts</option>
<option  value="Banking">Banking</option>
<option  value="Financial services">Financial services </option>
<option  value="Entertainment/Media/Jornalism">Entertainment/Media/Jornalism </option>
<option  value="Advertising,PR,MR,Event Mgmt">Advertising,PR,MR,Event Mgmt </option>
<option  value="Purchase/Supply Chain">Purchase/Supply Chain </option>
<option  value="Production/Engg/R & D ">Production/Engg/R & D </option>
<option  value="Pharma/BioTech">Pharma/BioTech </option>
<option  value="Call Centre,BPO,Customer Service">Call Centre,BPO,Customer Service  </option>
<option  value="Telecom,ISP">Telecom,ISP</option>
<option  value="Healthcare">Healthcare</option>
<option  value="Hotels,Restaurants">Hotels,Restaurants </option>
<option  value="Legal/Law">Legal/Law </option>
<option  value="Travel,Airlines">Travel,Airlines</option>
<option  value="Retail Chains">Retail Chains </option>
<option  value="Distrubution,Delivery/Courier">Distrubution,Delivery/Courier </option>
<option  value="Export/Import">Export/Import </option>
<option  value="Others">Others  </option>
</select>
<label class="mandatory">*</label>
</td>
</tr>

<tr>
<td class="labels">Current Designation</td>
<td>
<input type="text" name="txtcurrent_designation" class="textbox_name">

</td>
</tr>

<tr>
<td class="labels">Current Salary</td>
<td>
<input type="text" name="txtcurrent_salary" class="textbox_name">

</td>
</tr>

<tr>
<td class="labels">Current Location</td>
<td>
<input type="text" name="txtcurrent_location" class="textbox_name">

</td>
</tr>


<tr>
<td class="labels">No.of years with current Company</td>
<td>
<input type="text" name="txtcurrent_year" class="textbox_small" size="2">

</td>
</tr>

<tr>
<td class="labels">Total No Of Years Of Work Exp</td>
<td>
<input type="text" name="txttotal_experience" class="textbox_small" size="2">

</td>

<tr>
<tr>
								<td>
									&nbsp;&nbsp;&nbsp;
								</td>
							</tr>
<tr>
								<td>
									&nbsp;&nbsp;&nbsp;
								</td>
							</tr>
<tr>
								<td colspan="2" align="center">	
									<input type="button" value="Submit" class="button" onClick="dosubmit(this.form);">
									<input type="button" value="Cancel" class="button" onClick="return cancel1();">
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;&nbsp;&nbsp;
								</td>
							</tr>
							<tr>
								<td align="center" colspan="2" class="rosebox-head">
									<b><i>----- OR -----</i></b>
								</td>
							

<tr>
<td>
&nbsp;&nbsp;&nbsp;
</td>
</tr>
<tr>
<td>
&nbsp;&nbsp;&nbsp;
</td>
</tr>
<tr nowrap>
<td class="labels" nowrap width="60%" ><b>If Interested you can attach Your Resume</b></td>
</tr>	
<tr>		
<td class="labels">Attach resume</td>
<td>
<input type="file" name="uploadfile">
</td>
</tr>
<tr>
<td>
&nbsp;&nbsp;&nbsp;
</td>
</tr>

</tr>
<tr>
<td colspan="2" align="center">	
<input type="button" value="Submit" class="button" onClick="dosubmit(this.form);">
<input type="button" value="Cancel" class="button" onClick="return cancel();">
</td>
</tr>
<tr>
<td class="rosebox-end">
* - Mandatory
</td>
</tr>
</table>
</td>
<td background="images/rose-box_06.jpg">&nbsp;</td>
</tr>
<tr>
<td width="18" height="23"><img src="images/content-rose-box_07.jpg"></td>
<td background="images/rose-box_08.jpg">&nbsp;</td>
<td width="18" height="23"><img src="images/content-rose-box_09.jpg"></td>
</tr>
</table></td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" height="9"></td>
</tr>
</table>
</td>






</tr>
</table>
</td>
</tr>

<tr>
<td height="2" bgcolor="#141e73"></td>
</tr>

</form>



<?
include("includes/bridge_cmn_footer.php");
?>