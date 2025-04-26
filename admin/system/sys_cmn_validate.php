<? session_start();?>
<? 	include("../include/sys_cmn_opendb.inc"); 
	include("../include/sys_cmn_settings.php"); 
	include("../system/sys_cmn_function.php");  
	$objdb_function = new db_functions(); 
	
	# Transform hours like "13.30" into minutes like "810".
	function hours($hours,$minutes)
	{
		$minutesInHours    = $hours * 60;
		$totalMinutes = $minutesInHours + $minutes;
		return $totalMinutes;
	}
	
	function datesplit($dates)
	{
		$splitteddata=split('-',$dates);
		$date1=$splitteddata[0].$splitteddata[1].$splitteddata[2];
		return $date1;
	}
	
	$establish=new connection();

	if (!isset($_SESSION['user_code'])) { 
		session_destroy(); ?>			
		<script language="JavaScript">
			document.location="../system/sys_cmn_error.php?msgcode=ERR_LG007";
		</script>
	<? } else { 
		$blnsessionexpire = "FALSE";
		$msSQL = "select user_code, update_time from adm_ses_tsessionlogin where 
					session_gid='$_SESSION[session_gid]'";
		$rs_sessionlogin = mysql_query($msSQL,$establish->link);
		$arr_sessionlogin = mysql_fetch_array($rs_sessionlogin );
		
		$date2 = $arr_sessionlogin['update_time'];
		$getdate2=substr($date2,0,10); //print $getdate2."<br>";

		$date3=date("Y-m-d:His");
		$getdate3=substr($date3,0,10); //print $date3."<br>";

		if($getdate2==$getdate3) {
			$gethour3 = substr($date3,11,2); 
			$getminute3 = substr($date3,13,2);		
			$gettotalminute3 = hours($gethour3,$getminute3); 
			$gethour2 = substr($date2,11,2); 
			$getminute2 = substr($date2,14,2);		
			$gettotalminute2 = hours($gethour2,$getminute2); 
			$diff_minutes = $gettotalminute3 - $gettotalminute2;

			if($diff_minutes <= $sesexpiry_duration) {
				if (isset($_SESSION['user_code']))	{
					$currenttime = date("YmdHis");
					$msSQL = "update adm_ses_tsessionlogin set 
										update_time = '$currenttime' where 
										session_gid = '$_SESSION[session_gid]'";
					mysql_query($msSQL,$establish->link);
				}
				else {
					$blnsessionexpire = "TRUE";
				}
			}
			else {
				$blnsessionexpire = "TRUE";
			}
		} else {
			$blnsessionexpire = "TRUE";
		}

		if ($blnsessionexpire == "TRUE") {	
			$msSQL = "delete from adm_ses_tsessionlogin where 
							session_gid = '$_SESSION[session_gid]'";
			mysql_query($msSQL,$establish->link);
			session_destroy(); ?> 
			<script language="JavaScript">
				document.location="../system/sys_cmn_error.php?msgcode=ERR_LG006";
			</script>
		<? }
	}
?>