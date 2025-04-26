<?  session_start(); 
	include("../include/sys_cmn_opendb.inc"); 
	include("../include/sys_cmn_settings.php"); 

	$establish = new connection();
	
	$msSQL = "select user_gid, usergroup_gid from adm_mst_tuser where 
					user_code = '$_POST[txtuser_code]' and 
					user_password = '$_POST[txtpassword]'";
	$rs_checklogin = mysql_query($msSQL,$establish->link);
	$count_checklogin = mysql_num_rows($rs_checklogin);
	
	if($count_checklogin != 0 ) {
		$arr_checklogin = mysql_fetch_array($rs_checklogin);

		$ldttoday_date = date("YmdHis");
		session_register("usergroup_gid");
		$_SESSION['usergroup_gid'] = $arr_checklogin['usergroup_gid'];

		session_register("user_gid");
		$_SESSION['user_gid'] = $arr_checklogin['user_gid'];

		session_register("user_code");
		$_SESSION['user_code'] = $_POST['txtuser_code'];
		
		session_register("session_gid");
		$_SESSION['session_gid'] = session_id();

		$msSQL = "insert into adm_ses_tsessionlogin (session_gid, user_code, created_time, update_time) values 
						('$_SESSION[session_gid]','$_SESSION[user_code]','$ldttoday_date','$ldttoday_date')";
		$blnsuccess = mysql_query($msSQL,$establish->link);

		if($_SESSION['user_code'] == 'customer') { ?>
			<script language="javascript">
				document.location="../project/tas_trn_customercasesummary.php";
			</script>
		<? } else { ?>
			<script language="javascript">
				document.location="../resume/res_trn_candidatesummary.php";
			</script>
		<? } 
	} else {
		session_destroy(); ?>
		<script language="javascript">
			document.location="../index.php?msgcode=ERR_LG001";
		</script>
	<? } 
?>
