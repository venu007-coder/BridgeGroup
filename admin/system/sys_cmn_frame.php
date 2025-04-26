<html>
<head>
	<title><?=$browser_title?></title>
	<script language="javascript">
		var pre=null;
		var objMenu=null;
		function hideall(getallmenus)
		{
			var menus = getallmenus;
			var menuarray=menus.split(",");
			arraylength=menuarray.length - 1;
			for(i=0;i<arraylength;i++)
			{
				objMenu=document.getElementById(menuarray[i])
				objMenu.style.display="none"
			}
		}
		
		function expandmenu(vid)
		{
			var objMenu
			objMenu=document.getElementById(vid)
			if(pre)
				pre.style.display="none"
			if (objMenu)
			{
				objMenu.style.display=""
				pre=objMenu;
			}	
		}
	</script>
	
</head>

<body>

<? 	include("../system/sys_cmn_header.php");  ?>

<table width="100%" class="topmenu">
	<tr>
	<? 
		$msSQL = " SELECT distinct d.module_gid, d.module_name, d.module_code,
							 d.module_link, d.module_gid_parent,d.status FROM 
							adm_mst_tusergroup b, adm_mst_tprivilege c, adm_mst_tmodule d WHERE 
							d.module_gid = c.module_gid AND 
							b.usergroup_gid = c.usergroup_gid AND 
							c.usergroup_gid = '$_SESSION[usergroup_gid]' and 
							d.module_gid_parent = '$' AND
							d.status = '1'";
		$rs_topmenu = mysql_query($msSQL,$establish->link);
		$lstop_parent = "";
		while ( $arr_topmenu = mysql_fetch_array($rs_topmenu) ) 
		{ ?>			
			<td align="left">
				<a class="topmenu" href="../system/sys_trn_welcome.php?module_code=<? echo $arr_topmenu['module_code'];?>"><? print $arr_topmenu['module_name'] ?></a>
			</td>
			<?
			if (substr($gsmodule_code,0,2) == $arr_topmenu['module_code']) {
				$lstop_parent = $arr_topmenu['module_gid'];			
			}
		}  
		mysql_free_result($rs_topmenu); 
		?>
		<td align="left"><a class="topmenu" href = "../system/sys_cmn_logout.php">Logout</a></td>
	</tr>
</table>

<table width="100%" height="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td height="100%" valign="top" class="menustyle">
			<table class="leftmenu">
				<?
				$msSQL = " SELECT distinct d.module_gid, d.module_name, d.module_code,
									 d.module_link, d.module_gid_parent,d.status FROM 
									adm_mst_tusergroup b, adm_mst_tprivilege c, adm_mst_tmodule d WHERE 
									d.module_gid = c.module_gid AND 
									b.usergroup_gid = c.usergroup_gid AND 
									c.usergroup_gid = '$_SESSION[usergroup_gid]' and 
									d.module_gid_parent = '$lstop_parent' and
									d.status = '1'";
				$rs_leftmenuhdr = mysql_query($msSQL,$establish->link);
							
				$lsleftmenuhdr = "";
			  	$lsexpandmenu = "";
				while ($arr_leftmenuhdr = mysql_fetch_array($rs_leftmenuhdr) ) { 
				  	$lsleftmenuhdr = $lsleftmenuhdr . $arr_leftmenuhdr['module_gid'] . ",";
					if (strlen($gsmodule_code) > 2) {
						if (substr($gsmodule_code,2,2) == $arr_leftmenuhdr['module_code']) {
							$lstop_parent = $arr_topmenu['module_gid'];			
							$lsexpandmenu = "expandmenu('" . $arr_leftmenuhdr['module_gid'] . "');";
						}
					}
				?>
					<tr>
						<th>
							<a href="javascript:expandmenu('<?=$arr_leftmenuhdr['module_gid'] ?>')" class="leftmenunav"><? print $arr_leftmenuhdr['module_name'] ?></a>
						</th>
					</tr>
					<tr>
						<td>
							<table class="leftmenu" id="<? echo $arr_leftmenuhdr['module_gid'] ?>">
							<? 	$msSQL = " SELECT distinct d.module_gid, d.module_name, d.module_code, 
												d.module_link,d.status FROM 
												adm_mst_tusergroup b, adm_mst_tprivilege c, adm_mst_tmodule d WHERE 
												d.module_gid = c.module_gid AND 
												b.usergroup_gid = c.usergroup_gid AND 
												c.usergroup_gid = '$_SESSION[usergroup_gid]' and 
												d.module_gid_parent = '$arr_leftmenuhdr[module_gid]' AND
												d.status = '1'
												order by d.display_order";
								$rs_leftmenu = mysql_query($msSQL,$establish->link);

								while ($arr_leftmenu = mysql_fetch_array($rs_leftmenu) ) 
								{ ?>
									<tr>
										<td>
											<a class="leftmenu" href="<? print $arr_leftmenu['module_link'] ?>"><? print $arr_leftmenu['module_name'] ?></a>
										</td>
									</tr>
								<? } ?>
							</table>
						</td>
					</tr>
				<? } ?>					
			</table>
		</td>

		<script language="javascript">
			hideall('<?=$lsleftmenuhdr?>');
			<?=$lsexpandmenu?>
		</script>

		<!-- Work area Start--->
		<td valign="top">
