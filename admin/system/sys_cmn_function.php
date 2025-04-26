<?
class db_functions
{	
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
		$msSQL = "select sequence_gid, sequence_code, 
						sequence_name, sequence_curval, 
						sequence_format from adm_mst_tsequence 
					where 
						sequence_code = '$sequence_code'";
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

	function getnum_setting_remote($sequence_code, $establish, $client_gid , $prefix_code)
	{
		$msSQL = "select 
					sequence_gid, sequence_code, sequence_name, 
					sequence_curval, sequence_format 
					from adm_mst_tsequence where 
						sequence_code = '$sequence_code' and 
						client_gid = '$client_gid'";
		print $msSQL;
		$rs_sequence = mysql_query($msSQL,$establish->link);
		$arr_sequence = mysql_fetch_array($rs_sequence);
		mysql_free_result($rs_sequence);

		$lsseqno = $arr_sequence['sequence_curval'] + 1;
		
		$lstemporder_gid = $this->leading_zero($lsseqno, $arr_sequence['sequence_format'], $arr_sequence['sequence_code']);

		$msSQL = "update adm_mst_tsequence set 
						sequence_curval = $lsseqno where 
						sequence_code = '$sequence_code' and 
						client_gid = '$client_gid'";			
		$rs_upsequence = mysql_query($msSQL,$establish->link);
		return $prefix_code . $lstemporder_gid;
	}

	function dosendmail($from,$to, $subject, $message) {
		$headers1 = "MIME-Version: 1.0\r\n";
		$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers1 .= "To: ".$to."\r\n";
		$headers1 .= "From: ".$from."\r\n";
		$headers1 .= "Reply-To: ".$from."\r\n";
		return mail($to, $subject, $message, $headers1);
	}
	

