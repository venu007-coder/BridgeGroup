<? include("../system/sys_cmn_validate.php"); ?>

<?  $blnsuccess = TRUE;
	$objdb_function->begin();
	
	$msSQL = "update adm_mst_tuser set
			  user_password = '$_POST[txtuser_password]'
			  where user_gid = '$_POST[txtuser_gid]'";
	$blnsuccess = mysql_query($msSQL,$establish->link);
	
	if ($blnsuccess == TRUE) {
		$objdb_function->commit();
		$msgcode = "SUC_RP008";
	} else {
		$objdb_function->rollback();
		$blnsuccess = FALSE;
		$msgcode = "ERR_RP009";
	}

   if ($blnsuccess == TRUE) { ?>
		<script language="javascript">
			document.location="adm_mst_usersummary.php?msgcode=<?=$msgcode?>";
		</script>		
	<? } else { ?>
		<script language="javascript">
			document.location="adm_mst_resetpassword.php?msgcode=<?=$msgcode?>&txtuser_gid=<?=$_POST['txtuser_gid']?>";
		</script>		
<? } ?>

<? include("../system/sys_cmn_footer.php"); ?>
