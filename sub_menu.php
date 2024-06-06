<?php
include("adminsession.php");
$pagename = "sub_menu.php";
$module = "Add Sub Menu Details";
$submodule = "Sub Menu Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "submenu_details";
$tblpkey = "subid";
if ( isset( $_GET[ 'subid' ] ) )
	$keyvalue = $_GET[ 'subid' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
	$submenuname = test_input( $_POST[ 'submenuname' ] );
	$menuid = test_input( $_POST[ 'menuid' ] );
	$page_link = test_input( $_POST[ 'page_link' ] );
	$arr_seq = test_input( $_POST[ 'arr_seq' ] );

	//check Duplicate
	$check = check_duplicate( $connection, $tblname, "submenuname = '$submenuname' and menuid = '$menuid' and $tblpkey <> '$keyvalue'" );
	if ( $check > 0 ) {
		$dup = " Error : Duplicate User Id";
	} else {
		if ( $keyvalue == 0 ) {
			
			//insert
			$form_data = array('submenuname' => $submenuname,'menuid' => $menuid,'arr_seq' => $arr_seq,'page_link' => $page_link);
			dbRowInsert( $connection, $tblname, $form_data );
			$keyvalue = mysqli_insert_id( $connection );
			$action = 1;
			$process = "insert";
		} else {
			//update
			
			$form_data = array('submenuname' => $submenuname,'menuid' => $menuid,'arr_seq' => $arr_seq,'page_link' => $page_link);
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
	$submenuname = $rowedit[ 'submenuname' ];
	$arr_seq = $rowedit[ 'arr_seq' ];
	$page_link = $rowedit[ 'page_link' ];
	$menuid = $rowedit[ 'menuid' ];
	


} else { 
	$submenuname = '';
	$page_link = '';
	$menuid = '';
	$arr_seq = '';

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
					<div class="col-md-4">
						

						<div class="table-responsive">
							<h4 class="mt-0 header-title">Add Service</h4>

							<form action="" method="post">
								
								<div class="form-group row">
	<div class="col-sm-10">
<label for="example-text-input" class="col-sm-6 col-form-label">Menu Name</label>
										<select required  class="form-control" name="menuid" id="menuid"> <option value="">--Select--</option>
							
										<?php $sql=mysqli_query($connection,"select * from menu_details");
											while($data=mysqli_fetch_array($sql)){
											?>
											<option value="<?php echo $data['menuid']; ?>" ><?php echo $data['menuname'] ?></option>
											<?php } ?>
		
											</select>
                                             <script> document.getElementById('menuid').value='<?php echo $menuid; ?>'; </script>
									</div>
									
									<div class="col-sm-10">
<label for="example-text-input" class="col-sm-6 col-form-label">Sub Menu Name</label>
										<input required class="form-control" type="text" value="<?php echo $submenuname;?>" id="submenuname" name="submenuname">
									</div>
                                    
                                    <div class="col-sm-10">
<label for="example-text-input" class="col-sm-6 col-form-label">Page Link</label>
										<input required class="form-control" type="text" value="<?php echo $page_link;?>" id="page_link" name="page_link">
									</div>
                                    
                                    <div class="col-sm-10">
<label for="example-text-input" class="col-sm-6 col-form-label">Display Id</label>
										<input required class="form-control" type="text" value="<?php echo $arr_seq;?>" id="arr_seq" name="arr_seq">
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
                    
										<div class="col-md-8" style="border: groove;">
						<h4 class="mt-0 header-title">Service Details</h4>

							<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

								<thead>
									<tr>
										<th>SN.</th>
										<th>Menu Name</th>
										<th>Sub Menu Name</th>			
                                        <th>Page Link</th>									
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
										<?php
											$slno=1;
											
											
											$sql_get = mysqli_query($connection,"select * from submenu_details where 1=1 order by subid desc");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{
									
									$menuname=$cmn->getvalfield($connection,"menu_details","menuname","menuid='$row_get[menuid]'");
									?> <tr>
                                                <td><?php echo $slno++; ?></td>      
												 <td><?php echo $menuname; ?></td> 
                                                <td><?php echo $row_get['submenuname']; ?></td> 
                                                 <td><?php echo $row_get['page_link']; ?></td> 
										        <td><a class="fa fa-edit" style="font-size:20px"  title="Edit" href='?subid=<?php echo  $row_get['subid'] ; ?>'></a> /
                                                <a class="fa fa-remove" style="font-size:20px;color:red" onclick='funDel(<?php echo  $row_get['subid'] ; ?>);' style='cursor:pointer' title="Delete"></a></td>
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