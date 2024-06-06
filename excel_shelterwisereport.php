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
$filename = "ShelterwiseReport".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);
?>

<table border="1">
						
		<?php 
		//echo "select * from  m_ngo $condata group by districtid asc";
        $shelterdetail=mysqli_query($connection,"select * from  m_ngo $condata group by districtid asc");
        while($get_row=mysqli_fetch_array($shelterdetail)){ 
        $countshelter=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","ngoid='$get_row[ngoid]'");
		 $districtname=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_row[districtid]'");
        if($countshelter > 0){
        
        ?>
                <tr>
                
                 
                    <th colspan="6">District : <?php echo $districtname;?></th>
                    <th colspan="5"><center>Occupancy</center></th>
                  
                </tr> 
            
                <tr>
                <th style="text-align: center; width: 1%;">SN</th>
                <th style="text-align: center;">ULB</th>
                <th style="text-align: center;">Shelter</th>
                
                <th>SMA Name</th>
                 <th style="text-align: center;">Report Updated</th>
                <th>Capacity</th>
                 <th>Child</th>
                <th>Men</th>
                <th>Women</th>
                <th>Third Gender</th>
                
                <th style="text-align: center;">Today </th>
            </tr>
									  
										
											<?php
	$sno=0;
	//$occupied=0;
	$curdate=date("Y-m-d");
	$countdistrict=1;
	 if($usertype=='SHELTER'){
		$datashel = "ngoid = '$get_row[ngoid]'";
	 }else{
		 $datashel = "districtid = '$get_row[districtid]'";
	 }
	
											$sql_data=mysqli_query($connection,"select * from m_ngo where $datashel order by districtid");
											while($get_data=mysqli_fetch_array($sql_data)){
												
												$sno++;
												$totmale=0;
												$totfemale=0;
												$totother=0;
												$totchild=0;
											
													$sql_occu=mysqli_query($connection,"select * from attendance_details where ngoid = '$get_data[ngoid]' and atten_date='$curdate'");
													while($get_oc=mysqli_fetch_array($sql_occu)){
													$totmale +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and gender='Male' and age > 14 ");
													$totfemale +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and gender='FeMale' and age > 14");
													$totother +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and gender='Other' and age > 14");
													$totchild +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and age < 14");
													
													}
											 $totoccupied=$cmn->getvalfield($connection,"attendance_details","count(aid)","ngoid='$get_data[ngoid]' and attendance='Present' and atten_date='$curdate'");
											 $status=$cmn->getvalfield($connection,"attendance_details","count(aid)","ngoid='$get_data[ngoid]' and atten_date='$curdate'");
										$ulbname=$cmn->getvalfield($connection,"ulb_master","ulbname","districtid='$get_data[districtid]' and ulbid='$get_data[ulbid]'");
											$design_capacity=$cmn->getvalfield($connection,"m_ngo","design_capacity","districtid='$get_data[districtid]' and ulbid='$get_data[ulbid]'");
											?>
                                            
												<tr>
                                                    <td style="text-align: center;  width: 1%;"><?php echo $sno; ?></td>
                                                    <td><?php echo $ulbname; ?> </td>
                                                    <td><?php echo $get_data['ngoname']?></td>
                                                    <td><?php echo $get_data['smaname']?></td>
                                                    <td><?php 
													  
													 if( $get_data['ngoname']!=''){
													if($status=='0')
													echo 'No';
													else 
													echo 'Yes';
													 }?> </td>
                                                    <td align="right" class="comma  sum"><?php echo $design_capacity; ?></td>
                                                      <td><?php echo $totchild;?></td>
                                                    <td><?php echo $totmale;?></td>
                                                    <td><?php echo $totfemale;?></td>
                                                    <td><?php echo $totother;?></td>
                                                    
                                                    <td style="text-align: right;">  <?php   echo $totoccupied; ?></td>


											    	
												
												</tr>
											
												<?php // $countdistrict++;
												//if($countdistrict > $countdist) { $countdistrict=1; }
												 } ?>
									
                        
                        
					<?php  } } ?>	
						<!--  Corporation Wise Report -->
						
					</table>
 
 
