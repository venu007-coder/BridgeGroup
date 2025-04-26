<? 	include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">

<?  $msSQL = "select user_gid from adm_mst_tuser where 
			  usergroup_gid = '$_GET[txtusergroup_gid]'";

	$rs_user = mysql_query($msSQL,$establish->link);
	$mncount_user = mysql_num_rows($rs_user);
	
	if ($mncount_user == 0) {
		$objdb_function->begin();
		$msSQL = "delete from adm_mst_tprivilege where 
				usergroup_gid = '$_GET[txtusergroup_gid]'";
		$blnsuccess=mysql_query($msSQL,$establish->link);
		
		if($blnsuccess == TRUE)
		{
			$msSQL = "delete from adm_mst_tusergroup where 
				  	  usergroup_gid = '$_GET[txtusergroup_gid]'";
			$blnsuccess = mysql_query($msSQL,$establish->link); 
			if ($blnsuccess == TRUE) {
				$objdb_function->commit();
				$msgcode = "SUC_UG005";
			} else {
				$objdb_function->rollback();
				$blnsuccess = FALSE;
				$msgcode = "ERR_UG004";
			}
		} else {
				$objdb_function->rollback();
				$msgcode = "ERR_UG006";
		} 
	} else {
	  	
		$msgcode = "ERR_UG007";
	  
	}	
?>

<script language="javascript">
	document.location="adm_mst_usergroupsummary.php?msgcode=<?=$msgcode?>";
</script>		

<? include("../system/sys_cmn_footer.php"); ?>
