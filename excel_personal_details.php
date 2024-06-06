<?php include("adminsession.php");
error_reporting(0);
if($usertype=='ADMIN')
		{
			$crit = " where 1 = 1 ";
			$con = " where 1 = 1 ";
			$conulb = " where 1 = 1 ";
		
		}
		else
		{
				$crit=" where userid='$loginid' ";
			$con=" where districtid='$districtid' ";
			$conulb=" where districtid='$districtid'";
		}
if($_GET['fromdate']!="" && $_GET['todate']!="")
{
	$fromdate = addslashes(trim($_GET['fromdate']));
	$todate = addslashes(trim($_GET['todate']));
}
else
{
	$fromdate = date("Y-m-d"); 
	$todate = date('Y-m-d');
}
if($_GET['fromage']!="" && $_GET['toage']!="")
{
	$fromage = addslashes(trim($_GET['fromage']));
	$toage = addslashes(trim($_GET['toage']));
}
else
{
	$fromage = ''; 
	$toage ='';
}
if($_GET['fromperiod']!="" && $_GET['toperiod']!="")
{
	$fromperiod = addslashes(trim($_GET['fromperiod']));
	$toperiod = addslashes(trim($_GET['toperiod']));
}
else
{
	$fromperiod = ''; 
	$toperiod ='';
}

if($_GET['districtid']) {
	 $districtid = trim(addslashes($_GET['districtid']));
	}
	else
	{
	$districtid='';
	}
	if($_GET['ulbid']) {
	$ulbid = trim(addslashes($_GET['ulbid']));
	}
	else
	{
	$ulbid='';
	}
	if($_GET['ngoid']) {
	$ngoid = trim(addslashes($_GET['ngoid']));
	}
	else
	{
	$ngoid='';
	}
 
 if($_GET['gender']) {
	$gender = trim(addslashes($_GET['gender']));
	}
	else
	{
	$gender='';
	}

if($fromdate!="" && $todate!="")
{
	//$fromdate = $cmn->dateformatusa($fromdate);
	//$todate = $cmn->dateformatusa($todate);
	$crit .= " and  createdate between '$fromdate' and '$todate'";
}


	
if($districtid !='') {
		 $crit .= " and districtid= '$districtid'";
		  $con .= " and districtid= '$districtid'";
		    $conulb .= " and districtid= '$districtid'";
	}	
	
	if($ulbid !='') {
		$crit .= " and ulbid= '$ulbid'";
		$con .= " and ulbid= '$ulbid'";
	}
	
	if($ngoid !='') {
		$crit .= " and ngoid= '$ngoid'";
		$con .= " and ngoid= '$ngoid'";
	}
	if($fromage!="" && $toage!="")
{
	//$fromdate = $cmn->dateformatusa($fromdate);
	//$todate = $cmn->dateformatusa($todate);
	$crit .= " and  age between '$fromage' and '$toage'";
}

if($fromperiod!="" && $toperiod!="")
{
	//$fromdate = $cmn->dateformatusa($fromdate);
	//$todate = $cmn->dateformatusa($todate);
	$crit .= " and  period_stayed_place between '$fromperiod' and '$toperiod'";
}
if($gender !='') {
		 $crit .= " and gender= '$gender'";
		 
	}
	
 header("Content-type: application/vnd-ms-excel");
$filename = "PersonalReport".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);
?>

<table border="1">
		 	  <thead>
		 	     <tr>
		 	       <th>Sl.No</th>
					 
					 <th>District</th>
					<th>ULB</th>
					 <th>Shelter Name</th>
		 	       <th>Name</th>
                     <th>DOB</th>
                       <th>Age</th>
				  <th>Gender</th>
                   <th>Mobile No.</th>
                    <th>Alt. Mobile No.</th>
                     <th>Address</th>
                      <td>Percondition</td>
                        <td>Status</td>
                        <td>State of Domicile</td>
                        <td>Domicile State</td>
                        <td>Town/Village of Domicile</td>
                        <td>Marital Status</td>
                        <td>Last Place of Stay (State / District)</td>
                        <td>Period of Stay</td>
                        <td>Common Language</td>
                        <td>Language you can Read</td>
                        <td>Language you can Write</td>
                        <td>Language you can Speak</td>
                      
                        <td>Qualification</td>
                        <td>Place of Study</td>
                        <td>Health Condition</td>
                        <td>Physical Ailment</td>
                        <td>Employment</td>
                        <td>Employment Type</td>
                        <td>Skilled</td>
                        <td>Skill Type</td>
                        <td>Social Security & Others</td>
                        <td>Adhar No</td>
                        <td>Ration No</td>
                                 <td>Bank A/C No.</td>
					
		 	     </tr>
		 	  </thead>
		 	  <tbody>
		 	  
		 	      <?php
				  $sno=1;
				//  echo "select * from personal_details $crit";
				  $shelterdetail=mysqli_query($connection,"select * from personal_details $crit");
				  while($get_data=mysqli_fetch_array($shelterdetail)){
				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");
					    $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");
					  $ngo=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");
				  ?>
		 	      <tr>
		 	      <td><?php echo $sno++; ?></td>
		 	     <td><?php echo ucfirst(strtolower($district));?></td>
                          <td><?php echo ucfirst(strtolower($ulbname));?></td>
				  <td><?php echo $ngo; ?></td>
				
				  <td><?php echo $get_data['per_name']?></td>
                    <td><?php echo $get_data['date_of_birth']?></td>
                      <td><?php echo $get_data['age']?></td>
		 	       <td><?php echo $get_data['gender']?></td>
                    <td><?php echo $get_data['phone_no']?></td>
                     <td><?php echo $get_data['alternative_phone_no']?></td>
                      <td><?php echo $get_data['address']?></td>
                        <td><?php echo $get_data['percondition']?></td>
                        <td><?php echo $get_data['status']?></td>
                        <td><?php echo $get_data['domicile_state']?></td>
                        <td><?php echo $get_data['domicile_district']?></td>
                        <td><?php echo $get_data['domicile_village']?></td>
                        <td><?php echo $get_data['marital_status']?></td>
                        <td><?php echo $get_data['last_stayed_place']?></td>
                        <td><?php echo $get_data['period_stayed_place']?></td>
                        <td><?php echo $get_data['connon_language']?></td>
                        <td><?php echo $get_data['language_read']?></td>
                        <td><?php echo $get_data['language_write']?></td>
                        <td><?php echo $get_data['language_speak']?></td>
                       
                        <td><?php echo $get_data['qualification']?></td>
                        <td><?php echo $get_data['study_place']?></td>
                        <td><?php echo $get_data['health_condition']?></td>
                        <td><?php echo $get_data['physical_ailment']?></td>
                        <td><?php echo $get_data['employment']?></td>
                        <td><?php echo $get_data['emp_type']?></td>
                        <td><?php echo $get_data['skill']?></td>
                        <td><?php echo $get_data['skill_type']?></td>
                        <td><?php echo $get_data['ssecurity']?></td>
                        <td><?php echo $get_data['adhaar_no']?></td>
                        <td><?php echo $get_data['ration_no']?></td>
                                 <td><?php echo $get_data['bankac']?></td>
                                     
                      
		 	    </tr>
		 	    <?php } ?>
		 	   
		 	    
		 	  </tbody>
			</table>
 
 
