<? include("../system/sys_cmn_validate.php"); ?>

<?  $blnsuccess = TRUE;

 	$msSQL = "select user_password from adm_mst_tuser where 
			  user_code = '$_SESSION[user_code]' and 
			  user_password = '$_POST[txtoldpassword]'";
	$rs_password = mysql_query($msSQL,$establish->link);
	$cnt_password = mysql_num_rows($rs_password);
	
	if ($cnt_password > 0) {
		$objdb_function->begin();
		$msSQL = "update adm_mst_tuser set 
				 user_password = '$_POST[txtnewpassword]'
				 where user_code = '$_SESSION[user_code]'";
		$blnsuccess = mysql_query($msSQL,$establish->link); 

		if ($blnsuccess == TRUE) {
			$objdb_function->commit();
			$msgcode = "SUC_CP008";
		} else {
			$objdb_function->rollback();
			$blnsuccess = FALSE;
			$msgcode = "ERR_CP009";
		}
	} else {
		$msgcode = "ERR_CP010";
	} 
?>
<script language="javascript">	
	document.location="adm_mst_changepassword.php?msgcode=<?=$msgcode?>";
</script>		


<? include("../system/sys_cmn_footer.php"); ?>