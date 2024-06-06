<?php include("adminsession.php");

 header("Content-type: application/vnd-ms-excel");
$filename = "StatewiseReport".strtotime("now").'.xls';
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
												<th style="text-align: center;">State Name</th>
												<th style="text-align: center;">No.of Districts</th>
												<th style="text-align: center;">No.of Shelters</th> 
											</tr>
									   </thead>
									   
										<tbody>
											<?php 
											$sno=1;
											$totdist=0;
											$totshelter=0;
											$sql=mysqli_query($connection,"select * from m_state"); 
											while($data=mysqli_fetch_array($sql)){
												$distid=$cmn->getvalfield($connection,"m_district","districtid","stateid='$data[stateid]'");
												$district=$cmn->getvalfield($connection,"m_district","count(districtname)","stateid='$data[stateid]'");
												$shelter=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","1=1");
												
												
												
												$male_aged_no=$cmn->getvalfield($connection,"m_shelter","sum(male_aged_people_no)","districtid='$distid'");
												$male_children_no=$cmn->getvalfield($connection,"m_shelter","sum(male_children_no)","districtid='$distid'");
												$male_others_no=$cmn->getvalfield($connection,"m_shelter","sum(male_others_no)","districtid='$distid'");
												$male_differently_abled=$cmn->getvalfield($connection,"m_shelter","sum(male_differently_abled)","districtid='$distid'");
												
												$female_aged_no=$cmn->getvalfield($connection,"m_shelter","sum(female_aged_people_no)","districtid='$distid'");
												$female_children_no=$cmn->getvalfield($connection,"m_shelter","sum(female_children_no)","districtid='$distid'");
												$female_others_no=$cmn->getvalfield($connection,"m_shelter","sum(female_others_no)","districtid='$distid'");
												$female_differently_abled=$cmn->getvalfield($connection,"m_shelter","sum(female_differently_abled)","districtid='$distid'");
											$totdist +=$district;
											$totshelter +=$shelter;
											?>
												<tr>
													
													<td style="text-align: center;  width: 1%;"><?php echo $sno++; ?></td>
													<td><a href="districtwise_report.php?id=<?php echo $data['stateid']; ?>" ><?php echo $data['statename']; ?></a></td>
											    	<td style="text-align: right;" class="comma sum"> <?php echo $district; ?> </td>
											    	<td style="text-align: right;">
										<?php echo $shelter; ?>
											    	</td>
												</tr>
											<?php } ?>
											
										</tbody>
										<tfoot >
											<tr style="font-weight: bold;" >
												<td></td>
												<td style="text-align: center;">Total</td>
												<td align="right" class="total"><?php echo $totdist; ?></td>
												<td align="right" class="total"><?php echo $totshelter; ?></td>
											</tr>
										</tfoot>
									
									
									
								</table>
							</td>
						</tr>
						
						<!--  District Wise Report -->
						
						<!--  Corporation Wise Report -->
						
					</table>
 
 
