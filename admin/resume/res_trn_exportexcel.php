<?
// Connect database. 
mysql_connect("localhost","bridgegroup","resume",true);

mysql_select_db("bridgegroup");

// Get data records from table. 
$result=mysql_query("select * from 
			 		 res_trn_tcandidate ");

// Functions for export to excel.
function xlsBOF() { 
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0); 
return; 
} 
function xlsEOF() { 
echo pack("ss", 0x0A, 0x00); 
return; 
} 
function xlsWriteNumber($Row, $Col, $Value) { 
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
echo pack("d", $Value); 
return; 
} 
function xlsWriteLabel($Row, $Col, $Value) { 
$L = strlen($Value); 
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
echo $Value; 
return; 
} 

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=profile.xls "); 
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,5,"List of Profile.");

// Make column labels. (at line 3)
			xlsWriteLabel(2,1,"Name");
			xlsWriteLabel(2,2,"Contact No ");
			xlsWriteLabel(2,3,"E-Mail");
			xlsWriteLabel(2,4,"Qualification");
			xlsWriteLabel(2,5,"Name of the Current Company Working");
			xlsWriteLabel(2,6,"Department");
			xlsWriteLabel(2,7,"Current Designation");
			xlsWriteLabel(2,8,"Current Salary");
			xlsWriteLabel(2,9,"Current Location");
			xlsWriteLabel(2,10,"No.of years with current Company");
			xlsWriteLabel(2,11,"Total No Of Years Of Work Exp");

$xlsRow = 3;

// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){

xlsWriteLabel($xlsRow,1,$row['candidate_name']);
xlsWriteLabel($xlsRow,2,$row['candidate_no']);
xlsWriteLabel($xlsRow,3,$row['candidate_email']);
xlsWriteLabel($xlsRow,4,$row['candidate_qualification']);
xlsWriteLabel($xlsRow,5,$row['candidate_currentworking']);
xlsWriteLabel($xlsRow,6,$row['candidate_department']);
xlsWriteLabel($xlsRow,7,$row['candidate_designation']);
xlsWriteLabel($xlsRow,8,$row['candidate_salary']);
xlsWriteLabel($xlsRow,9,$row['candidate_location']);
xlsWriteLabel($xlsRow,10,$row['candidate_currentyears']);
xlsWriteLabel($xlsRow,11,$row['candidate_experience']);

$xlsRow++;
} 
xlsEOF();
exit();
?>
