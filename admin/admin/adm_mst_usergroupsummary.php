<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<?    $gsmodule_code = "T1L1UG";
	 include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">
function doconfirmdel(usergroup_gid) 
{
	if (confirm("Are you sure want to delete this Staff Group?"))
		{
			document.location="adm_mst_usergroupdelete.php?txtusergroup_gid="+usergroup_gid;
		}
}
</script>

<table width="100%">
	<tr>
		<td class="headingI">Staff Group Summary</td>
	</tr>
</table>

	<? if (isset($_GET['msgcode'])) { 
		$msgtype = substr($_GET['msgcode'],0,3); ?>
		<table align="center" width="80%" >
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
	<tr>
		<td align="right"><a href="adm_mst_usergroupadd.php" class="addhyperlink">Add Staff Group</a></td>
	</tr>
</table>

<table width="80%" class="summary" align="center">
	<tr>
		<th>Staff Group Code</th>
		<th>Staff Group Name</th>
		<th colspan="3">Action</th>
	</tr>
	
<? 	$msSQL = "select usergroup_gid, usergroup_code, usergroup_name from adm_mst_tusergroup order by usergroup_name";
	$rs_usergroup = mysql_query($msSQL,$establish->link); ?>

	<?  $alternaterow = "N";
		while ($row = mysql_fetch_array($rs_usergroup)) { 
			if ($alternaterow == "N") { 
				$tdclass = "";
				$alternaterow = "Y";
			} else { 
				$tdclass =  "class=\"alternate\"";
				$alternaterow = "N";
			} ?>
		<tr>
			<td <?=$tdclass?> ><?=$row['usergroup_code']?></td>
			<td <?=$tdclass?> ><?=$row['usergroup_name']?></td>	
			<td <?=$tdclass?> align="center"><a href="adm_mst_usergroupview.php?txtusergroup_gid=<?=$row['usergroup_gid']?>" class="hyperlink">View</a></td>
			<td <?=$tdclass?> align="center"><a href="adm_mst_usergroupedit.php?txtusergroup_gid=<?=$row['usergroup_gid']?>" class="hyperlink">Edit</a></td>
			<td <?=$tdclass?> align="center"><a href="javascript:doconfirmdel('<?=$row['usergroup_gid']?>');" class="hyperlink">Delete</a></td>
		</tr>
	<? } ?>
</table>

<? 	include("../system/sys_cmn_footer.php"); ?>