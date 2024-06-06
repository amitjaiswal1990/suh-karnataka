<?php
include("adminsession.php");
$pagename = "add_user.php";
$module = "Add Copo-Municipal";
$submodule = "Corp-Municipal Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "user";
$tblpkey = "userid";
if ( isset( $_GET[ 'userid' ] ) )
	$keyvalue = $_GET[ 'userid' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
header("Content-type: application/vnd-ms-excel");
$filename = "TrainingReport".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
</head>

<body>


							<table border="1">

								<thead>
									<tr>
										<th>SN.</th>	
                                         <th>District</th>
                                          <th>ULB</th>
                                           <th>Shelter</th>
                                          <th>User Name</th>								
                                        <th>Password</th>
                                        <th>User Type</th>
									
									</tr>
								</thead>
								<tbody>
										
									
									
													
										<?php
												
													$slno=1;
											$sql1 = mysqli_query($connection,"select * from  user ");	
											while($row = mysqli_fetch_assoc($sql1))
											{ 
												$ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$row[ulbid]'");
							$ngoname = $cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$row[ngoid]'");
							$districtname = $cmn->getvalfield($connection,"m_district","districtname","districtid='$row[districtid]'");
							?>
											
				                    
										<tr>
										<td><?php echo $slno++;?></td>
                                          <td><?php echo $districtname;?></td>
                                             <td><?php echo $ulbname;?></td>	
                                               <td><?php echo $ngoname;?></td>	
										<td><?php echo $row['username'];?></td>
										<td><?php echo $row['password'];?></td>	
                                        <td><?php echo $row['usertype'];?></td>
                                      								
											
							
									</tr>
										
								
									<?php }?>
								</tbody>
							</table>
					
</body>
<!-- Mirrored from themesbrand.com/lexa/html/horizontal/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Aug 2019 07:19:42 GMT -->
</html>