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
$alternative_phone_no=$_POST['alternative_phone_no'];
$marital_status=$_POST['marital_status'];
 $imgname= $_FILES['imgname'];
  $inspectionimgname= $_FILES['inspectionimgname'];
 $districtid =  $_POST['districtid'];			
			$ngoid =  $_POST['ngoid'];
			$ulbid =  $_POST['ulbid'];
 
	//check Duplicate


	mysqli_query($connection,"insert into auditors_entry set stateid='$stateid',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',auditname='$auditname',inspectiondate='$inspectiondate',phone_no='$phone_no',alternative_phone_no='$alternative_phone_no',marital_status='$marital_status',address='$address',
email='$email',gender='$gender'");
	$keyvalue = mysqli_insert_id($connection);
	$uploaded_filename = uploadImage($imgpath,$imgname);
		$uploaded_filename1 = uploadImage($imgpath,$inspectionimgname);
			mysqli_query($connection,"update auditors_entry set imgname='$uploaded_filename' where audid='$keyvalue'");			
			mysqli_query($connection,"update auditors_entry set inspectionimgname='$uploaded_filename1' where audid='$keyvalue'");
			
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
		<form name="addServiceForm" method="post" action="" enctype="multipart/form-data"><div><input type="hidden" ></div>
	
		<div class="container-fluid">
		<div class="text-center"></div>
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
			<h4 class="card-title">Social Audit Assessment Details</h4>
		</div>
		<div class="table-responsive">
				<table class="table table-bordered table-striped">
                
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
					
						<th style="width: 20%;">Name</th>
						<td style="width: 30%;"><input required type="text" name="auditname" id="auditname" onKeyUP="this.value = this.value.toUpperCase();" class="form-control"></td>
						<tr>
						<th  style="width: 20%;">Date of Inspection</th>   
						<td  style="width: 30%;"><input required type="date" name="inspectiondate" maxlength="10" value="<?php echo $inspectiondate_date;?>" id="inspectiondate" class="form-control datePicker required"></td>
					
						<th>Gender</th>
						<td>
						    <input type="radio" name="gender" value="Male" /> &nbsp; Male  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						    <input type="radio" name="gender" value="Female" /> &nbsp; Female  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="gender" value="Third Gender" /> &nbsp; Third Gender  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						    <div id="gender_status_err" style="color: red;display: none;">Please select Gender</div>
						</td>
						</tr>
					
					<tr>
						
						<th>Contact No </th>
						<td>
						  <input   type="text" name="phone_no" maxlength="10" value=""  on id="phone_no" style="width:90%;float:left" class="form-control">
						 
						</td>
					
					    
						<th>Photo <br/><span style="font-size: 12px;">(Maximum File Size 200 KB)</span></th>
						<td>
						  <input  type="file" name="imgname" value="" id="imgname" style="width:80%;float:left;" class="form-control"><!--  onchange="showimagepreview(this);" -->
						 
						 </td>
                         
                         </tr>
                         <tr>
						 
						 
					    <th>Inspection Photo <br/><span style="font-size: 12px;">(Maximum File Size 200 KB)</span></th>
						<td>
						  <input  type="file" name="inspectionimgname" value="" id="inspectionimgname" style="width:80%;float:left;" class="form-control"><!--  onchange="showimagepreview(this);" -->
						 
						 </td>
					
                    
						<th>Marital Status</th>
						<td>
                        
                     <input type="radio" name="marital_status" value="Single">&nbsp;Single &nbsp;
						    <input type="radio" name="marital_status" value="Married">&nbsp;Married
                            <input type="radio" name="marital_status" value="Widow">&nbsp;Widow/Widower</td>
					</tr>
					<tr>	 
					   <th>E-Mail</th>
						<td><input required type="text" name="email" value="" onBlur="checkEmail(this)" class="form-control"></td>
						 
				
						
					    <th>Address</th>
						<td><input required type="text" name="address" maxlength="600" value="" onKeyUP="this.value = this.value.toUpperCase();"  class="form-control"></td>
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


<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
			<h4 class="card-title">Auditor Details</h4>
		</div>
		<div class="table-responsive">
				<table class="table table-bordered table-striped">
				
					<tr>
					    <th>Sl.No</th>
						<th>Name</th>
						<th>Date of Entry</th>
						<th>Gender</th>   
						<!-- <th>Marital Status</th> -->
						<th>Contact No</th>   
						
						<th>E-Mail</th>   
						<th>Address</th>
						<th>Photo</th>
						<th>Inspection Photo</th>
					</tr>
					
					    <?php 
						$sn=1;
						$dist=mysqli_query($connection,"select * from auditors_entry");
							while($data=mysqli_fetch_array($dist)){ 
							$ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$data[ulbid]'");
							$ngoname = $cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$data[ngoid]'");
							$districtname = $cmn->getvalfield($connection,"m_district","districtname","districtid='$data[districtid]'");
							?>
					    <tr>
					      <td><?php echo $sn++;?></td>
                           <td><?php echo ucfirst(strtolower($districtname));?></td>
                          <td><?php echo ucfirst(strtolower($ulbname));?></td>
                            <td><?php echo $ngoname;?></td>
					      <td><?php echo $data['auditname'];?></td>
					      <td><?php echo dateformatindia($data['inspectiondate']);?></td>
                           <td><?php echo $data['gender'];?></td>
                            <td><?php echo $data['phone_no'];?></td>
                          
                              <td><?php echo $data['email'];?></td>
                               <td><?php echo $data['address'];?></td>
					      <td>
					        <img src="uploaded/auditors/<?php echo $data['imgname'];?>"   style=" height:30px; width:30px;" id="imgprvw" title="Auditor Photo"/> </td> <td>
					        <img src="uploaded/auditors/<?php echo $data['inspectionimgname'];?>"  style=" height:30px; width:30px;" id="imgprvw1" title="Auditor Photo"/>
					      </td>
					    </tr>
					<?php } ?>  
					
					

				</table>
		</div>
		</div>
		</div>
		</div>
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