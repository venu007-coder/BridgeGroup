<? 	session_start(); 
	include("../include/sys_cmn_opendb.inc"); 
	$establish=new connection();
	$msSQL = "delete from adm_ses_tsessionlogin where 
					session_gid = '$_SESSION[session_gid]'";
	mysql_query($msSQL,$establish->link);
	session_destroy(); 
?>
<script language="javascript">
	document.location="../index.html";
</script>
