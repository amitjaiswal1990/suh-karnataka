<?php
include("adminsession.php");
$pagename = "ngoMaster.php";
$module = "Add Shelter";
$submodule = "Shelter Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "m_ngo";
$tblpkey = "ngoid";
$dup='';
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
if ( isset( $_GET[ 'ngoid' ] ) )
	$keyvalue = $_GET[ 'ngoid' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) { 
$districtid=$_POST['districtid'];
		$ngoname = test_input( $_POST[ 'ngoname' ] );
		$ulbid = test_input( $_POST[ 'ulbid' ] );
		$districtid = test_input( $_POST[ 'districtid' ] );
		$s_type=$_POST['s_type'];
		$smaname=$_POST['smaname'];
		$contatct_person=$_POST['contatct_person'];
		$design_capacity=$_POST['design_capacity'];
			$expiry_date=$_POST['expiry_date'];
	
	
	
	//check Duplicate
	$check = check_duplicate( $connection, $tblname, "ngoname = '$ngoname' and $tblpkey <> '$keyvalue'" );
	if ( $check > 0 ) {
		$dup = " Error : Duplicate ngo name";
	} else {
		if ( $keyvalue == 0 ) {
			
			
			
			//insert
			$form_data = array( 'stateid'=>$stateid,
								'districtid'=>$districtid,
							   'ngoname' => $ngoname,
							    'ulbid' => $ulbid,
								 's_type'=>$s_type,
								'smaname'=>$smaname,
							   'contatct_person' => $contatct_person,
							     'expiry_date' => $expiry_date,
							    'design_capacity' => $design_capacity
							  
							  );
			dbRowInsert( $connection, $tblname, $form_data );
			$keyvalue = mysqli_insert_id( $connection );
			$action = 1;
			$process = "insert";
		} else {
			//update
			$stateid=$_POST['stateid'];
			$districtid=$_POST['districtid'];
			
			$form_data = array( 
				'stateid'=>$stateid,
				'districtid'=>$districtid,
				'ngoname' => $ngoname,
				 'ulbid' => $ulbid,
				 's_type'=>$s_type,
								'smaname'=>$smaname,
							   'contatct_person' => $contatct_person,
							     'expiry_date' => $expiry_date,
							    'design_capacity' => $design_capacity
			 	
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
	$ngoname = $rowedit[ 'ngoname' ];
	$districtid = $rowedit[ 'districtid' ];
	$stateid = $rowedit[ 'stateid' ];
	$ulbid = $rowedit[ 'ulbid' ];
	$s_type = $rowedit[ 's_type' ];
	$smaname = $rowedit[ 'smaname' ];
	$contatct_person = $rowedit[ 'contatct_person' ];
	$design_capacity = $rowedit[ 'design_capacity' ];
		$expiry_date = $rowedit[ 'expiry_date' ];
	
} else {
	$ngoname = '';
	$s_type = '';	
	$smaname = '';
	$contatct_person = '';
	$design_capacity='';
	$expiry_date='';
	

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
			
	<?php if($dup!="") { ?>
			 <div class="alert alert-danger bg-danger text-white mb-0" role="alert" >
   
      <strong><?php echo $dup; ?> </strong>
    </div><!--alert-->
	<?php } ?>
	
			<div class="row">
				
				<div class="col-md-12">
					<div class="col-md-5">
						

						<div class="table-responsive">
							<h3 class="mt-0 header-title">Shelter Master</h3>

							<form action="" method="post">
								
								<div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-6 col-form-label">State Name</label>
							<label for="example-text-input" style="font-size:16px;color:green" class="col-sm-6 col-form-label"><?php echo ucfirst(strtolower($statename));?></label>
											
									</div>
								</div>
								
								<div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-6 col-form-label">District Name</label>
										
											<select required name="districtid" id="districtid" onChange="getulb();" class="form-control">
											  <option value="">Select District</option>
												<?php 
												$sql=mysqli_query($connection,"select * from m_district");
												while($getrow=mysqli_fetch_array($sql)){
												?>
											  <option value="<?php echo $getrow['districtid'] ?>"><?php echo ucfirst(strtolower($getrow['districtname'])); ?></option>
											 <?php } ?>
											</select>
										 <script> document.getElementById('districtid').value='<?php echo $districtid; ?>'; </script>
									</div>
								</div>
								
                                
                                <div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-6 col-form-label">ULB Name</label>
										
											<select required name="ulbid" id="ulbid"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from ulb_master");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
						<?php } ?>
                     </select>
                      <script> document.getElementById('ulbid').value='<?php echo $ulbid; ?>'; </script>
									</div>
								</div>
                                
								<div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">Shelter Name</label>

										<input class="form-control" required type="text"  value="<?php echo $ngoname;?>" id="ngoname" name="ngoname">
									</div>
								</div> 
                                <div class="form-group row">
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">SMA Name</label>
<input  type="text" name="smaname" id="smaname"  value="<?php echo $smaname; ?>"  class="form-control">
									</div>
								</div> 
                                
                                	<div class="form-group row">
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">Contact Person</label>
<input  type="text" name="contatct_person" id="contatct_person"  value="<?php echo $contatct_person; ?>"  class="form-control">
									</div>
								</div> 
                                
                                <div class="form-group row">
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">Shelter Type</label>
<select  id="s_type" name="s_type"  value="" class="form-control"><option value="">-- Select --</option>
							
								<option value="Men">Men</option>
								<option value="WoMen">WoMen</option>
                                <option value="Men and Women">Men and WoMen</option>
                                <option value="Third Gender">Third Gender</option>
							</select>
                                   <script>  document.getElementById('s_type').value=('<?php echo $s_type;?>'); </script>     
									</div>
								</div> 
                                <div class="form-group row">
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">Capacity</label>
<input  type="text" name="design_capacity" id="design_capacity"  value="<?php echo $design_capacity; ?>"  class="form-control">
									</div>
								</div> 
                                
                                <div class="form-group row">
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">Expiry Date</label>
<input  type="date" name="expiry_date" id="expiry_date"  value="<?php echo $expiry_date; ?>"  class="form-control">
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
										<div class="col-md-7">
						<h4 class="mt-0 header-title">Shelter Details</h4>

							<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

								<thead>
									<tr>
										<th>SN.</th>
										
										<th>District Name</th>
											<th>ULB Name</th>
										<th>Shelter Name</th>
                                      
										
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
										<?php
											$slno=1;
											
											
											$sql_get = mysqli_query($connection,"select * from m_ngo where 1=1 order by ngoid desc");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{
									$statename =$cmn->getvalfield($connection,"m_state","statename","stateid='$row_get[stateid]'");
									 $districtname =$cmn->getvalfield($connection,"m_district","districtname","districtid='$row_get[districtid]'");
									  $ulbname =$cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$row_get[ulbid]'");
									
									?> <tr>
                                                <td><?php echo $slno++; ?></td> 
									 		
                                                 <td><?php echo $districtname; ?></td>    
                                                   <td><?php echo $ulbname; ?></td>    
                                                <td><?php echo $row_get['ngoname']; ?></td> 
                                               
												
										        <td><a class="fa fa-edit" style="font-size:20px"  title="Edit" href='?ngoid=<?php echo  $row_get['ngoid'] ; ?>'></a> /
                                                <a class="fa fa-remove" style="font-size:20px;color:red" onclick='funDel(<?php echo  $row_get['ngoid'] ; ?>);' style='cursor:pointer' title="Delete"></a></td>
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
		
  </script>

</body>

</html>