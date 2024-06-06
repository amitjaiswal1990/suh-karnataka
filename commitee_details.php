 <?php
include("adminsession.php");
error_reporting(0);
$pagename = "commitee_details.php";
$module = "Add Inspection Details";
$submodule = "Inspection Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "committee_details_entry";
$tblpkey = "centryid";
$imgpath = "uploaded/committee/";
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
if ( isset( $_GET[ 'centryid' ] ) )
	$keyvalue = $_GET[ 'centryid' ];
else
	$keyvalue = 0;
	

if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim($_GET['action']) );
else
	$action = "";



?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<title>SAVIOUR</title>
	<meta content="Admin Dashboard" name="description">
	<meta content="Themesbrand" name="author">
	<link rel="shortcut icon" href="image/suhlogo.png">
	<link rel="stylesheet" href="../plugins/morris/morris.css">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

	<?php include("inc/header.php");?>

	<div class="wrapper">
	
	    <?php  include("inc/alerts.php");?>

		<div class="container-fluid">
       
         
  
  
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
         <h4 class="card-title">Committee Details Entry</h4>
			
	
		</div>
          
		<div class="table-responsive">

<div class="tab">
  <button class="tablinks" onClick="openCity(event, 'state')" id="defaultOpen">State</button>
  <button class="tablinks" onClick="openCity(event, 'ulb')">ULB</button>
  <button class="tablinks" onClick="openCity(event, 'shelter')">Shelter</button>
</div>

<div id="state" class="tabcontent">
   <a href="statecommitee_list.php" class="btn btn-info" style="float:right;">Show List</a><br>
 <form name="addServiceForm" method="post" action="save_statecommiteesave.php" enctype="multipart/form-data">
        <table class="table table-bordered table-striped">
        
					<tr>
                    
					   	
						
						<th>Whether Executive Committee has been Formed (Y/N) </th>
						<td>
                          <select name="executive_commitee" id="executive_commitee"  class="form-control">
                       <option value="">-Select-</option>
                                           
                                          			<option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                           
                                      </select>  
                                         <script>document.getElementById('executive_commitee').value='<?php echo $executive_commitee; ?>'; </script>
                            </td>
                            <th>Date of Formation of EC</th>
						<td><input type="date" name="date_of_formation_ec"  autocomplete="off"  id="date_of_formation_ec" class="form-control datePicker "></td>
					
					</tr>
						
					
					<tr>

						
						<th>Executive Committee Meeting Date</th>
						<td><input type="date"  name="execommmeeting_date" id="execommmeeting_date" autocomplete="off"  class="form-control"></td>
                        <th>Upload Minutes Of Meeting</th>
						<td><input type="file"  name="pdfmeeting"  autocomplete="off"  class="form-control"></td>
                    </tr>
					
				
					
			<tr>
					  <th>No. Of Members Participated</th>
						<td><input type="text" name="members_participated"  autocomplete="off"  id="members_participated" class="form-control datePicker "></td>	
						
                        <th>Meeting Photo</th>
						<td><input type="file" name="meetingphoto[]" multiple autocomplete="off" id="meetingphoto" class="form-control"></td>
						
					</tr>
                     <tr>
                     <td></td>
                     <td>
                     <input type="submit" name="submit" value="Submit" style="width:200px; float:none;" class="btn btn-success">
                     </td></tr>
				</table>
                </form>
</div>

