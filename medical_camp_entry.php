<?phpinclude("adminsession.php");$pagename = "medical_camp_entry.php";$module = "Add Medical Camp Details";$submodule = "Add Medical Camp Details";$btn_name = "Save";$keyvalue = 0;$tblname = "medical_camp";$tblpkey = "medid";$imgpath= "uploaded/diagnosis/";$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");	$camp_date=date('Y-m-d');if ( isset( $_GET[ 'medid' ] ) )	$keyvalue = $_GET[ 'medid' ];else	$keyvalue = 0;if ( isset( $_GET[ 'action' ] ) )	$action = addslashes( trim( $_GET[ 'action' ] ) );else	$action = "";if ( isset( $_POST[ 'submit' ] ) ) {					$camp_date=$_POST['camp_date'];		$no_doctors=$_POST['no_doctors'];$districtid =  $_POST['districtid'];			$ngoid =  $_POST['ngoid'];$ulbid =  $_POST['ulbid'];$no_persons_treated=$_POST['no_persons_treated'];$no_persons_checked=$_POST['no_persons_checked'];$doctor_name=$_POST['doctor_name'];	$hospital_type=$_POST['hospital_type'];	$hospital_name=$_POST['hospital_name'];	$remarks=$_POST['remarks'];	$diagnosis_photo= $_FILES['diagnosis_photo'];$no_of_enment=$_POST['no_of_enment'];	if ( $keyvalue == 0 ) { 	mysqli_query($connection,"insert into medical_camp set stateid='$stateid',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',camp_date='$camp_date',no_doctors='$no_doctors',no_persons_checked='$no_persons_checked',no_persons_treated='$no_persons_treated',no_of_enment='$no_of_enment',remarks='$remarks',doctor_name='$doctor_name',hospital_type='$hospital_type',hospital_name='$hospital_name',userid='$loginid'");	$keyvalue = mysqli_insert_id($connection);	$uploaded_filename = uploadImage($imgpath,$diagnosis_photo);	//echo "update medical_camp set diagnosis_photo='$uploaded_filename' where medid='$keyvalue'";die;			mysqli_query($connection,"update medical_camp set diagnosis_photo='$uploaded_filename' where medid='$keyvalue'");				$action=1;	}	else	{						mysqli_query($connection,"update medical_camp set stateid='$stateid',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',camp_date='$camp_date',no_doctors='$no_doctors',no_persons_checked='$no_persons_checked',no_persons_treated='$no_persons_treated',no_of_enment='$no_of_enment',remarks='$remarks',doctor_name='$doctor_name',hospital_type='$hospital_type',hospital_name='$hospital_name',userid='$loginid' where medid = '$keyvalue'");if($_FILES['diagnosis_photo']['tmp_name']!="")				{					//delete old file					$rowimg = mysqli_fetch_array(SelectDB($connection,$tblname,"medid = '$keyvalue'"));					 $oldimg = $rowimg["diagnosis_photo"];					if($oldimg != "")					unlink("uploaded/diagnosis/$oldimg");										//insert new file										$uploaded_filename = uploadImage($imgpath,$diagnosis_photo);						//echo "update medical_camp set diagnosis_photo='$uploaded_filename' where medid='$keyvalue'";die;			mysqli_query($connection,"update medical_camp set diagnosis_photo='$uploaded_filename' where medid='$keyvalue'");							}					$action=2;	}			echo "<script>location='$pagename?action=$action'</script>";}if (isset($_GET[$tblpkey])){//$btn_name = "Update";//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );$camp_date=$rowedit['camp_date'];		$no_doctors=$rowedit['no_doctors'];$districtid =  $rowedit['districtid'];			$ngoid =  $rowedit['ngoid'];$no_of_enment=$rowedit['no_of_enment'];$ulbid =  $rowedit['ulbid'];$no_persons_treated=$rowedit['no_persons_treated'];$no_persons_checked=$rowedit['no_persons_checked'];$doctor_name=$rowedit['doctor_name'];	$hospital_type=$rowedit['hospital_type'];	$hospital_name=$rowedit['hospital_name'];	$remarks=$rowedit['remarks'];	$diagnosis_photo= $rowedit['diagnosis_photo'];} else {$camp_date='';		$no_doctors='';//$districtid = '';			//$ngoid = '';//$ulbid = '';$no_persons_treated='';$no_persons_checked='';$doctor_name='';	$hospital_type='';	$hospital_name='';	$remarks='';	$diagnosis_photo= '';$no_of_enment='';}?><!DOCTYPE html><html lang="en"><head>	<meta charset="utf-8">	<meta http-equiv="X-UA-Compatible" content="IE=edge">	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>	<title>SAVIOUR</title>	<meta content="Admin Dashboard" name="description">	<meta content="Themesbrand" name="author">	<link rel="shortcut icon" href="image/suhlogo.png">	<link rel="stylesheet" href="plugins/morris/morris.css">	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">	<link href="assets/css/style.css" rel="stylesheet" type="text/css"></head><body>	<?php include("inc/header.php");?>	<div class="wrapper">     <?php  include("inc/alerts.php");?>		<form name="addServiceForm" method="post" action="" enctype="multipart/form-data"><div><input type="hidden" ></div>		<input type="hidden" name="key">		<input type="hidden" name="medicalcamp_id" value="" id="medicalcamp_id">		<div class="container-fluid">		<div class="text-center"></div>		<div class="row">		<div class="col-md-12">		<div class="card mt-12">		<div class="card-header">          <h4 class="card-title">Medical Camp Details Entry</h4><a href="medical_camp_list.php" class="btn btn-info" style="float:right;">Show List</a>					</div>		<div class="table-responsive">				<table class="table table-bordered table-striped">                	<tr>						<th style="width: 20%;">District Name</th>						                       <td>						<?php if($usertype=='SHELTER')                        { ?>                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="contatct_person" class="form-control" autocomplete="off">                           <input  type="text"  name="district" value="<?php echo $district; ?>"  id="district"  readonly class="form-control" autocomplete="off">                                                <?php } else { ?>														 <select required name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control"><option value="">-- Select District--</option>                        <?php $dist=mysqli_query($connection,"SELECT * FROM m_district $condata order by districtname asc");							while($data=mysqli_fetch_array($dist)){															?>							  <option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>						<?php } ?>                     </select>                         <script>document.getElementById('districtid').value='<?php echo $districtid; ?>'; </script>														<?php }?>                       						</td>						</td>							<th style="width: 20%;">ULB Name </th>						<td style="width: 25%;">                        	<?php if($usertype=='SHELTER')                        { ?>                        <input  type="hidden"  name="ulbid" value="<?php echo $ulbid; ?>"  id="ulbid" class="form-control" autocomplete="off">                           <input  type="text"  name="ulbname" value="<?php echo $ulbname; ?>"  id="ulbname"  readonly class="form-control" autocomplete="off">                                                <?php } else { ?>													 <select required name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control"><option value="">-- Select --</option>                        <?php $dist=mysqli_query($connection,"select * from ulb_master $condata order by ulbname asc");							while($data=mysqli_fetch_array($dist)){?>							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>						<?php } ?>                     </select>                       <script>document.getElementById('ulbid').value='<?php echo $ulbid; ?>'; </script>														<?php }?>                                                    												<div id="nor">													</div>						</td>																	</tr>                    <tr>                    <th style="width: 20%;">Shelter Name</th>					   							<td style="width: 25%;">                        	<?php if($usertype=='SHELTER')                        { ?>                        <input  type="hidden"  name="ngoid" value="<?php echo $ngoid; ?>"  id="ngoid" class="form-control" autocomplete="off">                           <input  type="text"  name="ngo" value="<?php echo $ngo; ?>"  id="ngo"  readonly class="form-control" autocomplete="off">                                                <?php } else { ?>													        <select name="ngoid" id="ngoid"  class="form-control" required onChange="getdetails(this.value);">                       <option value="">-Select Shelter Name-</option>                                            <?php 											$sql1 = "select distinct ngoname,ngoid from m_ngo $condata order by ngoname asc";											$res1 = mysqli_query($connection,$sql1);											while($row1 = mysqli_fetch_array($res1))												{																								?>                                          			<option value="<?php echo $row1['ngoid']; ?>"><?php echo $row1['ngoname']; ?></option>                                            <?php												}																								?>                                      </select>                                           <script>document.getElementById('ngoid').value='<?php echo $ngoid; ?>'; </script>														<?php }?>                                                                                         </td>											    <th>No of Doctors </th>  						<td><input required type="number" name="no_doctors" maxlength="4" value="<?php echo $no_doctors; ?>" onKeyUp="intOnly(this); addRows(this); " id="no_doctors" class="form-control" autocomplete="off"></td>					</tr>										<tr>                    <th style="width: 25%;">Capacity</th>					<td style="width: 25%;"><input required type="text" readonly name="capacity" value="<?php echo $capacity;?>"  id="capacity" class="form-control" autocomplete="off"></td>					                      <th style="width: 25%;">Date of Camp</th>					<td style="width: 25%;"><input required type="date" name="camp_date" value="<?php echo $camp_date;?>"  id="camp_date" class="form-control" autocomplete="off"></td>					  											</tr>                    					<tr>                    						<th colspan="4">Doctors Details</th>					</tr>					<tr>						<td colspan="4">							<table class="doctorsTable table table-bordered table-striped" id="table_of_items">								<tr class="doctorsTable_tr1" id="table_of_items">																	</tr>							</table>						</td>						</tr>                                        <tr>							<th>Name of the Doctor</th>						<td><input required type="text" name="doctor_name" value="<?php echo $doctor_name;?>"  class="form-control" autocomplete="off"></td>						<th>Hospital Type</th>                        <td>  <select name="hospital_type" required id="hospital_type" class="form-control">                        <option value="">-Select-</option>                        <option value="Government">Government</option>                        <option value="Private Hospital">Private Hospital</option>                        </select>                          <script>document.getElementById('hospital_type').value='<?php echo $hospital_type; ?>'; </script>                        </td>					</tr>                                        <tr>							<th>Hospital Name</th>						<td><input required type="text" name="hospital_name" value="<?php echo $hospital_name; ?>"  class="form-control" autocomplete="off"></td>						  <th>Upload Diagnosis Report</th>						<td><input type="file" name="diagnosis_photo" value="<?php echo $diagnosis_photo; ?>" id="diagnosis_photo" class="form-control" required>                       <?php if($diagnosis_photo!=""){ ?>  <img id="blah" alt="" height='50'width='50' title='Text Image' src='<?php if($diagnosis_photo!="" && file_exists("uploaded/diagnosis/".$diagnosis_photo))					        {								echo "uploaded/diagnosis/".$diagnosis_photo; }?>'/><?php } ?>                        </td>					</tr>										<tr>							<th>No.of.Persons Screened</th>						<td><input required type="number" name="no_persons_checked" id="no_persons_checked" maxlength="3" value="<?php echo $no_persons_checked; ?>"  class="form-control" autocomplete="off"></td>						<th>No of Persons Referred/Treated</th>						<td><input required type="number" name="no_persons_treated" id="no_persons_treated" onChange="getCheck(this.value);" maxlength="3" value="<?php echo $no_persons_treated; ?>"  class="form-control" autocomplete="off"></td>					</tr>										<tr>	<th>No. of Enments Reffered for Higher Treatment</th>						<td ><input required type="number"  name="no_of_enment" maxlength="600" value="<?php echo $no_of_enment; ?>"  id="no_of_enment" class="form-control" autocomplete="off"></td>	<th>Remarks</th>						<td ><input required type="text" onKeyUP="this.value = this.value.toUpperCase();" name="remarks" maxlength="600" value="<?php echo $remarks; ?>"  id="remarks" class="form-control" autocomplete="off"></td>					</tr>					<tr>						<td align="center" colspan="4"><input type="submit" name="submit" value="Submit"  style="width:200px; float:none;" class="site-btn">						</td>										</tr>								</table>				</div>		</div>		</div>		</div>		</div>	</form>		<!-- end container -->	</div>	<?php include("inc/footer.php"); ?> <script>	  function getshelter(){      //alert('hello'); var districtid = jQuery("#districtid").val();  var ulbid = jQuery("#ulbid").val();//alert(districtid);   		  jQuery.ajax({		  type: 'POST',		  url: 'getngo.php',		  data: "districtid="+districtid+'&ulbid='+ulbid,		  dataType: 'html',		  success: function(data){				  	//	alert(data);													jQuery('#ngoid').html(data);//				//jQuery('#showdatarecord').html(data);												}		  });//ajax close}		function getulb(){      //alert('hello'); var districtid = jQuery("#districtid").val();//alert(districtid);   		  jQuery.ajax({		  type: 'POST',		  url: 'getulb.php',		  data: "districtid="+districtid,		  dataType: 'html',		  success: function(data){			  jQuery('#ulbid').html(data);								//jQuery('#showdatarecord').html(data);												}		  });//ajax close}	function getdetails(ngoid){	     jQuery.ajax({		  type: 'POST',		  url: 'getcapacity.php',		  data: "ngoid="+ngoid,		  dataType: 'html',		  success: function(data){	            //  alert(data);		  jQuery('#capacity').val(data);	    	}	});}		function showhide(s_type)		{			//var s_type=jQuery("#s_type").val();						if(s_type=='Normal'){			   			   jQuery("#Normal").show();			   }			else				{					 jQuery("#Normal").hide();				}		}				function getCheck(data){						 var no_persons_checked = jQuery("#no_persons_checked").val();						 if(data>no_persons_checked)			 {				 alert('Please Check Referred is not more than Screened');				   jQuery('#no_persons_treated').val('');				      jQuery('#no_persons_treated').focus();			 }		}	</script></body></html>