<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<?  $gsmodule_code = "T1L1CP";
     include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">

function changepassword(form) 
{
	if (form.txtoldpassword.value =="")
	{
		alert("Please enter Old Password");
		form.txtoldpassword.focus();
		return false;
	}

	if (form.txtnewpassword.value=="")
	{
		  alert("Please enter New Password");
		  form.txtnewpassword.focus();
		  return false;
	}

	if(form.txtconfirmpassword.value=="") 
	{
		  alert("Please enter Confirm Password");
		  form.txtconfirmpassword.focus();
		  return false;
	}	
	
	if(form.txtnewpassword.value != form.txtconfirmpassword.value)
	{
		alert("Password and confirm Password are not same.");
		form.txtconfirmpassword.focus();
		return false;
	} 
	form.submit();
}
	
function cancel()
	{
		document.location="../system/sys_trn_welcome.php?module_code=T1";
	}

</script>

<form name="frmchangepassword" action="adm_mst_changepasswordcfm.php" method="post" >
	<table width="100%" align="center">
		<tr>
			<td class="headingI">Change Password</td>
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

	<table width="80%" align="center">
		<td width="40%">
			<tr> 
				<td align="center" class="labels1">Old Password</td>
				<td>
					<input type="password"  name="txtoldpassword" class="textbox_password">
					<label class="mandatory">*</label>
				</td>
			</tr>
			<tr> 
				<td align="center" class="labels1">New Password</td>
				<td>
					<input type="password"  name="txtnewpassword" class="textbox_password">
					<label class="mandatory">*</label>
				</td>
			</tr>
			<tr> 
				<td align="center" class="labels1">Confirm Password</td>
				<td>
					<input type="password"  name="txtconfirmpassword" class="textbox_password">
					<label class="mandatory">*</label>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">	
					<input type="button" class="button" value="Update" onClick="changepassword(this.form);">
					<input type="button" class="button" value="Cancel" onclick ="return cancel();">
				</td>
			</tr>
		</td>
	</table>
</form>

<? include("../system/sys_cmn_footer.php"); ?>