<div id="ulb" class="tabcontent">
  <a href="ulbcommitee_list.php" class="btn btn-info" style="float:right;">Show List</a><br>
 <form name="addServiceForm" method="post" action="save_ulbcommiteesave.php" enctype="multipart/form-data">
        <table class="table table-bordered table-striped">
        <tr>
						<th style="width: 20%;">District Name</th>
						
                       <td>
						<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="contatct_person" class="form-control" autocomplete="off">
                           <input  type="text"  name="district" value="<?php echo $district; ?>"  id="district"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
							 <select required name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control"><option value="">-- Select District--</option>
                        <?php $dist=mysqli_query($connection,"SELECT * FROM m_district $condata order by districtname asc");
							while($data=mysqli_fetch_array($dist)){
							
								?>
							  <option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>
						<?php } ?>
                     </select>
                         <script>document.getElementById('districtid').value='<?php echo $districtid; ?>'; </script>
							
							<?php }?>
                       
						</td>
						</td>
							<th style="width: 20%;">ULB Name </th>
						<td style="width: 25%;">
                        	<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="ulbid" value="<?php echo $ulbid; ?>"  id="ulbid" class="form-control" autocomplete="off">
                           <input  type="text"  name="ulbname" value="<?php echo $ulbname; ?>"  id="ulbname"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
						 <select required name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from ulb_master $condata order by ulbname asc");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
						<?php } ?>
                     </select>
                       <script>document.getElementById('ulbid').value='<?php echo $ulbid; ?>'; </script>
							
							<?php }?>
                            
                        
						
						
						</td>
						
						
					</tr>
					<tr>
                    
					   	
						
												<th>Whether Executive Committee has been Formed (Y/N) </th>
						<td>
                          <select name="executive_commitee" id="executive_commitee"  class="form-control">
                       <option value="">-Select-</option>
                                           
                                          			<option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                           
                                      </select>  
                                         <script>document.getElementById('executive_commitee').value='<?php echo $executive_commitee; ?>'; </script>
                            </td>
                            <th>Date of Formation of EC</th>
						<td><input type="date" name="date_of_formation_ec"  autocomplete="off"  id="date_of_formation_ec" class="form-control datePicker "></td>
					
					</tr>
						
					
					<tr>

						
						<th>Executive Committee Meeting Date</th>
						<td><input type="date"  name="execommmeeting_date" id="execommmeeting_date" autocomplete="off"  class="form-control"></td>
                        	<th>Upload Minutes Of Meeting</th>
						<td><input type="file"  name="pdfmeeting"  autocomplete="off"  class="form-control"></td>
                    </tr>
					
				
					
			<tr>
						 <th>No. Of Members Participated</th>
						<td><input type="text" name="members_participated"  autocomplete="off"  id="members_participated" class="form-control datePicker "></td>	
						
					
                        <th>Meeting Photo </th>
						<td><input type="file" name="meetingphoto[]" multiple autocomplete="off" id="meetingphoto" class="form-control"></td>
						
					</tr>
                     <tr>
                      <td></td>
                     <td>
                     <input type="submit" name="submit" value="Submit" style="width:200px; float:none;" class="btn btn-success">
                     </td></tr>
				</table>
                </form>
</div>

<div id="shelter" class="tabcontent">
  <a href="sheltercommitee_list.php" class="btn btn-info" style="float:right;">Show List</a><br>
  <form name="addServiceForm" method="post" action="save_sheltercommiteesave.php" enctype="multipart/form-data">
        <table class="table table-bordered table-striped">
        <tr>
						<th style="width: 20%;">District Name</th>
						
                       <td>
						<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="contatct_person" class="form-control" autocomplete="off">
                           <input  type="text"  name="district" value="<?php echo $district; ?>"  id="district1"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
							 <select required name="districtid" id="districtid1" onChange="getulb1();getshelter1();"  class="form-control"><option value="">-- Select District--</option>
                        <?php $dist=mysqli_query($connection,"SELECT * FROM m_district $condata order by districtname asc");
							while($data=mysqli_fetch_array($dist)){
							
								?>
							  <option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>
						<?php } ?>
                     </select>
                         <script>document.getElementById('districtid').value='<?php echo $districtid; ?>'; </script>
							
							<?php }?>
                       
						</td>
						</td>
							<th style="width: 20%;">ULB Name </th>
						<td style="width: 25%;">
                        	<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="ulbid" value="<?php echo $ulbid; ?>"  id="ulbid" class="form-control" autocomplete="off">
                           <input  type="text"  name="ulbname" value="<?php echo $ulbname; ?>"  id="ulbname"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
						 <select required name="ulbid" id="ulbid1" onChange="getshelter1();"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from ulb_master $condata order by ulbname asc");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
						<?php } ?>
                     </select>
                       <script>document.getElementById('ulbid').value='<?php echo $ulbid; ?>'; </script>
							
							<?php }?>
                            
                        
						
						<div id="nor">
						
							</div>
						</td>
						
						
					</tr>
					<tr>
                    <th style="width: 20%;">Shelter Name</th>
					   	
						<td style="width: 25%;">
                        	<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="ngoid" value="<?php echo $ngoid; ?>"  id="ngoid" class="form-control" autocomplete="off">
                           <input  type="text"  name="ngo" value="<?php echo $ngo; ?>"  id="ngo"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
						        <select name="ngoid" id="ngoid1"  class="form-control" onChange="getdetails(this.value);">
                       <option value="">-Select Shelter Name-</option>
                                            <?php 
											$sql1 = "select distinct ngoname,ngoid from m_ngo $condata order by ngoname asc";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
													
											?>
                                          			<option value="<?php echo $row1['ngoid']; ?>"><?php echo $row1['ngoname']; ?></option>
                                            <?php
												}
												
												?>
                                      </select>  
                                         <script>document.getElementById('ngoid').value='<?php echo $ngoid; ?>'; </script>
							
							<?php }?>
                            
                
                        
                     </td>
												<th>Whether Executive Committee has been Formed (Y/N) </th>
						<td>
                          <select name="executive_commitee" id="executive_commitee"  class="form-control">
                       <option value="">-Select-</option>
                                           
                                          			<option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                           
                                      </select>  
                                         <script>document.getElementById('executive_commitee').value='<?php echo $executive_commitee; ?>'; </script>
                            </td>
					
					</tr>
						
					
					<tr>

						<th>Date of Formation of EC</th>
						<td><input type="date" name="date_of_formation_ec"  autocomplete="off"  id="date_of_formation_ec" class="form-control datePicker "></td>
						<th>Executive Committee Meeting Date</th>
						<td><input type="date"  name="execommmeeting_date" id="execommmeeting_date" autocomplete="off"  class="form-control"></td>
                    </tr>
					
				
					
			<tr>
						
						<th>Upload Minutes Of Meeting</th>
						<td><input type="file"  name="pdfmeeting"  autocomplete="off"  class="form-control"></td>
                        <th>Meeting Photo </th>
						<td><input type="file" name="meetingphoto[]" multiple autocomplete="off" id="meetingphoto" class="form-control"></td>
						
					</tr>
                     
                     <tr>
                     <th>No. Of Members Participated</th>
						<td><input type="text" name="members_participated"  autocomplete="off"  id="members_participated" class="form-control datePicker "></td>	
						
                     <td>
                     <input type="submit" name="submit" value="Submit" style="width:200px; float:none;" class="btn btn-success">
                     </td></tr>
				</table>
                </form>
