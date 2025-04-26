<? include("../system/sys_cmn_validate.php"); ?>


<?	$blnsuccess = TRUE;

	$objdb_function->begin();

	$msSQL = "update adm_mst_tusergroup set 
			usergroup_name = '$_POST[txtusergroup_name]'
			where usergroup_gid='$_POST[txtusergroup_gid]'";
	$blnsuccess = mysql_query($msSQL,$establish->link); 

	if ($blnsuccess == TRUE) {
	  if(isset($_POST['txtmodule_gid'])) {
		$msSQL="delete from adm_mst_tprivilege where 
				usergroup_gid = '$_POST[txtusergroup_gid]'";
		$blnsuccess = mysql_query($msSQL,$establish->link);
		$arrmodule_gid = $HTTP_POST_VARS['txtmodule_gid'];
		$cnt_module_gid = sizeof($arrmodule_gid);

		for($i=0;$i<$cnt_module_gid;$i++) 
		{
			$msGetGID = $objdb_function->getnum_setting("PV",$establish);
			$msSQL = "insert into adm_mst_tprivilege
					(privilege_gid, module_gid, usergroup_gid) values 
					('$msGetGID','$arrmodule_gid[$i]','$_POST[txtusergroup_gid]')";
			$blnsuccess = mysql_query($msSQL,$establish->link); 	
		}
		
		if ($blnsuccess == TRUE) {
			$objdb_function->commit();
			$msgcode = "SUC_UG008";
		} else {
			$objdb_function->commit();
			$msgcode = "ERR_UG009";
		}

	} else {
			$msgcode = "ERR_UG010";
		}
	} else {
		$objdb_function->rollback();
		$blnsuccess = FALSE;
		$msgcode = "ERR_UG007";
	}

   if ($blnsuccess == TRUE) { ?>
		<script language="javascript">
			document.location="adm_mst_usergroupsummary.php?msgcode=<?=$msgcode?>";
		</script>		
	<? } else { ?>
		<form name="frmusergroupedit" action="adm_mst_usergroupedit.php?msgcode=<?=$msgcode?>&usergroup_gid=<?=$_POST['usergroup_gid']?>" method="post">
			<input type="hidden" name="txtusergroup_code" value="<?=$_POST['txtusergroup_code']?>">
			<input type="hidden" name="txtusergroup_name" value="<?=$_POST['txtusergroup_name']?>">
		</form>
		
		<script language="javascript">
			document.frmusergroupedit.submit();
		</script>		
<? } ?>
<? include("../system/sys_cmn_footer.php"); ?>