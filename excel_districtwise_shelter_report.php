<?php include("adminsession.php");
error_reporting(0);
$_GET['stateid']=2;



if($usertype=='ADMIN')
		{
				$con1 = "where 1=1";
				$con='1=1';
				$crit=' 1=1';
		
		}
		else
		{
			$con1=" where districtid='$districtid'";
			$con=" districtid='$districtid'";
			$crit=" districtid='$districtid'";
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
	if($_GET['stateid']!=0){
		$con1 .=" and stateid = '$_GET[stateid]'";
		//$con .=" and stateid = '$_GET[stateid]'";
	}
	
	
	
	if($_GET['districtid']!=0){
		 $con1 .=" and districtid = '$_GET[districtid]'";
		 $con .=" and districtid = '$_GET[districtid]'";
	}
	if($_GET['ulbid']!=0){
		 $con1 .=" and ulbid = '$_GET[ulbid]'";
		 $con .=" and ulbid = '$_GET[ulbid]'";
	}
	
	if($_GET['ngoid']!=0){
		 $con1 .=" and ngoid = '$_GET[ngoid]'";
		 $con .=" and ngoid = '$_GET[ngoid]'";
	}
	
	if($fromdate!="" && $todate!="")
{
	//$fromdate = $cmn->dateformatusa($fromdate);
	//$todate = $cmn->dateformatusa($todate);
	$crit .= " and  createdate between '$fromdate' and '$todate'";
}
 header("Content-type: application/vnd-ms-excel");
$filename = "DistrictwiseShelter".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);
?>

  <table border="1">
						
							 
							<tr>
								<td colspan="12">
									<table id="districtWiseSheltersReport" class="example table table-bordered table-condensed table-hover"   >
									  <thead>
											<tr>
												<th style="text-align: center; width: 1%;">Sl.No.</th>
											
												<th style="text-align: center;">District Name</th>
											
												<th style="text-align: center;">No.of Shelters</th> 
												<th style="text-align: center;">Total Occupied</th>
												
												<th style="text-align: center;">Total Capacity</th>
											</tr>
									   </thead>
									   
										<tbody>
											<?php
	$sno=0;
	$tot=0;
	$totcap=0;
	$totocc=0;
	
	//echo $con1;
	//echo "select * from m_ngo $con1 group by districtid";
								$sql_data=mysqli_query($connection,"select * from m_district $con1 group by districtid");
											while($get_data=mysqli_fetch_array($sql_data)){
												$sno++;
											 $distname=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
											  
												//$statename=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");
												
												
												$d_capacity=$cmn->getvalfield($connection,"m_ngo","sum(design_capacity)","districtid='$get_data[districtid]'");
												$c_shelter=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","districtid='$get_data[districtid]'");

												
												$tot=$cmn->getvalfield($connection,"attendance_details","count(aid)","districtid='$get_data[districtid]' and attendance='Present' and atten_date='$fromdate'");
												$totocc =$totocc+$tot;
												$totcap +=$d_capacity;
											?>
												<tr>
													<td style="text-align: center;  width: 1%;"><?php echo $sno; ?></td>
													
													<td><?php echo $distname ?> </td>
												
											    	<td style="text-align: right;">
									
											    		<a href="all_shelter_details_report.php?stid=<?php echo $get_data['stateid'] ?>&distid=<?php echo $get_data['districtid'] ?>&ngoid=<?php echo $get_data['ngoid'] ?>&fromdate=<?php echo $fromdate; ?>"><?php echo $c_shelter ?></a>
											    	</td>
													
											    	<td style="text-align: right;">
											    		<a href="inmate_details_report.php?districtid=<?php echo $get_data['districtid'] ?>&fromdate=<?php echo $fromdate; ?>" class="comma sum" ><?php
												echo $tot;
												?></a>
											    	</td>
											    	<td align="right" class="comma  sum"><?php echo $d_capacity ?></td>
												
												</tr>
											
												<?php } ?>
											
										</tbody>
										<tfoot >
											<tr style="font-weight: bold;" >
												<td></td>
												<td style="text-align: center;">Total</td>
											
												
												<td align="right" class="total"><?php echo $c_shel=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","$con"); ?></td>
												<td align="right" class="total"><?php echo $totocc; ?></td>
												<td align="right" class="total"><?php echo $totcap; ?></td>
											</tr>
										</tfoot>
									
									
									
								</table>
							</td>
						</tr>
							
</table>
 
 
