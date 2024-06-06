<?php include("../adminsession.php");
 $id  = $_REQUEST['id'];
$Property_I  =$_REQUEST['Property_I'];
$Ward_No  =$_REQUEST['Ward_No'];
$Cad_street = $_REQUEST['Cad_street'];
$OCMC = $_REQUEST['OCMC'];
$Door_No = $_REQUEST['Door_No'];
$Proparty_T = $_REQUEST['Proparty_T'];
$No_Of_Taps = $_REQUEST['No_Of_Taps'];
$Independen = $_REQUEST['Independen'];
$Name_Of_Ow = $_REQUEST['Name_Of_Ow'];
$Main_Sourc = $_REQUEST['Main_Sourc'];
$Frequency = $_REQUEST['Frequency'];
$How_Do_You = $_REQUEST['How_Do_You'];


$res =  mysqli_query($connection,"update properties_detail set Property_I='$Property_I',Ward_No='$Ward_No',Cad_street='$Cad_street',OCMC='$OCMC',Door_No='$Door_No',Proparty_T='$Proparty_T',No_Of_Taps='$No_Of_Taps',Independen='$Independen',Name_Of_Ow='$Name_Of_Ow',Main_Sourc='$Main_Sourc',Frequency='$Frequency',How_Do_You='$How_Do_You'  where id = '$id'");



?>

