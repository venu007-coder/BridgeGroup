<? 	include("../system/sys_cmn_validate.php"); 
	$gsmodule_code = "T1L1US"; 

	$objdb_function->begin();
	
	$msSQL = "select user_code from adm_mst_tuser 
			  where 
			  user_gid = '$_GET[txtuser_gid]' and 
			  user_code = 'sysadmin'";
	$rs_user = mysql_query($msSQL,$establish->link); 
	$mncount_user = mysql_num_rows($rs_user);
	
	if ($mncount_user == 0 ) {
		$msSQL = "delete from adm_mst_tuser where user_gid = '$_GET[txtuser_gid]'";
		$blnsuccess = mysql_query($msSQL,$establish->link); 
			
		if ($blnsuccess == TRUE) {
			$objdb_function->commit();
			$msgcode = "SUC_US005";
		} else {
			$objdb_function->rollback();
			$blnsuccess = FALSE;
			$msgcode = "ERR_US004";
		}
	} else {
	 
	  $msgcode = "ERR_US006";
	}
?>

<script language="javascript">
	document.location="adm_mst_usersummary.php?msgcode=<?=$msgcode?>";
</script>		

<? include("../system/sys_cmn_footer.php"); ?>

