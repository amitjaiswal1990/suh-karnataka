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
 
 
if($fromdate!="" && $todate!="")
{
	//$fromdate = $cmn->dateformatusa($fromdate);
	//$todate = $cmn->dateformatusa($todate);
	$crit .= " and  atten_date between '$fromdate' and '$todate'";
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
 header("Content-type: application/vnd-ms-excel");
$filename = "AttendanceReport".strtotime("now").'.xls';
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
<th>Attendance Date</th>

                        <th>Attendance</th>
					
		 	     </tr>
		 	  </thead>
		 	  <tbody>
		 	  
		 	      <?php
				  $sno=1;
				//  echo "select * from personal_details $crit";
			//	echo "select * from attendance_details $crit";
				  $shelterdetail=mysqli_query($connection,"select * from attendance_details $crit");
				  while($get_data=mysqli_fetch_array($shelterdetail)){
				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");
					    $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");
					  $ngo=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");
					   $id=$cmn->getvalfield($connection,"personal_details","id","id='$get_data[pid]'");
						$per_name=$cmn->getvalfield($connection,"personal_details","per_name","id='$id'");
						$profile_photo=$cmn->getvalfield($connection,"personal_details","profile_photo","id='$id'");
						$date_of_birth=$cmn->getvalfield($connection,"personal_details","date_of_birth","id='$id'");
						$age=$cmn->getvalfield($connection,"personal_details","age","id='$id'");
						$gender=$cmn->getvalfield($connection,"personal_details","gender","id='$id'");
						
						
				  ?>
		 	      <tr>
		 	      <td><?php echo $sno++; ?></td>
		 	   
		 	    <td><?php echo ucfirst(strtolower($district));?></td>
                          <td><?php echo ucfirst(strtolower($ulbname));?></td>
				  <td><?php echo $ngo; ?></td>
				
				  <td>
				 
				  <?php echo $per_name;?></td>
                    <td><?php echo dateformatindia($date_of_birth);?></td>
                      <td><?php echo $age;?></td>
		 	       <td><?php echo $gender;?></td>
                    <td><?php echo dateformatindia($get_data['atten_date']);?></td>
                     
                             <td>
                             <?php if($get_data['attendance']=='Present'){ ?> <span style="color:#390"><strong>Present</strong></span> <?php } else { ?> <span style="color:#F00"><strong>Absent</strong></span> <?php } ?>        
                         </td>
			
		 	    </tr>
		 	    <?php } ?>
		 	   
		 	    
		 	  </tbody>
			</table>
 
 
