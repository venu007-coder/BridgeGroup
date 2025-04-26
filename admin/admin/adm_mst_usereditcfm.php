<? include("../system/sys_cmn_validate.php"); ?>

<?	$blnsuccess = TRUE;
	$objdb_function->begin();

	$msSQL =   "update adm_mst_taddress set 
				address1 = '" . addslashes($_POST['txtpresent_address1']) . "',
				address2 = '" . addslashes($_POST['txtpresent_address2']) . "',
				postalcode = '" . addslashes($_POST['txtpresent_postalcode']) . "',
				country_gid = '$_POST[cbopresentcountry]' where 
				address_gid = '$_POST[txtpresentaddress_gid]'";
	$blnsuccess = mysql_query($msSQL,$establish->link);  	

	$msSQL = "update adm_mst_tuser set 
								user_code = '$_POST[txtuser_code]',
								user_firstname = '$_POST[txtuser_firstname]',
								usergroup_gid = '$_POST[cbousergroup]',
								user_lastname = '$_POST[txtuser_lastname]',
								status='$_POST[rdostatus]'
								where user_gid = '$_POST[txtuser_gid]'";
	//Print $msSQL;
	$blnsuccess = mysql_query($msSQL,$establish->link); 

	if ($blnsuccess == TRUE) {
		$objdb_function->commit();
		$msgcode = "SUC_UR008";
	} else {
		$objdb_function->rollback();
		$blnsuccess = FALSE;
		$msgcode = "ERR_UR009";
	}

   if ($blnsuccess == TRUE) { ?>
		<script language="javascript">
			document.location="adm_mst_usersummary.php?msgcode=<?=$msgcode?>";
		</script>		
	<? } else { ?>
		<form name="frmusereditcfm" action="adm_mst_useredit.php?msgcode=<?=$msgcode?>&txtuser_gid=<?=$_POST['txtuser_gid']?>" method="post">
			<input type="hidden" name="cbousergroup" value="<?=$_POST['cbousergroup']?>">
			<input type="hidden" name="txtuser_code" value="<?=$_POST['txtuser_code']?>">
			<input type="hidden" name="txtuser_firstname" value="<?=$_POST['txtuser_firstname']?>">
			<input type="hidden" name="txtuser_lastname" value="<?=$_POST['txtuser_lastname']?>">
			<input type="hidden" name="rdostatus" value="<?=$_POST['rdostatus']?>">
		</form>
		<script language="javascript">
		document.frmuseredit.submit();
		</script>		
	<? } ?>
<? include("../system/sys_cmn_footer.php"); ?>