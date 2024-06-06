<?php
include("adminsession.php");
 $districtid=trim(addslashes($_REQUEST['districtid']));
 $ulbid=trim(addslashes($_REQUEST['ulbid']));
 $con="where 1=1";
 if($districtid!='')
 {
	 $con .=" and districtid='$districtid'";
	  $con1 =" and districtid='$districtid'";
 }
 
  if($ulbid!='')
 {
	 $con .=" and ulbid='$ulbid'";
	  $con1 .=" and ulbid='$ulbid'";
 }
 
 $totngo=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","1=1 $con1");
 
 if($totngo!=0)
 {
 
?>


                       <option value="">-Select Shelter Name-</option>
                      
                                            <?php 
											$sql1 = "select distinct ngoname,ngoid from m_ngo $con order by ngoname asc";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
											{ ?>
														<option value="<?php echo $row1['ngoid']; ?>"><?php echo $row1['ngoname']; ?></option>
												
                                          			
                                            <?php
												}
 }
 else {
									
                                  			?>
                                     
                                    	<option value="0">NA</option>        
                                            
                                  
                             
                              <?php } ?>              
