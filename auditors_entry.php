<?php
include("adminsession.php");
$pagename = "auditors_entry.php";
$module = "Add Auditor Details";
$submodule = "Add Auditor Details";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "auditors_entry";
$tblpkey = "audid";
$imgpath = "uploaded/auditors/";
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
	$inspectiondate_date=date('Y-m-d');
if ( isset( $_GET[ 'audid' ] ) )
	 $keyvalue = $_GET[ 'audid' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
$auditname=$_POST['auditname'];;
$inspectiondate=$_POST['inspectiondate'];
$gender=$_POST['gender'];					
$phone_no=$_POST['phone_no'];
$email=$_POST['email'];
$address=$_POST['address'];								

$marital_status=$_POST['marital_status'];
$imgname= $_FILES['imgname'];
$inspectionimgname= $_FILES['inspectionimgname'];
$districtid =  $_POST['districtid'];			
$ngoid =  $_POST['ngoid'];
$ulbid =  $_POST['ulbid'];
 
	//check Duplicate
if ( $keyvalue == 0 ) { 

	mysqli_query($connection,"insert into auditors_entry set stateid='$stateid',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',auditname='$auditname',inspectiondate='$inspectiondate',phone_no='$phone_no',marital_status='$marital_status',address='$address',
email='$email',gender='$gender',userid='$loginid'");
	$keyvalue = mysqli_insert_id($connection);
	$uploaded_filename = uploadImage($imgpath,$imgname);
		$uploaded_filename1 = uploadImage($imgpath,$inspectionimgname);
			mysqli_query($connection,"update auditors_entry set imgname='$uploaded_filename' where audid='$keyvalue'");			
			mysqli_query($connection,"update auditors_entry set inspectionimgname='$uploaded_filename1' where audid='$keyvalue'");
			$action=1;
}
else{

		mysqli_query($connection,"update auditors_entry set stateid='$stateid',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',auditname='$auditname',inspectiondate='$inspectiondate',phone_no='$phone_no',marital_status='$marital_status',address='$address',
email='$email',gender='$gender',userid='$loginid' where audid = '$keyvalue' ");
	//$keyvalue = mysqli_insert_id($connection);
	
	if($_FILES['imgname']['tmp_name']!="")
				{
					//delete old file
					$rowimg = mysqli_fetch_array(SelectDB($connection,$tblname,"audid = '$keyvalue'"));
					$oldimg = $rowimg["imgname"];
					if($oldimg != "")
					unlink("uploaded/auditors/$oldimg");
					
				$uploaded_filename = uploadImage($imgpath,$imgname);
				//echo "update personal_details set fir_copy='$uploaded_filename' where id='$keyvalue'";die;
			mysqli_query($connection,"update auditors_entry set imgname='$uploaded_filename' where audid='$keyvalue'");		
				}
			
			
			if($_FILES['inspectionimgname']['tmp_name']!="")
				{
					//delete old file
					$rowimg = mysqli_fetch_array(SelectDB($connection,$tblname,"audid = '$keyvalue'"));
					$oldimg = $rowimg["inspectionimgname"];
					if($oldimg != "")
					unlink("uploaded/auditors/$oldimg");
					
					//insert new file
			$uploaded_filename1 = uploadImage($imgpath,$inspectionimgname);
				//echo "update personal_details set profile_photo='$uploaded_filename1' where id='$keyvalue'";die;
			mysqli_query($connection,"update auditors_entry set inspectionimgname='$uploaded_filename1' where audid='$keyvalue'");
				}
				
	$action=2;
			
		
}
			echo "<script>location='$pagename?action=$action'</script>";
}
if (isset($_GET[$tblpkey])){
//$btn_name = "Update";
//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );
$auditname=$rowedit['auditname'];;
$inspectiondate=$rowedit['inspectiondate'];
 $gender=$rowedit['gender'];					
$phone_no=$rowedit['phone_no'];
$email=$rowedit['email'];
$address=$rowedit['address'];								
$alternative_phone_no=$rowedit['alternative_phone_no'];
$marital_status=$rowedit['marital_status'];
$imgname= $rowedit['imgname'];
$inspectionimgname= $rowedit['inspectionimgname'];
$districtid =  $rowedit['districtid'];			
$ngoid =  $rowedit['ngoid'];
$ulbid =  $rowedit['ulbid'];

} else {
$auditname='';
$inspectiondate=date('d-m-Y');
$gender='';					
$phone_no='';
$email='';
$address='';								
$alternative_phone_no='';
$marital_status='';
$imgname= '';
$inspectionimgname= '';
//$districtid = '';			
//$ngoid =  '';
//$ulbid = '';
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
   <?php  include("inc/alerts.php");?>
		<form name="addServiceForm" method="post" action="" enctype="multipart/form-data"><div><input type="hidden" ></div>
	
		<div class="container-fluid">
		<div class="text-center"></div>
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
         <h4 class="card-title">Social Audit Assessment Details Entry</h4><a href="auditors_list.php" class="btn btn-info" style="float:right;">Show List</a>
		
		</div>
		<div class="table-responsive">
				<table class="table table-bordered table-striped">
                
                 <tr>
						<th style="width: 20%;">District Name</th>
						
                       <td>
						<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="districtid" class="form-control" autocomplete="off">
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
					
						<th style="width: 20%;">Name</th>
						<td style="width: 30%;"><input required type="text" name="auditname" id="auditname" value="<?php echo $auditname;?>" onKeyUP="this.value = this.value.toUpperCase();" class="form-control" autocomplete="off"></td>
						<tr>
						<th  style="width: 20%;">Date of Inspection</th>   
						<td  style="width: 30%;"><input required type="date" name="inspectiondate" maxlength="10" value="<?php echo $inspectiondate_date;?>" id="inspectiondate" class="form-control datePicker required" autocomplete="off"></td>
					
						<th>Gender</th>
						<td>
						    <input type="radio" name="gender" value="Male" <?php if($gender=='Male') {?>checked <?php } ?>  /> &nbsp; Male  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						    <input type="radio" name="gender" value="Female" <?php if($gender=='Female') {?>checked <?php } ?>  /> &nbsp; Female  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="gender" value="Third Gender"  <?php if($gender=='Third Gender') {?>checked <?php } ?> /> &nbsp; Third Gender  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						    <div id="gender_status_err" style="color: red;display: none;">Please select Gender</div>
						</td>
						</tr>
					
					<tr>
						
						<th>Contact No </th>
						<td>
						  <input   type="text" name="phone_no" maxlength="10" value="<?php echo $phone_no;?>"  on id="phone_no" style="width:90%;float:left" class="form-control" autocomplete="off">
						 
						</td>
					
					    
						<th>Photo <br/><span style="font-size: 12px;">(Maximum File Size 200 KB)</span></th>
						<td>
						  <input  type="file" name="imgname" value="" id="imgname" style="width:80%;float:left;" class="form-control"><!--  onchange="showimagepreview(this);" -->
						  <?php  if($imgname!="") { ?>  <img id="blah" alt="" height='50'width='50' title='Text Image' src='<?php if($imgname!="" && file_exists("uploaded/auditors/".$imgname))
					        {
								echo "uploaded/auditors/".$imgname; }?>'/><?php } ?>
						 </td>
                         
                         </tr>
                         <tr>
						 
						 
					    <th>Inspection Photo <br/><span style="font-size: 12px;">(Maximum File Size 200 KB)</span></th>
						<td>
						  <input  type="file" name="inspectionimgname" value="" id="inspectionimgname" style="width:80%;float:left;" class="form-control"> <?php  if($inspectionimgname!="") { ?>  <img id="blah" alt="" height='50'width='50' title='Text Image' src='<?php if($inspectionimgname!="" && file_exists("uploaded/auditors/".$inspectionimgname))
					        {
								echo "uploaded/auditors/".$inspectionimgname; }?>'/><?php } ?>
						 
						 </td>
					
                    
						<th>Marital Status</th>
						<td>
                        
                     <input type="radio" name="marital_status" value="Single" <?php if($marital_status=='Single') {?>checked <?php } ?> >&nbsp;Single &nbsp;
						    <input type="radio" name="marital_status" value="Married" <?php if($marital_status=='Married') {?>checked <?php } ?> >&nbsp;Married
                            <input type="radio" name="marital_status" value="Widow" <?php if($marital_status=='Widow') {?>checked <?php } ?> >&nbsp;Widow/Widower</td>
					</tr>
					<tr>	 
					   <th>E-Mail</th>
						<td><input  type="text" name="email" value="<?php echo $email;?>" onBlur="checkEmail(this)" class="form-control" autocomplete="off"></td>
						 
				
						
					    <th>Address</th>
						<td><input  type="text" name="address" maxlength="600" value="<?php echo $address;?>" onKeyUP="this.value = this.value.toUpperCase();"  class="form-control" autocomplete="off"></td>
					</tr>
					<tr>
						<td align="center" colspan="4"><input type="submit" name="submit" value="Submit"  style="width:200px; float:none;" class="site-btn">
						</td>
					
					</tr>
                  

				</table>
		</div>
		</div>
		</div>
		</div>
		
		
	</form>



		<!-- end container -->
	</div>
</div>


	<?php include("inc/footer.php"); ?>
<script>
function chageUpper(str)
{
	 var res = str.toUpperCase();	
  document.getElementById("auditname").value = res;
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
</script>
</body>

</html>