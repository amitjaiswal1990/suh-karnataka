<?php
include("adminsession.php");
echo $districtid=trim(addslashes($_REQUEST['districtid'])); 

?>

 <select name="panchayat_id" id="panchayat_id">
                       <option value="">-Select Townpanchayat-</option>
                                            <?php 
											$sql1 = "select distinct panchayat,panchayat_id from m_townpanchayat where districtid='$districtid'";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
													
											?>
                                          			<option value="<?php echo $row1['panchayat_id']; ?>"><?php echo $row1['panchayat']; ?></option>
                                            <?php
												}
												
												?>
                                      </select>  
                                  
                                            </td>
                                            
                                  
                             
                                            
