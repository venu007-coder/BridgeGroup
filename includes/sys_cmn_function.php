<?
class db_functions
{	
	function quote_smart($value)
	{
	   // Stripslashes
	   if (get_magic_quotes_gpc()) {
	       $value = stripslashes($value);
	   }
	   // Quote if not a number or a numeric string
	   if (!is_numeric($value)) {
	       $value = "'" . mysql_real_escape_string($value) . "'";
	   }
	   return $value;
	}
	function begin() 
	{
		mysql_query("BEGIN");
	}
	
	function commit()
	{
		mysql_query("COMMIT");
	}
	
	function rollback()
	{
		mysql_query("ROLLBACK");
	}

	function leading_zero($aNumber, $intPart, $prefix)
	{       
		$formattedNumber = $aNumber;	
		if ($intPart > floor(log10($formattedNumber)))
		{
			$formattedNumber = str_repeat("0",($intPart + -1 - floor(log10($formattedNumber)))).$formattedNumber;
		}
		$mdtym = date('ym');
		$formattedNumber = $prefix . $mdtym . $formattedNumber;
		return $formattedNumber;
	}

	function getnum_setting($sequence_code,$establish)
	{
		$establish = new connection();

		$msSQL = "select sequence_gid, sequence_code, sequence_name, sequence_curval, sequence_format from adm_mst_tsequence 
						where sequence_code = '$sequence_code'";
		$rs_sequence = mysql_query($msSQL,$establish->link);
		$arr_sequence = mysql_fetch_array($rs_sequence);
		mysql_free_result($rs_sequence);

		$lsseqno = $arr_sequence['sequence_curval'] + 1;
		
		$lstemporder_gid = $this->leading_zero($lsseqno, $arr_sequence['sequence_format'], $arr_sequence['sequence_code']);

		$msSQL = "update adm_mst_tsequence set 
						sequence_curval = $lsseqno where 
						sequence_code = '$sequence_code'";			
		$rs_upsequence = mysql_query($msSQL,$establish->link);
		return $lstemporder_gid;
	}

	function dosendmail($from,$to, $subject, $message) {
		$headers1 = "MIME-Version: 1.0\r\n";
		$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers1 .= "To: ".$to."\r\n";
		$headers1 .= "From: ".$from."\r\n";
		$headers1 .= "Reply-To: ".$from."\r\n";
		
		$Headers = "FROM: " . $from. "\r\n"; 
		$Headers .= "Reply-To: " . $from . "\r\n"; 
		$Headers .= "X-Priority: 1\r\n"; //1 is important 3 is normal 
		$Headers .= "X-MSMail-Priority: High\r\n"; 
		$Headers .= "X-Sender: " .  $from . "\r\n"; 
		$Headers .= 'X-Mailer: PHP/' . "phpversion()\r\n"; 
		$Headers .= "MIME-Version: 1.0\r\n"; 
		$Headers .= "Content-Type: text/html; charset=iso-8859-1 \r \n"; 
		$Headers .= "Content-Transfer-Encoding: 8bit\r\n"; 

		return mail($to, $subject, $message, $Headers);
	}

	function insaddress($address1, $address2, $country, $postalcode) {
		$establish=new connection();
		$msGetGID = $this->getnum_setting("AD",$establish);
		$msSQL = "insert into adm_mst_taddress (address_gid, address1, address2, country_gid, postalcode) values 
				 ('$msGetGID','$address1','$address2','$country','$postalcode')";
		$blnsuccess = mysql_query($msSQL,$establish->link);
		return $msGetGID;
	}

	function getratingfactor($ratingfactor)
	{
		switch ($ratingfactor) {
			case "beginner":
				 return "0.2";
				 break;
			case "intermediate":
				 return "0.5";
				 break;
			case "professional":
				 return "0.6";
				 break;
			case "expert":
				 return "0.8";
				 break;
			default:
				 break;
		}
	}
	
	// This function returns the extension of the file uploaded
	function getExtension($str) 
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

