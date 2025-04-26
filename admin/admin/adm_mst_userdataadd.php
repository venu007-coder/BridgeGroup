<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? $gsmodule_code = "T1L1UD";
   include("../system/sys_cmn_frame.php"); ?>

<script language="javascript" src="../system/sys_js_validate.js"></script>
<script language="javascript">
function dosubmit(form)
{
	  if (form.txtuserdata_name.value == "")
	  {
		alert("Enter User Data Name");
		form.txtuserdata_name.focus();
		return false;
	   }
	   if(form.txtseq_no.value == "") 
	   {
		alert("Enter  the Sequence No");
		form.txtseq_no.focus();
		return false;
	    }
		if (isnumeric(form.txtseq_no) == false) {
			alert("Please enter a numeric value");
			form.txtseq_no.value = "";
			form.txtseq_no.focus();
			return false;
		}
	   if(form.txtdisplay_order.value == "")
	   {
		alert("Enter the Display Order");
		form.txtdisplay_order.focus();
		return false;
	   }
     	if (isnumeric(form.txtdisplay_order) == false) {
			alert("Please enter a numeric value");
			form.txtdisplay_order.value = "";
			form.txtdisplay_order.focus();
			return false;
		}
		form.submit();
}			
function cancel()
{
	 document.location="adm_mst_userdatasummary.php";
}
</script>

<form name="frmuserdataadd" action="adm_mst_userdataaddcfm.php" method="post">
<table width="100%">
	<tr>
		<td class="headingI" >Add User Data</td>
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

<table width="80%" align="center">
	<tr>
		<td class="labels" width="40%">User Data Name</td>
		<td width="40%">
		  <? if (isset($_POST['txtuserdata_name'])) { ?>
			<input type="text" name="txtuserdata_name" class="textbox_name" value="<?=$_POST['txtuserdata_name']?>">
		  <? } else { ?>
			<input type="text" name="txtuserdata_name" class="textbox_name">
		  <? } ?>
 			<label class="mandatory">*</label>
		</td>
	</tr>
	<tr>
		<td class="labels">Sequence No</td>
		<td>
		 <? if (isset($_POST['txtseq_no'])) { ?>
			<input type="text" name="txtseq_no" class="textbox_number" value="<?=$_POST['txtseq_no']?>">
		  <? } else { ?>
			<input type="text" name="txtseq_no" class="textbox_number">
		  <? } ?>
 			<label class="mandatory">*</label>
		 </td>
	</tr>
	<tr>
		<td class="labels">Display Order</td>
		<td>
		  <? if (isset($_POST['txtdisplay_order'])) { ?>
		    <input type="text" name="txtdisplay_order" class="textbox_number" value="<?=$_POST['txtdisplay_order']?>">
		  <? } else { ?>
		    <input type="text" name="txtdisplay_order" class="textbox_number">
		  <? } ?>
 			<label class="mandatory">*</label>
		</td>
	</tr>
	<tr>
		<td  colspan="2"align="center">
			<input type="button" value="Submit" class="button" onClick="dosubmit(this.form)">
			<input type="button" value="Cancel" class="button" onClick="return cancel();">
		</td>
	</table>
</form>
<? include("../system/sys_cmn_footer.php"); ?>