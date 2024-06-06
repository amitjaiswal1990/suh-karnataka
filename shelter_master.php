<?php
include("adminsession.php");
error_reporting(0);
$pagename = "shelter_master.php";
$module = "Add Shelter Details";
$submodule = "Shelter Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "m_shelter";
$tblpkey = "shelter_id";
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
$createdate = date('Y-m-d');	
	
if ( isset( $_GET[ 'shelter_id' ] ) )
	$keyvalue = $_GET[ 'shelter_id' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim($_GET['action']) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
	
	//$stateid= $_POST['stateid'];
	
			$s_type= $_POST['s_type'];	
			$districtid =  $_POST['districtid'];	
			$design_capacity =  $_POST['design_capacity'];
			$ngoid =  $_POST['ngoid'];
			$ulbid =  $_POST['ulbid'];
			$smaname =  $_POST['smaname'];
			$contatct_person =  $_POST['contatct_person'];
			$men =  $_POST['men'];
			$women =  $_POST['women'];
			$children =  $_POST['children'];
			$total =  $_POST['total'];			
			$register_type =  $_POST['register_type'];
			//print($register_type);
			//$regid =  $_POST['regid'];
			$ameniti_no =  $_POST['ameniti_no'];			
			$ameniti_type =  $_POST['ameniti_type'];
			$amenitiename =  $_POST['amenitiename'];
			$itemname =  $_POST['itemname'];
			$available =  $_POST['available'];
			$amenitieid =  $_POST['amenitieid'];			
			$male_aged_people_no =  $_POST['male_aged_people_no'];
			$male_children_no =  $_POST['male_children_no'];
			$male_others_no =  $_POST['male_others_no'];
			$male_differently_abled =  $_POST['male_differently_abled'];
			$female_aged_people_no =  $_POST['female_aged_people_no'];
			$female_children_no =  $_POST['female_children_no'];
			$female_others_no =  $_POST['female_others_no'];
			$female_differently_abled =  $_POST['female_differently_abled'];
			$registername =  $_POST['registername'];
			
			//print_r($registername);
			$corporate_bank_account =  $_POST['corporate_bank_account'];			
			$third_aged_people_no =  $_POST['third_aged_people_no'];
			$third_children_no =  $_POST['third_children_no'];
			$third_others_no =  $_POST['third_others_no'];
			$third_differently_abled =  $_POST['third_differently_abled'];
			$bank_name =  $_POST['bank_name'];
			$ifsc_code =  $_POST['ifsc_code'];
			$branch =  $_POST['branch'];
			$opening_date =  $_POST['opening_date'];
			$ac_no =  $_POST['ac_no'];
			$nulm_type =  $_POST['nulm_type'];
			$proposal_type =  $_POST['proposal_type'];
			$functional_type =  $_POST['functional_type'];
			$shelter_validity =  $_POST['shelter_validity'];
			$complete_address =  $_POST['complete_address'];
			$services_available =  $_POST['services_available'];
			$noof_manager =  $_POST['noof_manager'];
			$noof_caregiver =  $_POST['noof_caregiver'];
			$chief_organization =  $_POST['chief_organizat'];
			$building_type =  $_POST['building_type'];
			$noof_room =  $_POST['noof_room'];
			$noof_toilet =  $_POST['noof_toilet'];
			$noof_kitchen =  $_POST['noof_kitchen'];
			$noof_sickroom =  $_POST['noof_sickroom'];
			$cctv_installation =  $_POST['cctv_installation'];
			$sheltercode =  $_POST['sheltercode'];
			
				$check = check_duplicate($connection,$tblname,"districtid = '$districtid' && ulbid = '$ulbid' && ngoid = '$ngoid'  && $tblpkey <> $keyvalue");
		if($check > 0)
			{
			/*$dup = " Error : Duplicate Record";*/
			$dup="<div class='alert alert-danger'>
			<strong>Error!</strong> Error : Duplicate Record.
			</div>";
			} 
			else{
			
			if ( $keyvalue == 0 ) { 
		
	

		
	mysqli_query($connection,"insert into m_shelter set stateid='$stateid',design_capacity='$design_capacity',s_type='$s_type',ngoid='$ngoid',ulbid='$ulbid',smaname='$smaname',contatct_person='$contatct_person',men='$men',women='$women',children='$children',districtid='$districtid',total='$total',male_aged_people_no='$male_aged_people_no',male_children_no='$male_children_no',male_others_no='$male_others_no',male_differently_abled='$male_differently_abled',female_aged_people_no='$female_aged_people_no',female_children_no='$female_children_no',female_others_no='$female_others_no',female_differently_abled='$female_differently_abled',createdate='$createdate',corporate_bank_account='$corporate_bank_account',third_aged_people_no='$third_aged_people_no',third_children_no='$third_children_no',third_others_no='$third_others_no',third_differently_abled='$third_differently_abled',userid='$loginid',bank_name='$bank_name',ifsc_code='$ifsc_code',branch='$branch',ac_no='$ac_no',opening_date='$opening_date',nulm_type='$nulm_type',proposal_type='$proposal_type',functional_type='$functional_type',shelter_validity='$shelter_validity',complete_address='$complete_address',services_available='$services_available',noof_manager='$noof_manager',noof_caregiver='$noof_caregiver',chief_organization='$chief_organization',building_type='$building_type',noof_room='$noof_room',noof_toilet='$noof_toilet',noof_kitchen='$noof_kitchen',noof_sickroom='$noof_sickroom',cctv_installation='$cctv_installation',sheltercode='$sheltercode',approval_status=0");
					
					$lastid = mysqli_insert_id($connection);
					$totreg = count($registername);	
					for ($x = 0; $x < $totreg; $x++) {	
				//	echo "insert into save_register_type set shelter_id='$lastid',registername='$registername[$x]',register_type='$register_type[$x]'";
					mysqli_query($connection,"insert into save_register_type set shelter_id='$lastid',registername='$registername[$x]',register_type='$register_type[$x]'");
					}
					//die;
					$totam = count($amenitiename);	
					for ($i = 0; $i < $totam; $i++) {	
					mysqli_query($connection,"insert into save_amenities set shelter_id='$lastid',amenitiename='$amenitiename[$i]',ameniti_type='$ameniti_type[$i]',ameniti_no='$ameniti_no[$i]'");
					}
					
					$totki = count($itemname);	
					for ($k = 0; $k < $totki; $k++) {	
					
					mysqli_query($connection,"insert into  save_kichen set shelter_id='$lastid',kitemname='$itemname[$k]',available='$available[$k]',amenitieid='$amenitieid[$k]'");
					} 
					$action = 1;
					$process = "Inserted";
					}
			
			else
			{
				
				
				mysqli_query($connection,"update m_shelter set stateid='$stateid',design_capacity='$design_capacity',s_type='$s_type',ngoid='$ngoid',ulbid='$ulbid',smaname='$smaname',contatct_person='$contatct_person',men='$men',women='$women',children='$children',districtid='$districtid',total='$total',male_aged_people_no='$male_aged_people_no',male_children_no='$male_children_no',male_others_no='$male_others_no',male_differently_abled='$male_differently_abled',female_aged_people_no='$female_aged_people_no',female_children_no='$female_children_no',female_others_no='$female_others_no',female_differently_abled='$female_differently_abled',createdate='$createdate',corporate_bank_account='$corporate_bank_account',third_aged_people_no='$third_aged_people_no',third_children_no='$third_children_no',third_others_no='$third_others_no',third_differently_abled='$third_differently_abled',userid='$loginid',bank_name='$bank_name',ifsc_code='$ifsc_code',branch='$branch',ac_no='$ac_no',opening_date='$opening_date',nulm_type='$nulm_type',proposal_type='$proposal_type',functional_type='$functional_type',shelter_validity='$shelter_validity',complete_address='$complete_address',services_available='$services_available',noof_manager='$noof_manager',noof_caregiver='$noof_caregiver',chief_organization='$chief_organization',building_type='$building_type',noof_room='$noof_room',noof_toilet='$noof_toilet',noof_kitchen='$noof_kitchen',noof_sickroom='$noof_sickroom',cctv_installation='$cctv_installation',sheltercode='$sheltercode' where shelter_id = '$keyvalue'");
	
	//echo "delete from save_register_type where shelter_id = '$keyvalue'";die;
		mysqli_query($connection,"delete from save_register_type where shelter_id = '$keyvalue'");
		mysqli_query($connection,"delete from save_amenities where shelter_id = '$keyvalue'");
		mysqli_query($connection,"delete from save_kichen where shelter_id = '$keyvalue'");
		
	
	$lastid = mysqli_insert_id($connection);
	
	 $totreg = count($registername);	
	for ($x = 0; $x < $totreg; $x++) {	
	
	mysqli_query($connection,"insert into save_register_type set shelter_id='$keyvalue',registername='$registername[$x]',register_type='$register_type[$x]'");
	}
	
$totam = count($amenitiename);	
	for ($i = 0; $i < $totam; $i++) {	
	mysqli_query($connection,"insert into save_amenities set shelter_id='$keyvalue',amenitiename='$amenitiename[$i]',ameniti_type='$ameniti_type[$i]',ameniti_no='$ameniti_no[$i]'");
	}
	
	$totki = count($itemname);	
	for ($k = 0; $k < $totki; $k++) {	
	//echo "insert into  save_kichen set shelter_id='$keyvalue',kitemname='$itemname[$k]',available='$available[$k]',amenitieid='$amenitieid[$k]'";
	mysqli_query($connection,"insert into  save_kichen set shelter_id='$keyvalue',kitemname='$itemname[$k]',available='$available[$k]',amenitieid='$amenitieid[$k]'");
	}
	
	//die;			
				
				$action = 2;
			$process = "updated";
			}
	
		echo "<script>location='$pagename?action=$action'</script>";

}
}


