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
 header("Content-type: application/vnd-ms-excel");
$filename = "ShelterReport".strtotime("now").'.xls';
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
		 	       <th> Date</th>
		 	      <td>Shelter Type</td>	
<td>SMA Name</td>
<td>Design Capacity</td>
<td>Contatct Person</td>
<td>Men</td>
<td>Women</td>
<td>Children</td>
<td>Total</td>			
<td>Register Type</td>
<td>Cancelled Date</td>
<td>Reason</td>
				
		 	     </tr>
		 	  </thead>
		 	  <tbody>
		 	  
		 	      <?php
				  $sno=1;
				  $shelterdetail=mysqli_query($connection,"select * from  deleted_shelter $crit");
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
				  <td><?php echo $cmn->dateformatindia($get_data['createdate'])?></td>
				<td><?php echo  $get_data['s_type'];?></td>	
<td><?php echo  $get_data['smaname'];?></td>
<td><?php echo  $get_data['design_capacity'];?></td>
<td><?php echo   $get_data['contatct_person'];?></td>
<td><?php echo  $get_data['men'];?></td>
<td><?php echo  $get_data['women'];?></td>
<td><?php echo   $get_data['children'];?></td>
<td><?php echo   $get_data['total'];?></td>			
<td><?php echo   $get_data['register_type'];?></td>
 <td><?php echo $cmn->dateformatindia($get_data['delete_date'])?></td>
   <td><?php echo   $get_data['reason'];?></td>

		 	      
		 	    </tr>
		 	    <?php } ?>
		 	   
		 	    
		 	  </tbody>
			</table>
 
 
