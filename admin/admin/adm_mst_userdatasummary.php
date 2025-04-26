<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? $gsmodule_code = "T1L1UD";
	include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">
function doconfirmdel(userdata_gid)
{
   if(confirm("Are you sure to delete this User Data ?"))
   {
	document.location="adm_mst_userdatadelete.php?txtuserdata_gid="+userdata_gid;
   }
}
</script>

<table width="100%">
  <tr>
	<td class="headingI">User Data Summary</td>
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
		<td align="right"><a href="adm_mst_userdataadd.php" class="addhyperlink">Add User Data</a></td>
	</tr>
</table>

<table width="80%" class="summary" align="center">
	<tr>
		<th>User Data Name</th>
		<th>Sequence No</th>
		<th>Display order</th>
		<th colspan="3">Action</th>
	</tr>

	<? 	$msSQL="select userdata_gid,userdata_name,seq_no,display_order from adm_mst_tuserdata order by seq_no,display_order";
    	     $rs_userdata=mysql_query($msSQL,$establish->link); ?>
	
		<? 	$alternaterow ="N";
		while ($row = mysql_fetch_array($rs_userdata)) { 
			if ($alternaterow == "N") { 
				$tdclass = "";
				$alternaterow = "Y";
			} else { 
				$tdclass =  "class=\"alternate\"";
				$alternaterow = "N";
			} ?>
			<tr>
				<td <?=$tdclass?>><?=$row['userdata_name']?></td>
				<td <?=$tdclass?> align="center"><?=$row['seq_no']?></td>
				<td <?=$tdclass?> align="center"><?=$row['display_order']?></td>
				<td <?=$tdclass?> align="center"><a href="adm_mst_userdataview.php?txtuserdata_gid=<?=$row['userdata_gid']?>" class="hyperlink">View</a></td>
				<td <?=$tdclass?> align="center"><a href="adm_mst_userdataedit.php?txtuserdata_gid=<?=$row['userdata_gid']?>" class="hyperlink">Edit</a></td>
				<td <?=$tdclass?> align="center"><a href="javascript:doconfirmdel('<?=$row['userdata_gid']?>');" class="hyperlink">Delete</a></td>
			</tr>
	<?	} ?>
</table>
<? include("../system/sys_cmn_footer.php"); ?>