if (isset($_GET[$tblpkey])){
//$btn_name = "Update";
//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );
$traindate = $rowedit[ 'traindate' ];

			$s_type= $rowedit['s_type'];	
			$districtid =  $rowedit['districtid'];	
			$design_capacity =  $rowedit['design_capacity'];
			$ngoid =  $rowedit['ngoid'];
			$ulbid =  $rowedit['ulbid'];
			$smaname =  $rowedit['smaname'];
			$contatct_person =  $rowedit['contatct_person'];
			$men =  $rowedit['men'];
			$women =  $rowedit['women'];
			$children =  $rowedit['children'];
			$total =  $rowedit['total'];			
			$register_type =  $rowedit['register_type'];
			$ameniti_no =  $rowedit['ameniti_no'];			
			$ameniti_type =  $rowedit['ameniti_type'];
			$amenitiename =  $rowedit['amenitiename'];
			$itemname =  $rowedit['itemname'];
			$available =  $rowedit['available'];
			$amenitieid =  $rowedit['amenitieid'];			
			$male_aged_people_no =  $rowedit['male_aged_people_no'];
			$male_children_no =  $rowedit['male_children_no'];
			$male_others_no =  $rowedit['male_others_no'];
			$male_differently_abled =  $rowedit['male_differently_abled'];
			$female_aged_people_no =  $rowedit['female_aged_people_no'];
			$female_children_no =  $rowedit['female_children_no'];
			$female_others_no =  $rowedit['female_others_no'];
			$female_differently_abled =  $rowedit['female_differently_abled'];
			$registername =  $rowedit['registername'];
			$corporate_bank_account =  $rowedit['corporate_bank_account'];			
			$third_aged_people_no =  $rowedit['third_aged_people_no'];
			$third_children_no =  $rowedit['third_children_no'];
			$third_others_no =  $rowedit['third_others_no'];
			$third_differently_abled =  $rowedit['third_differently_abled'];
			$bank_name =  $rowedit['bank_name'];
			$ifsc_code =  $rowedit['ifsc_code'];
			$branch =  $rowedit['branch'];
			$opening_date =  $rowedit['opening_date'];
			$ac_no =  $rowedit['ac_no'];
			$nulm_type =  $rowedit['nulm_type'];
			$proposal_type =  $rowedit['proposal_type'];
			$functional_type =  $rowedit['functional_type'];
			$shelter_validity =  $rowedit['shelter_validity'];
			$complete_address =  $rowedit['complete_address'];
			$services_available =  $rowedit['services_available'];
			$noof_manager =  $rowedit['noof_manager'];
			$noof_caregiver =  $rowedit['noof_caregiver'];
			$chief_organization =  $rowedit['chief_organizat'];
			$building_type =  $rowedit['building_type'];
			$noof_room =  $rowedit['noof_room'];
			$noof_toilet =  $rowedit['noof_toilet'];
			$noof_kitchen =  $rowedit['noof_kitchen'];
			$noof_sickroom =  $rowedit['noof_sickroom'];
			$cctv_installation =  $rowedit['cctv_installation'];
			$sheltercode =  $rowedit['sheltercode'];

} else {
$s_type='';	
		//	$districtid =  '';	
			//$design_capacity = '';
		//	$ngoid = '';
		//	$ulbid =  '';
			//$smaname = '';
			$contatct_person =  '';
			//$men = '';
			//$women =  '';
			//$children =  '';
			//$total = '';			
			$register_type = '';
			$ameniti_no =  '';			
			$ameniti_type =  '';
			$amenitiename =  '';
			$itemname = '';
			$available =  '';
			$amenitieid =  '';			
			
			$registername = '';
			$corporate_bank_account = '';			
			
			$bank_name = '';
			$ifsc_code = '';
			$branch = '';
			$opening_date =  '';
			$ac_no = '';
			$nulm_type = '';
			$proposal_type = '';
			$functional_type ='';
			$shelter_validity = '';
			$complete_address = '';
			$services_available = '';
			$noof_manager ='';
			$noof_caregiver = '';
			$chief_organization =  '';
			$building_type = '';
			$noof_room = '';
			$noof_toilet = '';
			$noof_kitchen ='';
			$noof_sickroom = '';
			$cctv_installation =  '';
			
			$lastid=$cmn->getvalfield($connection,"m_shelter","max(shelter_id)+1","1=1");
  $statecode=$cmn->getvalfield($connection,"m_state","statecode","1=1");
  $districtcode=$cmn->getvalfield($connection,"m_district","districtcode","districtid='$districtid'");
  $ulbcode=$cmn->getvalfield($connection,"ulb_master","ulbcode","ulbid='$ulbid'");
 $sheltercode='SUHDWD-'.$statecode."-".$districtcode."-".$ulbcode."-".$lastid;
			
			
		
}
	$male_children_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 0 AND 14 and gender='Male'  and differently_abled='No' and userid='$loginid'");
				$female_children_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 0 AND 14 and gender='Female' and differently_abled='No' and userid='$loginid'");
				$third_children_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 0 AND 14 and gender='Third Gender' and differently_abled='No' and userid='$loginid'");
				
				$male_aged_people_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 15 AND 59 and gender='Male' and differently_abled='No' and userid='$loginid'");
				$female_aged_people_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 15 AND 59 and gender='Female' and differently_abled='No' and userid='$loginid'");
				$third_aged_people_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 15 AND 59 and gender='Third Gender' and differently_abled='No' and userid='$loginid'");
				
				$male_others_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 60 AND 100 and gender='Male' and differently_abled='No' and userid='$loginid'");
				$female_others_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 60 AND 100 and gender='Female' and differently_abled='No' and userid='$loginid'");
				$third_others_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 60 AND 100 and gender='Third Gender' and differently_abled='No' and userid='$loginid'");
				
				$male_differently_abled=$cmn->getvalfield($connection,"personal_details","count(id)","differently_abled='Yes' and gender='Male' and userid='$loginid'");
				$female_differently_abled=$cmn->getvalfield($connection,"personal_details","count(id)","differently_abled='Yes' and gender='Female' and userid='$loginid'");
				$third_differently_abled=$cmn->getvalfield($connection,"personal_details","count(id)","differently_abled='Yes' and gender='Third Gender' and userid='$loginid'");
				
				 $men=$cmn->getvalfield($connection,"personal_details","count(id)","gender='Male' and userid='$loginid'");
				$women=$cmn->getvalfield($connection,"personal_details","count(id)","gender='Female' and userid='$loginid'");
				$children=$cmn->getvalfield($connection,"personal_details","count(id)","gender='Third Gender' and userid='$loginid'");
			 $total=$men+$women+$children;
			  $smaname=$cmn->getvalfield($connection,"m_ngo","smaname","ngoid='$ngoid'");



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
	<link rel="stylesheet" href="../plugins/morris/morris.css">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

	<?php  include("inc/header.php");?>

	<div class="wrapper">
    	<?php  include("inc/alerts.php");?>
        
         <?php if($dup!=""){?> <div class="col-md-12"><h1><span style="color:#F00;"><?php echo $dup;?></span></h1></div>  <?php } ?>
    
		<form name="addServiceForm" method="post" action="">
		
		<div class="container-fluid">
		<div class="text-center"></div>
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
						<h4 class="card-title">Shelter Master</h4><a href="shelter_list.php" class="btn btn-info" style="float:right;">Show List</a>
		</div>
		<div class="table-responsive">
			
			
			
				<table class="table table-bordered table-striped">
                
				<input type="hidden" name="sheltercode" value="<?php echo $sheltercode;?>">	<tr>
						<th><label>State Name<label></th>
						<td>
                        <label for="example-text-input" class="col-sm-6 col-form-label"><?php echo ucfirst(strtolower($statename));?></label>
                       
                       
                     </select>
						</td>
						<th>District Name</th>
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
						
						
					</tr>
					

					<tr>
						<th style="width: 25%;">ULB Name </th>
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
                            
                        
						
						<div id="nor">
						
							</div>
						</td>
						
						<th>Shelter Name</th>
                        <td style="width: 25%;">
                        	<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="ngoid" value="<?php echo $ngoid; ?>"  id="ngoid" class="form-control" autocomplete="off">
                           <input  type="text"  name="ngo" value="<?php echo $ngo; ?>"  id="ngo"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
						        <select name="ngoid" id="ngoid"  class="form-control" onChange="getdetails(this.value);">
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
					</tr>
                    
                    <tr>
						<th style="width: 25%;">SMA Name </th>
						<td style="width: 25%;">
						<input  type="text" name="smaname"  value="<?php echo $smaname; ?>"  id="smaname" class="form-control" autocomplete="off">
						<div id="nor">
						
							</div>
						</td>
						
						<th>Contact Person</th>
                        <td style="width: 25%;"><input  type="text"  name="contatct_person" value="<?php echo $contatct_person; ?>"  id="contatct_person" class="form-control" autocomplete="off"></td>
					</tr>
					
					 
                    
                    <tr>
						<th style="width: 25%;">Shelter Type </th>
						<td style="width: 25%;">
						<select  id="s_type" name="s_type" onChange="getstype(this.value);" value="<?php echo $s_type; ?>" <?php if($keyvalue!=0){ ?> disabled <?php } ?> class="form-control" ><option value="">-- Select --</option>
							
								<option value="Men">Men shelters </option>
								<option value="Women">Women shelters: For the needs of women and their dependent children. </option>
                                <option value="Men and Women">Family Shelters: For families living on the streets </option>
                                <option value="Special Shelters">Special Shelters: old persons without care, mentally ill, recovering patients and their families</option>
                                <option value="Third Gender">Transgender Shelter</option>
							</select>
                              <script>document.getElementById('s_type').value='<?php echo $s_type; ?>'; </script>                    
                                      
						</td>
						
						<th>Capacity</th>
                        <td style="width: 25%;"> <input  type="text"  name="design_capacity" maxlength="50" value="<?php echo $design_capacity; ?>"  id="design_capacity" class="form-control " autocomplete="off" <?php if($keyvalue!=0){ ?>readonly<?php } ?>></td>
					</tr>
                    
                    
                    
                    
                    <tr>
						<th style="width: 25%;">NULM Type </th>
						<td style="width: 25%;">
						<select  id="s_type" name="nulm_type"  value="<?php echo $nulm_type; ?>" class="form-control" ><option value="">-- Select --</option>
                        <option value="NULM Shelter">NULM Shelter</option>
								<option value="NON NULM Shelter">NON NULM Shelter </option>
							</select>
                              <script>document.getElementById('nulm_type').value='<?php echo $nulm_type; ?>'; </script>                    
                                      
						</td>
						
						<th>Shelter Proposal Type</th>
                        <td style="width: 25%;">
                        <select  id="proposal_type" name="proposal_type"  value="<?php echo $proposal_type; ?>" class="form-control" ><option value="">-- Select --</option>
							
								<option value="New Construction">New Construction</option>
								<option value="O and M Only">O and M Only </option>
                                <option value="Refurbishment">Refurbishment </option>
							</select>
                              <script>document.getElementById('proposal_type').value='<?php echo $proposal_type; ?>'; </script>          
                              </td>
					</tr>
                    
                    <tr>
						<th style="width: 25%;">Functional Type </th>
						<td style="width: 25%;">
						<select  id="functional_type" name="functional_type"  value="<?php echo $functional_type; ?>" class="form-control" ><option value="">-- Select --</option>
							
								<option value="Shelter Functional">Shelter Functional</option>
								<option value="Non Functional">Non Functional </option>
							</select>
                              <script>document.getElementById('functional_type').value='<?php echo $functional_type; ?>'; </script>                    
                                      
						</td>
						
						<th>Period of Validity to run the Shelter</th>
                        <td style="width: 25%;">
                        <input type="text" name="shelter_validity" value="<?php echo $shelter_validity; ?>" placeholder="Enter Period of Validity to run the Shelter" class="form-control" autocomplete="off">       
                              </td>
					</tr>
                    
                    <tr>
						<th>Complete Address</th>
                        <td style="width: 25%;">
                        <input type="text" name="complete_address" value="<?php echo $complete_address; ?>" placeholder="Enter Complete Address" class="form-control" autocomplete="off">       
                              </td>
						
						<th style="width: 25%;">Services Available </th>
						<td style="width: 25%;">
						<select  id="services_available" name="services_available"  value="<?php echo $services_available; ?>" class="form-control" ><option value="">-- Select --</option>
							
								<option value="Education">Education</option>
								<option value="Health Check-Ups">Health Check-Ups</option>
                                <option value="Counselling">Counselling</option>
							</select>
                              <script>document.getElementById('services_available').value='<?php echo $services_available; ?>'; </script>                    
                                      
						</td>
					</tr>
                    
                    <tr>
						<th style="width: 25%;">Whether Bank Account has been Opened Corpus fund  (Y/N)</th>
						<td style="width: 25%;">
					<select  name="corporate_bank_account"  id="corporate_bank_account" class="form-control" onChange="GetBank(this.value);"  ><option value="">-- Select --</option>
								  <option value="YES">YES</option>
								  <option value="NO">NO</option></select>
                                    <script>document.getElementById('corporate_bank_account').value='<?php echo $corporate_bank_account; ?>'; </script>
                                  <br>
                                  
                             <div id="bank" <?php if($corporate_bank_account=='YES'){ ?> <?php } else { ?>style="display:none;" <?php } ?> >
                     <input type="text" name="bank_name" value="<?php echo $bank_name; ?>" placeholder="Enter Bank name"  class="form-control" autocomplete="off"><br>
                     <input type="text" name="ac_no" value="<?php echo $ac_no; ?>"  placeholder="Enter A/C No." class="form-control" autocomplete="off"><br>
                         <input type="text" name="ifsc_code" value="<?php echo $ifsc_code; ?>"  placeholder="Enter IFSC Code" class="form-control" autocomplete="off"><br>
                     <input type="text" name="branch" value="<?php echo $branch; ?>" placeholder="Enter Branch" class="form-control" autocomplete="off"><br>
                       <input type="date" name="opening_date" value="<?php echo $opening_date; ?>" placeholder="Enter Account Opening Date" class="form-control" autocomplete="off">
                   </div>      
							
						</td>
                       
                        
						
						
					</tr>
                     
                    
                      <tr><th colspan="4">Staffing</th></tr>
					<tr>	
						<td colspan="4">
						   <table style="width: 100%">
						     <tr>
						        <th>Number of Manager</th>
						        <th>Number of Caregiver</th>
						        <th>Name and contact of Chief Functionary of the Organization</th>
						       
						     </tr>
						     
						     
							      <tr>
							      <td><input  type="number" name="noof_manager" id="noof_manager"  value="<?php echo $noof_manager; ?>"   class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="noof_caregiver" id="noof_caregiver"  value="<?php echo $noof_caregiver; ?>" class="form-control" autocomplete="off"></td>
							        <td><input  type="text" name="chief_organization" id="chief_organization"  value="<?php echo $chief_organization; ?>" class="form-control" autocomplete="off"></td>
							       
							     </tr>
						     
						     
							     
						     
						   </table>
						</td>
					</tr>
                    
                      <tr><th colspan="4">Infrastructure</th></tr>
					<tr>	
						<td colspan="4">
						   <table style="width: 100%">
						     <tr>
						        <th>Building Type</th>
						        <th>No. of Rooms</th>
						        <th>No. of Toilets</th>
						        <th>No. of Kitchen</th>
                                 <th>No of Sick Room</th>
                                   <th>CCTV installation at Entry and Exit point</th>
						     </tr>
						     
						     
							      <tr>
							      <td>
                                  <select  name="building_type"  id="building_type" class="form-control" ><option value="">-- Select --</option>
								  <option value="Rent">Rent</option>
								  <option value="Own">Own</option></select>
                                    <script>document.getElementById('building_type').value='<?php echo $building_type; ?>'; </script>
                                    </td>
							        <td><input  type="number" name="noof_room" id="noof_room"  value="<?php echo $noof_room; ?>"  class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="noof_toilet" id="noof_toilet"  value="<?php echo $noof_toilet; ?>"  class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="noof_kitchen" id="noof_kitchen"   value="<?php echo $noof_kitchen; ?>"   class="form-control" autocomplete="off"></td>
                                      <td><input  type="number" name="noof_sickroom" id="noof_sickroom"   value="<?php echo $noof_sickroom; ?>"   class="form-control" autocomplete="off"></td>
                                        <td>
                                  <select  name="cctv_installation"  id="cctv_installation" class="form-control" ><option value="">-- Select --</option>
								  <option value="YES">YES</option>
								  <option value="NO">NO</option></select>
                                    <script>document.getElementById('cctv_installation').value='<?php echo $cctv_installation; ?>'; </script>
                                    </td>
							     </tr>
						     
						     
							     
						     
						   </table>
						</td>
					</tr>
					    
					 <tr><th colspan="4">Inmates details (Now Occupied)</th></tr>
					<tr>	
						<td colspan="4">
						   <table style="width: 100%">
						     <tr>
						        <th>Male</th>
						        <th>Female</th>
						        <th>Third Gender</th>
						        <th>Total</th>
						     </tr>
						     
						     
							      <tr>
							      <td><input  type="number" name="men" id="men"  value="<?php echo $men; ?>" onChange="gettotal();"   class="form-control" readonly autocomplete="off"></td>
							        <td><input  type="number" name="women" id="women"  value="<?php echo $women; ?>" onChange="gettotal();" readonly  class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="children" id="children"  value="<?php echo $children; ?>" onChange="gettotal();" readonly class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="total" id="total"   value="<?php echo $total; ?>" readonly  class="form-control" autocomplete="off"></td>
							     </tr>
						     
						     
							     
						     
						   </table>
						</td>
					</tr>		
					<tr>
						<th colspan="4"> Residents Now Occupied</th>
					</tr>
					<tr>	
						<td colspan="4">
						   <table style="width: 100%">
						     <tr>
						        <th>Sl.No</th>
						        <th>Type</th>
						        <th>Male</th>
						        <th>Female</th>
                                 <th>Third Gender</th>
						     </tr>
						     
						     
							      <tr>
							        <td>1.</td>
							        <td>Adult</td>
							        <td><input  type="number" name="male_aged_people_no" maxlength="7" value="<?php echo $male_aged_people_no; ?>" readonly class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="female_aged_people_no" maxlength="7" value="<?php echo $female_aged_people_no; ?>" readonly  class="form-control" autocomplete="off"></td>
                                     <td><input  type="number" name="third_aged_people_no" maxlength="7" value="<?php echo $third_aged_people_no; ?>" readonly  class="form-control" autocomplete="off"></td>
							     </tr>
						     
						     
							      <tr>
							        <td>2.</td>
							        <td>Children</td>
							        <td><input  type="number" name="male_children_no" maxlength="7" value="<?php echo $male_children_no; ?>" readonly class="form-control " autocomplete="off"></td>
							        <td><input  type="number" name="female_children_no" maxlength="7" value="<?php echo $female_children_no; ?>" readonly class="form-control " autocomplete="off"> </td>
                                     <td><input  type="number" name="third_children_no" maxlength="7" value="<?php echo $third_children_no; ?>" readonly class="form-control " autocomplete="off"></td>
							     </tr>
						     
						     
							      <tr>
							        <td>3.</td>
							        <td>Senior Citizen</td>
							        <td><input  type="number" name="male_others_no" maxlength="7" value="<?php echo $male_others_no; ?>" readonly onKeyUp="numericOnly(this)" class="form-control " autocomplete="off"></td>
							        <td><input  type="number" name="female_others_no" maxlength="7" value="<?php echo $female_others_no; ?>" readonly onKeyUp="numericOnly(this)" class="form-control " autocomplete="off"></td>
                                    <td><input  type="number" name="third_others_no" maxlength="7" value="<?php echo $third_others_no; ?>" readonly onKeyUp="numericOnly(this)" class="form-control " autocomplete="off"></td>
							     </tr>
						     
						     
							      <tr>
							        <td>4.</td>
							        <td>Differently Abled</td>
							        <td><input  type="number" name="male_differently_abled" maxlength="7" value="<?php echo $male_differently_abled; ?>" readonly class="form-control " autocomplete="off"></td>
							        <td><input  type="number" name="female_differently_abled" maxlength="7" value="<?php echo $female_differently_abled; ?>" readonly class="form-control " autocomplete="off"></td>
                                    <td><input  type="number" name="third_differently_abled" maxlength="7" value="<?php echo $third_differently_abled; ?>" readonly class="form-control " autocomplete="off"></td>
							     </tr>
						     
						     
						   </table>
						</td>
					</tr>
					    <tr><th colspan="4">Register</th></tr>
						<tr>
						<td colspan="4">   
						     <table style="width:100%">
						     <tr>
						        <th>Sl.No</th>
						        <th>Register Type</th>
						        <th style="text-align: center;">Yes</th>
						        <th style="text-align: center;">No</th>
						     </tr>
						     
						     <?php
								
								 $sn=1;
								 if (isset($_GET[$tblpkey])){
								
								$reg=mysqli_query($connection,"select * from save_register_type where shelter_id='$_GET[$tblpkey]' group by registername"); 								
							     while($data3=mysqli_fetch_array($reg)){?>
                                 <tr>
									<td><?php echo $sn;?> </td>
							        <td><?php echo $data3['registername'];?><input type="hidden" name="registername[]" value="<?php echo $data3['registername'];?>">
                                  
                                    </td>
							        <td><input type="radio"  name="register_type[]<?php echo $sn;?>" value="Yes"    class="form-control" <?php if($data3['register_type']=='Yes') {?>checked <?php } ?>></td>
						            <td><input type="radio"  name="register_type[]<?php echo $sn;?>" value="No"  class="form-control" <?php if($data3['register_type']=='No') {?>checked <?php } ?>> </td>
							     </tr>
								<?php $sn++; } }
								 else
								 {
								
									  $reg=mysqli_query($connection,"select * from m_register"); 
									   while($data3=mysqli_fetch_array($reg)){?>
                                 <tr>
									<td><?php echo $sn;?> </td>
							        <td><?php echo $data3['registername'];?><input type="hidden" name="registername[]" value="<?php echo $data3['registername'];?>">
                                   
                                    </td>
							        <td><input type="radio"  name="register_type[]<?php echo $sn;?>" value="Yes"  required  class="form-control" <?php if($register_type=='Yes') {?>checked <?php } ?>></td>
						            <td><input type="radio"  name="register_type[]<?php echo $sn;?>" value="No"  class="form-control" <?php if($register_type=='No') {?>checked <?php } ?>> </td>
							     </tr>
								<?php $sn++;  }
								 }
																	 
									 ?>
								 
						     
							  
						     
						     </table></td>
						     </tr>
						   
						   
						     <tr>
						     <th colspan="4">Basic Amenities</th>
						     </tr>
						     <tr>
						     <td colspan="4">
						     
						     
						     <table style="width: 100%;">
							     <tr>
							        <th>Sl.No</th>
							        <th>Item</th>
                                       <th>Number</th>
							        <th style="text-align: center;">Yes</th>
							        <th style="text-align: center;">No</th>
							     </tr>
                                 
                                 <?php 
								  $sn=1;
								 if (isset($_GET[$tblpkey])){
								//echo "select * from save_amenities where shelter_id='$_GET[$tblpkey]' group by amenitiename";	
								$reg=mysqli_query($connection,"select * from save_amenities where shelter_id='$_GET[$tblpkey]' group by amenitiename"); 								
							     while($data3=mysqli_fetch_array($reg)){
									
									 ?>
                                 <tr>
									 <td><?php echo $sn;?> </td>
							        <td><?php echo $data3['amenitiename'];?><input type="hidden" name="amenitiename[]" value="<?php echo $data3['amenitiename'];?>">
                                    <?php if($data3['amenitiename']=='KITCHEN') { 
								
									?>
                                    <div id="kichendata">
                                    <table>
                                    <tr><th>Item</th><th>Yes</th><th>No</th></tr>
                                   <?php 
								    $sn1=1;
								   $reg1=mysqli_query($connection,"select * from save_kichen where shelter_id='$data3[shelter_id]' group by kitemname"); 								
							     while($data4=mysqli_fetch_array($reg1)){?>
                                    <tr>
                                    <td><?php echo $data4['kitemname'];?><input type="hidden" name="itemname[]" value="<?php echo $data4['kitemname'];?>"><input type="hidden" name="amenitieid[]" value="<?php echo $data4['amenitieid'];?>">
                                    </td>
                                      <td><input type="radio"   name="available[]<?php echo $sn1;?>"  value="Yes" <?php if($data4['available']=='Yes') {?>checked <?php } ?> class="form-control"></td>
						            <td><input type="radio"  name="available[]<?php echo $sn1;?>" value="No" <?php if($data4['available']=='No') {?>checked <?php } ?> class="form-control"> </td>
                                    </tr>
                                    
                                      <?php  $sn1++; } ?>
                                    </table>
                                    </div>
                                    <?php } ?>
                                    
                                    </td>
                                      <td><?php if($data3['amenitiename']=='COT' || $data3['amenitiename']=='BEDDING' || $data3['amenitiename']=='TOILETS') {?><input type="number"  name="ameniti_no[]"   style="width:140px;" value="<?php echo $data3['ameniti_no'];?>" placeholder="<?php if($data3['amenitiename']=='COT'){ ?>No.of Amenities <?php } ?> " class="form-control"> <?php } else { ?>
                                      <input type="hidden"  name="ameniti_no[]" value="0"  class="form-control" style="width:110px;"> <?php }?>
                                      </td>
							        <td><input type="radio" name="ameniti_type[]<?php echo $sn;?>" value="Yes" required onClick="getKichan(this.value,'<?php echo $data3['amenitiename'];?>');"  class="form-control" <?php if($data3['ameniti_type']=='Yes') {?>checked <?php } ?>></td>
						            <td><input type="radio" name="ameniti_type[]<?php echo $sn;?>" value="No"  onClick="getKichan(this.value,'<?php echo $data3['amenitiename'];?>');" class="form-control" <?php if($data3['ameniti_type']=='No') {?>checked <?php } ?>> </td>
							     </tr>
								<?php $sn++; } }
								 else
								 {
								
									  $reg=mysqli_query($connection,"select * from m_amenities"); 
									   while($data3=mysqli_fetch_array($reg)){?>
                                 <tr>
									 <td><?php echo $sn;?> </td>
							        <td><?php echo $data3['amenitiename'];?><input type="hidden" name="amenitiename[]" value="<?php echo $data3['amenitiename'];?>">
                                    <?php if($data3['amenitiename']=='KITCHEN') { ?>
                                    <div id="kichendata" style="display:none;">
                                    <table>
                                    <tr><th>Item</th><th>Yes</th><th>No</th></tr>
                                   <?php 
								    $sn1=1;
								   $reg1=mysqli_query($connection,"select * from m_kichen"); 								
							     while($data4=mysqli_fetch_array($reg1)){?>
                                    <tr>
                                    <td><?php echo $data4['itemname'];?><input type="hidden" name="itemname[]" value="<?php echo $data4['itemname'];?>"><input type="hidden" name="amenitieid[]" value="<?php echo $data3['amenitieid'];?>">
                                    </td>
                                      <td><input type="radio"   name="available[]<?php echo $sn1;?>"  value="Yes" class="form-control"></td>
						            <td><input type="radio"  name="available[]<?php echo $sn1;?>" value="No"  class="form-control"> </td>
                                    </tr>
                                    
                                      <?php  $sn1++; } ?>
                                    </table>
                                    </div>
                                    <?php } ?>
                                    
                                    </td>
                                      <td><?php
									  
									
									  if($data3['amenitiename']=='COT' || $data3['amenitiename']=='BEDDING' || $data3['amenitiename']=='TOILETS') {?><input type="number"  name="ameniti_no[]"   style="width:140px;" placeholder="<?php if($data3['amenitiename']=='COT'){ ?>No.of Amenities <?php } ?> " class="form-control"> <?php } else { ?>
                                      <input type="hidden"  name="ameniti_no[]" value="0"  class="form-control" style="width:110px;"> <?php }?>
                                      </td>
							        <td><input type="radio" name="ameniti_type[]<?php echo $sn;?>" value="Yes" required onClick="getKichan(this.value,'<?php echo $data3['amenitiename'];?>');"  class="form-control"></td>
						            <td><input type="radio" name="ameniti_type[]<?php echo $sn;?>" value="No"  onClick="getKichan(this.value,'<?php echo $data3['amenitiename'];?>');" class="form-control"> </td>
							     </tr>
								<?php $sn++;  }
								 }
																	 
									 ?>
                                     
                                 
							     
						   </table>
						   </td>
					   </tr>
						   
						   
						     
						     
					   <tr>
							<td align="center" colspan="4">
								<input type="submit" name="submit" value="Submit" style="width:200px; float:none;" class="site-btn">
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
	
	function gettotal()
	{
		var men= parseFloat(jQuery('#men').val());  
		var women= parseFloat(jQuery('#women').val());  
		var children= parseFloat(jQuery('#children').val());  
		
		   var tot=men+women+children;
		 jQuery('#total').val(tot);//  alert(tot);
		   
	}
