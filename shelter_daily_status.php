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
$currentdate=date('Y-m-d');
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
						<h4 class="mt-0 header-title">Shelter Update Status</h4>

							<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

								<thead>
									<tr>
										<th>SN.</th>
										
										<th>District Name</th>
										<th>ULB Name</th>
										<th>Shelter Name</th>
                                        <th>SMA Name</th>
										
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
								
									<?php
											$slno=1;
											
										//	echo "select * from attendance_details where atten_date = '$currentdate' group by userid order by districtid asc";
											$sql_get = mysqli_query($connection,"select * from attendance_details where $conuser1 and atten_date = '$currentdate' group by userid order by districtid asc");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{
								//	$statename =$cmn->getvalfield($connection,"m_state","statename","stateid='$row_get[stateid]'");
									 $districtname =$cmn->getvalfield($connection,"m_district","districtname","districtid='$row_get[districtid]'");
									  $ulbname =$cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$row_get[ulbid]'");
									  $ngoname =$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$row_get[ngoid]'");
									    $smaname =$cmn->getvalfield($connection,"m_ngo","smaname","ngoid='$row_get[ngoid]'");
									/// echo "personal_details","districtid = '$row_get[districtid]' && ulbid = '$row_get[ulbid]' && ngoid = '$row_get[ngoid]' && createdate = '$currentdate'";
									// $check = check_duplicate($connection,"personal_details","districtid = '$row_get[districtid]' && ulbid = '$row_get[ulbid]' && ngoid = '$row_get[ngoid]' && createdate = '$currentdate' group by ngoid");
									//   if($check >=1) {
									?> <tr>
                                                <td><?php echo $slno++; ?></td> 
									 		
                                                 <td><?php echo $districtname; ?></td>  
                                                   <td><?php echo $ulbname; ?></td>  
                                                 
                                                <td><?php echo $ngoname; ?></td> 
                                                  <td><?php echo $smaname; ?></td> 
												
                                               
										        <td>
                                                <?php echo "<span style='color:#6C0'>Updated</span>"; /*else {  echo  " <span style='color:#F00'>Not Updated</span>";}*/  ?>
                                               
                                                </td>
									</tr>
									<?php }//} ?>
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