<? include("../system/sys_cmn_validate.php"); ?>
<?	$blnsuccess = TRUE;

	$objdb_function->begin();
	$msGetGID = $objdb_function->getnum_setting("UD",$establish);

	$msSQL = "insert into adm_mst_tuserdata 
			(userdata_gid, userdata_name, seq_no, display_order) values
			('$msGetGID','$_POST[txtuserdata_name]', '$_POST[txtseq_no]', 
			 '$_POST[txtdisplay_order]')";
	$blnsuccess = mysql_query($msSQL,$establish->link); 

	if ($blnsuccess == TRUE) {
		$objdb_function->commit();
		$msgcode = "SUC_UD001";
	} else {
		$objdb_function->rollback();
		$blnsuccess = FALSE;
		$msgcode = "ERR_UD002";
	}

   if ($blnsuccess == TRUE) { ?>
		<script language="javascript">
			document.location="adm_mst_userdatasummary.php?msgcode=<?=$msgcode?>";
		</script>		
	<? } else { ?>
		<form name="frmuserdataadd" action="adm_mst_userdataadd.php?msgcode=<?=$msgcode?>" method="post">
			<input type="hidden" name="txtuserdata_name" value="<?=$_POST['txtuserdata_name']?>">
			<input type="hidden" name="txtseq_no" value="<?=$_POST['txtseq_no']?>">
			<input type="hidden" name="txtdisplay_order" value="<?=$_POST['txtdisplay_order']?>">
		</form>
		<script language="javascript">
			document.frmuserdataadd.submit();
		</script>		
<? } ?>