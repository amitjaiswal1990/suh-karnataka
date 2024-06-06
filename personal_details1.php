s<?php
include("adminsession.php");
$pagename = "personal_details.php";
$module = "Add Personals Details";
$submodule = "Add Personals Details";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "personal_details";
$tblpkey = "id";
$imgpathinmate = "uploaded/personal/inmate/";
$imgpathfir = "uploaded/personal/fir/";
if ( isset( $_GET[ 'id' ] ) )
	$keyvalue = $_GET[ 'id' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
	$per_name=$_POST['per_name'];;
$date_of_birth=$_POST['date_of_birth'];
$age=$_POST['age'];	
$gender=$_POST['gender'];					
$place_individual_identified=$_POST['place_individual_identified'];		
$stateid=$_POST['stateid'];				
$districtid=$_POST['districtid'];	
$corpmunicipal_id =  $_POST['corpmunicipal_id'];
$panchayat_id= $_POST['panchayat_id'];
$phone_no=$_POST['phone_no'];								
$alternative_phone_no=$_POST['alternative_phone_no'];
$address=$_POST['address'];
$percondition=$_POST['percondition'];
$status=$_POST['status'];
$domicile_state=$_POST['domicile_state'];
$domicile_district=$_POST['domicile_district'];						
$domicile_village=$_POST['domicile_village'];						
$marital_status=$_POST['marital_status'];
$last_stayed_place=$_POST['last_stayed_place'];						
$period_stayed_place=$_POST['period_stayed_place'];					
$connon_language=$_POST['connon_language'];	
$language_read=$_POST['language_read'];	
$language_write=$_POST['language_write'];	
$language_speak=$_POST['language_speak'];		
$qualification=$_POST['qualification'];
$study_place=$_POST['study_place'];
$health_condition=$_POST['health_condition'];
$physical_ailment=$_POST['physical_ailment']; 
$ngoid=$_POST['ngoid']; 
 $imgname= $_FILES['fir_copy'];
  $photo= $_FILES['profile_photo'];
$shelter_id=$_POST['shelter_id'];
	//check Duplicate



	mysqli_query($connection,"insert into personal_details set per_name='$per_name',date_of_birth='$date_of_birth',age='$age',ngoid='$ngoid',gender='$gender',place_individual_identified='$place_individual_identified',stateid='$stateid',				
districtid='$districtid',corpmunicipal_id='$corpmunicipal_id',panchayat_id='$panchayat_id',phone_no='$phone_no',alternative_phone_no='$alternative_phone_no',address='$address',percondition='$percondition',status='$status',
domicile_state='$domicile_state',domicile_district='$domicile_district',domicile_village='$domicile_village',marital_status='$marital_status',last_stayed_place='$last_stayed_place',period_stayed_place='$period_stayed_place',connon_language='$connon_language',language_read='$language_read',language_write='$language_write',	
language_speak='$language_speak',qualification='$qualification',study_place='$study_place',health_condition='$health_condition',physical_ailment='$physical_ailment',shelter_id='$shelter_id'");
	$keyvalue = mysqli_insert_id($connection);
	$uploaded_filename = uploadImage($imgpathfir,$imgname);
			mysqli_query($connection,"update personal_details set fir_copy='$uploaded_filename' where id='$keyvalue'");
			
			$uploaded_filename1 = uploadImage($imgpathinmate,$photo);
			mysqli_query($connection,"update personal_details set profile_photo='$uploaded_filename1' where id='$keyvalue'");
			
			echo "<script>location='$pagename?action=1'</script>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
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
	<link rel="stylesheet" href="plugins/morris/morris.css">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

	<?php include("inc/header.php");?>

	<div class="wrapper">
      <?php if($action==1){?> <div class="col-md-12"><h1><span style="color:#F00;">Record Inserted Successfully</span></h1></div>  <?php } ?>
		<form  method="post" action="" enctype="multipart/form-data"><div><input type="hidden" name="org.apache.struts.taglib.html.TOKEN" value="23dbbcf7349cfcf95cbba4067c3c7704"></div>
		<input type="hidden" name="key">
		<input type="hidden" name="service_id" value="" id="service_id">
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
						<h4 class="card-title">Personal Details Entry</h4>
		</div>
		<div class="table-responsive">
				<table class="table table-bordered table-striped">
                
                	
					
					<tr>
						<th style="width: 25%;">Name</th>
						<td style="width: 25%;"><input type="text" name="per_name" value="" onKeyUp="validateCharacters(this);" id="name" class="form-control required"></td>
						
						<th>Date of Birth</th>
						<td><input type="date" name="date_of_birth" value="" id="date_of_birth" class="form-control datePicker required"></td>
					</tr>
					<tr>
						<th style="width: 25%;">Age </th>
						<td style="width: 25%;"><input type="text" name="age" maxlength="2" value="" onKeyUp="intOnly(this);" id="age" class="form-control"></td>
					
						<th style="width: 25%;">Gender</th>
						<td><input type="radio" name="gender" value="Male"> &nbsp;&nbsp;&nbsp; Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						    <input type="radio" name="gender" value="Female"> &nbsp;&nbsp;&nbsp; Female
						    <div id="gender_status_err" style="color: red;display: none;">Please select Gender</div> 
						 </td>
					</tr>
					<tr>
						<th>Place Where Individual was Identified </th>
							<td><input type="text" name="place_individual_identified"  class="form-control"></td>
							
							<th>State</th>
							<td>
								   <select required name="stateid" id="stateid" onChange="getdistrict();getshelter();"   class="form-control">
                                   <option value="">-- Select --</option>
                        <?php $statesql=mysqli_query($connection,"select * from  m_state");
							while($data=mysqli_fetch_array($statesql)){?>
							  <option value="<?php echo $data['stateid']; ?>"><?php echo $data['statename']; ?></option>
						<?php } ?>
                        </select>
							</td>
						</tr>
						<tr>
							<th>District</th>
							<td>
								   <select required name="districtid" id="districtid" onChange="getmunicipal();getpanchayat();getngo();getshelter();"   class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from m_district");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['districtid']; ?>"><?php echo $data['districtname']; ?></option>
						<?php } ?>
                        </select>
							</td>
                            <th>Corporation / Municipality</th>
						<td>
				<select required name="corpmunicipal_id" id="corpmunicipal_id" style="width: 100%;" class="form-control"><option value="">Select Corporation</option>
							<?php $corp=mysqli_query($connection,"select * from m_corpmunicipal");
							while($data1=mysqli_fetch_array($corp)){?>						
<option value="<?php echo $data1['corpmunicipal_id'] ?>"><?php echo $data1['corpmunicipal'] ?> </option>
<?php } ?>
							</select>
						</td>
							
						</tr>
                        
                        <tr>
						
						<th>Townpanchayat Name</th>
						<td>
                        <select required name="panchayat_id" id="panchayat_id"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from m_townpanchayat");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['panchayat_id']; ?>"><?php echo $data['panchayat']; ?></option>
						<?php } ?>
                     </select>
						</td>
                        <th>Phone No</th>
							<td><input type="text" name="phone_no" maxlength="10" value="" onKeyUp="intOnly(this);" onChange="validateMobileNumber('#phone_no')" id="phone_no" class="form-control required"></td>
					</tr>
                        
					<tr>
					    <th>Alternative Phone No</th>
						<td><input type="text" name="alternative_phone_no" maxlength="10" value="" onKeyUp="intOnly(this);" onChange="validateMobileNumber('#alternative_phone_no')" id="alternative_phone_no" class="form-control required"></td>
						<th>Address</th>
						<td><input type="text" name="address" value="" onKeyUp="alphaNumericSlash(this);" class="form-control required"></td>	
					</tr>
					<tr>
						<th>Condition</th>
						<td>  
						   <select required name="percondition" id="condition" class="form-control required"><option value="">-- Select --</option>
							<option value="Normal">Normal</option>
							<option value="Lunatic">Lunatic</option>
							<option value="Violent">Violent</option></select>
						</td>
					
						<th>Status</th>
						<td>    
						   <select required name="status" id="status" class="form-control required"><option value="">-- Select --</option>
							<option value="Outsted">Outsted</option>
							<option value="Stained Decision">Stained Decision</option>
							<option value="Destitute">Destitute</option>
							<option value="INternational">INternational</option></select>	
						</td>
					 </tr>
					 
					 <tr>
						<th>State of Domicile</th>
						<td><input required type="text" name="domicile_state" maxlength="20" value="" onKeyUp="validateCharacters(this);" class="form-control"></td>
					
						<th>District of Domicile</th>
						<td><input required type="text" name="domicile_district" maxlength="20" value="" onKeyUp="validateCharacters(this);" id="domicile_district" class="form-control required"></td>
					 </tr>
					 
					  <tr>
						<th>Town/Village of Domicile</th>
						<td><input required type="text" name="domicile_village"  maxlength="30" value="" onKeyUp="validateCharacters(this);" class="form-control required"></td>
					
						<th>Marital Status</th>
						<td>
						    <input type="radio" name="marital_status" value="Single">&nbsp;&nbsp;&nbsp;Single &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						    <input type="radio" name="marital_status" value="Married">&nbsp;&nbsp;&nbsp;Married
						    <div id="martial_status_err" style="color: red;display: none;">Please select Marital Status</div>
						</td>
					 </tr>
					  <tr>
					    <th>Last Place of Stay (State / District)</th>
						<td><input required type="text" name="last_stayed_place" maxlength="50" value="" onKeyUp="validateCharacters(this);" id="last_stayed_place" class="form-control required"></td>
						
						<th>Period of Stay</th>
						<td><input required type="text" name="period_stayed_place" maxlength="50" value="" onKeyUp="alphaNumericCharacters(this);" id="period_stayed_place" class="form-control required"></td>
					 </tr>
					 <tr>
						<th>Common Language</th>
						<td><input required type="text" name="connon_language" value="" onKeyUp="validateCharacters(this);" class="form-control required"></td>
					
						<th>Language you can Read</th>
						<td><input required type="text" name="language_read" value="" onKeyUp="validateCharacters(this);" class="form-control required"></td>
					 </tr>
					 
					 <tr>
						<th>Language you can Write</th>
						<td><input required type="text" name="language_write" value="" onKeyUp="validateCharacters(this);" class="form-control required"></td>
					
						<th>Language you can Speak</th>
						<td><input required type="text" name="language_speak" value="" onKeyUp="validateCharacters(this);" class="form-control required"></td>
					 </tr>
					 
					  <tr>
						<th>Qualification</th>
						<td><input required type="text" name="qualification" value="" onKeyUp="alphaNumericCharacters(this);" class="form-control required"></td>
					
						<th>Place of Study</th>
						<td><input required type="text" name="study_place" value="" onKeyUp="alphaNumericCharacters(this);" class="form-control required"></td>
					 </tr>
					 <tr>
						<th>Health Condition</th>
						<td><input required type="text" name="health_condition" value="" onKeyUp="validateCharacters(this);" class="form-control required"></td>
					
						
						<th>Physical Ailment</th>
						<td><input required type="text" name="physical_ailment" value="" onKeyUp="validateCharacters(this);" class="form-control required"></td>
						
					 </tr>
					  <tr>
					    <th>Upload FIR Copy</th>
						<td><input type="file" name="fir_copy" value="" id="fir_copy" class="form-control required"> </td>
                          <th>Upload Photo</th>
						<td><input type="file" name="profile_photo" value="" id="profile_photo" class="form-control required"> </td>
					 </tr>
                     <tr>
						<th>Name of The N.G.O</th>
						<td>
                        <select required name="ngoid" id="ngoid"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from m_ngo");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ngoid']; ?>"><?php echo $data['ngoname']; ?></option>
						<?php } ?>
                     </select>
						</td>
						 
						 <th>Location of Shelter</th>
						<td>
                        <select required name="shelter_id" id="shelter_id"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from m_shelter");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['shelter_id']; ?>"><?php echo $data['location_of_shelter']; ?></option>
						<?php } ?>
                     </select>
						</td>
					</tr>
					 <tr>
						<td align="center" colspan="4">
						     <input type="submit" name="submit" value="Submit"  style="width:200px; float:none;" class="site-btn">
						</td>
					
					 </tr>

				</table>
		
		</div>
		</div>
		</div>
			</div>
			</div>
	</form>
		
		<!-- end container -->
	</div>



	<?php include("inc/footer.php"); ?>
<script>
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

	function getmunicipal(){      
//alert('hello');
 var districtid = jQuery("#districtid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getmunicipal.php',
		  data: "districtid="+districtid,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		
		jQuery('#corpmunicipal_id').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
function getpanchayat(){      
//alert('hello');
 var districtid = jQuery("#districtid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getpanchayat.php',
		  data: "districtid="+districtid,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		
		jQuery('#panchayat_id').html(data);//
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
	function getshelter(){      
//alert('hello');corpmunicipal_id
var corpmunicipal_id = jQuery("#corpmunicipal_id").val();	
var stateid = jQuery("#stateid").val();
 var districtid = jQuery("#districtid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getshelter.php',
		  data: "districtid="+districtid+"&stateid="+stateid+"&corpmunicipal_id="+corpmunicipal_id,
		  dataType: 'html',
		  success: function(data){				  
		alert(data);
		
		jQuery('#ngoid').html(data);//
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
	</script>
</body>

</html>