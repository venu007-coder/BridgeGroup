<? include("../system/sys_cmn_validate.php"); 
	$gsmodule_code = "T2L3RS"; 
	
	$objdb_function->begin();
	
	$msSQL = "select candidate_gid
			from res_trn_tcandidate where 
			candidate_gid = '$_GET[txtcandidate_gid]'";
	$rs_address = mysql_query($msSQL,$establish->link);
	$arr_address = mysql_fetch_array($rs_address);
	
	
	$msSQL ="delete from res_trn_tcandidate where
		    candidate_gid = '$_GET[txtcandidate_gid]'";
	$blnsuccess1 = mysql_query($msSQL,$establish->link);

	
	if ($blnsuccess1== true) {
			$objdb_function->commit();
			$msgcode = "SUC_CD005";
	} else {
			$objdb_function->rollback();
			$msgcode = "ERR_CD006";
	}
?>
	<script language="javascript">
		document.location="res_trn_candidatesummary.php?msgcode=<?=$msgcode?>";
	</script>	
	
<? 	include("../system/sys_cmn_footer.php"); ?>