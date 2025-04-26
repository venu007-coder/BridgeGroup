<? 	include("../system/sys_cmn_validate.php"); ?>
<? 	$gsmodule_code = "T1L1UD";
     
	$objdb_function->begin();
	$msSQL = "delete from adm_mst_tuserdata where userdata_gid = '$_GET[txtuserdata_gid]'";
	$blnsuccess = mysql_query($msSQL,$establish->link); 
	
	if ($blnsuccess == TRUE) {
		$objdb_function->commit();
		$msgcode = "SUC_UD005";
	} else {
		$objdb_function->rollback();
		$blnsuccess = FALSE;
		$msgcode = "ERR_UD004";
	}
?>
<script language="javascript">
	document.location="adm_mst_userdatasummary.php?msgcode=<?=$msgcode?>";
</script>		

<? include("../system/sys_cmn_footer.php"); ?>
