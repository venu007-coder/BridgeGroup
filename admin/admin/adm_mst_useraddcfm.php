<? include("../system/sys_cmn_validate.php"); ?>

<?	$blnsuccess = TRUE;
	$msSQL = "select user_code from adm_mst_tuser where 
			 user_code = '$_POST[txtuser_code]'"; 
	$rs_user = mysql_query($msSQL,$establish->link);
	$mncount = mysql_num_rows($rs_user);

	if ($mncount == 0)
	 { 

		$objdb_function->begin();

	   $msGetaddressGID = $objdb_function->insaddress(
							$_POST['txtpresent_address1'],
							$_POST['txtpresent_address2'],
							$_POST['cbopresentcountry'],
							$_POST['txtpresent_postalcode'],
							$establish);

		$msGetGID = $objdb_function->getnum_setting("US",$establish);
	
		$msuser_gid = $msGetGID;
		
	
		$msSQL = "insert into adm_mst_tuser
					(user_gid, 
					usergroup_gid, 
					user_code,
					user_firstname, 
					user_lastname,
					user_password, 
					status,
					user_mobile,
					user_contact,
					address_gid) values
					('$msGetGID',
					'$_POST[cbousergroup]', 
					'$_POST[txtuser_code]', 
					'$_POST[txtuser_firstname]',
					'$_POST[txtuser_lastname]',
					'$_POST[txtpassword]',
					'$_POST[rdostatus]',
					'$_POST[txtuser_mobile]',
					'$_POST[txtuser_contact]',
					'$msGetaddressGID')";
		
		$blnsuccess = mysql_query($msSQL,$establish->link); 

		if ($blnsuccess == TRUE) {
			$objdb_function->commit();
			$msgcode = "SUC_UR002";
		} else {
			$objdb_function->rollback();
			$blnsuccess = FALSE;
			$msgcode = "ERR_UR003";
		}
	} else { 
		$blnsuccess = FALSE;
		$msgcode = "ERR_UR001";
	 } 	

   if ($blnsuccess == TRUE) { ?>
		<script language="javascript">
			document.location="adm_mst_usersummary.php?msgcode=<?=$msgcode?>";
		</script>		
	<? } else { ?>
		<form name="frmuseradd" action="adm_mst_useradd.php?msgcode=<?=$msgcode?>" method="post">
		  <input type="hidden" name="cbousergroup" value="<?=$_POST['cbousergroup']?>">
		  <input type="hidden" name="txtuser_code" value="<?=$_POST['txtuser_code']?>">
		  <input type="hidden" name="txtuser_firstname" value="<?=$_POST['txtuser_firstname']?>">
      	  <input type="hidden" name="txtuser_lastname" value="<?=$_POST['txtuser_lastname']?>">
		  <input type="hidden" name="txtpassword" value="<?=$_POST['txtpassword']?>">
		  <input type="hidden" name="txtconfirmpassword" value="<?=$_POST['txtconfirmpassword']?>">
		  <input type="hidden" name="rdostatus" value="<?=$_POST['rdostatus']?>">
		</form>
		<script language="javascript">
			document.frmuseradd.submit();
		</script>		
<? } ?>
<? include("../system/sys_cmn_footer.php"); ?>