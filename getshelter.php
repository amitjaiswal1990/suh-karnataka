<?php
include("adminsession.php");
echo $districtid=trim(addslashes($_REQUEST['districtid'])); 

?>

 <select name="ngoid" id="ngoid">
                       <option value="">-Select Shelter name-</option>
                                            <?php 
											$sql1 = "select ngoid,ngoname from m_ngo where districtid='$districtid'";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
													
											?>
                                          			<option value="<?php echo $row1['ngoid']; ?>"><?php echo $row1['ngoname']; ?></option>
                                            <?php
												}
												
												?>
                                      </select>  
                                  
                                            </td>
                                            
                                  
                             
                                            
