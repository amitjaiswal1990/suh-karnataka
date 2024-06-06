<?php
include("adminsession.php");
$pagename = "add_user.php";
$module = "Add Copo-Municipal";
$submodule = "Corp-Municipal Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "user";
$tblpkey = "userid";
if ( isset( $_GET[ 'userid' ] ) )
	$keyvalue = $_GET[ 'userid' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
	
	$role_id=$_POST['role_id'];
			$username=$_POST['username'];
			$mobile=$_POST['mobile'];
			$role_id=$_POST['role_id'];
			  $usertype=$cmn->getvalfield($connection,"add_role","role_name","role_id='$role_id'");
			$password=$_POST['password'];
			$uname=$_POST['uname'];
			$districtid=$_POST['districtid'];
			$ulbid=$_POST['ulbid'];
			$ngoid=$_POST['ngoid'];
	//check Duplicate
	$check = check_duplicate( $connection, $tblname, "username = '$username' and password = '$password' and $tblpkey <> '$keyvalue'" );
	if ( $check > 0 ) {
		$dup = " Error : Duplicate User Id";
	} else {
		if ( $keyvalue == 0 ) {
			
			//insert
			$form_data = array( 'role_id'=>$role_id,
							   'username' => $username,							
							   'password' => $password,
							    'usertype' => $usertype,
							    'uname' => $uname,
							   'mobile' => $mobile,
							   'districtid' => $districtid,
							   'ulbid' => $ulbid,
							   'ngoid' => $ngoid
							  );
			
			dbRowInsert( $connection, $tblname, $form_data );
			$keyvalue = mysqli_insert_id( $connection );
			$action = 1;
			$process = "insert";
		} else {
			//update
			$role_id=$_POST['role_id'];
			$form_data = array( 'role_id'=>$role_id,
							   'username' => $username,							 
							   'password' => $password,
							     'usertype' => $usertype,
							    'uname' => $uname,								 
							   'mobile' => $mobile,
							   'districtid' => $districtid,
							   'ulbid' => $ulbid,
							   'ngoid' => $ngoid
							  );
			dbRowUpdate( $connection, $tblname, $form_data, "WHERE $tblpkey = '$keyvalue'" );
			$action = 2;
			$process = "updated";
		}
echo "<script>location='$pagename?action=$action'</script>";
	

	}
}

if ( isset( $_GET[ $tblpkey ] ) ) {
	//$btn_name = "Update";
	//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
	$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
	$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );
	$username = $rowedit[ 'username' ];
	$password = $rowedit[ 'password' ];
	$uname1 = $rowedit[ 'uname' ];
	$role_id = $rowedit[ 'role_id' ];
	$mobile = $rowedit[ 'mobile' ];
	$districtid=$rowedit['districtid'];
			$ulbid=$rowedit['ulbid'];
			$ngoid=$rowedit['ngoid'];


} else {
	$username = '';
	$mobile ='';
	$login_id='';
	$role_id='';
	$uname1='';
	$password='';

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


	<!-- End Navigation Bar-->
	<div class="wrapper">
		<div class="container-fluid">
			<?php include("inc/alerts.php"); ?>
			<div class="row">
				
				<div class="col-md-12">
					<div class="col-md-5">
						

						<div class="table-responsive">
							<h3 class="mt-0 header-title">Add User</h3>

							<form action="" method="post">
                            <div class="form-group row">

									
									<div class="col-sm-10">
										
										<label for="example-text-input" class="col-sm-6 col-form-label">Role Name</label>
											<select required name="role_id" id="role_id" class="form-control" onChange="getRole(this.value);">
											  <option value="">Select Role</option>
												<?php 
												$sql=mysqli_query($connection,"select * from add_role where role_name in ('SHELTER','DISTRICT')");
												while($getrow=mysqli_fetch_array($sql)){
												?>
											  <option value="<?php echo $getrow['role_id'] ?>"><?php echo $getrow['role_name'] ?></option>
											 <?php } ?>
											</select>
										 <script> document.getElementById('role_id').value='<?php echo $role_id; ?>'; </script>
									</div>
								</div>
                                
                          		  <div class="form-group row" >

									
									<div class="col-sm-10">
										
										<label for="example-text-input" class="col-sm-6 col-form-label">District</label>
											 <select required name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control"><option value="">-- Select District--</option>
                        <?php $dist=mysqli_query($connection,"SELECT * FROM m_district $condata order by districtname asc");
							while($data=mysqli_fetch_array($dist)){
							
								?>
							  <option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>
						<?php } ?>
                     </select>
                         <script>document.getElementById('districtid').value='<?php echo $districtid; ?>'; </script>
									</div>
								</div>
                              	  <div class="form-group row" id="showblock">

									
									<div class="col-sm-10">
										
										<label for="example-text-input" class="col-sm-6 col-form-label">Block Name</label>
										 <select required name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from ulb_master $condata order by ulbname asc");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
						<?php } ?>
                     </select>
                       <script>document.getElementById('ulbid').value='<?php echo $ulbid; ?>'; </script>
									</div>
								</div>
                                
                                <div class="form-group row" id="showshelter">

									
									<div class="col-sm-10">
										
										<label for="example-text-input" class="col-sm-6 col-form-label">Shelter Name</label>
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
									</div>
								</div>
                                
								
								
									 
                                <div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">Name </label>

										<input required class="form-control" type="text"  value="<?php echo $uname1;?>" id="uname" name="uname">
									</div>
								</div>
								
								<div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">Mobile No.</label>

										<input required class="form-control" type="text"  maxlength="10" value="<?php echo $mobile;?>" id="mobile" name="mobile">
									</div>
								</div> 
                                
                                <div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">Login ID</label>

										<input required class="form-control" type="text"  value="<?php echo $username;?>" id="username" name="username">
									</div>
								</div>
                                
                                <div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">Password</label>

										<input required class="form-control" type="text" value="<?php echo $password;?>" id="password" name="password">
									</div>
								</div>
                                
								
