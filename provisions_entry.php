<?php

include("adminsession.php");

//echo $usertype;die;

$pagename = "provisions_entry.php";

$module = "Updation";

$submodule = "Updation";

$btn_name = "Save";

$keyvalue = 0;

$tblname = "personal_details";

$tblpkey = "id";

$imgpath = "uploaded/document/";

$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");

	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");

if ( isset( $_GET[ 'id' ] ) )

	$keyvalue = $_GET[ 'id' ];

else

	$keyvalue = 0;

if ( isset( $_GET[ 'action' ] ) )

	$action = addslashes( trim( $_GET[ 'action' ] ) );

else

	$action = "";

		

	if ( isset( $_POST[ 'submit' ] ) ) {

			$vacant_date=$_POST['vacant_date'];

			$districtid =  $_POST['districtid'];			

			$ngoid =  $_POST['ngoid'];

			$ulbid =  $_POST['ulbid'];

			$soid=$_POST['soid'];	

			$perid=$_POST['perid'];	

			$document_type=$_POST['document_type'];

			$remark=$_POST['remark'];

			$imgname=$_FILES['imgname'];

			$medical_checkup=$_POST['medical_checkup'];

			$counselling=$_POST['counselling'];

			$education=$_POST['education'];

			

$lastid = mysqli_insert_id($connection);

//print_r($imgname);

//print_r($imgname['tmp_name']);

//print_r($document_type);

$newsoid = array();

$soidnew=array_filter($soid, 'strlen');

foreach ($soidnew as $value) {

	array_push($newsoid,$value);

}



$remarknew=array_filter($remark, 'strlen');

$newremark = array();

foreach ($remarknew as $value) {

	array_push($newremark,$value);

}

//print_r($newremark);

$imgnamenew=array_filter($imgname['name'], 'strlen');



$newimgname = array();

foreach ($imgnamenew as $value) {

	array_push($newimgname,$value);

}



$imgtemp=array_filter($imgname['tmp_name'], 'strlen');



$newtempimgname = array();

foreach ($imgtemp as $value) {

	array_push($newtempimgname,$value);

}

//print_r($newtempimgname);



//print_r($newimgname);

 $totreg = count($newsoid);

 //print_r($newimgname);

 $snrk=0;

 $snimg=0;

 

				for ($x = 0; $x < $totreg; $x++) {

					//echo $newremark[$x];

					$imgname='';

					$remark='';

				if($document_type[$x]=='Yes'){

					$imgname = $newimgname[$snimg];

					$sourcePath = $newtempimgname[$snimg];

					$targetPath = "uploaded/document/".$imgname;

					move_uploaded_file($sourcePath,$targetPath);

					$snimg++;

				}

				

				$s=1;

				if($document_type[$x]=='No'){

					 $remark = $newremark[$snrk];

					 $snrk++;

					

				}

			

					mysqli_query($connection,"insert into save_document_type set shelter_id='$ngoid',userid='$loginid',perid='$perid',soid='$newsoid[$x]',document_type='$document_type[$x]',remark='$remark',imgname='$imgname'");

		}

			

			mysqli_query($connection,"update personal_details set education = '$education',counselling = '$counselling',medical_checkup = '$medical_checkup',perid = '$perid' where id = '$perid'  ");

			

	//check Duplicate

	

		



		echo "<script>location='$pagename?action=$action'</script>";



}



	



