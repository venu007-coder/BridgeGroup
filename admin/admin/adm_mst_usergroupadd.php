<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? $gsmodule_code = "T1L1UG";      
   include("../system/sys_cmn_frame.php"); ?>

<script language="javascript" src="../system/sys_js_validate.js"></script>

<script language="javascript">

function dosubmit(form)
{
	if (form.txtusergroup_code.value == "")
	{
		alert("Enter User Group Code");
		form.txtusergroup_code.focus();
		return false;
	}
	
	if(form.txtusergroup_name.value == "")
	{
		alert("Enter User Group Name");
		form.txtusergroup_name.focus();
		return false;
	}
	
	form.submit();
}
		
function cancel()
{
	document.location="adm_mst_usergroupsummary.php";
}

function ToggleAll(e) 
{
	   for(var x = 0; x < document.frmusergroupadd.elements.length; x++ ) 
	   {	 
		var y = document.frmusergroupadd.elements[x]; 
	     if( y.name != 'CHECKALL') {
			y.checked = document.frmusergroupadd.CHECKALL.checked; 
		}
	   } 
}

function checkparent(nochild,parentid,objcheck,rowschild)
{
	  isparentcheck(parentid);
	  var c=0;var a=0;var b=0;
	  var inputs = document.getElementsByTagName("input");
	  for(index = 0; index <inputs.length ; index++)
	 {
		var link_val=inputs[index].id;
		var val=link_val.split("-");
		if(val[1] == objcheck.value)
		{ 
			if(objcheck.checked)
			{ 
				inputs[index].checked = 1;
			} else {
				inputs[index].checked = 0;
			}
		}
		if(val[0] == parentid)
		{
			c=c+1; 
			if (inputs[index].checked==true)
			{
				a=a+1;
			} else {
				b=b+1;
			}
		}
	}	  // end of for loop
		// unchecking everything if they were checked before
	if(b==c)
	{
		for(index = 0; index <inputs.length ; index++){
			if (inputs[index].id == parentid+"p")
			{
				inputs[index].checked =0;	
			 }
		 }
	}
} 

function isparentcheck(parentid)
{
	  var inputs = document.getElementsByTagName("input");
	  for(index = 0; index < inputs.length; index++)
		  {
				/*   To check parent by default        */
				if(inputs[index].id == parentid+"p"){
				if(inputs[index].checked ==0){
				inputs[index].checked = 1;
						  }
				if(inputs[index].checked ==1){
				inputs[index].checked = 1;  }
					 }
			} // end of for loop
}

function checkchild(parentid,objcheck,hasparent)
{
	var c=0;var a=0;var b=0;var child=0;var nochild=0;var hasch=0;
	var inputs = document.getElementsByTagName("input");
	isparentcheck(parentid);
	for(index = 0; index <inputs.length ; index++)
	{
		var link_val=inputs[index].id;
		var val=link_val.split("-");
		if(val[2]==hasparent){b=b+1; if(inputs[index].checked==true){c=c+1;}else{a=a+1;}}
		if(inputs[index].value==hasparent) { if(objcheck.checked) { inputs[index].checked=1;}
	}
	if(val[0]==parentid)
	{child=child+1; if(inputs[index].checked==true){hasch=hasch+1;}else{nochild=nochild+1;}}
	}
	if(a==b)
	{
		for(index = 0; index <inputs.length ; index++)
		{
			if(inputs[index].value==hasparent)
			{
			inputs[index].checked =0;	
			}
		}
	}
	if(nochild==child-1)
	{
		for(index = 0; index <inputs.length ; index++){
		 if(inputs[index].id == parentid+"p"){
		inputs[index].checked =0;	}
		}
	}
}
function checkAll(checkWhat,objcheck) 
{
	// Find all the checkboxes...
	var inputs = document.getElementsByTagName("input");
	// Loop through all form elements (input tags)
  	for(index = 0; index < inputs.length; index++)
	{
		// ...if it's the type of checkbox we're looking for, toggle its checked status
		var link_val=inputs[index].id;
		var val=link_val.split("-");
		if(val[0]== checkWhat)
		if(objcheck.checked){
		inputs[index].checked = 1;
		}
		else
		{
			inputs[index].checked = 0;
		}  
	}
}
</script>
<form name="frmusergroupadd" action="adm_mst_usergroupaddcfm.php" method="post">

	<table width="100%">
		<tr>
			<td class="headingI">Add Staff Group</td>
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
			
	<table width="80%" align="center">
		<tr>
			<td width="40%" class="labels1">Group Code</td>
			<td width="40%" >
			<? if (isset($_POST['txtusergroup_code'])) { ?>
				<input type="text" name="txtusergroup_code" class="textbox_code" value="<?=$_POST['txtusergroup_code']?>">
				<label class="mandatory">*</label>
			<? } else { ?>
				<input type="text" name="txtusergroup_code" class="textbox_code">
				<label class="mandatory">*</label>
			<? } ?>
			</td>
		</tr>
		<tr>
			<td class="labels1">Group Name</td>
			<td width="40%" class="labels">
				<? if (isset($_POST['txtusergroup_name'])) { ?>
					<input type="text" name="txtusergroup_name" class="textbox_name" value="<?=$_POST['txtusergroup_name']?>">
					<label class="mandatory">*</label>
				<? } else { ?>
					<input type="text" name="txtusergroup_name" class="textbox_name">
					<label class="mandatory">*</label>
				<? } ?>
			</td>
		</tr>
	</table>

	<table width="80%" align="center" class="summary">
		<tr>
			<th colspan="2">Set Privilege</th>
		</tr>
		<tr bgcolor="class=\"alternate\"";>
			<td class="alternate" align="right"><b>Select All</b>&nbsp;&nbsp;&nbsp;</td>
			<td class="alternate" >&nbsp;&nbsp
				<input name="CHECKALL" type="checkbox" class="checkbox" 
				onClick="ToggleAll(this);">
			</td>
		</tr>	
		<?
			$alternaterow = "N";
			$msSQL = "select module_gid,module_name,module_gid_parent,
		 			display_order,module_link from adm_mst_tmodule where 
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
						
						<input type="checkbox" class="checkbox" id="<?=$arr_topmenu['module_gid']."p";?>" 
						name="txtmodule_gid[]" value="<?=$arr_topmenu['module_gid']?>" 
						onClick="checkAll('<?=$arr_topmenu['module_gid']?>',this)">
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
								name="txtmodule_gid[]" value="<?=$arr_leftmenuhdr['module_gid']?>" 
								onClick="checkparent('<?=$rowcnt_leftmenuhdr?>','<?=$arr_topmenu['module_gid']?>',this)">
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
									<input type="checkbox" class="checkbox" 
									value="<?=$arr_leftmenu['module_gid'];?>"
									name="txtmodule_gid[]" id="<?=$chd?>" 
									onClick="checkchild('<?=$arr_topmenu['module_gid']?>',this,'<?=$arr_leftmenuhdr['module_gid']?>')">
								</td>
							</tr>	
						<? } ?>
					<? }
				?>
			<? } 
		?>
	</table>		
	<table width="100%"	 align="center">
		<tr>
			<td colspan="2" align="center">	
				<input type="button" value="Submit" class="button" onClick="dosubmit(this.form);">
				<input type="button" value="Cancel" class="button" onClick="return cancel();">
			</td>
		</tr>
	</table>  
</form>
<? 	include("../system/sys_cmn_footer.php"); ?>
