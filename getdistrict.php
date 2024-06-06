<?php
include("adminsession.php");
echo $stateid=trim(addslashes($_REQUEST['stateid'])); 

?>

 <select name="districtid" id="districtid">
                       <option value="">-Select District-</option>
                                            <?php 
											$sql1 = "select distinct districtname,districtid from m_district where stateid='$stateid' order by districtname ";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
													//$districtname = $row1['districtname'];
											?>
                                          			<option value="<?php echo $row1['districtid']; ?>"><?php echo $row1['districtname']; ?></option>
                                            <?php
												}
												
												?>
                                      </select>  
                                  
                                            </td>
                                            
                                  
                             
                                            
