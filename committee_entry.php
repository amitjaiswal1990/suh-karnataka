<?php
include("adminsession.php");
//echo $usertype;die;
$pagename = "committee_entry.php";
$module = "Add Vacant Details";
$submodule = "Add Vacant Details";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "committee_members";
$tblpkey = "memid";
$imgpath = "uploaded/financial/";
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
if ( isset( $_GET[ 'memid' ] ) )
	$keyvalue = $_GET[ 'memid' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
		
	if ( isset( $_POST[ 'submit' ] ) ) {
			
$districtid =  $_POST['districtid'];			
$ngoid =  $_POST['ngoid'];
$ulbid =  $_POST['ulbid'];

$staff_name=$_POST['staff_name'];
$address=$_POST['address'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$job_type=$_POST['job_type'];
$qualification=$_POST['qualification'];
$staff_profession=$_POST['staff_profession'];
$monthly_income=$_POST['monthly_income'];
$adhar_no=$_POST['adhar_no'];
$mobile_no=$_POST['mobile_no'];
$imgname=$_FILES['imgname'];
			if ( $keyvalue == 0 ) {
			mysqli_query($connection,"insert into committee_members set districtid = '$districtid',ngoid = '$ngoid',ulbid = '$ulbid',createdate = '$createdate',staff_name = '$staff_name',address = '$address',gender = '$gender',age = '$age',job_type = '$job_type',qualification = '$qualification',staff_profession = '$staff_profession',monthly_income = '$monthly_income',adhar_no = '$adhar_no',mobile_no = '$mobile_no'");
			$keyvalue = mysqli_insert_id($connection);
	$uploaded_filename = uploadImage($imgpath,$imgname);
			mysqli_query($connection,"update committee_members set imgname='$uploaded_filename' where memid='$keyvalue'");
		
			$action=1;
			}else{
					mysqli_query($connection,"update committee_members set districtid = '$districtid',ngoid = '$ngoid',ulbid = '$ulbid',createdate = '$createdate',staff_name = '$staff_name',address = '$address',gender = '$gender',age = '$age',job_type = '$job_type',qualification = '$qualification',staff_profession = '$staff_profession',monthly_income = '$monthly_income',adhar_no = '$adhar_no',mobile_no = '$mobile_no' where memid = '$keyvalue'  ");
					if($_FILES['imgname']['tmp_name']!="")
				{
					//delete old file
					$rowimg = mysqli_fetch_array(SelectDB($connection,$tblname,"activid = '$keyvalue'"));
					$oldimg = $rowimg["imgname"];
					if($oldimg != "")
					unlink("uploaded/staff/$oldimg");
					
				$uploaded_filename = uploadImage($imgpath,$imgname);
				//echo "update covidactivityentry set imgname='$uploaded_filename' where id='$keyvalue'";die;
			mysqli_query($connection,"update committee_members set imgname='$uploaded_filename' where memid='$keyvalue'");
			
				}
					$action=2;
			}
			
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
			$staff_name=$rowedit['staff_name'];
$address=$rowedit['address'];
$gender=$rowedit['gender'];
$age=$rowedit['age'];
$job_type=$rowedit['job_type'];
$qualification=$rowedit['qualification'];
$staff_profession=$rowedit['staff_profession'];
$monthly_income=$rowedit['monthly_income'];
$adhar_no=$rowedit['adhar_no'];
$mobile_no=$rowedit['mobile_no'];
$imgname=$rowedit['imgname'];
		
} else {
	$staff_name='';
$address='';
$gender='';
$age='';
$job_type='';
$qualification='';
$staff_profession='';
$monthly_income='';
$adhar_no='';
$mobile_no='';
$imgname='';
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
           <h4 class="card-title">Commitee Staff Details Entry</h4><a href="committee_list.php" class="btn btn-info" style="float:right;">Show List</a>
					
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
                      <th style="width: 25%;">Adhar No
 </th>
						<td style="width: 25%;"><input type="text" name="adhar_no" value="<?php echo $adhar_no;?>" id="adhar_no" class="form-control" autocomplete="off"></td>
                        
                	
					
						
					
					</tr>
                   	
                    
                    
                    
                    <tr>
						<th>Name  </th>
						<td> 
                        <input type="text" name="staff_name" value="<?php echo $staff_name;?>"   id="staff_name" class="form-control required" autocomplete="off">
                        
                     
                     </td>
                     <th>Profile Photo  </th>
						<td style="width: 25%;">
                       <input type="file" name="imgname" value="<?php echo $imgname;?>"   id="imgname" class="form-control required" autocomplete="off">  <?php if($imgname!=''){ ?><img src="uploaded/staff/<?php echo $imgname;?>" style="width:50px; height:50px;" > <?php } ?></td>
						
                    </tr>
                    
                     <tr>    
                        
                        <th style="width: 25%;">Gender
 </th>
						<td style="width: 25%;">
                        <select  id="gender" name="gender" class="form-control" ><option value="">-- Select --</option>
							
								<option value="Male">Male </option>
								<option value="Female">Female </option>
                                <option value="Third Gender">Third Gender</option>
                            
							</select>
                              <script>document.getElementById('gender').value='<?php echo $gender; ?>'; </script>
                        </td> 
                       
					
					
                        
                         <th style="width: 25%;">Age </th>
						<td style="width: 25%;"><input type="text" name="age" value="<?php echo $age;?>" id="age" class="form-control" autocomplete="off"></td>
                        </tr>
                    <tr>
                    
                        <th style="width: 25%;">Mobile No.
</th>
						<td style="width: 25%;"><input type="number" name="mobile_no" value="<?php echo $mobile_no;?>"   id="mobile_no" class="form-control " autocomplete="off" ></td>
                      
                    <th style="width: 25%;">Address
</th>
						<td style="width: 25%;"><input type="text" name="address" value="<?php echo $address;?>"   id="vacant_date" class="form-control " autocomplete="off"></td>
                        </tr>
                    
                     <tr>
                         <th style="width: 25%;">Job Type
 </th>
						<td style="width: 25%;">
                          <select  id="job_type" name="job_type" class="form-control" ><option value="">-- Select --</option>
							
								<option value="Part Time">Part Time </option>
								<option value="Full Time">Full Time </option>
                                                           
							</select>
                              <script>document.getElementById('job_type').value='<?php echo $job_type; ?>'; </script>
                        </td>
                   
                         <th style="width: 25%;">Qualification </th>
						<td style="width: 25%;"><input type="text" name="qualification" value="<?php echo $qualification;?>" id="qualification" class="form-control" autocomplete="off"></td>
                        </tr>
                    
                     <tr>
                         <th style="width: 25%;">Profession
 </th>
						<td style="width: 25%;"><input type="text" name="staff_profession" value="<?php echo $staff_profession;?>" id="staff_profession" class="form-control" autocomplete="off"></td>
                  
                        
                         <th style="width: 25%;">Monthly Income </th>
						<td style="width: 25%;"><input type="text" name="monthly_income" value="<?php echo $monthly_income;?>" id="monthly_income" class="form-control" autocomplete="off"></td>
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

  </script>
</body>

</html>