</div>

	
       
		</div>
		</div>
		</div>
		</div>
		</div>
	
		<!-- end container -->
	</div>



	<?php include("inc/footer.php"); ?>
    
     <script>
	 function getdetails(ngoid)
{
	
	 jQuery.ajax({
		  type: 'POST',
		  url: 'getngodetails.php',
		  data: "ngoid="+ngoid,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		
		var jsonobj = jQuery.parseJSON(data);
						//$( "#shelter_type option:selected" ).text(jsonobj.s_type);					
			
				jQuery('#no_inmates').val(jsonobj.design_capacity);			
				
		
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
	 function getshelter1(){      

 var districtid = jQuery("#districtid1").val();
  var ulbid = jQuery("#ulbid1").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getngo.php',
		  data: "districtid="+districtid+'&ulbid='+ulbid,
		  dataType: 'html',
		  success: function(data){				  
	//	alert(data);
					
				
		
		jQuery('#ngoid1').html(data);//
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
function getulb1(){      
//alert('hello');
 var districtid = jQuery("#districtid1").val();
alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getulb.php',
		  data: "districtid="+districtid,
		  dataType: 'html',
		  success: function(data){	
		  jQuery('#ulbid1').html(data);
		
		
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}

	
	function getdistrict(){      
//alert('hello');
 var stateid = jQuery("#stateid").val();
//alert(stateid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getdistrict.php',
		  data: "stateid="+stateid,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		
		jQuery('#districtid').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}

	
	function getngo(){      
//alert('hello');
 var districtid = jQuery("#districtid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getngo.php',
		  data: "districtid="+districtid,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		
		jQuery('#ngoid').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}

	function getngo1(){      
//alert('hello');
 var districtid = jQuery("#districtid1").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getngo.php',
		  data: "districtid="+districtid,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		
		jQuery('#ngoid1').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
	
	
		
		function showhide(s_type)
		{
			//var s_type=jQuery("#s_type").val();
			
			if(s_type=='Normal'){
			   
			   jQuery("#Normal").show();
			   }
			else
				{
					 jQuery("#Normal").hide();
				}
		}
		
		function hideShowCorpus(bank_account_formed)
		{
		
			if(bank_account_formed =='Yes'){
			
			   jQuery("#showac").show();
			   }
			else
				{
					 jQuery("#showac").hide();
				}
			
			
		}
	</script>
   <script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>

</html>