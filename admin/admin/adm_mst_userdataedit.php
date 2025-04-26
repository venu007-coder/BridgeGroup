<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? $gsmodule_code = "T2L1MD";
   include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">
function dosubmit(form)
{
	if(form.txtuserdata_name.value == "")
	{
		alert("Enter User Data Name");
		form.txtuserdata_name.focus();
		return false;
	}
	
	if(form.txtseq_no.value == "" )
	{
		alert("Enter the sequence No");
		form.txtseq_no.focus();
		return false;
	}
	
	if(form.txtdisplay_order.value == "")
	{
		alert("Enter the Display Order");
		form.txtdisplay_order.focus();
		return false;
	}
	form.submit();
}
		
function cancel()
{
	document.location="adm_mst_userdatasummary.php";
}
</script>

<form name="frmuserdataadd" action="adm_mst_userdataeditcfm.php" method="post">

	<table width="100%" >
		<tr>
			<td class="headingI">Edit User Data</td>
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

	<? 	$msSQL = "select userdata_name, seq_no, display_order from adm_mst_tuserdata where 
				 userdata_gid = '$_GET[txtuserdata_gid]'";
		$rs_userdata = mysql_query($msSQL,$establish->link);?>
				 
		<? while ($row = mysql_fetch_array($rs_userdata)) { ?>
			<table width="80%" align="center">
				<tr>
					<td width="40%" class="labels">User Data Name</td>
					<td width="60%" >
						<input type="text" name="txtuserdata_name"  class="textbox_name" value="<?=$row['userdata_name']?>">
						<label class="mandatory">*</label>	
					</td>
				</tr>
				<tr>
					<td class="labels">Sequence No</td>
					<td width="40%" class="labels">
						<input type="text" name="txtseq_no" class="textbox_code" value="<?=$row['seq_no']?>">
						<label class="mandatory">*</label>	
					</td>
				</tr>
				<tr>
					<td class="labels">Display Order</td>
					<td width="40%" class="labels">
						<input type="text" name="txtdisplay_order" class="textbox_number" value="<?=$row['display_order']?>">
						<label class="mandatory">*</label>	
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">	
						<input type="hidden" name="txtuserdata_gid" value="<?=$_GET['txtuserdata_gid']?>">
						<input type="button" value="update" class="button" onClick="dosubmit(this.form);">
						<input type="button" value="Cancel" class="button" onClick="return cancel();">
					</td>
				</tr>
			</table>  
		<? } ?>
</form>

<? 	include("../system/sys_cmn_footer.php"); ?>
