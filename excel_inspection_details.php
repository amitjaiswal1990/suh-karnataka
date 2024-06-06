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
	$crit .= " and  inspection_date between '$fromdate' and '$todate'";
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
$filename = "InspectionReport".strtotime("now").'.xls';
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
		 	       <th>Inspection Date</th>
		 	       <td>Extent of shelter</td>
<td>Executive commitee</td>
 <td>Date of Formation ec</td>
<td>No of Complain Solved</td>
<td>Executive Committee Meeting</td>
<td>No of Complain Recieved</td>	
<td>No Inmates</td>
<td>Male Aged People </td>
<td>Male children </td>
<td>Male others </td>
<td>Male differently abled</td>
<td>Female aged people </td>
<td>Female children </td>
<td>Female others </td>
<td>Female differently abled</td>
<td>Cleaning of Room</td>			       
<td>Cleaning of Bathroom</td>   
<td>Bank account Formed</td>  
<td>Fund out Flow</td>   
<td>Fund in Flow</td>     
<td>Festivals Org</td>     
<td>Project Work Students</td>                  
 <td>Orientation Per month</td>                 
<td>Dpr Status</td>  
<td>Suggestions of Inmates</td>
<td>Overall Remarks</td>	


<td>Corpus Account</td>

<td>Third Aged people </td>
<td>Third Children </td>
<td>Third Others </td>
<td>Third Differently Abled</td>
                  
					
		 	     </tr>
		 	  </thead>
		 	  <tbody>
		 	  
		 	      <?php
				  $sno=1;
				  $shelterdetail=mysqli_query($connection,"select * from inspection_details $crit");
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
				  <td><?php echo $cmn->dateformatindia($get_data['inspection_date'])?></td>
				  <td><?php echo $get_data['extent_of_shelter'];?></td>
<td><?php echo $get_data['executive_commitee'];?></td>
 <td><?php echo $get_data['date_of_formation_ec'];?></td>
<td><?php echo $get_data['noofcomplain_solved'];?></td>
<td><?php echo $get_data['executive_committee_meeting'];?></td>
<td><?php echo $get_data['noofcomplain_recieved'];?></td>	
<td><?php echo $get_data['no_inmates'];?></td>
<td><?php echo   $get_data['male_aged_people_no'];?></td>
<td><?php echo   $get_data['male_children_no'];?></td>
<td><?php echo   $get_data['male_others_no'];?></td>
<td><?php echo   $get_data['male_differently_abled'];?></td>
<td><?php echo   $get_data['female_aged_people_no'];?></td>
<td><?php echo   $get_data['female_children_no'];?></td>
<td><?php echo   $get_data['female_others_no'];?></td>
<td><?php echo   $get_data['female_differently_abled'];?></td>
<td><?php echo $get_data['cleaning_of_room'];?></td>			       
<td><?php echo $get_data['cleaning_of_bathroom'];?></td>   
<td><?php echo $get_data['bank_account_formed'];?></td>  
<td><?php echo $get_data['fund_out_flow'];?></td>   
<td><?php echo $get_data['fund_in_flow'];?></td>     
<td><?php echo $get_data['festivals_org'];?></td>     
<td><?php echo $get_data['project_work_students'];?></td>                  
 <td><?php echo $get_data['orientation_per_month'];?></td>                 
<td><?php echo $get_data['dpr_status'];?></td>  
<td><?php echo $get_data['suggestions_of_inmates'];?></td>
<td><?php echo $get_data['overall_remarks'];?></td>	

<td><?php echo   $get_data['corpus_account'];?></td>
<td><?php echo   $get_data['third_aged_people_no'];?></td>
<td><?php echo   $get_data['third_children_no'];?></td>
<td><?php echo   $get_data['third_others_no'];?></td>
<td><?php echo   $get_data['third_differently_abled'];?></td>
                  
                  
                
                  
		 	
		 	    </tr>
		 	    <?php } ?>
		 	   
		 	    
		 	  </tbody>
			</table>
 
 
