<?php
include("adminsession.php");
$pagename = "corpMunicipalityMaster.php";
$module = "Add Copo-Municipal";
$submodule = "Corp-Municipal Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "m_corpmunicipal";
$tblpkey = "corpmunicipal_id";
if ( isset( $_GET[ 'corpmunicipal_id' ] ) )
	$keyvalue = $_GET[ 'corpmunicipal_id' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
	$corpmunicipal = test_input( $_POST[ 'corpmunicipal' ] );

	//check Duplicate
	$check = check_duplicate( $connection, $tblname, "corpmunicipal = '$corpmunicipal' and $tblpkey <> '$keyvalue'" );
	if ( $check > 0 ) {
		$dup = " Error : Duplicate User Id";
	} else {
		if ( $keyvalue == 0 ) {
			$stateid=$_POST['stateid'];
			$districtid=$_POST['districtid'];
			//insert
			$form_data = array( 'stateid'=>$stateid,
								'districtid'=>$districtid,
							   'corpmunicipal' => $corpmunicipal );
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
				'corpmunicipal' => $corpmunicipal );
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
	$corpmunicipal = $rowedit[ 'corpmunicipal' ];
	$districtid = $rowedit[ 'districtid' ];
$stateid = $rowedit[ 'stateid' ];

} else {
	$corpmunicipal = '';

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
							<h3 class="mt-0 header-title">Corp-Municipal Master</h3>

							<form action="" method="post">
								
								<div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-6 col-form-label">State Name</label>
										
											<select required name="stateid" id="stateid" onChange="getdistrict();" class="form-control">
											  <option value="">Select State</option>
												<?php 
												$sql=mysqli_query($connection,"select * from m_state");
												while($getrow=mysqli_fetch_array($sql)){
												?>
											  <option value="<?php echo $getrow['stateid'] ?>"><?php echo $getrow['statename'] ?></option>
											 <?php } ?>
											</select>
										 <script> document.getElementById('stateid').value='<?php echo $stateid; ?>'; </script>
									</div>
								</div>
								
								<div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-6 col-form-label">District Name</label>
										
											<select required name="districtid" id="districtid" class="form-control">
											  <option value="">Select District</option>
												<?php 
												$sql=mysqli_query($connection,"select * from m_district");
												while($getrow=mysqli_fetch_array($sql)){
												?>
											  <option value="<?php echo $getrow['districtid'] ?>"><?php echo $getrow['districtname'] ?></option>
											 <?php } ?>
											</select>
										 <script> document.getElementById('districtid').value='<?php echo $districtid; ?>'; </script>
									</div>
								</div>
								
								<div class="form-group row">

									
									<div class="col-sm-10">
										<label for="example-text-input" class="col-sm-12 col-form-label">Corporation (or) Municipality Details</label>

										<input class="form-control" required type="text" onKeyUP="this.value = this.value.toUpperCase();" value="<?php echo $corpmunicipal;?>" id="corpmunicipal" name="corpmunicipal">
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
						<h4 class="mt-0 header-title">Corporation (or) Municipality Details</h4>

							<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

								<thead>
									<tr>
										<th>SN.</th>
										<th>State Name</th>
										<th>District Name</th>
										<th>Corporation (or) Municipalityl</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
										<?php
											$slno=1;
											
											
											$sql_get = mysqli_query($connection,"select * from m_corpmunicipal where 1=1 order by corpmunicipal_id desc");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{
									$statename =$cmn->getvalfield($connection,"m_state","statename","stateid='$row_get[stateid]'");
									 $districtname =$cmn->getvalfield($connection,"m_district","districtname","districtid='$row_get[districtid]'");
									
									?> <tr>
                                                <td><?php echo $slno++; ?></td> 
									 			<td><?php echo $statename; ?></td>
                                                 <td><?php echo $districtname; ?></td>    
                                                <td><?php echo $row_get['corpmunicipal']; ?></td> 
										        <td><a class="fa fa-edit" style="font-size:20px"  title="Edit" href='?corpmunicipal_id=<?php echo  $row_get['corpmunicipal_id'] ; ?>'></a> /
                                                <a class="fa fa-remove" style="font-size:20px;color:red" onclick='funDel(<?php echo  $row_get['corpmunicipal_id'] ; ?>);' style='cursor:pointer' title="Delete"></a></td>
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
</script>

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

  </script>


</body>
<!-- Mirrored from themesbrand.com/lexa/html/horizontal/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Aug 2019 07:19:42 GMT -->
</html>