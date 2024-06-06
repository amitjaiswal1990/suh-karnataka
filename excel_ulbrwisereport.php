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
if($_GET['fromdate']!="")
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
 
 
if($fromdate!="")
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
$filename = "ULBwiseReport".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);
?>

<table border="1">
						
					 <?php 
					 $totcapacity=0;
				 $shelterdetail=mysqli_query($connection,"select * from  m_district order by districtname asc");
				  while($get_row=mysqli_fetch_array($shelterdetail)){ 
				  $totulb=$cmn->getvalfield($connection,"ulb_master","count(ulbid)","districtid='$get_row[districtid]'");
				   $totngo=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","districtid='$get_row[districtid]'");
				    $totcapacity=$cmn->getvalfield($connection,"m_ngo","sum(design_capacity)","districtid='$get_row[districtid]'");
				  
				  
				  ?>
                <tr>
            
                    <th  colspan="5">District : <?php echo $get_row['districtname'];?> &nbsp;&nbsp;&nbsp;&nbsp; Total ULBs : <?php echo $totulb;?>&nbsp;&nbsp;&nbsp;&nbsp; Total Shelters : <?php echo $totngo;?>&nbsp;&nbsp;&nbsp;&nbsp; Total Capacity : <?php echo $totcapacity;?></th>
                 
                  
                </tr>
								<tr>
												<th style="text-align: center; width: 1%;">SN</th>
											
                                                <th style="text-align: center;">ULB</th>
                                                
												<th style="text-align: center;">Shelter</th>
                                                
                                                <th style="text-align: center;">Total Capacity</th>
												<th style="text-align: center;">Today Occupancy</th>
												
												
											</tr>
									 
											<?php
	$sno=0;
	//$occupied=0;
	$curdate=date("Y-m-d");
	$countdistrict=1;

	
											$sql_data=mysqli_query($connection,"select * from ulb_master where districtid = '$get_row[districtid]' order by districtid,ulbname");
											while($get_data=mysqli_fetch_array($sql_data)){
												
												$sno++;
												
												 //$status=$cmn->getvalfield($connection,"attendance_details","count(aid)","districtid='$get_data[districtid]' and atten_date='$curdate'");
											 $totoccupied=$cmn->getvalfield($connection,"attendance_details","count(aid)","ulbid='$get_data[ulbid]' and attendance='Present' and atten_date='$curdate'");
										
										$shelter=$cmn->getvalfield($connection,"m_ngo","ngoname","districtid='$get_data[districtid]' and ulbid='$get_data[ulbid]'");
											$design_capacity=$cmn->getvalfield($connection,"m_ngo","sum(design_capacity)","ulbid='$get_data[ulbid]'");
											?>
                                            
												<tr>
													<td style="text-align: center;  width: 1%;"><?php echo $sno; ?></td>
												
                                                    <td><?php echo $get_data['ulbname'] ?> </td>
                                                    <td style="text-align: left;">
                                                    <?php if($shelter!=''){ ?>	
													<table border="1" width="100%">
                                                    <tr><td>SN</td><td>Shelter</td><td>Report Updated</td></tr>
                                                  <?php
                                                  	$count=1;
                                                  $sql=mysqli_query($connection,"select * from m_ngo where ulbid = '$get_data[ulbid]'");
											while($getn=mysqli_fetch_array($sql)){
											     $status=$cmn->getvalfield($connection,"attendance_details","count(aid)","ngoid='$getn[ngoid]' and atten_date='$curdate'");
												?>
                                                    <tr>
                                                    <td><?php echo $count++;?></td>
                                                    <td><?php echo $getn['ngoname'];?></td>
                                                    <td><?php 
													  
													 if($shelter!=''){
													if($status=='0')
													echo 'No';
													else 
													echo 'Yes';
													 }?> </td>
                                                    </tr>
                                                    <?php } ?>
                                                    </table>
                                                    <?php } ?>
													</td>
											    	  
													<td align="right" class="comma  sum"><?php echo $design_capacity; ?></td>
											    	<td style="text-align: right;">  <?php  if($shelter!=''){ echo $totoccupied; }?></td>
											  
											    	
											    	
												
												</tr>
											
												<?php // $countdistrict++;
												//if($countdistrict > $countdist) { $countdistrict=1; }
												 } ?>
											
										
						</tr>
                        
                        
					<?php } ?>	
						<!--  Corporation Wise Report -->
						
					</table>
 
 
