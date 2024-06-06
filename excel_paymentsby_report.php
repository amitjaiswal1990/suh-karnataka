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
	$crit .= " and  paydate between '$fromdate' and '$todate'";
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
$filename = "PaymentReport".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);
?>

<table border="1">
				
					<tr>
					    <th>Sl.No</th>
                        <th>District</th>
						<th>ULB</th>
                        <th>Shelter</th>
						<th>Date</th>						
						 <td>Term</td>			
			
			
		 <td>Approved By</td>
			
			  <th>Payment Made By State Towards</th>
              <th>Amount</td>
		 <th>Payment Made By Shelter Towards</th>
		 <td>Amount</td>
                       
			 <td>Remark</td>			
					</tr>
					
					    <?php 
						$sn=1;
						
						$dist=mysqli_query($connection,"select * from payments_by $crit");
							while($data=mysqli_fetch_array($dist)){
							$ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$data[ulbid]'");
							$ngoname = $cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$data[ngoid]'");
							$districtname = $cmn->getvalfield($connection,"m_district","districtname","districtid='$data[districtid]'");
								?>
					    <tr>
					      <td><?php echo $sn++;?></td>
                        <td><?php echo ucfirst(strtolower($districtname));?></td>
                          <td><?php echo ucfirst(strtolower($ulbname));?></td>
                            <td><?php echo ucfirst(strtolower($ngoname));?></td>
                         <td><?php echo $cmn->dateformatindia($data['paydate']);?></td>
					        <td><?php echo $data['term'];?></td>			
		
			
		 <td><?php echo $data['approved_by'];?></td>
			
			 <td><?php echo $data['payment_made'];?></td>
             	 <td><?php echo $data['amount'];?></td>
		 <td><?php echo $data['payment_made_under'];?></td>
		 <td><?php echo $data['underamount'];?></td>
                           
                <td><?php echo $data['remark'];?></td>         
                             
                          
					    </tr>
					<?php } ?>  
					
					

				</table>
 
 