function getKichan(avail,amenitiename)
{

			if(amenitiename=='KITCHEN' && avail=='Yes'){
			   
			   jQuery("#kichendata").show();
			   }
			    else
			   {
				    jQuery("#kichendata").hide();
			   }
			
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
		//alert(data);
		jQuery('#s_type').val('');	
				jQuery('#design_capacity').val('');			
				jQuery('#men').val('');
				jQuery('#women').val('');
				jQuery('#children').val('');
				jQuery('#total').val('');				
				jQuery('#smaname').val('');
				jQuery('#contatct_person').val('');
		jQuery('#ulbid').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
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
					
				jQuery('#s_type').val('');	
				jQuery('#design_capacity').val('');			
				jQuery('#men').val('');
				jQuery('#women').val('');
				jQuery('#children').val('');
				jQuery('#total').val('');				
				jQuery('#smaname').val('');
				jQuery('#contatct_person').val('');
		
		jQuery('#ngoid').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}

function getdetails(ngoid)
{
	
	 jQuery.ajax({
		  type: 'POST',
		  url: 'getngodetails.php',
		  data: "ngoid="+ngoid,
		  dataType: 'html',
		  success: function(data){				  
		
		
		var jsonobj = jQuery.parseJSON(data);
						//$( "#shelter_type option:selected" ).text(jsonobj.s_type);					
				jQuery('#s_type').val(jsonobj.s_type);	
				jQuery('#design_capacity').val(jsonobj.design_capacity);			
				jQuery('#men').val(jsonobj.men);
				jQuery('#women').val(jsonobj.women);
				jQuery('#children').val(jsonobj.children);
				jQuery('#total').val(jsonobj.total);				
				jQuery('#smaname').val(jsonobj.smaname);
				jQuery('#contatct_person').val(jsonobj.contatct_person);
				jQuery('#districtid').val(jsonobj.districtid);
				jQuery('#ulbid').val(jsonobj.ulbid);
		
		
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
		
	function GetBank(data)
{
	if(data=='YES'){
			   
			   jQuery("#bank").show();
			   }
			else
				{
					 jQuery("#bank").hide();
				}
}	
	</script>
	
	

</body>

</html>