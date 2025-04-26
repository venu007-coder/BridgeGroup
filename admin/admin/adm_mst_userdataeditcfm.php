<? include("../system/sys_cmn_validate.php"); ?>
<?	$blnsuccess = TRUE;

	$objdb_function->begin();

	$msSQL = "update adm_mst_tuserdata set 
			userdata_name = '$_POST[txtuserdata_name]',
			seq_no = '$_POST[txtseq_no]',
			display_order='$_POST[txtdisplay_order]'
			where userdata_gid = '$_POST[txtuserdata_gid]'";
	$blnsuccess = mysql_query($msSQL,$establish->link); 

	if ($blnsuccess == TRUE) {
		$objdb_function->commit();
		$msgcode = "SUC_UD008";
	} else {
		$objdb_function->rollback();
		$blnsuccess = FALSE;
		$msgcode = "ERR_UD009";
	}

   if ($blnsuccess == TRUE) { ?>
		<script language="javascript">
			document.location="adm_mst_userdatasummary.php?msgcode=<?=$msgcode?>";
		</script>		
	<? } else { ?>
		<form name="frmuserdataedit" action="adm_mst_userdataedit.php?msgcode=<?=$msgcode?>&txtuserdata_gid=<?=$_POST['txtuserdata_gid']?>" method="post">
			<input type="hidden" name="txtuserdata_name" value="<?=$_POST['txtuserdata_name']?>">
			<input type="hidden" name="txtseq_no" value="<?=$_POST['txtseq_no']?>">
			<input type="hidden" name="txtdisplay_order" value="<?=$_POST['txtdisplay_order']?>">
		</form>
		<script language="javascript">
			document.frmuserdataedit.submit();
		</script>		
<? } ?>
<? include("../system/sys_cmn_footer.php"); ?>