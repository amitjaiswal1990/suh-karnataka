<?php 

$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
	
	$districtid =  $_POST['districtid'];			
			$ngoid =  $_POST['ngoid'];
			$ulbid =  $_POST['ulbid'];
			
			stateid='$stateid',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',
	
?>


 <tr>
						<th style="width: 20%;">District Name</th>
						
                       <td style="width: 25%;">
                        <select required name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control"><option value="">-- Select District--</option>
                        <?php $dist=mysqli_query($connection,"SELECT * FROM m_district order by districtname asc");
							while($data=mysqli_fetch_array($dist)){
							
								?>
							  <option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>
						<?php } ?>
                     </select>
						</td>
						</td>
							<th style="width: 20%;">ULB Name </th>
						<td style="width: 25%;">
						 <select required name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from ulb_master order by ulbname asc");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
						<?php } ?>
                     </select>
						
						</td>
						
						
					</tr>
                    <tr>
                    <th style="width: 20%;">Shelter Name</th>
					   	
						<td style="width: 25%;">
                        <select name="ngoid" id="ngoid" class="form-control">
                       <option value="">-Select Shelter Name-</option>
                                            <?php 
											$sql1 = "select distinct ngoname,ngoid from m_ngo";
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
						
                        
                        function getshelter(){      
//alert('hello');
 var districtid = jQuery("#districtid").val();
  var ulbid = jQuery("#ulbid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getngo.php',
		  data: "districtid="+districtid+'&ulbid='+ulbid,
		  dataType: 'html',
		  success: function(data){				  
	//	alert(data);
					
				
		
		jQuery('#ngoid').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
	
	function getulb(){      
//alert('hello');
 var districtid = jQuery("#districtid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getulb.php',
		  data: "districtid="+districtid,
		  dataType: 'html',
		  success: function(data){	
		  jQuery('#ulbid').html(data);
		
		
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}


ALTER TABLE `counseling_details` ADD `stateid` INT NOT NULL AFTER `counsid`, ADD `districtid` INT NOT NULL AFTER `stateid`, ADD `ulbid` INT NOT NULL AFTER `districtid`, ADD `ngoid` INT NOT NULL AFTER `ulbid`;


ALTER TABLE `training_orientation` ADD `stateid` INT NOT NULL AFTER `trainid`, ADD `districtid` INT NOT NULL AFTER `stateid`, ADD `ngoid` INT NOT NULL AFTER `districtid`, ADD `ulbid` INT NOT NULL AFTER `ngoid`;


ALTER TABLE `financial_audit` ADD `stateid` INT NOT NULL AFTER `finid`, ADD `districtid` INT NOT NULL AFTER `stateid`, ADD `ulbid` INT NOT NULL AFTER `districtid`, ADD `ngoid` INT NOT NULL AFTER `ulbid`;


ALTER TABLE `payments_by` ADD `stateid` INT NOT NULL AFTER `payid`, ADD `districtid` INT NOT NULL AFTER `stateid`, ADD `ngoid` INT NOT NULL AFTER `districtid`, ADD `ulbid` INT NOT NULL AFTER `ngoid`;

ALTER TABLE `medical_camp` CHANGE `corpmunicipal_id` `ulbid` INT(11) NOT NULL;

ALTER TABLE `inspection_details` CHANGE `panchayat_id` `ulbid` INT(11) NOT NULL;

ALTER TABLE `auditors_entry` CHANGE `date_of_birth` `inspectiondate` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

ALTER TABLE `auditors_entry` ADD `stateid` INT NOT NULL AFTER `audid`, ADD `districtid` INT NOT NULL AFTER `stateid`, ADD `ngoid` INT NOT NULL AFTER `districtid`, ADD `ulbid` INT NOT NULL AFTER `ngoid`;