	function insaddress($address1, $address2, $country, $postalcode, $address_establish) {
		$msGetGID = $this->getnum_setting("AD",$address_establish);
		$msSQL = "insert into adm_mst_taddress ( 	address_gid, 
													address1, 
													address2, 
													country_gid, 
													postalcode) values 
				 ('$msGetGID','$address1','$address2','$country','$postalcode')";
		$blnsuccess = mysql_query($msSQL,$address_establish->link);
		return $msGetGID;
	}
	
	function updaddress($address_gid, $address1, $address2, $country, $postalcode, $address_establish) {
		$msSQL = "update adm_mst_taddress set 
					address1 = '$address1',
					address2 = '$address2', 
					country_gid = '$country', 
					postalcode = '$postalcode'
				 where 
				 	address_gid = '$address_gid'";
		$blnsuccess = mysql_query($msSQL,$address_establish->link);
		return $blnsuccess;
	}

	function insaddress_remote(	$address1, 
								$address2, 
								$country, 
								$postalcode, 
								$address_establish, 
								$client_gid,
								$prefix_code) {
		$msGetGID = $this->getnum_setting_remote("AD",$address_establish, $client_gid, $prefix_code);
		$msSQL = "insert into adm_mst_taddress (address_gid, address1, address2, country_gid, postalcode) values 
				 ('$msGetGID','$address1','$address2','$country','$postalcode')";
		$blnsuccess = mysql_query($msSQL,$address_establish->link);
		return $msGetGID;
	}
	
	function insaddress_remoteams (	$address1, 
									$address2, 
									$country, 
									$postalcode, 
									$address_establish,
									$local_establish) {
		$msGetGID = "AM" . $this->getnum_setting("AD",$local_establish);
		$msSQL = "insert into adm_mst_taddress (address_gid, address1, address2, country_gid, postalcode) values 
				 ('$msGetGID','$address1','$address2','$country','$postalcode')";
		$blnsuccess = mysql_query($msSQL,$address_establish->link);
		return $msGetGID;
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
	
	
			case "ERR_UR001":
				return "User Code already exist!.  Please enter a unique User Code";
				break;
			case "SUC_UR002":
				return "User Code added successfully.";
				break;
			case "ERR_UR003":
				return "Error occured while adding new User.  Please contact system administrator";
				break;
			case "ERR_UR004":
				return "Error occured while deleting the User  . Please contact system administrator";
				break;
			case "SUC_UR005":
				return "Successfully deleted the selected User ";
				break;
			case "ERR_UR006";
				return "You can't Delete Sysadmin User";
				break;	
			case "SUC_UR008":
				return "Successfully updated the selected User ";
				break;
			case "ERR_UR009":
				return "Error occured while updating the User . Please contact system administrator";
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
				
	
			case "ERR_CS001":
				return "Customer Code or Prefix code already exist!.  Please enter a unique Customer Code or prefix code";
				break;
			case "SUC_CS002":
				return "Customer added successfully.";
				break;
			case "ERR_CS003":
				return "Error occured while adding new Customer.  Please contact system administrator";
				break;
			case "ERR_CS004":
				return "Error occured while deleting the Customer.  Please contact system administrator";
				break;
			case "SUC_CS005":
				return "Successfully deleted the selected Customer";
				break;
			case "SUC_CS006":
				return "Successfully updated the selected Customer";
				break;
			case "ERR_CS007":
				return "Error occured while updating the Customer.  Please contact system administrator";
				break;
			case "SUC_CS008":
				return "Successfully updated the selected Customer";
				break;
			case "ERR_CS009":
				return "Error occured while updating the Customer.  Please contact system administrator";
				break;
			case "ERR_CS010":
				return "You Cannot Delete this Customer. Order has been Raised";
				break;
			
			
			case "ERR_PR001":
				return "Customer Code or Prefix code already exist!.  Please enter a unique Customer Code or prefix code";
				break;
			case "SUC_PR002":
				return "Customer added successfully.";
				break;
			case "ERR_PR003":
				return "Error occured while adding new Customer.  Please contact system administrator";
				break;
			case "ERR_PR004":
				return "Error occured while deleting the Customer.  Please contact system administrator";
				break;
			case "SUC_PR005":
				return "Successfully deleted the selected Customer";
				break;
			case "SUC_PR006":
				return "Successfully updated the selected Customer";
				break;
			case "ERR_PR007":
				return "Error occured while updating the Customer.  Please contact system administrator";
				break;
			case "SUC_PR008":
				return "Successfully updated the selected Customer";
				break;
			case "ERR_PR009":
				return "Error occured while updating the Customer.  Please contact system administrator";
				break;
			case "ERR_PR010":
				return "You Cannot Delete this Customer. Order has been Raised";
				break;


			case "SUC_TM001":
				return "Task Manager added successfully.";
				break;	
			case "ERR_TM002":
				return "Error occured while adding new Task Manager.  Please contact system administrator";
				break;
			case "SUC_TM003":
				return "Successfully updated the selected Task Manager";
				break;
			case "ERR_TM004":
				return "Error occured while updating the Task Manager.  Please contact system administrator";
				break;
				
			case "ERR_FU001":
				return "Error occured while uploading your File. The file extension is invalid!";
			case "ERR_FU002":
				return "Error occured while uploading your File. The file size exceeds 2MB!";
			case "ERR_FU004":
				return "Error occured while uploading your File. Please Contact system administrator";
			default:
				break;
				
			case "SUC_AM001":
				return "Active Manager added successfully.";
				break;	
			case "ERR_AM002":
				return "Error occured while adding new Active Manager.  Please contact system administrator";
				break;
			case "SUC_AM003":
				return "Successfully updated the selected Active Manager";
				break;
			case "ERR_AM004":
				return "Error occured while updating the Active Manager.  Please contact system administrator";
				break;
		
			case "ERR_GL001":
				return "Guideline Code already exist!.  Please enter a unique Guideline code";
				break;
			case "SUC_GL002":
				return "Guideline Code added successfully.";
				break;
			case "ERR_GL003":
				return "Error occured while adding new Guideline.  Please contact system administrator";
				break;
			case "ERR_GL004":
				return "Error occured while deleting the Guideline.  Please contact system administrator";
				break;
			case "SUC_GL005":
				return "Successfully deleted the selected Guideline";
				break;
			case "SUC_GL008":
				return "Successfully updated the selected Guideline";
				break;
			case "ERR_GL009":
				return "Error occured while updating the Guideline.  Please contact system administrator";
				break;
			
			case "ERR_GS001":
				return "Guideline Subcategory Code already exist!.  Please enter a unique Guideline Subcategory code";
				break;
			case "SUC_GS002":
				return "Guideline Subcategory Code added successfully.";
				break;
			case "ERR_GS003":
				return "Error occured while adding new Guideline Subcategory.  Please contact system administrator";
				break;
			case "ERR_GS004":
				return "Error occured while deleting the Guideline Subcategory.  Please contact system administrator";
				break;
			case "SUC_GS005":
				return "Successfully deleted the selected Guideline Subcategory";
				break;
			case "SUC_GS008":
				return "Successfully updated the selected Guideline Subcategory";
				break;
			case "ERR_GS009":
				return "Error occured while updating the Guideline Subcategory.  Please contact system administrator";
				break;
				
			case "ERR_GC001":
				return "Guideline Category Code already exist!.  Please enter a unique Guideline Category code";
				break;
			case "SUC_GC002":
				return "Guideline Category Code added successfully.";
				break;
			case "ERR_GC003":
				return "Error occured while adding new Guideline Category.  Please contact system administrator";
				break;
			case "ERR_GC004":
				return "Error occured while deleting the Guideline Category.  Please contact system administrator";
				break;
			case "SUC_GC005":
				return "Successfully deleted the selected Guideline Category";
				break;
			case "SUC_GC008":
				return "Successfully updated the selected Guideline Category";
				break;
			case "ERR_GC009":
				return "Error occured while updating the Guideline Category.  Please contact system administrator";
				break;
				
			case "ERR_PA001":
				return "Customer Code or Prefix code already exist!.  Please enter a unique Customer Code or prefix code";
				break;
			case "SUC_PA002":
				return "User Activity added successfully.";
				break;
			case "ERR_PA003":
				return "Error occured while adding new Project Activity .  Please contact system administrator";
				break;
			case "ERR_PA004":
				return "Error occured while deleting the user Activity .  Please contact system administrator";
				break;
			case "SUC_PA005":
				return "Successfully deleted the selected user Activity ";
				break;
			case "SUC_PA006":
				return "Successfully updated the selected user Activity ";
				break;
			case "ERR_PA007":
				return "Error occured while updating the user Activity .  Please contact system administrator";
				break;
			case "SUC_PA008":
				return "Successfully updated the selected user Activity ";
				break;
			case "ERR_PA009":
				return "Error occured while updating the user Activity .  Please contact system administrator";
				break;

									
		}
	}
} 
class Pager  
   {  
       function getPagerData($numHits, $limit, $page)  
       {  
           $numHits  = (int) $numHits;  
           $limit    = max((int) $limit, 1);  
           $page     = (int) $page;  
           $numPages = ceil($numHits / $limit);  
           $page = max($page, 1);  
           $page = min($page, $numPages);  
           $offset = ($page - 1) * $limit;  
           $ret = new stdClass;  
           $ret->offset   = $offset;  
           $ret->limit    = $limit;  
           $ret->numPages = $numPages;  
           $ret->page     = $page;  
           return $ret;  
       }  
   }  
?>