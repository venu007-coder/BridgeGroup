<? include("../system/sys_cmn_validate.php"); ?>
<LINK href="../include/ss_stylesheet.css" type="text/css" rel="stylesheet">
<? include("../system/sys_cmn_frame.php"); ?>

<script language="javascript">

function changepassword() 

{
	if( (document.changepassword.txt_newpassword.value) != (document.changepassword.txt_confirmpassword.value) )

	{

		alert("Your passwords do not match!");
		document.changepassword.txt_confirmpassword.value="";				
		document.changepassword.txt_confirmpassword.focus();
		return false;

	}
		return true;
}

function validatefrm()

	{
		if (document.changepassword.txt_oldpassword.value=="")

		{
			alert("Please enter Old Password");
			document.changepassword.txt_oldpassword.focus();
			return false;

		}

			if (document.changepassword.txt_newpassword.value=="")

		 {
			  alert("Please enter New Password");
			  document.changepassword.txt_newpassword.focus();
			  return false;
		 }

			  if (document.changepassword.txt_newpassword.value==document.changepassword.txt_oldpassword.value)

		 {

			  alert("New Password and Old Password should not be the same");
			  document.changepassword.txt_newpassword.value="";
			  document.changepassword.txt_newpassword.focus();
			  return false;

		 }
			  if(document.changepassword.txt_confirmpassword.value=="") 
		 {
			  alert("Please enter Confirm Password");
			  document.changepassword.txt_confirmpassword.focus();
			  return false;
		}	 

	}

function focusing()

	   {

			 document.changepassword.txt_oldpassword.focus();

	   }

function cancel()

	   {

			 document.location="adm_mst_welcome.php?&menu=maintenance";

	   }

function cancelling()

	   {

			 changepassword.reset();

			 return false;

		}

</script>

<table width="100%" align="center">
	<tr>
		<td class="headingI"> Change Password </td>
	</tr>
</table>

<form name="changepassword"  method="post" action="adm_mst_chanpasswordcfm.php" onSubmit="return validatefrm();" >

  <!--first table starts here-->

  

   <table width="70%" border="0" align="center" class="Blueborder">

    <tr> 

      <td class="HEDER" align="center">Change Password</td>

    </tr>

    <tr>

	<td align="center" class="success" ><? if(isset($msg)) { print $msg; }?></td>

	</tr>

    <tr> 

      <td valign="top"> 

        <!--second table srts here-->

        <table  cellspacing="0" cellpadding="0" align="center" class="forms">

		

          <tr> 

            <td align="left" class="label">Old Password</td>

			<td>:</td>

            <td><input type="password"  name="txt_oldpassword" value="" maxlength="20" class="txtbox"><font color="red">*</font></td>

          </tr>

          <tr> 

            <td align="left" class="label">New Password</td>

			<td>:</td>

            <td><input type="password"  name="txt_newpassword" value="" maxlength="20" class="txtbox"><font color="red">*</font></td>

          </tr>

          <tr> 

            <td align="left" class="label">Confirm Password</td>

			<td>:</td>

            <td><input type="password"  name="txt_confirmpassword" onchange="chkpassword();" value="" maxlength="20" class="txtbox"><font color="red">*</font></td>

          </tr>

        </table>

        <!--second table ends here-->

       

        <br> <center>

          <input type="hidden" name="txtuserid" value="<?=$arow[0];?>">

          &nbsp; 

          <input type="submit" class="btn1" value="Update">

          &nbsp; 

          <input type="reset" value="Reset" class="btn1" onClick=""return cancelling();"">

          &nbsp;

          <input type="button" onclick ="return cancel();" value="Cancel" class="btn1">

          

          <br>

        </center></td>

    </tr>

  </table>

</form>

</body>


<table width="100%" >
 <tr>
     <td width="30%"  ></td>
 	 <td width="10%" class="labels">Old Password</td>
	 <td width="2%">:</td>
     <td width="30%">   <input type="text" class="textbox_name">    </td>
	 <td width="30%"   ></td>
  </tr>
  <tr>
     <td width="30%"   ></td>
 	 <td width="10%" class="labels">New Password</td>
	 <td width="2%">:</td>
     <td width="30%">   <input type="text" class="textbox_name">    </td>
	 <td width="30%"   ></td>
  </tr>
  <tr>
     <td width="30%"   ></td>
 	 <td width="10%" class="labels">Confirm Password</td>
	 <td width="2%">:</td>
     <td width="30%">   <input type="text" class="textbox_name">    </td>
	 <td width="30%"   ></td>
  </tr>
  </table>
  <br>
  <br>
<table width="100% align="center" >
	<tr>
     	<td width="100%" align="center"> <input type="button" value="Update" class="button"> &nbsp;&nbsp;
		 <input type="button" value="Reset" class="button"> &nbsp;&nbsp;
	 	<input type="button" value="Cancel" class="button" >   
		</td>
	 </tr>
 </table>
