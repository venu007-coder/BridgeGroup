<? 	session_start(); 
	session_destroy(); ?>
<?	include("include/sys_cmn_settings.php"); ?>
<?	include("system/sys_cmn_header.php"); ?>
<table width="100%" class="banner" border="0" cellspacing="0" cellpadding="0"> 
	<tr> 
		<td colspan="6" height="10" bgcolor="#082410"></td> 
	</tr> 
</table>
<html>
<head>
	<title><?=$browser_title?></title>
	<link href="include/ss_stylesheet.css" type="text/css" rel="stylesheet">
	<script language="javascript">
		function dosubmit(){
			if(document.frmlogin.txtuser_code.value == '')
			{
				alert("Please enter the User Code ");
				return false;
			}
			else if(document.frmlogin.txtpassword.value == '')
			{
				alert("Please enter the password");
				return false;
			}
			else {
				document.frmlogin.action = "system/sys_trn_checklogin.php";
				document.frmlogin.submit();
			}
		}
	</script>
</head>

<table width="100%">
	<tr height="30">
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="headingI"><marquee direction="right">Welcome to <font color="#FF3904">THE BRIDGE </font> <font color="#000000">Services </font></marquee></td>
	</tr>
</table>

<form name="frmlogin" method="post" action="">
	<table class="summary" align="center" width="30%">
		<tr>
			<td align="left" class="labels"><b> User Code</b></td>
			<td>
				<input class="textbox_code1" type="text" name="txtuser_code" size="24" maxlength="32" value="">
			</td>
		</tr>
		<tr>
			<td align="center" class="labels"><b>Password</b></td>
			<td><input class="textbox_password1" type="password" name="txtpassword" size="35" maxlength="32">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><br>
				<input type="button" name="btnsubmit" value="Login" class="button" onClick="return dosubmit();">&nbsp;&nbsp;
				<input type="reset" name="btnreset" value="Reset" class="button">
			</td>
		</tr>
	</table>
	<? if (isset($_GET['msgcode'])) { 
		include("system/sys_cmn_function.php");  
		$objdb_function = new db_functions(); 
		$msgtype = substr($_GET['msgcode'],0,3); ?>
		<table align="center" width="40%" >
			<tr>
				<? if ($msgtype == "ERR") { ?>
					<td class="warning"><? print $objdb_function->getmsg($_GET['msgcode']);?></td>
				<? } else { ?>
					<td class="success"><? print $objdb_function->getmsg($_GET['msgcode']);?></td>
				<? } ?>
			</tr>
		</table>
	<? } ?>
</form>

</html>
