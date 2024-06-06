<?php
include("adminsession.php");
 $stateid=trim(addslashes($_REQUEST['stateid'])); 

?>

 <select name="districtid" id="districtid" onChange="show_corporat(this.value);"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from m_district where stateid='$stateid'");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['districtid']; ?>"><?php echo $data['districtname']; ?></option>
						<?php } ?>
                     </select>
                                          
                                            
                                  
                             
                                            
