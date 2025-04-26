<? include("../system/sys_cmn_validate.php"); ?>


<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? 	$gsmodule_code = "T2L3RS"; 
	include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">
function doconfirmdel(candidate_gid)
{
	if(confirm("Are you sure you want to delete this Candidate?"))
	{
		document.location="res_trn_candidatedelete.php?txtcandidate_gid="+candidate_gid;
	}
}

function dosubmit()
{
document.location="res_trn_exportexcel.php"	
}
</script>

<table width="100%">
<tr>
	<td class="headingI">Candidate Summary</td>
</tr>
</table>

<? if (isset($_GET['msgcode'])) { 
		$msgtype = substr($_GET['msgcode'],0,3); ?>
		<table align="center" width="80%" >
			<tr>
				<? if ($msgtype == "ERR") { ?>
					<td class="warning"><? print $objdb_function->getmsg($_GET['msgcode']);?></td>
				<? } else { ?>
					<td class="success"><? print $objdb_function->getmsg($_GET['msgcode']);?></td>
				<? } ?>
			</tr>
		</table>
	<? } ?>
	
	<table width="92%" align="center">
	<tr> 
		<td align="right">
			<input type="button" name="btnsubmit" value="Export Excel" class="button" onClick="return dosubmit();">&nbsp;&nbsp;
		</td>
	</tr>
</table>


<table width="90%" class="summary" align="center">
<tr>
	<th>Name</th>
	<th>Contact No</th>
	<th>Email</th>
	<th>Qualification</th>
	<th>Department</th>
	<th>Download Resume</th>
	<th colspan="2">Action</th>
</tr>

<?	 $msSQL = "select 
					         candidate_gid, 
							 candidate_name,
							 candidate_no,
							 candidate_email,
							 candidate_qualification,
							 candidate_department,
							resume_filename
			  from 
			 		 res_trn_tcandidate ";
	$rs_candidate = mysql_query($msSQL,$establish->link);?>
		
	 <?  $alternaterow = "N";
		while ($row = mysql_fetch_array($rs_candidate)) { 

		  
			if ($alternaterow == "N") { 
				$tdclass = "";
				$alternaterow = "Y";
			} else { 
				$tdclass =  "class=\"alternate\"";
				$alternaterow = "N";
			} ?>
	
	<tr>
		
		<td <?=$tdclass?>><?=str_replace("\\", "",$row['candidate_name'])?></td>
		<td <?=$tdclass?>><?=str_replace("\\", "",$row['candidate_no'])?></td>
		<td <?=$tdclass?>><?=$row['candidate_email']?></td>
		<td <?=$tdclass?>><?=$row['candidate_qualification']?></td>
	    <td <?=$tdclass?>><?=$row['candidate_department']?></td>
		<td <?=$tdclass?> align="center">
			<? if ($row['resume_filename'] != "") { ?>
				<a class="hyperlink" 
				   href="<?=$upload_url2path?><?=$row['resume_filename']?>">Resume</a>
		<? } ?>
		</td>
		<td <?=$tdclass?> align="center"><a href="res_trn_candidateview.php?txtcandidate_gid=<?=$row['candidate_gid']?>" class="hyperlink">View</a></td>
		<td <?=$tdclass?> align="center"><a href="javascript:doconfirmdel('<?=$row['candidate_gid']?>');" class="hyperlink">Delete</a></td>
	</tr>	
	
	

	<? } ?>
</table>


<? 	include("../system/sys_cmn_footer.php"); ?>