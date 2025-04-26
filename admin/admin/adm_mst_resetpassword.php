<? include("../system/sys_cmn_validate.php"); ?>
<link href="../include/ss_stylesheet.css" rel="stylesheet" type="text/css">
<?  $gsmodule_code = "T1L1SF";
    include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">

function resetpassword (form)
{
	if (form.txtuser_password.value == "")
		{
			  alert("Please Enter New Password");
			  form.txtuser_password.focus();
			  return false;
		} 
	if (form.txtconfirmpassword.value == "")
		{
			alert("Please Enter Confirm Password");
			form.txtconfirmpassword.focus();
			return false;
		}
	if(form.txtuser_password.value != form.txtconfirmpassword.value)
		{
			alert("Password and Confirm Password are not same.");
			form.txtconfirmpassword.focus();
			return false;
		}
	form.submit();
}

function cancel()
	{
		document.location="../admin/adm_mst_usersummary.php?&menu=maintainence";
	}		
</script>

<form name="frmresetpassword" action="adm_mst_resetpasswordcfm.php" method="post">

	<table width="80%" align="center">
		<tr>
			<td class="headingI"> Reset Password </td>
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
				<td align="center" class="labels1">New Password</td>
				<td>
					<input type="password" name="txtuser_password" class="textbox_password">
				</td>
			</tr>
			<tr>
				<td align="center" class="labels1">Confirm Password</td>
				<td>
					<input type="password" name="txtconfirmpassword" class="textbox_password">
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="hidden" name="txtuser_gid" value="<?=$_GET['txtuser_gid']?>">
					<input type="button" class="button" value="Submit" onClick="resetpassword(this.form);">
					<input type="button" class="button" value="Cancel" onClick="return cancel();">
				</td>
			</tr>
		</td>
	</table>	
</form>

 <? 	include("../system/sys_cmn_footer.php"); ?>

