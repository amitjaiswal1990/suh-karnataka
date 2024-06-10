<?php

include("adminsession.php");

$pagename = "dailystaffattendance_entry.php";

$module = "Add Daily Report Entry";

$submodule = "Add Daily Report Details";

$btn_name = "Save";

$keyvalue = 0;

$tblname = "staff_attendance_details";

$tblpkey = "aid";

$imgpath= "uploaded/diagnosis/";

$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");

	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");

	

if ( isset( $_GET[ 'aid' ] ) )

	$keyvalue = $_GET[ 'aid' ];

else

	$keyvalue = 0;

if ( isset( $_GET[ 'action' ] ) )

	$action = addslashes( trim( $_GET[ 'action' ] ) );

else

	$action = "";

if ( isset( $_POST[ 'submit' ] ) ) {

	

				

$staffid=$_POST['staffid'];		

$atten_date=$_POST['atten_date'];

$districtid =  $_POST['districtid'];			

$ngoid =  $_POST['ngoid'];

$ulbid =  $_POST['ulbid'];

$attendance=$_POST['attendance'];

	$check = check_duplicate($connection,$tblname,"districtid = '$districtid' && ulbid = '$ulbid' && ngoid = '$ngoid' && atten_date = '$atten_date' && userid = '$loginid'  && $tblpkey <> $keyvalue");

		if($check > 0)

			{

			/*$dup = " Error : Duplicate Record";*/

			$dup="<div class='alert alert-danger'>

			<strong>Error!</strong> Error : Duplicate Entry.

			</div>";

			} 

			else{

	if ( $keyvalue == 0 ) { 



 $totper = count($staffid);	

	for ($x = 0; $x < $totper; $x++) {	

	

	mysqli_query($connection,"insert into staff_attendance_details set districtid='$districtid',ulbid='$ulbid',ngoid='$ngoid',userid='$loginid',atten_date='$atten_date',attendance='$attendance[$x]',staffid='$staffid[$x]'");

	}

	

				$action=1;

	}

	else

	{

		mysqli_query($connection,"delete from staff_attendance_details where atten_date = '$keyvalue'");

		$totper = count($staffid);	

		for ($x = 0; $x < $totper; $x++) {	

	

	mysqli_query($connection,"insert into staff_attendance_details set districtid='$districtid',ulbid='$ulbid',ngoid='$ngoid',userid='$loginid',atten_date='$atten_date',attendance='$attendance[$x]',staffid='$staffid[$x]' where atten_date = '$keyvalue'");

	}

	

					$action=2;



	}

			echo "<script>location='$pagename?action=$action'</script>";

} }



if (isset($_GET[$tblpkey])){

//$btn_name = "Update";

//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;

$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";

$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );

$upload_date=$rowedit['upload_date'];		

$no_doctors=$rowedit['no_doctors'];

$districtid =  $rowedit['districtid'];			

$ngoid =  $rowedit['ngoid'];

$ulbid =  $rowedit['ulbid'];

$no_persons_treated=$rowedit['no_persons_treated'];

$no_persons_checked=$rowedit['no_persons_checked'];

$doctor_name=$rowedit['doctor_name'];	

$hospital_type=$rowedit['hospital_type'];	

$hospital_name=$rowedit['hospital_name'];	

$remarks=$rowedit['remarks'];	

