<?php
include("adminsession.php");
$pagename = "entrycommittee_details.php";
$module = "Add NGO";
$submodule = "NGO Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "committee_details";
$tblpkey = "comid";
$dup='';
if ( isset( $_GET[ 'comid' ] ) )
	$keyvalue = $_GET[ 'comid' ];
else
	$keyvalue = 0;
	
	
	
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
	 $designation =  $_POST[ 'designation' ];
	$position=$_POST['position'];
			$committee_type=$_POST['committee_type'];
			
	
	//check Duplicate
	$check = check_duplicate( $connection, $tblname, "designation = '$designation' and position = '$position' and committee_type = '$committee_type' and $tblpkey <> '$keyvalue'" );
	if ( $check > 0 ) {
		$dup = " Error : Duplicate ngo name";
	} else {
		if ( $keyvalue == 0 ) {
			
			
			//insert
			$form_data = array( 'position'=>$position,
								'committee_type'=>$committee_type,
							   'designation' => $designation,
							  
							  );
			dbRowInsert( $connection, $tblname, $form_data );
			$keyvalue = mysqli_insert_id( $connection );
			$action = 1;
			$process = "insert";
		} else {
			//update
			$position=$_POST['position'];
			$committee_type=$_POST['committee_type'];
			
			$form_data = array( 
				'position'=>$position,
				'committee_type'=>$committee_type,
				'designation' => $designation,
			 	
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
	$designation = $rowedit[ 'designation' ];
	$committee_type = $rowedit[ 'committee_type' ];
	$position = $rowedit[ 'position' ];
	
} else {
	$designation = '';
	$committee_type = '';
	$position = '';
	

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
               
					
										<div class="col-md-12">
						<h4 class="mt-0 header-title">State Committee Details</h4>

							<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

								<thead>
									<tr>
										<th>SN.</th>
									
										<th>Designation</th>
										<th>Position</th>
										
										<!--<th>Action</th>-->
									</tr>
								</thead>
								<tbody>
								
										<?php
											$slno=1;
											
											
											$sql_get = mysqli_query($connection,"select * from committee_details where committee_type='STATE' order by comid desc");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{
									
									
									?> <tr>
                                                <td><?php echo $slno++; ?></td> 
									 			 
                                                      <td><?php echo ucfirst(strtolower($row_get['designation'])); ?></td>    
                                                <td><?php echo ucfirst(strtolower($row_get['position'])); ?></td> 
												
										        <!--<td><a class="fa fa-edit" style="font-size:20px"  title="Edit" href='?comid=<?php echo  $row_get['comid'] ; ?>'></a> /
                                                <a class="fa fa-remove" style="font-size:20px;color:red" onclick='funDel(<?php echo  $row_get['comid'] ; ?>);' style='cursor:pointer' title="Delete"></a></td>-->
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
  function gettype(type)
  {
	 location='entrycommittee_details.php?type='+type;  
  }
  </script>

</body>

</html>