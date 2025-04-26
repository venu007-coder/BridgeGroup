<? include("../system/sys_cmn_validate.php"); ?>
<link href="../include/ss_stylesheet.css" rel="stylesheet" type="text/css">
<? 	$gsmodule_code = "T2L3JM"; 
	include ("../system/sys_cmn_frame.php"); ?>

<script language="javascript">
function cancel()
{
	document.location="res_trn_candidatesummary.php";
}
</script>

<form name="frmjobadd" action="res_trn_candidatesummary.php" method="post">

<table width="100%">
	<tr>
		<td class="headingI">View Profile</td>
	</tr>
</table>
	
	
	
	
	<? $msSQL = "select 
					         candidate_gid, 
							 candidate_name,
							 candidate_no,
							 candidate_email,
							 candidate_qualification,
							 candidate_currentworking,
							 candidate_department,
							 candidate_designation,
							 candidate_salary,
							 candidate_location,
							 candidate_currentyears,
							 candidate_experience,
							 resume_filename
			  from 
			 		 res_trn_tcandidate 
			 where		 
			     candidate_gid = '$_GET[txtcandidate_gid]'";
	     
			     	$rs_candidate = mysql_query($msSQL,$establish->link);
			     	$arr_candidate = mysql_fetch_array($rs_candidate);
			     
	//print $msSQL;
	   
	 ?> 
	  
	<table width="70%" align="center">
		<tr align="center" >
			<td class="labels1">Name</td>
			<td width="60%" class="labelsvalues"><?=$arr_candidate['candidate_name']?></td>
		</tr>
		<tr>
			<td width="40%" class="labels1">Contact No</td>
			<td width="60%" class="labelsvalues"><?=$arr_candidate['candidate_no']?></td>
		</tr>
	     
		<tr>
			<td width="40%" class="labels1">E-Mail</td>
			<td width="60%" class="labelsvalues"><?=$arr_candidate['candidate_email']?></td>
		</tr>
	
		<tr>
			<td width="40%" class="labels1">Qualification</td>
			<td width="60%" class="labelsvalues"><?=$arr_candidate['candidate_qualification']?></td>
		</tr>
		<tr>
			<td width="40%" class="labels1">Name of the Current Company Working</td>
			<td width="60%" class="labelsvalues"><?=$arr_candidate['candidate_currentworking']?></td>
		</tr>
		<tr>
			<td width="40%" class="labels1">Department</td>
			<td width="60%" class="labelsvalues"><?=$arr_candidate['candidate_department']?></td>
		</tr>
		 <tr>
			<td width="40%" class="labels1">Current Designation</td>
			<td width="60%" class="labelsvalues"><?= $arr_candidate['candidate_designation']?></td>
		</tr>
		<tr>
			<td width="40%" class="labels1">Current Salary</td>
			<td width="60%" class="labelsvalues"><?= $arr_candidate['candidate_salary']?></td>
		</tr>
		<tr>
			<td width="40%" class="labels1">Current Location</td>
			<td  width="60%" class="labelsvalues"><?= $arr_candidate['candidate_location']?></td>
		</tr>
		<tr>
			<td width="40%" class="labels1">No.of years with current Company</td>
			<td  width="60%" class="labelsvalues"><?= $arr_candidate['candidate_currentyears']?></td>
		</tr>
		<tr>
			<td width="40%" class="labels1">Total No Of Years Of Work Exp</td>
			<td  width="60%" class="labelsvalues"><?= $arr_candidate['candidate_experience']?></td>
		</tr>
		</table><br><br>
		<table align="center">
		<tr>
			<td colspan="2" align="center">	
				<input type="button" value="Back" class="button" onClick="return cancel();">
			</td>
		</tr>
	</table>  
</form>

<? 	include("../system/sys_cmn_footer.php"); ?>