$diagnosis_photo= $rowedit['diagnosis_photo'];



} else {

$atten_date=date('Y-m-d');		



//$districtid = '';			

//$ngoid = '';

//$ulbid = '';

$dup='';

}
// echo "select * from  staff_details $conuser order by staffid desc";die;


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

       <?php if($dup!=""){?> <div class="col-md-12"><h1><span style="color:#F00;"><?php echo $dup;?></span></h1></div>  <?php } ?>

		</div>

		<input type="hidden" name="key">

		<input type="hidden" name="medicalcamp_id" value="" id="medicalcamp_id">

		<div class="container-fluid">

		<div class="text-center"></div>

		<div class="row">

		<div class="col-md-12">

		<div class="card mt-12">

		<div class="card-header">

         <!-- <h4 class="card-title">Daily Report Entry</h4><a href="dailyreport_list.php" class="btn btn-info" style="float:right;">Show List</a>-->

			

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

						

					  <th style="width: 25%;">Date </th>

						<td style="width: 25%;"><input required type="date"  readonly name="atten_date" value="<?php echo $atten_date;?>"  id="atten_date" class="form-control" autocomplete="off" ></td>

					</tr>

					</table>

                   <h2>Selected From Staff Entry List</h2>

                   

                     <div align="right">

                    <a href="staff_entry.php" class="btn btn-success"> Add New</a>

                     <input type="text" id="myInput" class="form-control" onKeyUp="myFunction()"  placeholder="Search For Names.." title="Type in a Name" style="float:right; width:20%"></div>

                     <br>

                    

                    <table class="table table-bordered table-striped" id="myTable">

					

                 		<tr>

					      <th>Sl.No</th>

                          <th>Photo</th>

                                    <th>District</th>

                    <th>ULB</th>

                    <th>Shelter Name</th>

                    <th>Name</th>
                    <th>Post</th>

                    <th>Adhaar</th>

                    <th>Age</th>

                    <th>Gender</th>



                        <th colspan="2">Attendance</th>

					</tr>

					

					    <?php

				  $sno=1;

				  $currentdate=date('Y-m-d');

				  if($usertype=='admin'){

				  $shelterdetail=mysqli_query($connection,"select * from  staff_details $conuser order by staffid desc ");

				  }else{

				    $shelterdetail=mysqli_query($connection,"select * from  staff_details $conuser order by staffid desc");

				  }

				  while($get_data=mysqli_fetch_array($shelterdetail)){

				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");

					   $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");

					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");

					  $ngo=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");

					     $attendance=$cmn->getvalfield($connection,"staff_attendance_details","attendance","districtid='$get_data[districtid]' && ulbid='$get_data[ulbid]' && ngoid='$get_data[ngoid]' && atten_date='$currentdate' && staffid='$get_data[staffid]'");
                      $adharlength=strlen($get_data['adhar_no']);
				
				  ?>

		 	      <tr>

		 	      <td><?php echo $sno++; ?></td>

                  <td> <?php if($get_data['imgname']!=''){?>  <img src="uploaded/staff/<?php echo $get_data['imgname'];?>"   style=" height:30px; width:30px;" id="imgprvw" /> <?php } ?></td> 

		 	    <td><?php echo ucfirst(strtolower($district));?></td>

                          <td><?php echo ucfirst(strtolower($ulbname));?></td>

				  <td><?php echo $ngo; ?></td>

				

				  <td>

				  <input type="hidden" id="staffid<?php echo $sno; ?>" name="staffid<?php echo $sno; ?>" value=" <?php echo $get_data['staffid']?>">


				  <?php echo $get_data['staff_name']?></td>
                    <td><?php echo $get_data['staff_post'];?></td>
                    <td><?php echo $get_data['adhar_no'];?></td>

                      <td><?php echo $get_data['age']?></td>

		 	       <td><?php echo $get_data['gender']?></td>

                             <td>

                   <?php if($attendance=='Present') { ?> <button class="btn btn-success"  >  <span>Present</span> </button>

                   

                   <?php } else { ?>
 <div class="modal fade" id="myModal<?php echo $get_data['staffid']?>" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" style="color:#4c0a38">Staff Attendance</h3>
        </div>
        <div class="modal-body">
            <table style="width:100%">
                <tr><td>Staff Name</td><td><?php echo $get_data['staff_name']?></td></tr>
                <tr><td>Designation</td><td><?php echo $get_data['staff_post'];?></td></tr>
                <tr><td><label>Take Live Photo</label></td><td><input type="file" name='attendancephoto' id="attendancephoto" required/></td></tr>
				<tr><td colspan="2"><center><button onclick="getLocation()" class="btn btn-success" >Get Current Locations</button></center>
				<input type="hidden"  required name="latitude"  id="latitude"/>
				<input type="hidden"  required name="longitude" id="longitude" /></td></tr>

            </table>
        </div>
        <div class="modal-footer">
           
            <?php
            
            // echo $adharlength;
            if($adharlength==12 && $get_data['adhaarfront']!=''){ ?>
            <button class="btn btn-warning" onClick="GetAttend(<?php echo $sno; ?>);" >  <span> Take Attendance</span> </button>
            <?php } else{?>
             <a href="staff_entry.php?staffid=<?php echo $get_data['staffid']?>" class="btn btn-primary">  <span> Update Profile</span> </a><?php }?>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
                  
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $get_data['staffid']?>" >Not Present</button>
                   <?php } ?>

                   

                             

                             

                           </td>

					    </tr>

					<?php } ?>  

					

					

				



				</table>

		

		</div>

		</div>

		</div>

		</div>

		</div>

	





		<!-- end container -->

	</div>







	<?php include("inc/footer.php"); ?>

 <script>

 

 function GetAttend(sn){

	

	var districtid = jQuery("#districtid").val();

  	var ulbid = jQuery("#ulbid").val();

   	var ngoid = jQuery("#ngoid").val();

    var atten_date = jQuery("#atten_date").val();

	var staffid = jQuery("#staffid"+sn).val();

	var latitude = jQuery("#latitude").val();

	var longitude = jQuery("#longitude"+sn).val();
	 

//  	 alert(staffid);

	 if(districtid == '')

		{ alert('District can not be blank!');

			document.getElementById('districtid').focus();

			return false;

		}

		 if(ulbid == '')

		{ alert('ULB can not be blank!');

			document.getElementById('ulbid').focus();

			return false;

		}

		 if(ngoid == '')

		{ alert('Shelter can not be blank!');

			document.getElementById('ngoid').focus();

			return false;

		}

		if(latitude == '')

		{ alert('Please get current location.');

			return false;

		}

		if(longitude == '')
		{ 
			alert('Please get current location.');

			return false;

		}

 if(confirm("Are you sure! Present"))

		{ 
 var file_data = $('#attendancephoto').prop('files')[0];
var form_data = new FormData();                     // Create a form
form_data.append('attendancephoto', file_data);           // append file to form

         form_data.append('districtid',districtid);
          form_data.append('ulbid',ulbid);
           form_data.append('ngoid',ngoid);
            form_data.append('atten_date',atten_date);
             form_data.append('staffid',staffid);
			 form_data.append('latitude',latitude);
             form_data.append('longitude',longitude);
		  jQuery.ajax({

		  type: 'POST',

		  url: 'save_staff_attendance.php',

		  data: form_data,
          contentType: false,
          cache: false,
            processData:false,
		  dataType: 'html',

		  success: function(data){				  
            // if(data!=0){

			  location='<?php echo $pagename."?action=1" ; ?>';
// }
// else{
//     alert("Please capture photo");
// }
			}

		  });//ajax close

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

		

		function getCheck(data){

			

			 var no_persons_checked = jQuery("#no_persons_checked").val();

			

			 if(data>no_persons_checked)

			 {

				 alert('Please Check Referred is not more than Screened');

				   jQuery('#no_persons_treated').val('');

				      jQuery('#no_persons_treated').focus();

			 }

		}

	</script>

    

    <script>

function myFunction() {

 var value = jQuery('#myInput').val().toLowerCase();

	//alert(value);

	

	 jQuery("#myTable tr").filter(function() {

      jQuery(this).toggle(jQuery(this).text().toLowerCase().indexOf(value) > -1)

    });

}

</script>

<script>


function getLocation() {
  if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(showPosition);
	
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  
  document.getElementById("latitude").value=position.coords.latitude;
  document.getElementById("longitude").value=position.coords.longitude;
}
</script>

</body>



</html>