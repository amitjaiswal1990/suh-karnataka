<?php include("adminsession.php");
error_reporting(0);
$getid=2;
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
	$crit .= " and  counsdate between '$fromdate' and '$todate'";
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
$filename = "CounselingReport".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);
?>

<table id="districtWiseSheltersReport" class="example table table-bordered table-condensed table-hover"   >
									  <thead>
											<tr>
												<th style="text-align: center; width: 1%;vertical-align: middle;">Sl.No.</th>
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;vertical-align: middle;">District</th> 
                                                <th style="text-align: center;vertical-align: middle;">ULB</th> 
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;">Shelter</th> 
                                                <th style="text-align: center;vertical-align: middle;">conductdate</th> 
                                                <th style="text-align: center;vertical-align: middle;">Men</th> 
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;">Women</th> 
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;">Children</th> 
                                                <th style="text-align: center;vertical-align: middle;">PWP</th> 
                                                <th style="text-align: center;vertical-align: middle;">Total</th> 
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;vertical-align: middle;">Date of formation of Executive Committee</th> 
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;">No of Executive Committee meetings conducted</th> 
                                                <th style="text-align: center;vertical-align: middle;">Date of Formation of Shelter Management committee </th> 
                                                <th style="text-align: center;vertical-align: middle;">No of Shelter Management committee meetings conducted</th> 
                                                <th style="text-align: center;vertical-align: middle;">No of Urban Homeless rescued and accommadate in the shelter (Jan to Nov 2020)</th>

												
												
											</tr>
									   </thead>
									   
										<tbody>
											<?php
	$sno=0;
	$occupied=0;
	$curdate=date("Y-m-d");
											$sql_data=mysqli_query($connection,"select * from thirdpartysurey");
											while($get_data=mysqli_fetch_array($sql_data)){
												$sno++;
												$districtid=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
												$ulbid=$cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'"); 
											//	$ngoid=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");
												$conductdate=$get_data['conductdate']; 
												$men=$get_data['men']; 
												$women=$get_data['women']; 
												$children=$get_data['children']; 
												$PWP=$get_data['PWP']; 
												$total=$get_data['total']; 
												$men1=$get_data['men1']; 
												$women1=$get_data['women1']; 
												$children1=$get_data['children1']; 
												$PWP1=$get_data['PWP1']; 
												$ecformationdate=$get_data['ecformationdate']; 
												$ecmeetingconduct=$get_data['ecmeetingconduct']; 
												$smformationdate=$get_data['smformationdate']; 
												$smmeetingconduct=$get_data['smmeetingconduct']; 
												$nohsc=$get_data['nohsc'];
													$ngoid=$get_data['ngoid'];
												
												
												 
												
											?>
                                            
												<tr>
													<td   width: 1%;"><?php echo $sno; ?></td>
													<td><?php echo $districtid ?></td> 
                                                    <td><?php echo $ulbid ?></td> 
                                                    <td><?php echo $ngoid ?></td> 
                                                    <td><?php echo $conductdate ?></td> 
                                                    <?php if($getid==1){ ?>
                                                    <td><?php echo $men ?></td> 
                                                    <td><?php echo $women ?></td> 
                                                    <td><?php echo $children ?></td> 
                                                    <td><?php echo $PWP ?></td> 
                                                    <td><?php echo $total ?></td> 
                                                    <?php } else if($getid==2){ ?>
                                                    <td><?php echo $men1 ?></td> 
                                                    <td><?php echo $women1 ?></td> 
                                                    <td><?php echo $children1 ?></td> 
                                                    <td><?php echo $PWP1 ?></td>
                                                    <td><?php echo $PWP1+$men1+$women1+$children1 ?></td> <?php } ?>
                                                    <td><?php echo $ecformationdate ?></td> 
                                                    <td><?php echo $ecmeetingconduct ?></td>
                                                     <td><?php echo $smformationdate ?></td>
                                                     <td><?php echo $smmeetingconduct ?></td> 
                                                     <td><?php echo $nohsc ?></td>
												
												</tr>
											
												<?php } ?>
											
										</tbody>
										<tfoot >
											<!--<tr style="font-weight: bold;" >
												<td></td>
												<td style="text-align: center;">Total</td>
												<td align="right" class="total"></td>
												<td align="right" class="total"></td>
												<td align="right" class="total"></td>
											</tr>-->
										</tfoot>
									
									
									
								</table>
 
 