if (isset($_GET[$tblpkey])){

//$btn_name = "Update";

//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;

$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";

$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );





			$vacant_date=$rowedit['vacant_date'];

			$districtid =  $rowedit['districtid'];			

			$ngoid =  $rowedit['ngoid'];

			$ulbid =  $rowedit['ulbid'];

			$reintegration=$rowedit['reintegration'];			

		

			$purpose_release=$rowedit['purpose_release'];

				$id=$rowedit['id'];

				$etc=$rowedit['etc'];

		

} else {

$vacant_date=date('Y-m-d');



			//$districtid = '';			

			//$ngoid ='';

			//$ulbid =  '';

			$reintegration='';			

		

			$purpose_release='';

			

//$imgname='';

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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>SAVIOUR</title>

	<meta content="Admin Dashboard" name="description">

	<meta content="Themesbrand" name="author">

	<link rel="shortcut icon" href="image/suhlogo.png">

	<link rel="stylesheet" href="../plugins/morris/morris.css">

	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">

	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">

	<link href="assets/css/style.css" rel="stylesheet" type="text/css">
	<link href="plugins/select2/css/select2.min.css" rel="stylesheet" />

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

           <h4 class="card-title">Updation Entry</h4>

         <!--  <a href="vacant_list.php" class="btn btn-info" style="float:right;">Show List</a>-->

					

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

							

							 <select required name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control js-example-basic-single"><option value="">-- Select District--</option>

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

							

						 <select required name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control js-example-basic-single"><option value="">-- Select --</option>

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

							

						        <select name="ngoid" id="ngoid"  class="form-control js-example-basic-single" onChange="getdetails(this.value);">

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

                	<th>Beneficiary  </th>

						<td> <select required name="perid" id="perid"  class="form-control js-example-basic-single"><option value="">-- Select --</option>

                        <?php $dist=mysqli_query($connection,"select * from personal_details $condata");

							while($data=mysqli_fetch_array($dist)){?>

							  <option value="<?php echo $data['id']; ?>"><?php echo $data['per_name']; ?></option>

						<?php } ?>

                     </select>

                      <script>

                                       document.getElementById('perid').value='<?php echo $id; ?>';

                                       </script>

                     </td>
					</tr>
                    <tr>
						<th style="width: 25%;">Medical Checkup</th>
						<td style="width: 25%;"><input type="text" name="medical_checkup" value="<?php echo $medical_checkup;?>" placeholder=" Enter Medical Checkup"  id="medical_checkup" class="form-control required" autocomplete="off"></td>
						
						<th style="width: 25%;">Counselling</th>
						<td style="width: 25%;">
	                      <input type="text" name="counselling" value="<?php echo $counselling;?>" id="counselling" class="form-control" autocomplete="off">
	                    </td>
					</tr>

                    <tr>

                    <th style="width: 25%;">Education</th>

					<td style="width: 25%;">
                     <select required name="education" id="education"  class="form-control"><option value="">-- Select --</option>
							<option value="Yes">Yes</option>
							 <option value="No">No</option>
                     </select>
                      <script>document.getElementById('education').value='<?php echo $education; ?>';</script>
                    </td>
                    </tr>
					<tr><th colspan="4">Social Security Services</th></tr>
						<tr>
						<td colspan="4">   
						     <table style="width:100%">

						     <tr>

						        <th>Sl.No</th>

						        <th>Documents Type</th>

						        <th style="text-align: center;">Yes</th>

						        <th style="text-align: center;">No</th>

                                <th style="text-align: center;">Remark</th>

						     </tr>

						     

						     <?php

								

								 $sn=1;

								 if (isset($_GET[$tblpkey])){

								

								$reg=mysqli_query($connection,"select * from m_socialsecurity "); 								

							     while($data3=mysqli_fetch_array($reg)){

									$document_type = $cmn->getvalfield($connection,"save_document_type","document_type","soid='$data3[soid]' and perid='$id' ");

									 ?>

                                 <tr>

									<td><?php echo $sn;?> </td>

							        <td><?php echo $data3['socialdocname'];?><input type="hidden" name="socialdocname[]" value="<?php echo $data3['socialdocname'];?>">

                                  

                                    </td>

							        <td><input type="radio"  name="document_type[]<?php echo $sn;?>" id="document_type<?php echo $sn;?>"  value="Yes"     class="form-control" <?php if($document_type=='Yes') {?>checked <?php } ?>></td>

						            <td><input type="radio"  name="document_type[]<?php echo $sn;?>" value="No"  class="form-control" <?php if($document_type=='No') {?>checked <?php } ?>> </td>

							     </tr>

								<?php $sn++; } }

								 else

								 {

								

									  $reg=mysqli_query($connection,"select * from m_socialsecurity"); 

									   while($data3=mysqli_fetch_array($reg)){?>

                                 <tr>

									<td><?php echo $sn;?> </td>

							        <td><?php echo $data3['socialdocname'];?><input type="hidden" name="socialdocname[]" id="socialdocname<?php echo $sn;?>" value="<?php echo $data3['soid'];?>"><input type="hidden" name="soid[]<?php echo $sn;?>" id="soid<?php echo $sn;?>" >

                                   

                                    </td>

							        <td><input type="radio"  name="document_type[]<?php echo $sn;?>" id="document_type<?php echo $sn;?>" value="Yes" onClick="getUpload(this.value,<?php echo $sn;?>);"     class="form-control" <?php if($document_type=='Yes') {?>checked <?php } ?>></td>

						            <td><input type="radio"  name="document_type[]<?php echo $sn;?>" id="document_type<?php echo $sn;?>" onClick="getUpload(this.value,<?php echo $sn;?>);"  value="No"  class="form-control" <?php if($document_type=='No') {?>checked <?php } ?>> </td>

                                       <td><input type="text" name="remark[]" maxlength="3" value="<?php echo $data3['remark'];?>"  id="remark<?php echo $sn;?>" class="form-control" style="display:none;">

                                       <input type="file" name="imgname[]" value="" id="imgname<?php echo $sn;?>" class="form-control" style="display:none;">

                       <?php  if($imgname!="") { ?>    <img id="blah" alt="" height='50'width='50' title='Text Image' src='<?php if($imgname!="" && file_exists("uploaded/personal/fir/".$imgname))

					        {

								echo "uploaded/personal/fir/".$imgname; }?>'/> <?php  } ?>

                        

                                       

                                       </td>

							     </tr>

								<?php $sn++;  }

								 }

																	 

									 ?>

								 

						     

							  

						     

						     </table></td>

						     </tr>

                    

                   

					 <tr>

						<td align="center" colspan="4">

                         <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">

						     <input type="submit" name="submit" value="Submit"  style="width:200px; float:none;" class="site-btn">

						</td>

					

					 </tr>



				</table>

		

		</div>

		</div>

		</div>

			</div>

			

	</form>

		

        

        

        </div>

		<!-- end container -->

	</div>







	<?php include("inc/footer.php"); ?>
	<script src="plugins/select2/js/select2.min.js"></script>	
<script>

	function funDel(id)

	{  //alert(id);   

		tblname = '<?php echo $tblname; ?>';

		tblpkey = '<?php echo $tblpkey; ?>';

		pagename = '<?php echo $pagename; ?>';

		submodule = '<?php echo $submodule; ?>';

		module = '<?php echo $module; ?>';

		imgpath = '<?php echo $imgpath; ?>';

		 //alert(module); 

		if(confirm("Are you sure! You want to delete this record."))

		{

			jQuery.ajax({

			  type: 'POST',

			  url: 'ajax/delete_image_master.php',

			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module+'&imgpath='+imgpath,

			  dataType: 'html',

			  success: function(data){

				//alert(data);

				   location='<?php echo $pagename."?action=3" ; ?>';

				}

				

			  });//ajax close

		}//confirm close

	} //fun close

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



function GetStatePay(data)

{

	if(data=='Others'){

			   

			   jQuery("#paystate").show();

			   }

			else

				{

					 jQuery("#paystate").hide();

				}

}



function GetShelterPay(data)

{

	if(data=='Others'){

			   

			   jQuery("#payshelter").show();

			   }

			else

				{

					 jQuery("#payshelter").hide();

				}

}

function getUpload(data,sn){

	var socialdocname = jQuery("#socialdocname"+sn).val();	

	 jQuery("#soid"+sn).val(socialdocname);

	if(data=='Yes'){

			   

			   jQuery("#imgname"+sn).show();

			    jQuery("#remark"+sn).hide();

			   }

			else

				{

					 jQuery("#remark"+sn).show();

					   jQuery("#imgname"+sn).hide();

				}

}


	// In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
  </script>

</body>



</html>