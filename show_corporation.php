<?php
include("adminsession.php");
$districtid=trim(addslashes($_REQUEST['districtid'])); 

?>

 <select required name="districtid" id="districtid" style="width: 100%;" class="form-control"><option value="">Select Corporation</option>
							<?php $corp=mysqli_query($connection,"select * from m_corpmunicipal where districtid='$districtid'");
							while($data1=mysqli_fetch_array($corp)){?>						
<option value="<?php echo $data1['corpmunicipal_id'] ?>"><?php echo $data1['corpmunicipal'] ?> </option>
<?php } ?>
							</select>
                                          
                                            
                                  
                             
                                            
