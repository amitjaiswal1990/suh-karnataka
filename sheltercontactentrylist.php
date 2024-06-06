<?php
include("adminsession.php");
$pagename = "sheltercontactentry.php";
$module = "Add Shelter Contact";
$submodule = "Shelter Contact";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "shelter_contact";
$tblpkey = "shecontactid";
$dup='';
if ( isset( $_GET[ 'shecontactid' ] ) )
	$keyvalue = $_GET[ 'shecontactid' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
	 $ulbname =  $_POST[ 'ulbname' ];
	$sheltername=$_POST['sheltername'];
			$emailid=$_POST['emailid'];
			$smaname=$_POST['smaname'];
			$contact_no=$_POST['contact_no'];
			
	
	//check Duplicate
	$check = check_duplicate( $connection, $tblname, "ulbname = '$ulbname' and sheltername = '$sheltername' and emailid = '$emailid' and $tblpkey <> '$keyvalue'" );
	if ( $check > 0 ) {
		$dup = " Error : Duplicate ngo name";
	} else {
		if ( $keyvalue == 0 ) {
			
			
			//insert
			$form_data = array( 'sheltername'=>$sheltername,
								'emailid'=>$emailid,
								'smaname'=>$smaname,
								'ulbname'=>$ulbname,
							   'contact_no' => $contact_no
							  
							  );
			dbRowInsert( $connection, $tblname, $form_data );
			$keyvalue = mysqli_insert_id( $connection );
			$action = 1;
			$process = "insert";
		} else {
			//update
		
			
			$form_data = array( 
				'sheltername'=>$sheltername,
								'emailid'=>$emailid,
								'smaname'=>$smaname,
								'ulbname'=>$ulbname,
							   'contact_no' => $contact_no
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
	$ulbname = $rowedit[ 'ulbname' ];
	$emailid = $rowedit[ 'emailid' ];
	$sheltername = $rowedit[ 'sheltername' ];
	$smaname = $rowedit[ 'smaname' ];
	$contact_no = $rowedit[ 'contact_no' ];
	
} else {
	$ulbname = '';
	$emailid = '';
	$sheltername = '';
	$smaname = '';
	$contact_no = '';
	

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
						<h4 class="mt-0 header-title">Shelter Contact Details</h4>

							<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

								<thead>
									<tr>
										<th>SN.</th>
                                        <th>ULB</th>
										<th>Sheltername</th>
										<th>SMA Name</th>
                                        <th>Contact No</th>
                                        <th>Email ID</th>
										
										
									</tr>
								</thead>
								<tbody>
								
										<?php
											$slno=1;
											
											
											$sql_get = mysqli_query($connection,"select * from shelter_contact where 1=1 order by shecontactid desc");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{
									
									
									?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['ulbname']; ?></td>    
                                                <td><?php echo $row_get['sheltername']; ?></td> 
									 			   <td><?php echo $row_get['smaname']; ?></td> 
                                                     <td><?php echo $row_get['contact_no']; ?></td> 
                                                       <td><?php echo $row_get['emailid']; ?></td> 
                                                      
												
										       
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