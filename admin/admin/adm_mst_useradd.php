<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? $gsmodule_code = "T1L1US";
   include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">
function dosubmit(form) 
{
   if(form.cbousergroup.options[form.cbousergroup.selectedIndex].value == "")
   {
	alert("Please select the Staff Group");
	return false;
   }
   if(form.txtuser_code.value == "") 
   {
	alert("Please enter the Staff Code");
	form.txtuser_code.focus();
	return false;
   }	

   if(form.txtuser_firstname.value == "")
   {
	alert("Please enter the Staff First Name");
	form.txtuser_firstname.focus();
	return false;
   }
   
   if(form.txtpassword.value == "")
   {
	alert("Please enter the Password");
	form.txtpassword.focus();
	return false;
   }
   if(form.txtpassword.value != form.txtconfirmpassword.value)
   {
	alert("Password and confirm Password are not same.");
	form.txtconfirmpassword.focus();
	return false;
   }
   form.submit();
}

function cancel()
{
	document.location="adm_mst_usersummary.php";
}
</script>

<table width="100%">
 <tr>
	<td class="headingI">Add Staff </td>
 </tr>
</table>

	<? if (isset($_GET['msgcode'])) { 
			$msgtype = substr($_GET['msgcode'],0,3); ?>
			<table align="center" width="80%">
				<tr>
					<? if ($msgtype == "ERR") { ?>
						<td class="warning"><? print $objdb_function->getmsg($_GET['msgcode']);?></td>
					<? } else { ?>
						<td class="success"><? print $objdb_function->getmsg($_GET['msgcode']);?></td>
					<? } ?>
				</tr>
			</table>
		<? } ?>

<? 
	$msSQL = "select usergroup_gid, usergroup_name from adm_mst_tusergroup
			   order by usergroup_name";		
	$rs_usergroup = mysql_query($msSQL,$establish->link);

	$msSQL = "select country_gid, country_code, country_name from adm_mst_tcountry";		
	$rs_presentcountry = mysql_query($msSQL,$establish->link);
?>

<form name="frmuseradd" action="adm_mst_useraddcfm.php" method="post">
	<table width="80%" align="center">
	   <td class="labels1">Group Name</td>
	   <td>
		   <select name="cbousergroup" class="cbobox">
		     <option selected value="">Please Select</option>
				
		      <? while ($row = mysql_fetch_array($rs_usergroup)) { ?>
		   	 <option value="<?=$row['usergroup_gid'];?>">
		   	   <? print $row['usergroup_name'];?>
		  	 </option> 
			 <? } ?>					
	    	    </select>
		    <label class="mandatory">*</label>
		</td>
		<tr>
		   <td class="labels1">User Code</td>
		   <td>
			   	<input type="text" name="txtuser_code" class="textbox_code">
			    <label class="mandatory">*</label>
	        </td>
		</tr>
		<tr>
			<td class="labels1">First Name</td>
			<td><input type="text" name="txtuser_firstname" class="textbox_name">
				<label class="mandatory">*</label>
			</td>
		</tr>
		<tr>
			<td class="labels1">Last Name</td>
			<td><input type="text"  name="txtuser_lastname" class="textbox_name"></td>
		</tr>
		<tr>
			<td class="labels1">Password</td>
			<td><input type="password"  name="txtpassword" class="textbox_password">
				<label class="mandatory">*</label>
			</td>
		</tr>
		<tr>
			<td class="labels1">Confirm Password</td>
			<td><input type="password"  name="txtconfirmpassword" class="textbox_password">
				<label class="mandatory">*</label>
			</td>
		</tr>
		<tr>
			<td class="labels1">Mobile No</td>
			<td><input type="text"  name="txtuser_mobile" class="textbox_phone"></td>
		</tr>
		<tr>
			<td class="labels1">Contact No</td>
			<td><input type="text"  name="txtuser_contact" class="textbox_phone"></td>
		</tr>
		<tr>
			<td class="labels1">Present Address</td>
		</tr>
		<tr>
			<td class="labels1">Address 1</td>
			<td>
				<input type="text" name="txtpresent_address1" class="textbox_long">
			</td>
		</tr>
		<tr>
			<td  class="labels1">Address 2</td>
			<td>
				<input type="text" name="txtpresent_address2" class="textbox_long">
			</td>
		</tr>
		<tr>
			<td class="labels1">Country</td>
			<td>
				<select name="cbopresentcountry" class="cbobox">
				   <option value="">Please Select</option>
					 <? while ($row = mysql_fetch_array($rs_presentcountry)) { ?>
					 	<? if ($row['country_gid'] == $arr_presentaddress['country_gid']) { ?>
						 	<option selected value="<?=$row['country_gid'];?>"><? print $row['country_name'];?></option> 
						<? } else { ?>
						 	<option value="<?=$row['country_gid'];?>"><? print $row['country_name'];?></option> 
						<? } ?>
					<? } ?>					
				</select>
			</td>
		</tr>
		<tr>
			<td class="labels1">Postal Code</td>
			<td>
				<input type="text" name="txtpresent_postalcode" class="textbox_number">
			</td>
		</tr>
		<tr>
			<td class="labels1">Status</td>
			<td class="radio"><input type="radio"  checked value="1" name="rdostatus">Active
			    <input type="radio" value="0" name="rdostatus">Inactive
		</tr>
		<tr>
			<td colspan="2" align="center">
			  <input type="button" class="button" value="Submit" onClick="dosubmit(this.form)">
			  <input type="button" class="button" value="Cancel" onClick="return cancel();">
			</td>
		</tr>
	</table>
</form>
<? 	include("../system/sys_cmn_footer.php"); ?>
