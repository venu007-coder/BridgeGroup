<? include("../system/sys_cmn_validate.php"); ?>

<?	$blnsuccess = TRUE;
	$msSQL = "select usergroup_code from adm_mst_tusergroup where 
			 usergroup_code = '$_POST[txtusergroup_code]'"; 
	$rs_usergroup = mysql_query($msSQL,$establish->link);
	$mncount = mysql_num_rows($rs_usergroup);
	

	if ($mncount == 0) { 
		if(isset($_POST['txtmodule_gid'])) {
			$objdb_function->begin();
			$msGetGID = $objdb_function->getnum_setting("UG",$establish);
			$msusergroup_gid = $msGetGID;
		
			$msSQL = "insert into adm_mst_tusergroup 
					(usergroup_gid, usergroup_code, usergroup_name) values
					('$msGetGID','$_POST[txtusergroup_code]', '$_POST[txtusergroup_name]')";
			$blnsuccess = mysql_query($msSQL,$establish->link); 
	
			if ($blnsuccess == TRUE) {
				$arrmodule_gid = $HTTP_POST_VARS['txtmodule_gid'];
				$cnt_module_gid = sizeof($arrmodule_gid);
	
				for($i=0;$i<$cnt_module_gid;$i++) 
				{
					$msGetGID = $objdb_function->getnum_setting("PV",$establish);
					$msSQL = "insert into adm_mst_tprivilege
							(privilege_gid, module_gid, usergroup_gid) values 
							('$msGetGID','$arrmodule_gid[$i]','$msusergroup_gid')";
					$blnsuccess = mysql_query($msSQL,$establish->link); 						
				}
				
				if ($blnsuccess == TRUE) {
					$objdb_function->commit();
					$msgcode = "SUC_UG002";
				} else {
					$objdb_function->rollback();
					$msgcode = "ERR_UG004";
				}
			} else {
				$objdb_function->rollback();
				$blnsuccess = FALSE;
				$msgcode = "ERR_UG003";
			} 
		} else {
			$msgcode = "ERR_UG010";
		}
	} else { 
		$blnsuccess = FALSE;
		$msgcode = "ERR_UG001";
	} 	

   if ($blnsuccess == TRUE) { ?>
		<script language="javascript">
			 document.location="adm_mst_usergroupsummary.php?msgcode=<?=$msgcode?>";
		</script>		
	<? } else { ?>
		<form name="frmusergroupadd" action="adm_mst_usergroupadd.php?msgcode=<?=$msgcode?>" method="post">
			<input type="hidden" name="txtusergroup_code" value="<?=$_POST['txtusergroup_code']?>">
			<input type="hidden" name="txtusergroup_name" value="<?=$_POST['txtusergroup_name']?>">
			</form>
		<script language="javascript">
			 document.frmusergroupadd.submit();
		</script>		
<? } ?>
<? include("../system/sys_cmn_footer.php"); ?>