<?php

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
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
$createdate=date('Y-m-d');
if ( isset( $_GET[ 'id' ] ) )
	$keyvalue = $_GET[ 'id' ];
else
	$keyvalue = 0;

if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";

if ( isset( $_POST[ 'submit' ] ) ) {
		$districtid =$_POST['districtid'];			
		$ngoid =$_POST['ngoid'];
		$ulbid =$_POST['ulbid'];
		$per_name=$_POST['per_name'];
		$date_of_birth=$_POST['date_of_birth'];
		$age=$_POST['age'];	
		$gender=$_POST['gender'];					
		$place_individual_identified=$_POST['place_individual_identified'];	
		$districtid=$_POST['districtid'];	
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
		$qualification=mysqli_real_escape_string($connection,$_POST['qualification']);
		$study_place=$_POST['study_place'];
		$health_condition=$_POST['health_condition'];
		$physical_ailment=$_POST['physical_ailment']; 
		$fir_copy= $_FILES['fir_copy'];
		$profile_photo= $_FILES['profile_photo'];
		$employment=$_POST['employment'];
		$company_name=$_POST['company_name'];
		$emp_type=$_POST['emp_type'];
		$skill=$_POST['skill'];
		$skill_type=$_POST['skill_type'];
		$otherskill=$_POST['otherskill'];
		$ssecurity=$_POST['ssecurity'];
		$adhaar_no=$_POST['adhaar_no'];
		$ration_no=$_POST['ration_no'];
		$bankac=$_POST['bankac'];
		$differently_abled=$_POST['differently_abled'];
		$remarks=$_POST['remarks'];
		$entry_time=$_POST['entry_time'];
		$profile_id=$_POST['profile_id'];
		$createdate=$_POST['createdate'];
		$noofchild=$_POST['noofchild'];
		$referrer_name=$_POST['referrer_name'];
		$ref_mobile=$_POST['ref_mobile'];
		$ref_occupation=$_POST['ref_occupation'];
		$ref_remark=$_POST['ref_remark'];



	//check Duplicate
	if ( $keyvalue == 0 ) { 
		$maxsize = 10485760;
		if(($_FILES['fir_copy']['size'] >= $maxsize))
		{ 
			echo "<script>location='$pagename?action=5'</script>";
		} 
// echo "insert into personal_details set company_name='$company_name',otherskill='$otherskill',stateid='$stateid',profile_id='$profile_id',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',per_name='$per_name',date_of_birth='$date_of_birth',age='$age',gender='$gender',place_individual_identified='$place_individual_identified',phone_no='$phone_no',alternative_phone_no='$alternative_phone_no',address='$address',percondition='$percondition',status='$status',domicile_state='$domicile_state',domicile_district='$domicile_district',domicile_village='$domicile_village',marital_status='$marital_status',last_stayed_place='$last_stayed_place',period_stayed_place='$period_stayed_place',connon_language='$connon_language',language_read='$language_read',language_write='$language_write',language_speak='$language_speak',qualification='$qualification',study_place='$study_place',health_condition='$health_condition',physical_ailment='$physical_ailment',employment='$employment',emp_type='$emp_type',skill='$skill',skill_type='$skill_type',ssecurity='$ssecurity',adhaar_no='$adhaar_no',ration_no='$ration_no',bankac='$bankac',userid='$loginid',noofchild='$noofchild',differently_abled='$differently_abled',remarks='$remarks',entry_time='$entry_time',createdate='$createdate',referrer_name='$referrer_name',ref_mobile='$ref_mobile',ref_occupation='$ref_occupation',ref_remark='$ref_remark'";die;
	mysqli_query($connection,"insert into personal_details set company_name='$company_name',otherskill='$otherskill',stateid='$stateid',profile_id='$profile_id',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',per_name='$per_name',date_of_birth='$date_of_birth',age='$age',gender='$gender',place_individual_identified='$place_individual_identified',				

		phone_no='$phone_no',alternative_phone_no='$alternative_phone_no',address='$address',percondition='$percondition',status='$status',

		domicile_state='$domicile_state',domicile_district='$domicile_district',domicile_village='$domicile_village',marital_status='$marital_status',last_stayed_place='$last_stayed_place',period_stayed_place='$period_stayed_place',connon_language='$connon_language',language_read='$language_read',language_write='$language_write',	

		language_speak='$language_speak',qualification='$qualification',study_place='$study_place',health_condition='$health_condition',physical_ailment='$physical_ailment',employment='$employment',emp_type='$emp_type',skill='$skill',skill_type='$skill_type',ssecurity='$ssecurity',adhaar_no='$adhaar_no',ration_no='$ration_no',bankac='$bankac',userid='$loginid',noofchild='$noofchild',differently_abled='$differently_abled',remarks='$remarks',entry_time='$entry_time',createdate='$createdate',referrer_name='$referrer_name',ref_mobile='$ref_mobile',ref_occupation='$ref_occupation',ref_remark='$ref_remark'");

		$keyvalue = mysqli_insert_id($connection);

		$uploaded_filename = uploadImage($imgpathfir,$fir_copy);
		mysqli_query($connection,"update personal_details set fir_copy='$uploaded_filename' where id='$keyvalue'");

		$uploaded_filename1 = uploadImage($imgpathinmate,$profile_photo);
		mysqli_query($connection,"update personal_details set profile_photo='$uploaded_filename1' where id='$keyvalue'");

		$action = 1;
	}
	else{
		mysqli_query($connection,"update personal_details set company_name=$company_name',otherskill='$otherskill',stateid='$stateid',profile_id='$profile_id',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',per_name='$per_name',date_of_birth='$date_of_birth',age='$age',gender='$gender',place_individual_identified='$place_individual_identified',				

					phone_no='$phone_no',alternative_phone_no='$alternative_phone_no',address='$address',percondition='$percondition',status='$status',

					domicile_state='$domicile_state',domicile_district='$domicile_district',domicile_village='$domicile_village',marital_status='$marital_status',last_stayed_place='$last_stayed_place',period_stayed_place='$period_stayed_place',connon_language='$connon_language',language_read='$language_read',language_write='$language_write',	

					language_speak='$language_speak',qualification='$qualification',study_place='$study_place',health_condition='$health_condition',physical_ailment='$physical_ailment',employment='$employment',emp_type='$emp_type',skill='$skill',skill_type='$skill_type',ssecurity='$ssecurity',adhaar_no='$adhaar_no',ration_no='$ration_no',bankac='$bankac',userid='$loginid',noofchild='$noofchild',createdate='$createdate',differently_abled='$differently_abled',remarks='$remarks',entry_time='$entry_time',referrer_name='$referrer_name',ref_mobile='$ref_mobile',ref_occupation='$ref_occupation',ref_remark='$ref_remark' where id = '$keyvalue'");

					//$keyvalue = mysqli_insert_id($connection);

				if($_FILES['fir_copy']['tmp_name']!="")
				{
					//delete old file
					$rowimg = mysqli_fetch_array(SelectDB($connection,$tblname,"id = '$keyvalue'"));
					$oldimg = $rowimg["fir_copy"];
					if($oldimg != "")
						unlink("uploaded/personal/fir/$oldimg");
						$uploaded_filename = uploadImage($imgpathfir,$fir_copy);
						//echo "update personal_details set fir_copy='$uploaded_filename' where id='$keyvalue'";die;
						mysqli_query($connection,"update personal_details set fir_copy='$uploaded_filename' where id='$keyvalue'");
				}

				if($_FILES['profile_photo']['tmp_name']!="")
				{
					//delete old file
					$rowimg = mysqli_fetch_array(SelectDB($connection,$tblname,"id = '$keyvalue'"));
					$oldimg = $rowimg["profile_photo"];

					if($oldimg != "")
						unlink("uploaded/personal/inmate/$oldimg");
						//insert new file
						$uploaded_filename1 = uploadImage($imgpathinmate,$profile_photo);
						//echo "update personal_details set profile_photo='$uploaded_filename1' where id='$keyvalue'";die;
						mysqli_query($connection,"update personal_details set profile_photo='$uploaded_filename1' where id='$keyvalue'");
				}

		$action = 2;

	}		
			echo "<script>location='$pagename?action=$action'</script>";

}



if (isset($_GET[$tblpkey])){

	//$btn_name = "Update";
	//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
	$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );
	$districtid =  $rowedit['districtid'];			
	$ngoid =  $rowedit['ngoid'];
	$ulbid =  $rowedit['ulbid'];
	$per_name=$rowedit['per_name'];
	$date_of_birth=$rowedit['date_of_birth'];
	$age=$rowedit['age'];	
	$gender=$rowedit['gender'];					
	$place_individual_identified=$rowedit['place_individual_identified'];	
	$districtid=$rowedit['districtid'];	
	$phone_no=$rowedit['phone_no'];								
	$alternative_phone_no=$rowedit['alternative_phone_no'];
	$address=$rowedit['address'];
	$percondition=$rowedit['percondition'];
	$status=$rowedit['status'];
	$domicile_state=$rowedit['domicile_state'];
	$domicile_district=$rowedit['domicile_district'];						
	$domicile_village=$rowedit['domicile_village'];						
	$marital_status=$rowedit['marital_status'];
	$last_stayed_place=$rowedit['last_stayed_place'];						
	$period_stayed_place=$rowedit['period_stayed_place'];					
	$connon_language=$rowedit['connon_language'];	
	$company_name=$rowedit['company_name'];
	$otherskill=$rowedit['$otherskill'];
	$language_read=$rowedit['language_read'];	
	$language_write=$rowedit['language_write'];	
	$language_speak=$rowedit['language_speak'];		
	$qualification=$rowedit['qualification'];
	$study_place=$rowedit['study_place'];
	$health_condition=$rowedit['health_condition'];
	$physical_ailment=$rowedit['physical_ailment']; 
	$fir_copy= $rowedit['fir_copy'];
	$profile_photo= $rowedit['profile_photo'];
	$employment=$rowedit['employment'];
	$emp_type=$rowedit['emp_type'];
	$skill=$rowedit['skill'];
	$skill_type=$rowedit['skill_type'];
	$ssecurity=$rowedit['ssecurity'];
	$adhaar_no=$rowedit['adhaar_no'];
	$ration_no=$rowedit['ration_no'];
	$bankac=$rowedit['bankac'];
	$differently_abled=$rowedit['differently_abled'];
	$remarks=$rowedit['remarks'];
	$entry_time=$rowedit['entry_time'];
	$createdate=$rowedit['createdate'];
	$noofchild=$rowedit['noofchild'];
	$referrer_name=$rowedit['referrer_name'];
	$ref_mobile=$rowedit['ref_mobile'];
	$ref_occupation=$rowedit['ref_occupation'];
	$ref_remark=$rowedit['ref_remark'];
} else {  
	//$districtid =  '';			
	//$ngoid = '';
	//$ulbid = '';
	$per_name='';
	$date_of_birth='';
	$age='';	
	$gender='';					
	$place_individual_identified='';	
	$phone_no='';								
	$alternative_phone_no='';
	$address='';
	$percondition='';
	$status='';
	$domicile_state='';
	$domicile_district='';						
	$domicile_village='';						
	$marital_status='';
	$last_stayed_place='';						
	$period_stayed_place='';					
	$connon_language='';	
	$language_read='';	
	$language_write='';	
	$language_speak='';		
	$qualification='';
	$study_place='';
	$health_condition='';
	$physical_ailment=''; 
	$fir_copy= '';
	$profile_photo= '';
	$employment='';
	$emp_type='';
	$company_name='';
	$otherskill='';
	$skill='';
	$skill_type='';
	$ssecurity='';
	$adhaar_no='';
	$ration_no='';
	$bankac='';
	$remarks='';
	$entry_time=date("H:i:s");
	$referrer_name='';
	$ref_mobile='';
	$ref_occupation='';
	$ref_remark='';
	$lastid=$cmn->getvalfield($connection,"personal_details","max(id)+1","1=1");

	$statecode=$cmn->getvalfield($connection,"m_state","statecode","1=1");

	$districtcode=$cmn->getvalfield($connection,"m_district","districtcode","districtid='$districtid'");

	$ulbcode=$cmn->getvalfield($connection,"ulb_master","ulbcode","ulbid='$ulbid'");

	$profile_id='SUHBEN-'.$statecode."-".$districtcode."-".$ulbcode."-".$lastid;

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
    <?php  include("inc/alerts.php");?>
		<form  method="post" action="" enctype="multipart/form-data"><div><input type="hidden" name="org.apache.struts.taglib.html.TOKEN" value="23dbbcf7349cfcf95cbba4067c3c7704"></div>
		<input type="hidden" name="key">
		<input type="hidden" name="service_id" value="" id="service_id">
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
        <h4 class="card-title">Entry of Beneficiary profile/Add Beneficiary Details</h4><a href="personal_details_list.php" class="btn btn-info" style="float:right;">Show List</a>
		</div>
		<div class="table-responsive">
        <input type="hidden" name="profile_id" value="<?php echo $profile_id;?>">
				<table class="table table-bordered table-striped">
                     <tr>
						<th style="width: 20%;">District Name</th>
                       <td>
						<?php if($usertype=='SHELTER')
                        { ?>
							<input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="districtid" class="form-control" autocomplete="off">
							<input  type="text"  name="district" value="<?php echo $district; ?>"  id="district"  readonly class="form-control" required autocomplete="off">
                        <?php 
						} else { 
						?>
							<select required name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control" required><option value="">-- Select District--</option>
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
						 <select name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control" required><option value="">-- Select --</option>

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

							

						        <select name="ngoid" id="ngoid"  class="form-control" required onChange="getdetails(this.value);">

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

						

					<th style="width: 20%;">Name</th>

						<td style="width: 25%;"><input type="text" onKeyUP="this.value = this.value.toUpperCase();" name="per_name" value="<?php echo $per_name; ?>"   id="per_name" class="form-control" required autocomplete="off"></td>

						

					</tr>

						

					

                	

					

					<tr>

						

						<th style="width: 20%;">Date of Birth</th>

						<td style="width: 25%;"><input type="date" name="date_of_birth" required value="<?php echo $date_of_birth; ?>" id="date_of_birth" onchange="getage(this.value)" class="form-control datePicker required" autocomplete="off"></td>

                        <th>Age </th>

						<td ><input type="number" name="age" required value="<?php echo $age; ?>" id="age" class="form-control" autocomplete="off"></td>

					

					</tr>

					<tr>

						

						<th >Gender</th>

						<td><input type="radio" name="gender" id="gender" value="Male"  <?php if($gender=='Male') {?>checked <?php } ?> required>  Male &nbsp;

						    <input type="radio" name="gender" id="gender"  value="Female" <?php if($gender=='Female') {?>checked <?php } ?>> &nbsp; Female

                               <input type="radio" name="gender" id="gender"  value="Third Gender"  <?php if($gender=='Third Gender') {?>checked <?php } ?>> &nbsp; Third Gender
						    <div id="gender_status_err" style="color: red;display: none;">Please select Gender</div> 

						 </td>

                         <th>Place Where Individual was Identified </th>

							<td><input type="text" onKeyUP="this.value = this.value.toUpperCase();" name="place_individual_identified" value="<?php echo $place_individual_identified; ?>" required  class="form-control"></td>	

					</tr>

				

                        <tr>

						

						

                        <th>Phone No</th>

							<td><input name="phone_no" value="<?php echo $phone_no; ?>"  type="text" pattern="[0-9]{1}[0-9]{9}"  oninvalid="setCustomValidity('Please Enter 10 Digit Mobile No.')"
    onchange="try{setCustomValidity('')}catch(e){}"  maxlength="10" id="phone_no" class="form-control" required autocomplete="off"></td>

					

					    <th>Alternative Phone No</th>

						<td><input type="text" name="alternative_phone_no"  value="<?php echo $alternative_phone_no; ?>"  pattern="[0-9]{1}[0-9]{9}"  oninvalid="setCustomValidity('Please Enter 10 Digit Mobile No.')"
    onchange="try{setCustomValidity('')}catch(e){}"  maxlength="10" id="alternative_phone_no" class="form-control" autocomplete="off"></td>

                        </tr>

					<tr>

						<th>Address</th>

						<td><input type="text" onKeyUP="this.value = this.value.toUpperCase();" name="address" value="<?php echo $address; ?>" class="form-control" required autocomplete="off"></td>	

					

						<th>Condition</th>

						<td>  

						   <select required name="percondition" id="percondition" class="form-control" required><option value="">-- Select --</option>

							<option value="Normal">Normal</option>

							<option value="Lunatic">Lunatic</option>

							<option value="Violent">Violent</option></select>

                              <script>document.getElementById('percondition').value='<?php echo $percondition; ?>'; </script>

						</td>

                        </tr>

					<tr>

					

						<th>Status</th>

						<td>    

						   <select required name="status" id="status" class="form-control" required><option value="">-- Select --</option>

							<option value="Outsted">Outsted</option>

							<option value="Stained Decision">Stained Decision</option>

							<option value="Destitute">Destitute</option>

							<option value="International">International</option></select>	

                              <script>document.getElementById('status').value='<?php echo $status; ?>'; </script>

						</td>

					

						<th>State of Domicile</th>

						<td><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="domicile_state" maxlength="20" value="<?php echo $domicile_state; ?>"  class="form-control" autocomplete="off"></td>

                         </tr>

					 

					 <tr>

					

						<th>District of Domicile</th>

						<td><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="domicile_district" maxlength="20" value="<?php echo $domicile_district; ?>"  id="domicile_district" class="form-control" required autocomplete="off"></td>

					

						<th>Town/Village of Domicile</th>

						<td><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="domicile_village"  maxlength="30" value="<?php echo $domicile_village; ?>"  class="form-control" required autocomplete="off"></td>

                         </tr>

					 

					  <tr>

					

						<th>Marital Status</th>

						<td>

						    <input type="radio" name="marital_status" id="marital_status"  value="Single" onClick="getChild(this.value);" <?php if($marital_status=='Single') {?>checked <?php } ?> required>&nbsp;Single &nbsp;

						    <input type="radio" name="marital_status" id="marital_status" value="Married" onClick="getChild(this.value);" <?php if($marital_status=='Married') {?>checked <?php } ?>>&nbsp;Married

                            <input type="radio" name="marital_status" id="marital_status" value="Widow" onClick="getChild(this.value);" <?php if($marital_status=='Widow') {?>checked <?php } ?>>&nbsp;Widow/Widower

                              <input type="number" name="noofchild" id="noofchild" maxlength="10" value="<?php echo $noofchild; ?>"  id="noofchild" class="form-control" placeholder="Enter No. of Children" style="display:none;"  autocomplete="off">

						    <div id="martial_status_err" style="color: red;display: none;">Please select Marital Status</div>

						</td>

					

					    <th>Last Place of Stay (State / District)</th>

						<td><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="last_stayed_place" value="<?php echo $last_stayed_place; ?>"  id="last_stayed_place" class="form-control" required autocomplete="off"></td>

						 </tr>

					  <tr>

						<th>How Many Days Staying?  (In Days)</th>

						<td><input required type="number" onKeyUP="this.value = this.value.toUpperCase();" name="period_stayed_place"  value="<?php echo $period_stayed_place; ?>"  id="period_stayed_place" class="form-control" required autocomplete="off"></td>

					

						<th>Common Language</th>

						<td><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="connon_language" value="<?php echo $connon_language; ?>"  class="form-control" required autocomplete="off"></td>

                         </tr>

					 <tr>

					

						<th>Language you can Read</th>

						<td><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="language_read" value="<?php echo $language_read; ?>"  class="form-control" required autocomplete="off"></td>

					

						<th>Language you can Write</th>

						<td><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="language_write" value="<?php echo $language_write; ?>"  class="form-control" required autocomplete="off"></td>

                         </tr>

					 

					 <tr>

					

						<th>Language you can Speak</th>

						<td><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="language_speak" value="<?php echo $language_speak; ?>"  class="form-control" required autocomplete="off"></td>

					 

						<th>Qualification</th>

						<td>
						 <select class="form-control dropdown" id="qualification" name="qualification" class="form-control"  required>
                            <option value="" selected="selected" disabled="disabled">-- select one --</option>
                            <option value="No formal education">No formal education</option>
                            <option value="Primary education">Primary education</option>
                            <option value="Secondary education">Secondary education or high school</option>
                            <option value="GED">GED</option>
                            <option value="Vocational qualification">Vocational qualification</option>
                            <option value="Bachelor's degree">Bachelor's degree</option>
                            <option value="Master's degree">Master's degree</option>
                            <option value="Doctorate or higher">Doctorate or higher</option>
                        </select>
                        	 <script>document.getElementById('qualification').value='<?php echo $qualification; ?>'; </script>					
						</td>

                        </tr>

					 

					  <tr>

					

						<th>Place of Study</th>

						<td><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="study_place" value="<?php echo $study_place; ?>"  class="form-control" required autocomplete="off"></td>

					

						<th>Health Condition</th>

						<td><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="health_condition" value="<?php echo $health_condition; ?>"  class="form-control" required autocomplete="off"></td>

					

						</tr>

					 

					  <tr>

						<th>Physical Ailment</th>

						<td>

                         <select  name="physical_ailment" id="physical_ailment" class="form-control" required><option value="">-- Select --</option>

							<option value="B.P">B.P</option>

							<option value="Diabetic">Diabetic</option>

								<option value="None">None</option>

							</select>

                              <script>document.getElementById('physical_ailment').value='<?php echo $physical_ailment; ?>'; </script>

                   </td>

						

					 

					    <th>Upload Police / ULB Officials Intimation Copy (Below 10 MB Size)</th>

						<td><input type="file" name="fir_copy" value="" id="fir_copy" class="form-control" required>

                       <?php  if($fir_copy!="") { ?>    <img id="blah" alt="" height='50'width='50' title='Text Image' src='<?php if($fir_copy!="" && file_exists("uploaded/personal/fir/".$fir_copy))

					        {

								echo "uploaded/personal/fir/".$fir_copy; }?>'/> <?php  } ?>

                        

                         </td>

                        </tr>

					 

					  <tr>

                          <th>Upload Photo <span>*</span></span></th>

						<td><input type="file" name="profile_photo" value="" id="profile_photo" class="form-control" required>

                        

                    <?php  if($profile_photo!="") { ?>  <img id="blah" alt="" height='50'width='50' title='Text Image' src='<?php if($profile_photo!="" && file_exists("uploaded/personal/inmate/".$profile_photo))

					        {

								echo "uploaded/personal/inmate/".$profile_photo; }?>'/><?php } ?>

                         </td>

										

						<th>Employment</th>

						<td>

                        <select  name="employment" id="employment" onChange="GetEmpType(this.value);"  class="form-control" required><option value="">-- Select --</option>

                      

							  <option value="Yes">Yes</option>

                               <option value="No">No</option>

						

                     </select>

                       <script>document.getElementById('employment').value='<?php echo $employment; ?>'; </script>

                     <br>

                     <div id="showemp_type" <?php if($employment=='Yes'){ ?> <?php } else { ?>style="display:none;" <?php } ?>>
<span><strong>Comapany Name</strong></span>

                      <input type="text"  name="company_name" id="company_name"   class="form-control" >

						
                     <span><strong>Designation</strong></span>

                      <input type="text"  name="emp_type" id="emp_type"   class="form-control" >

						
                              </div>

						</td>

						 </tr>

					 

					  <tr>

						 <th>Skilled</th>

						<td>

                          <select required name="skill" id="skill" onChange="GetSkillType(this.value);"  class="form-control"><option value="">-- Select --</option>

                      

							  <option value="Yes">Yes</option>

                               <option value="No">No</option>

						

                     </select>

                       <script>document.getElementById('skill').value='<?php echo $skill; ?>'; </script>

                     <br>

                 <?php if($skill=='Yes'){ ?>    <span><strong>Skill Type</strong></span><?php }?>

                      <select name="skill_type" id="skill_type" onChange="GetOtherSkill(this.value);"  <?php if($skill=='Yes'){ ?> <?php } else { ?>style="display:none;" <?php } ?>  class="form-control"><option value="">-- Skill Type --</option>

							<option value="Technical">Technical</option>

							<option value="Education">Education</option>

                            <option value="Electricity">Electricity</option>

                              <option value="Computer">Computer</option>

                                <option value="Other">Other</option>

                                </select>

                                  <script>document.getElementById('skill_type').value='<?php echo $skill_type; ?>'; </script>

                        <div id="showotherskill" <?php if($skill_type=='Other'){ ?> <?php } else { ?>style="display:none;" <?php } ?>>
                        <span><strong>Other Skill</strong></span>

                      <input type="text"  name="otherskill" id="otherskill"   class="form-control" >

						</td>

					

						<th>ID Proofs</th>

						<td>

                        <select required name="ssecurity" id="ssecurity" onChange="GetSocialSecurity(this.value);"   class="form-control"><option value="">-- Select --</option>

                      

							  <option value="Yes">Yes</option>

                               <option value="No">No</option>

						

                     </select>

                       <script>document.getElementById('ssecurity').value='<?php echo $ssecurity; ?>'; </script>

                     <br>

                     <div id="social" <?php if($ssecurity=='Yes'){ ?> <?php } else { ?>style="display:none;" <?php } ?> >

                      <span><strong>Adhar Number</strong></span>

                     <input type="text" name="adhaar_no" value="<?php echo $adhaar_no; ?>" placeholder="Enter Adhar Number"  class="form-control" autocomplete="off"><br>

                      <span><strong>Ration Number</strong></span>

                     <input type="text" name="ration_no" value="<?php echo $ration_no; ?>"  placeholder="Enter Ration Number" class="form-control " autocomplete="off"><br>

                    

                   

                   

                   </div>

                   

                   <div id="social2" <?php if($ssecurity=='No'){ ?> <?php } else { ?>style="display:none;" <?php } ?> >

                      <span><strong>Remark</strong></span>

                     <input type="text" name="remarks" value="<?php echo $remarks; ?>" placeholder="Enter Remark"  class="form-control" autocomplete="off"><br>

                   

                   </div>

						</td>

						 

						

					</tr>

                    

                    <tr>

						 <th>Differently Abled</th>

						<td>

                          <select name="differently_abled" id="differently_abled"  class="form-control" onChange="GetDisability(this.value);" required><option value=""  >-- Select --</option>

                      

							  <option value="Yes">Yes</option>

                               <option value="No">No</option>

						

                     </select>

                       <script>document.getElementById('differently_abled').value='<?php echo $differently_abled; ?>'; </script>
<div id="showdisability" <?php if($disability=='Yes'){ ?> <?php } else { ?>style="display:none;" <?php } ?> >

                      <span><strong>Disability</strong></span>

                     <input type="text" name="disability" value="<?php echo $disability; ?>" placeholder="Enter Disability"  class="form-control" autocomplete="off"><br>

                   </div>
                   </td>

                    <th>Child Care Facilities</th>

						<td>

                          <select name="childcare_facility" id="childcare_facility" onChange="getAnganwadi(this.value);"  class="form-control"><option value="">-- Select --</option>

                      

							  <option value="Yes">Yes</option>

                               <option value="No">No</option>

						

                     </select>

                       <script>document.getElementById('childcare_facility').value='<?php echo $childcare_facility; ?>'; </script>

                       

                       <div id="showagnawadi" <?php if($childcare_facility=='Yes'){ ?> <?php } else { ?>style="display:none;" <?php } ?> >

                      <span><strong> Anganwadi Centers Name</strong></span>

                     <input type="text" name="Anganwadi_name" value="<?php echo $Anganwadi_name; ?>" placeholder="Enter Anganwadi"  class="form-control" autocomplete="off">

                      

                   </div>

                   </td>

                   

					</tr>

                    

                    <tr>

					 <th>Adminssion Date</th>

						<td>

                          <input type="date" name="createdate" value="<?php echo $createdate; ?>" placeholder="Enter Adminssion"  class="form-control" autocomplete="off" >

                   </td>

                    <th>Entry Time</th>

						<td>

                          <input type="time" name="entry_time" value="<?php echo $entry_time; ?>" placeholder="Enter Entry Time" readonly class="form-control" autocomplete="off">

                   </td>	

                    

						

					</tr>

                    <tr>

                    

						<th colspan="4">Referrer Details</th>

					</tr>

                    <tr>

                   

					 <th>Name</th>

						<td>

                          <input type="text" name="referrer_name" value="<?php echo $referrer_name; ?>"  placeholder="Enter Name"  class="form-control" autocomplete="off" >

                   </td>

                    <th>Contact Number</th>

						<td>

                          <input type="text" name="alternative_phone_no"  value="<?php echo $alternative_phone_no; ?>"  pattern="[0-9]{1}[0-9]{9}"  oninvalid="setCustomValidity('Please Enter 10 Digit Mobile No.')"
    onchange="try{setCustomValidity('')}catch(e){}"  maxlength="10"  name="ref_mobile" value="<?php echo $ref_mobile; ?>" placeholder="Enter Contact No."  class="form-control" autocomplete="off">

                   </td>	

                    

						

					</tr>

                     <tr>

                  

					 <th>Occupation</th>

						<td>

                          <input type="text" name="ref_occupation" value="<?php echo $ref_occupation; ?>" placeholder="Enter Occupation"  class="form-control" autocomplete="off" >

                   </td>

                    <th>Remark</th>

						<td>

                          <input type="text" name="ref_remark" value="<?php echo $ref_remark; ?>" placeholder="Enter Remark"  class="form-control" autocomplete="off">

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



function GetEmpType(emp)

{

	if(emp=='Yes'){

			   

			   jQuery("#showemp_type").show();

			   }

			else

				{

					 jQuery("#showemp_type").hide();

				}

}

function GetOtherSkill(otherskill){
    // alert("ok");
    	if(otherskill=='Other'){

			   

			   jQuery("#showotherskill").show();

			   }

			else

				{

					 jQuery("#showotherskill").hide();

				}

}

function GetDisability(disability){
    // alert("ok");
    if(disability=='Yes'){

			   

			   jQuery("#showdisability").show();

			   }

			else

				{

					 jQuery("#showdisability").hide();

				}
}
function GetSkillType(skill)

{

	if(skill=='Yes'){

			   

			   jQuery("#skill_type").show();

			   }

			else

				{

					 jQuery("#skill_type").hide();

				}

}



function GetSocialSecurity(ssecurity)

{

	if(ssecurity=='Yes'){social2

			   

			   jQuery("#social").show();

			     jQuery("#social2").hide();

			   }

			else

				{

					 jQuery("#social").hide();

					   jQuery("#social2").show();

				}

}



 

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



	function getChild(data){

	if(data=='Married' || data=='Widow'){			   

			   jQuery("#noofchild").show();

			   }

			else

				{

					 jQuery("#noofchild").hide();

				}

		

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

		

		function getAnganwadi(data){

			if(data=='Yes'){

			   

			   jQuery("#showagnawadi").show();

			   }

			else

				{

					 jQuery("#showagnawadi").hide();

				}

		

		}

		function getage(date){
		    var today = new Date();
		    var todayYear = today.getFullYear();
            // today month
            var todayMonth = today.getMonth();
            //today date
            var todayDate = today.getDate();
var dob = new Date(date);
// dob year
var dobYear = dob.getFullYear();
// dob month
var dobMonth = dob.getMonth();
//dob date
var dobDate = dob.getDate();
var yearsDiff = todayYear - dobYear ;
var age;

if ( todayMonth < dobMonth ) 
 { 
  age = yearsDiff - 1; 
 }
else if ( todayMonth > dobMonth ) 
 {
  age = yearsDiff ; 
 }

else //if today month = dob month
 { if ( todayDate < dobDate ) 
  {
   age = yearsDiff - 1;
  }
    else 
    {
     age = yearsDiff;
    }
 }
 
 document.getElementById("age").value = age;	
		  //  alert(age);
		    
		}

	</script>

</body>



</html>