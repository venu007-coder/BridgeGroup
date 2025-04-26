<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? $gsmodule_code = "T1L1US";
   include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">
function cancel()
{
	document.location="adm_mst_usersummary.php";
}
</script>

<form name="frmuserview" action="adm_mst_usersummary.php" method="post">
	<table width="100%">
		<tr>
			<td class="headingI">View Staff</td>
		</tr>
	</table>

	
<? 	$msSQL = "SELECT a.user_code, a.user_firstname, a.user_lastname, a.status,a.user_mobile,a.user_contact ,                  b.usergroup_name
FROM adm_mst_tuser a, adm_mst_tusergroup b where 
			a.usergroup_gid = b.usergroup_gid and 
			a.user_gid = '$_GET[txtuser_gid]'"; 
			
			

	$rs_user = mysql_query($msSQL,$establish->link);
	$arr_user = mysql_fetch_array($rs_user);
?>
    	<table width="80%" align="center">
	  <tr>
	  	 <td width="40%" class="labels1">Group Name</td>
		 <td width="60%" class="labelsvalues"><?= $arr_user['usergroup_name'] ?></td>
	 </tr>
		
	  <tr>
		<td class="labels1">User Code</td>
		<td class="labelsvalues"><?= $arr_user['user_code']?></td>
	  </tr>
	  <tr>
	  	<td class="labels1">First Name</td>
		<td class="labelsvalues"><?=$arr_user['user_firstname']?></td>
	  </tr>
	  <tr>
	  	<td class="labels1">Last Name</td>
		<td class="labelsvalues"><?=$arr_user['user_lastname']?></td>
	  </tr>
	  <tr>
	  	<td class="labels1">Status</td>
		<td class="labelsvalues">
		<? if($arr_user['status']== 1){ 
			print "Active";
  	   	    } else {
			print "Inactive";
		   }
		?>
		</td>
	  </tr>
	  <tr>
		<td class="labels1">Mobile No</td>
		<td class="labelsvalues"><?= $arr_user['user_mobile']?></td>
	  </tr>
	  <tr>
		<td class="labels1">Contact No</td>
		<td class="labelsvalues"><?= $arr_user['user_contact']?></td>
	  </tr>
	  <tr>
	  	<td >&nbsp;
		</td>
	  </tr>
	  
	  <tr>
	  	<td colspan="2" align="center"><input type="button" class="button" value="Back" onclick="return cancel();">
		</td>
	  </tr>
	  </table>
</form>

<? include("../system/sys_cmn_footer.php"); ?>
