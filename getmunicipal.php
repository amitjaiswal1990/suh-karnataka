<?php
include("adminsession.php");
echo $districtid=trim(addslashes($_REQUEST['districtid'])); 

?>

 <select name="corpmunicipal_id" id="corpmunicipal_id">
                       <option value="">-Select Corp-Municipal-</option>
                                            <?php 
											$sql1 = "select distinct corpmunicipal,corpmunicipal_id from m_corpmunicipal where districtid='$districtid'";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
													
											?>
                                          			<option value="<?php echo $row1['corpmunicipal_id']; ?>"><?php echo $row1['corpmunicipal']; ?></option>
                                            <?php
												}
												
												?>
                                      </select>  
                                  
                                            </td>
                                            
                                  
                             
                                            