<input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
								<center><button type="submit" name="submit" class="btn btn-primary waves-effect waves-light mr-1">Submit</button>
									<button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Reset</button>
								</center>
							</form>
							<br>
							<br>
							<br>

							
						</div>
					</div>
										<div class="col-md-12">
						<h4 class="mt-0 header-title">User Details</h4>

							<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

								<thead>
									<tr>
										<th>SN.</th>									
                                        <th>District</th>
                                         <th>Block</th>
                                          <th>Shelter</th>
                                           <th>User Name</th>
                                        <th>Mobile No</th>
										<th>Login ID</th><th>Password</th>
                                        
										
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
										
									
															
										<?php
												
													$slno=1;
											$sql1 = mysqli_query($connection,"select * from  user order by userid desc ");	
											while($row = mysqli_fetch_assoc($sql1))
											{ 
					$role_name =$cmn->getvalfield($connection,"add_role","role_name","role_id='$row[role_id]'"); 
					 $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$row[districtid]'");
					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$row[ulbid]'");
					  $ngo=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$row[ngoid]'");
					?>
					                    
										<tr>
										<td><?php echo $slno++;?></td>
                                        <td><?php echo $district;?></td>
                                        <td><?php echo $ulbname;?></td>
                                        <td><?php echo $ngo;?></td>
										<td><?php echo $row['uname'];?></td>
										<td><?php echo $row['mobile'];?></td>	
                                        <td><?php echo $row['username'];?></td>	
                                          <td><?php echo $row['password'];?></td>	
											
							 <td><a class="fa fa-edit" style="font-size:20px"  title="Edit" href='?userid=<?php echo  $row['userid'] ; ?>'></a> /
                                   <a class="fa fa-remove" style="font-size:20px;color:red" onclick="funDel(<?php echo  $row['userid'] ; ?>);" style='cursor:pointer' title="Delete"></a></td>
									</tr>
										
								
									<?php } ?>
								</tbody>
							</table>
					</div>
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->
		</div>





		<!-- end col -->
	</div>
	<!-- end row -->
	</div>





	<!-- end container-fluid -->
	</div>
	<!-- end wrapper -->




	<?php include("inc/footer.php"); ?>



<script>
	function funDel(id)
	{  //alert(id);   
		tblname = '<?php echo $tblname; ?>';
		tblpkey = '<?php echo $tblpkey; ?>';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		 //alert(module); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_master.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				//alert(data);
				   location='<?php echo $pagename."?action=3" ; ?>';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close

function getRole(data)
{
	//alert(data);
	if(data==12){
			   
			   jQuery("#showblock").show();
			     jQuery("#showshelter").show();
			   }
			else
				{
					 jQuery("#showblock").hide();
			     jQuery("#showshelter").hide();
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
					
			
		
		jQuery('#ngoid').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}

  </script>

</body>
<!-- Mirrored from themesbrand.com/lexa/html/horizontal/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Aug 2019 07:19:42 GMT -->
</html>