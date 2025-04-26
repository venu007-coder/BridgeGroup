<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? $gsmodule_code = "T1L1UD";
   include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">
function cancel()
{
	document.location="adm_mst_userdatasummary.php";
}
</script>

<form name="frmuserdataadd" action="adm_mst_userdatasummary.php" method="post">
	<table width="100%">
		<tr>
			<td class="headingI">View User Data</td>
		</tr>
	</table>

	<? 	$msSQL = "select userdata_name, seq_no, display_order from adm_mst_tuserdata where 
				 userdata_gid = '$_GET[txtuserdata_gid]'";
		$rs_userdata = mysql_query($msSQL,$establish->link);?>
				 
		<? while ($row = mysql_fetch_array($rs_userdata)) { ?>
			<table width="80%" align="center">
				<tr>
					<td width="40%" class="labels">User Data Name</td>
					<td width="60%" class="labelsvalue"><?=$row['userdata_name']?></td>
				</tr>
				<tr>
					<td class="labels">Sequence No</td>
					<td class="labelsvalue"><?=$row['seq_no']?></td>
				</tr>
				<tr>
					<td class="labels">Display Order</td>
					<td class="labelsvalue"><?=$row['display_order']?></td>
				</tr>
				<tr>
					<td colspan="2" align="center">	
						<input type="button" value="Back" class="button" onClick="return cancel();">
					</td>
				</tr>
			</table>  
		<? } ?>
</form>

<? 	include("../system/sys_cmn_footer.php"); ?>

