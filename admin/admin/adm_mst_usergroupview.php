<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? $gsmodule_code = "T1L1UG";
   include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">
function cancel()
{
	document.location="adm_mst_usergroupsummary.php";
}
</script>

<form name="frmusergroupview" action="adm_mst_usergroupsummary.php" method="post">
<table width="100%" >
   <tr>
	  <td class="headingI">View Staff Group</td>
   </tr>
</table>

  	<? $msSQL = "select usergroup_code, usergroup_name from adm_mst_tusergroup where 
			 usergroup_gid = '$_GET[txtusergroup_gid]'";
	   $rs_usergroup = mysql_query($msSQL,$establish->link);?>
	   
	
				 
	<? while ($row = mysql_fetch_array($rs_usergroup)) { ?>
<table width="80%" align="center">
  <tr>
	<td width="40%" class="labels1">Group Code</td>
	<td width="60%" class="labelsvalues"><?=$row['usergroup_code']?></td>
  </tr>
  <tr>
	<td class="labels1">Group Name</td>
	<td width="60%" class="labelsvalues"><?=$row['usergroup_name']?></td>
  </tr>
</table> 
<? } ?>
<table width="80%" align="center" class="summary">
		<tr>
			<th colspan="2">Set Privilege</th>
		</tr>
		
		<?
			$msSQL="select module_gid from adm_mst_tprivilege where
				   usergroup_gid = '$_GET[txtusergroup_gid]'";
			$rs_selectedmodule = mysql_query($msSQL,$establish->link);

			$arrselectedmodule_gid = "";
			while ($row = mysql_fetch_array($rs_selectedmodule)) {
				$arrselectedmodule_gid = $arrselectedmodule_gid . $row['module_gid'];
			}
			
			$alternaterow = "N";
			$msSQL = "select module_gid, module_name, module_gid_parent,
		 			display_order, module_link from adm_mst_tmodule where 
				 	module_gid_parent = '$' 
					order by display_order";
			$rs_topmenu = mysql_query($msSQL,$establish->link);
			$rowcnt_topmenu = mysql_num_rows($rs_topmenu);

			for($i=0;$i<$rowcnt_topmenu;$i++)
			{
				$arr_topmenu = mysql_fetch_array($rs_topmenu);
				$msSQL = "select module_gid,module_name,module_gid_parent,display_order,
						module_link from adm_mst_tmodule where 
						module_gid_parent = '$arr_topmenu[module_gid]' 
						order by display_order";
				$rs_leftmenuhdr = mysql_query($msSQL,$establish->link);
				$rowcnt_leftmenuhdr = mysql_num_rows($rs_leftmenuhdr); 

				if ($alternaterow == "N") { 
					$tdclass = "";
					$alternaterow = "Y";
				} else { 
					$tdclass =  "class=\"alternate\"";
					$alternaterow = "N";
				}  ?>
				<tr>
					<td <?=$tdclass?> width="40%">
						<img src="../images/plus.gif"><? print $arr_topmenu['module_name'];?>
					</td>
					<td <?=$tdclass?> width="60%">&nbsp;&nbsp;
						<input type="checkbox" class="checkbox"  disabled id="<?=$arr_topmenu['module_gid']."p";?>" 
						name="txtmodule_gid[]" value="<?=$arr_topmenu['module_gid']?>" 
						onClick="checkAll('<?=$arr_topmenu['module_gid']?>',this)"
						<? if (strpos($arrselectedmodule_gid,$arr_topmenu['module_gid']) !== false) { ?>
							checked >
						<? } else { ?>
							
						<? } ?>
					</td>
				</tr>	
				<?			
					for($j=0;$j<$rowcnt_leftmenuhdr;$j++)
					{
						$arr_leftmenuhdr = mysql_fetch_array($rs_leftmenuhdr);
						$msSQL = "select module_gid,module_name,module_gid_parent,display_order,
								module_link from adm_mst_tmodule where 
								module_gid_parent = '$arr_leftmenuhdr[module_gid]' 
								order by display_order";
						$rs_leftmenu = mysql_query($msSQL,$establish->link);
						$rowcnt_leftmenu = mysql_num_rows($rs_leftmenu);
						
						$haspt = $arr_leftmenuhdr['module_gid_parent'] . "-" . $arr_leftmenuhdr['module_gid']."-";
																								
						if ($alternaterow == "N") { 
							$tdclass = "";
							$alternaterow = "Y";
						} else { 
							$tdclass =  "class=\"alternate\"";
							$alternaterow = "N";
						} ?>
						<tr>
							<td <?=$tdclass?> width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<img src="../images/minus.gif"><? print $arr_leftmenuhdr['module_name'];?>
							</td>
							<td <?=$tdclass?> width="60%">&nbsp;&nbsp;
								<input type="checkbox" class="checkbox" id="<?=$haspt?>"
								name="txtmodule_gid[]"  disabled value="<?=$arr_leftmenuhdr['module_gid']?>" 
								onClick="checkparent('<?=$rowcnt_leftmenuhdr?>','<?=$arr_topmenu['module_gid']?>',this)"
								<? if (strpos($arrselectedmodule_gid,$arr_leftmenuhdr['module_gid']) !== false) { ?>
									checked >
								<? } else { ?>
									
								<? } ?>
							</td>
						</tr>	
						<? for($k=0;$k<$rowcnt_leftmenu;$k++)
						{
							$arr_leftmenu = mysql_fetch_array($rs_leftmenu);

							$chd = $arr_topmenu['module_gid']."-".$arr_leftmenu['module_gid_parent']."-".$arr_leftmenuhdr['module_gid'];

							if ($alternaterow == "N") { 
								$tdclass = "";
								$alternaterow = "Y";
							} else { 
								$tdclass =  "class=\"alternate\"";
								$alternaterow = "N";
							} ?>
							<tr>
								<td <?=$tdclass?> width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<img src="../images/minus.gif"><? print $arr_leftmenu['module_name'];?>
								</td>
								<td <?=$tdclass?> width="60%">&nbsp;&nbsp;
									<input type="checkbox"  disabled class="checkbox" 
									value="<?=$arr_leftmenu['module_gid'];?>"
									name="txtmodule_gid[]" id="<?=$chd?>" 
									onClick="checkchild('<?=$arr_topmenu['module_gid']?>',this,'<?=$arr_leftmenuhdr['module_gid']?>')"
									<? if (strpos($arrselectedmodule_gid,$arr_leftmenu['module_gid']) !== false) { ?>
										checked >
									<? } else { ?>
										
									<? } ?>
								</td>
							</tr>	
						<? } ?>
					<? }
				?>
			<? } 
		?>
	</table>
	<table width="100%" align="center">
		<tr>
			<td align="center">
				<input type="submit"  class="button" value="Back" onclick="return cancel();">
			</td>
		</tr>
	</table>
</form>
<? include("../system/sys_cmn_footer.php"); ?>