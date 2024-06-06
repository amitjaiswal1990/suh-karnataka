<?php
include("adminsession.php");
$districtid=trim(addslashes($_REQUEST['districtid'])); 

?>

 <select required name="ulbid" id="ulbid"  class="form-control">
  <option value="">-- Select ULB --</option>
 <option value=""> All ULB</option>
                        <?php $dist=mysqli_query($connection,"SELECT * FROM ulb_master  where districtid='$districtid' order by ulbname asc");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
						<?php } ?>
                     </select> 
                                  
                                            </td>
                                            
                                  
                             
                                            
