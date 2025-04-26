<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? 	$gsmodule_code = "T1L1US";
	include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">
function doconfirmdel(user_gid) 
{
	if (confirm("Are you sure want to delete the Staff Code?"))
		{
			document.location="adm_mst_userdelete.php?txtuser_gid="+user_gid;
		}
}
</script>

<table width="100%">
	<tr>
		<td class="headingI">Staff Summary</td>
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
		<td align="right"><a href="adm_mst_useradd.php" class="addhyperlink">Add Staff</a></td>
	</tr>
</table>

<table width="80%" class="summary" align="center">
	<tr>
		<th>Staff Group</th>
		<th>Staff Code</th>
		<th>Staff Name</th>
		<th>Status</th>
		
		<th colspan="3">Action</th>
	</tr>
	
<? 	$msSQL = " SELECT a.usergroup_name, b.user_gid, b.user_code, 
					  b.user_firstname, b.status from 
					  adm_mst_tusergroup a, adm_mst_tuser b where 
					  a.usergroup_gid = b.usergroup_gid 
					  order by user_firstname";
					  
				  
	$rs_user = mysql_query($msSQL,$establish->link); ?>
	
	<?  $alternaterow = "N";
		while ($row = mysql_fetch_array($rs_user)) { 
			if ($alternaterow == "N") { 
				$tdclass = "";
				$alternaterow = "Y";
			} else { 
				$tdclass =  "class=\"alternate\"";
				$alternaterow = "N";
			} ?>

				
			<td <?=$tdclass?>><?=$row['usergroup_name']?></td>
			<td <?=$tdclass?>><?=$row['user_code']?></td>
			<td <?=$tdclass?>><?=$row['user_firstname']?></td>
			
			<td <?=$tdclass?> align="center">
			<? if ($row['status'] == 1) {
				print "Active";
			} else {
				print ("Inactive"); 
			} ?>
			</td>
			
			<td <?=$tdclass?> align="center"><a href="adm_mst_userview.php?txtuser_gid=<?=$row['user_gid']?>" class="hyperlink">View</a></td>
			<td <?=$tdclass?> align="center"><a href="adm_mst_useredit.php?txtuser_gid=<?=$row['user_gid']?>" class="hyperlink">Edit</a></td>
			<td <?=$tdclass?> align="center"><a href="javascript:doconfirmdel('<?=$row['user_gid']?>');" class="hyperlink">Delete</a></td>
		</tr>
	<? } ?>
</table>
<? 	include("../system/sys_cmn_footer.php"); ?>
