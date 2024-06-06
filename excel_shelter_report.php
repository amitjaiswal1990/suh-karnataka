<?php
error_reporting(0);
include("adminsession.php");
 if($usertype=='ADMIN')
		{
				$crit = "  1 = 1 ";
				$con = "  1 = 1 ";
				$conulb = "  1 = 1 ";
		
		}
		else
		{
			$crit=" userid='$loginid' ";
		$con=" districtid='$districtid' ";
			$conulb=" districtid='$districtid' ";
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
 
 if($_GET['design_capacity']) {
	$design_capacity = trim(addslashes($_GET['design_capacity']));
	}
	else
	{
	$design_capacity='';
	}
	
	
	if($_GET['s_type']) {
	$s_type = trim(addslashes($_GET['s_type']));
	}
	else
	{
	$s_type='';
	}

 
 

if($fromdate!="" && $todate!="")
{
	//$fromdate = $cmn->dateformatusa($fromdate);
	//$todate = $cmn->dateformatusa($todate);
	$crit .= " and  date(createdate) between '$fromdate' and '$todate'";
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
	
	if($design_capacity !='') {
		$crit .= " and design_capacity= '$design_capacity'";
		$con .= " and design_capacity= '$design_capacity'";
	}
	
	if($s_type !='') {
		$crit .= " and s_type= '$s_type'";
		$con .= " and s_type= '$s_type'";
	}
// echo "SELECT *
// FROM attendance_details
// LEFT JOIN m_ngo
// ON attendance_details.ngoid = m_ngo.ngoid $crit";die;
	
	//echo "select * from ulb_master $conulb order by ulbname asc";die;
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
		 	     
		 	       <th>SMA Details</th>
                   <th>Capacity</th>
                   <th>Status</th>
                   
				
		 	     </tr>
		 	  </thead>
		 	  <tbody>
		 	  
		 	      <?php
				  $sno=1;
				  $shelterdetail=mysqli_query($connection,"SELECT * from m_ngo order by districtid");
				  while($get_data=mysqli_fetch_array($shelterdetail)){
				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");
					   $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");
					 
					  $status=$cmn->getvalfield($connection,"attendance_details","count(ngoid)","$crit and ngoid=$get_data[ngoid]");
				  ?>
		 	      <tr>
		 	      <td><?php echo $sno++; ?></td>
		 	     <td><?php echo ucfirst(strtolower($district));?></td>
                          <td><?php echo ucfirst(strtolower($ulbname));?></td>
				  <td><?php echo $get_data['ngoname']; ?></td>
				  
				 <td><?php if($get_data['smaname']!=''){echo $get_data['smaname']; }
				 else{ echo "-"; }?></td>
                  <td><?php echo $get_data['design_capacity']?></td>
                  <td><?php if ($status>0){?><span style="color:green">Updated</span><?php }else{ ?><span style="color:red">Not Updated</span><?php } ?></td>
		 	      
		 	    </tr>
		 	    <?php } ?>
		 	   
		 	    
		 	  </tbody>
			</table>