	function getmsg($msgcode) 
	{
		switch ($msgcode) {
			case "ERR_LG001":
				return "You have entered an invalid User Code or Password.";
				break;
				
			case "ERR_UG001":
				return "Staff Group Code already exist!.  Please enter a unique Staff Group code";
				break;
			case "SUC_UG002":
				return "Staff Group Code added successfully.";
				break;
			case "ERR_UG003":
				return "Error occured while adding new Staff Group. Please contact system administrator";
				break;
			case "ERR_UG004":
				return "Error occured while deleting the Staff Group . Please contact system administrator";
				break;
			case "SUC_UG005":
				return "Successfully deleted the selected Staff Group";
				break;		
			case "ERR_UG007";
				return "You can't Delete this User Group. User exist under this user group";
				break;
			case "SUC_UG008":
				return "Successfully updated the selected Staff Group";
				break;
			case "ERR_UG009":
				return "Error occured while updating the Staff Group. Please contact system administrator";
				break;
			case "ERR_UG010":
				return "Please Select atleast One Privilege";
				break;
					
			case "ERR_US001":
				return "User Code already exist!.  Please enter a unique User Code";
				break;
			case "SUC_US002":
				return "User Code added successfully.";
				break;
			case "ERR_US003":
				return "Error occured while adding new User.  Please contact system administrator";
				break;
			case "ERR_US004":
				return "Error occured while deleting the User  . Please contact system administrator";
				break;
			case "SUC_US005":
				return "Successfully deleted the selected User ";
				break;
			case "ERR_US006";
				return "You can't Delete Sysadmin User";
				break;	
			case "SUC_US008":
				return "Successfully updated the selected User ";
				break;
			case "ERR_US009":
				return "Error occured while updating the User . Please contact system administrator";
				break;
				
				
			case "ERR_UD002":
				return "Error occured while adding new User data.  Please contact system administrator";
				break;
			case "SUC_UD001":
				return "User Data added successfully.";
				break;
			case "ERR_UD003":
				return "Error occured while adding new User Data.  Please contact system administrator";
				break;
			case "ERR_UD004":
				return "Error occured while deleting the User Data.  Please contact system administrator";
				break;
			case "SUC_UD005":
				return "Successfully deleted the selected User Data";
				break;
			case "SUC_UD008":
				return "Successfully updated the selected User Data";
				break;
			case "ERR_UD009":
				return "Error occured while updating the User Data.  Please contact system administrator";
				break;
	
			case "SUC_CP008":
				return "Successfully updated the Password";
				break;
			case "ERR_CP009":
				return "Error occured while updating the Password. Please contact system administrator";
				break;
				
			case "SUC_RP008":
				return "The Password has been Reset Successfully";
				break;
			case "ERR_RP009":
				return "Error occured while Resetting the Password. Please contact system administrator";
				break;
	
			case "ERR_FA001":
				return "Functional Area Code already exist!.  Please enter a unique functional area code";
				break;
			case "SUC_FA002":
				return "Functional Area added successfully.";
				break;
			case "ERR_FA003":
				return "Error occured while adding new functional area.  Please contact system administrator";
				break;
			case "ERR_FA004":
				return "Error occured while deleting the Functional area.  Please contact system administrator";
				break;
			case "SUC_FA005":
				return "Successfully deleted the selected Functional area";
				break;
			case "SUC_FA008":
				return "Successfully updated the selected Functional area";
				break;
			case "ERR_FA009":
				return "Error occured while updating the Functional area.  Please contact system administrator";
				break;
				
			case "ERR_IN001":
				return "Industry Code already exist!.  Please enter a unique Industry code";
				break;
			case "SUC_IN002":
				return "Industry Code added successfully.";
				break;
			case "ERR_IN003":
				return "Error occured while adding new Industry.  Please contact system administrator";
				break;
			case "ERR_IN004":
				return "Error occured while deleting the Industry.  Please contact system administrator";
				break;
			case "SUC_IN005":
				return "Successfully deleted the selected Industry";
				break;
			case "SUC_IN008":
				return "Successfully updated the selected Industry";
				break;
			case "ERR_IN009":
				return "Error occured while updating the Industry.  Please contact system administrator";
				break;
				
			case "ERR_SC001":
				return "State-City Code already exist!.  Please enter a unique State-City code";
				break;
			case "SUC_SC002":
				return "State-City Code added successfully.";
				break;
			case "ERR_SC003":
				return "Error occured while adding new State-City.  Please contact system administrator";
				break;
			case "ERR_SC004":
				return "Error occured while deleting the State-City.  Please contact system administrator";
				break;
			case "SUC_SC005":
				return "Successfully deleted the selected State-City";
				break;
			case "SUC_SC008":
				return "Successfully updated the selected State-City";
				break;
			case "ERR_SC009":
				return "Error occured while updating the State-City.  Please contact system administrator";
				break;

				
			case "ERR_JB001":
				return "Job Code already exist!.  Please enter a unique Job code";
				break;
			case "SUC_JB002":
				return "Job Code added successfully.";
				break;
			case "ERR_JB003":
				return "Error occured while adding new Job. Please contact system administrator";
				break;
			case "ERR_JB004":
				return "Error occured while deleting the Job. Please contact system administrator";
				break;
			case "SUC_JB005":
				return "Successfully deleted the selected Job";
			case "SUC_JB008":
				return "Successfully updated the selected Job";
				break;
			case "ERR_JB009":
				return "Error occured while updating the Job. Please contact system administrator";
				break;
			
				
			case "ERR_JT001":
				return "Job Type already exist!.  Please enter a unique Job Type";
				break;
			case "SUC_JT002":
				return "Job Type added successfully.";
				break;
			case "ERR_JT003":
				return "Error occured while adding new Job Type.  Please contact system administrator";
				break;
			case "ERR_JT004":
				return "Error occured while deleting the Job Type.  Please contact system administrator";
				break;
			case "SUC_JT005":
				return "Successfully deleted the selected Job Type";
				break;
			case "SUC_JT008":
				return "Successfully updated the selected Job Type";
				break;
			case "ERR_JT009":
				return "Error occured while updating the Job Type.  Please contact system administrator";
				break;
				
			case "ERR_CD001":
				return "Candidate already exist!.  Please enter a unique Candidate code";
				break;
			case "SUC_CD002":
				return "Candidate added successfully.";
				break;
			case "ERR_CD003":
				return "Error occured while adding new Candidate.  Please contact system administrator";
				break;
			case "ERR_CD004":
				return "Error occured while deleting the Candidate.  Please contact system administrator";
				break;
			case "SUC_CD005":
				return "Successfully deleted the selected Candidate";
				break;
			case "SUC_CD008":
				return "Successfully updated the selected Candidate";
				break;
			case "ERR_CD009":
				return "Error occured while updating the Candidate.  Please contact system administrator";
				break;
			case "ERR_CD006":
				return "Candidate already exists!";
				break;
			case "ERR_CD007":
				return "Email already exists!";
				break;
							
			case "SUC_CJ002":
				return "Thankyou Your Resume has been Accepted";
				break;
			case "ERR_CJ007":
				return "General Error Occured.Please contact System Adminstrator";
				break;
			case "ERR_CJ008":
				return "General Error Occured";
				break;
				
		case "SUC_AC002":
				return "Candidate Academic Details has been added Successfully";
				break;
			case "ERR_AC003":
				return " Error Occured while adding the Academic Details";
				break;
			case "ERR_AC008":
				return "General Error Occured";
				break;
			case "SUC_AC005":
				return "Successfully deleted the selected Academic Details";
				break;
			case "ERR_AC004":
				return "Error occured while deleting the Academic Details.  Please contact system administrator";
				break;
			case "SUC_AC008":
				return "Successfully Updated the selected Academic Details";
				break;
			case "ERR_AC009":
				return "Error occured while updating the Academic Details.  Please contact system administrator";
				break;
			default:
				break;
					
			case "SUC_NA002":
				return "Candidate Non Academic Details has been added Successfully";
				break;
			case "ERR_NA003":
				return " Error Occured while adding the Non Academic Details";
				break;
			case "ERR_NA008":
				return "General Error Occured";
				break;
			case "SUC_NA005":
				return "Successfully deleted the selected Non Academic Details";
				break;
			case "ERR_NA004":
				return "Error occured while deleting the Non Academic Details.  Please contact system administrator";
				break;
			case "SUC_NA008":
				return "Successfully Updated the selected Non Academic Details";
				break;
			case "ERR_NA009":
				return "Error occured while updating the Non Academic Details.  Please contact system administrator";
				break;
			default:
				break;
				
			case "SUC_PJ002":
				return "Project Details has been added successfully";
				break;
			case "ERR_PJ003":
				return " Error Occured while adding the Project details";
				break;
			case "ERR_PJ008":
				return "General Error Occured";
				break;
			case "SUC_PJ005":
				return "Successfully deleted the selected Project Details";
				break;
			case "ERR_PJ004":
				return "Error occured while deleting the Project Details.  Please contact system administrator";
				break;
			case "SUC_PJ008":
				return "Successfully Updated the selected Project Details";
				break;
			case "ERR_PJ009":
				return "Error occured while updating the Project Details.  Please contact system administrator";
				break;
				
				
			case "SUC_WK002":
				return "Work Details has been added successfully";
				break;
			case "ERR_WK003":
				return " Error Occured while adding the Work details";
				break;
			case "ERR_WK008":
				return "General Error Occured";
				break;
			case "SUC_WK005":
				return "Successfully deleted the selected Work Details";
				break;
			case "ERR_WK004":
				return "Error occured while deleting the Work Details.  Please contact system administrator";
				break;
			case "SUC_WK008":
				return "Successfully Updated the selected Work Details";
				break;
			case "ERR_WK009":
				return "Error occured while updating the Work Details.  Please contact system administrator";
				break;
				
			case "ERR_SK001":
				return "Skillset already exist!.  Please enter a unique Skillset";
				break;
			case "SUC_SK002":
				return "Skillset added successfully.";
				break;
			case "ERR_SK003":
				return "Error occured while adding new Skillset.  Please contact system administrator";
				break;
			case "ERR_SK004":
				return "Error occured while deleting the Skillset.  Please contact system administrator";
				break;
			case "SUC_SK005":
				return "Successfully deleted the selected Skillset";
				break;
			case "SUC_SK008":
				return "Successfully updated the selected Skillset";
				break;
			case "ERR_SK009":
				return "Error occured while updating the Skillset.  Please contact system administrator";
				break;
			
			case "ERR_FU001":
				return "Error occured while uploading your Resume. The file extension is invalid!";
			case "ERR_FU002":
				return "Error occured while uploading your Resume. The file size exceeds 2MB!";
			case "ERR_FU004":
				return "Error occured while uploading your Resume. Please Contact system administrator";

			default:
				break;
			}
	}
} ?>