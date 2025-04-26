<?php
    include("includes/bridge_cmn_opendb.inc");
    include("includes/sys_cmn_function.php"); 
    include("includes/sys_cmn_settings.php");
	$objdb_function = new db_functions(); 
    $establish = new connection();

	$filename = basename( $_FILES['uploadfile']['name']);
 	$uploadfile_name = "";
	$msGetGID = $objdb_function->getnum_setting("CD",$establish);
	if($filename !='')
	{
	$blnSuccess = 1;
		$extension =$objdb_function->getExtension($filename);
		$extension = strtolower($extension);
		if (($extension != "doc") && ($extension != "rtf") && ($extension != "txt")) 
		{
			$blnSuccess = 0;
			$msgcode = "ERR_FU001";
		}
		else
		{
			$file_size=$_FILES['uploadfile']['size'];
			if($file_size <= $file_upload_size)
			{
				$_FILES['uploadfile']['tmp_name'];
				
				$uploadfile_name = $msGetGID.'.'.$extension;
				$newname = $upload_path . $uploadfile_name;
		
				$copied = copy($_FILES['uploadfile']['tmp_name'], $newname);
				if($copied != 1) {
				  	$blnSuccess = 0;
					$msgcode = "ERR_FU004";		  				  
				}
			}
			else{
				$msgcode = "ERR_FU002";
				$blnSuccess = 0;
			}
		}
	}
	
	$blnsuccess1 = TRUE;
	
		$objdb_function->begin();

		$msSQL =  " insert into res_trn_tcandidate 
							(candidate_gid, 
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
							 ) 
					values 
							('$msGetGID', 
							'" . addslashes($_POST['txtcandidate_name']) . "',
							'" . addslashes($_POST['txtcandidate_no']) . "',  
							'$_POST[txtemail]', 
							'$_POST[txtcandidate_qualification]',
							'$_POST[txtcandidate_working]',
							'$_POST[cbodepartment]',
							'$_POST[txtcurrent_designation]',
							'$_POST[txtcurrent_salary]',
							'$_POST[txtcurrent_location]',
							'$_POST[txtcurrent_year]',
							'$_POST[txttotal_experience]',
							'$uploadfile_name')";
							
		$blnsuccess1 = mysql_query($msSQL,$establish->link);  
		if ($blnsuccess1 == TRUE) {
			$objdb_function->commit();
			$msgcode = "SUC_CD002";
		} else {
			$objdb_function->rollback();
			$blnsuccess1 = FALSE;
			$msgcode = "ERR_CD003";
		}
	
	?>
	<script language="javascript"> 
		document.location="thank.applyonline.php?msgcode=<?=$msgcode?>";
	</script>
	

