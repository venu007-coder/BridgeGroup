<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? $gsmodule_code = "T1L1US";
   include("../system/sys_cmn_frame.php"); ?>

<script>
function dosubmit(form)
{
	if(form.txtuser_firstname.value == "")
	{
		alert("Enter First Name");
		form.txtuser_firstname.focus();
		return false;
	}
	form.submit();
}
		
function cancel()
{
	document.location="adm_mst_usersummary.php";
}

</script>

<form name="frmuseredit" action="adm_mst_usereditcfm.php" method="post">
	<table width="100%" >
		<tr>
			<td class="headingI">Edit Staff</td>
		</tr>
	</table>

	<? if (isset($_GET['msgcode'])) { 
		$msgtype = substr($_GET['msgcode'],0,3); ?>
		<table align="center" width="80%">
			<tr>
				<? if ($msgtype == "ERR") { ?>
					<td class="warning"><? print $objdb_function->getmsg($_GET['msgcode']);?></td>
				<? } else { ?>
					<td class="success"><? print $objdb_function->getmsg($_GET['msgcode']);?></td>
				<? } ?>
			</tr>
		</table>
	<? } ?>
	<?	
		$msSQL = "select usergroup_gid, usergroup_name from adm_mst_tusergroup";
		$rs_usergroup = mysql_query($msSQL,$establish->link);
	
		$msSQL = " select a.usergroup_gid,a.user_code,a.user_firstname,a.user_lastname,
				   a.status,b.address_gid from
			       adm_mst_tuser a,adm_mst_taddress b 
				   where a.address_gid = b.address_gid and a.user_gid='$_GET[txtuser_gid]' ";
	    
		$rs_user = mysql_query($msSQL,$establish->link);
		$arr_user = mysql_fetch_array($rs_user);

		$msSQL = "select country_gid, country_code, country_name from adm_mst_tcountry";		
		$rs_presentcountry = mysql_query($msSQL,$establish->link);
	?>

	  <table width="80%" align="center">
		  <tr>
			<td class="labels1">Group Name</td>
			  <td>
				 <select name="cbousergroup" class="cbobox">
				    <? while ($row = mysql_fetch_array($rs_usergroup)) { ?>
				    <? if ($arr_user['usergroup_gid'] == $row['usergroup_gid']) { ?>
						 <option selected value="<?=$row['usergroup_gid'];?>"><? print $row['usergroup_name'];?></option> 
					 <? } else { ?>
					  <option value="<?=$row['usergroup_gid'];?>"><? print $row['usergroup_name'];?></option> 
					 <? } ?>
				    <? } ?>
				 </select>
				 <label class="mandatory">*</label>
			   </td>
		   </tr>
		   <tr>
			  <td width="40%" class="labels1">User Code</td>
			  <td width="60%" >
				<input type="text" name="txtuser_code" readonly class="textbox_code" value="<?=$arr_user['user_code']?>">
			  </td>
		   </tr>
		
		   <tr>
			  <td class="labels1">First Name</td>
			  <td width="40%" class="labels">
				<input type="text" name="txtuser_firstname" class="textbox_name" value="<?=$arr_user['user_firstname']?>">
				<label class="mandatory">*</label>
			  </td>
		   </tr>
		   <tr>
			  <td class="labels1">Last Name</td>
			  <td width="40%" class="labels">
				<input type="text" name="txtuser_lastname" class="textbox_name" value="<?=$arr_user['user_lastname']?>">
			  </td>
		   </tr>
		  
		<? $msSQL = "select address_gid,address1, address2, city, state, postalcode, country_gid from adm_mst_taddress 
					 where address_gid = '$arr_user[address_gid]'";
			$rs_address = mysql_query($msSQL, $establish->link);  
			$arr_presentaddress = mysql_fetch_array($rs_address);?>
			
		<tr>
			<td class="labels1">Present Address</td>
		</tr>
		<tr>
			<td class="labels1">Address 1</td>
			<td>
				<input type="hidden" name="txtpresentaddress_gid" value="<?=$arr_presentaddress['address_gid']?>">
				<input type="text" name="txtpresent_address1" class="textbox_long" value="<?=$arr_presentaddress['address1']?>">
			</td>
		</tr>
		<tr>
			<td  class="labels1">Address 2</td>
			<td>
				<input type="hidden" name="txtpresentaddress_gid" value="<?=$arr_presentaddress['address_gid']?>">
				<input type="text" name="txtpresent_address2" class="textbox_long" value="<?=$arr_presentaddress['address2']?>">
			</td>
		</tr>
		<tr>
			<td class="labels1">Country</td>
			<td>
				<select name="cbopresentcountry" class="cbobox">
				   <option value="">Please Select</option>
					 <? while ($row = mysql_fetch_array($rs_presentcountry)) { ?>
					 	<? if ($row['country_gid'] == $arr_presentaddress['country_gid']) { ?>
						 	<option selected value="<?=$row['country_gid'];?>"><? print $row['country_name'];?></option> 
						<? } else { ?>
						 	<option value="<?=$row['country_gid'];?>"><? print $row['country_name'];?></option> 
						<? } ?>
					<? } ?>					
				</select>
			</td>
		</tr>
		<tr>
			<td class="labels1">Postal Code</td>
			<td>
				<input type="text" name="txtpresent_postalcode" class="textbox_number" value="<?=$arr_presentaddress['postalcode']?>">
			</td>
		</tr>
		   <tr>
			  <td class="labels1">Status</td>
			  <?
				if($arr_user['status']==1)
				{ ?>
					<td class="radio">
					    <input type="radio" name="rdostatus" value="1" checked>Active
					    <input type="radio" name="rdostatus" value="0">Inactive
					</td>
			  	<? }
				else
				{
				   ?>
					<td class="radio">
					    <input type="radio" name="rdostatus" value="1">Active
					    <input type="radio" name="rdostatus" value="0" checked>Inactive
				   <? } ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">	
				  <input type="hidden" name="txtuser_gid" value="<?=$_GET['txtuser_gid']?>">
				  <input type="button" value="Update" class="button" onClick="dosubmit(this.form);">
				  <input type="button" value="Cancel" class="button" onClick="return cancel();">
				</td>
			</tr>
		</table>
<? 	include("../system/sys_cmn_footer.php"); ?>