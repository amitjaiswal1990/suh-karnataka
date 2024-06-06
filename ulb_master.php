<?php
include("adminsession.php");
$pagename = "ulb_master.php";
$module = "Add ULB Details";
$submodule = "ULB Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "ulb_master";
$tblpkey = "ulbid";

$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
	
if ( isset( $_GET[ 'ulbid' ] ) )
	$keyvalue = $_GET[ 'ulbid' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
	$ulbname = test_input( $_POST[ 'ulbname' ] );
	  $stateid= $_POST[ 'stateid' ];
	   $districtid= $_POST[ 'districtid' ];
	   $ulbname= $_POST[ 'ulbname' ];
	    $type= $_POST[ 'type' ];
	//check Duplicate
	$check = check_duplicate( $connection, $tblname, "ulbname = '$ulbname' and $tblpkey <> '$keyvalue'" );
	if ( $check > 0 ) {
		$dup = " Error : Duplicate User Id";
	} else {
		if ( $keyvalue == 0 ) {
			
			//insert
			$form_data = array('ulbname' => $ulbname,'stateid'=>$stateid,'districtid'=>$districtid,'type'=>$type );
			dbRowInsert( $connection, $tblname, $form_data );
			$keyvalue = mysqli_insert_id( $connection );
			$action = 1;
			$process = "insert";
		} else {
			//update
			
			$form_data = array('ulbname' => $ulbname,'stateid'=>$stateid,'districtid'=>$districtid,'type'=>$type );
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
	$ulbname = $rowedit[ 'ulbname' ];
	$stateid = $rowedit[ 'stateid' ];
	$districtid = $rowedit[ 'districtid' ];
	$type = $rowedit[ 'type' ];
	
	


} else {
	$ulbname ='';

	$districtid = '';
	$type = '';

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
							<h4 class="mt-0 header-title">ULB Details</h4>

							<form action="" method="post">
								
								<div class="form-group row">
	<div class="col-sm-10">
<label for="example-text-input" class="col-sm-6 col-form-label">State Name</label>
											<label for="example-text-input" style="font-size:16px;color:green" class="col-sm-6 col-form-label"><?php echo ucfirst(strtolower($statename));?></label>
									</div>
									
									<div class="col-sm-10">
<label for="example-text-input" class="col-sm-6 col-form-label">District Name</label>
									<select required  class="form-control" name="districtid" id="districtid"><option value="">--Select--</option>
							
										<?php $sql=mysqli_query($connection,"select * from  m_district");
											while($data=mysqli_fetch_array($sql)){
											?>
											<option value="<?php echo $data['districtid']; ?>" ><?php echo $data['districtname'] ?></option>
											<?php } ?>
		
											</select>
                                             <script>
                                       document.getElementById('districtid').value='<?php echo $districtid; ?>';
                                       </script>
									</div>
                                    
                                    <div class="col-sm-10">
<label for="example-text-input" class="col-sm-6 col-form-label">ULB Name</label>
										<input class="form-control" type="text" onKeyUP="this.value = this.value.toUpperCase();" value="<?php echo $ulbname;?>" id="ulbname" name="ulbname" required>
									</div>
                                    
                                    <div class="col-sm-10">
<label for="example-text-input" class="col-sm-6 col-form-label">Type</label>
										<input class="form-control" type="text" onKeyUP="this.value = this.value.toUpperCase();" value="<?php echo $type;?>" id="type" name="type" required>
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
						<h4 class="mt-0 header-title">ULB Details</h4>

							<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

								<thead>
									<tr>
										<th>SN.</th>
										
										<th>District Name</th>
                                        <th>ULB Name</th>
									
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
										<?php
											$slno=1;
											
											
											$sql_get = mysqli_query($connection,"select * from  ulb_master where 1=1 order by ulbid desc");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{
									
									$sname=$cmn->getvalfield($connection,"m_state","statename","stateid='$row_get[stateid]'");
									$districtname=$cmn->getvalfield($connection,"m_district","districtname","districtid='$row_get[districtid]'");
									?> <tr>
                                                <td><?php echo $slno++; ?></td>      
												
                                                <td><?php echo $districtname; ?></td> 
                                                   <td><?php echo $row_get['ulbname']; ?></td> 
										        <td><a class="fa fa-edit" style="font-size:20px"  title="Edit" href='?ulbid=<?php echo  $row_get['ulbid'] ; ?>'></a> /
                                                <a class="fa fa-remove" style="font-size:20px;color:red" onclick='funDel(<?php echo  $row_get['ulbid'] ; ?>);' style='cursor:pointer' title="Delete"></a></td>
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

  </script>

</body>

</html>