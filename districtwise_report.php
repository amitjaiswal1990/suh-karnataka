<?php
include("adminsession.php");
$getid=$_GET['id'];
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
		
		
			<div class="row">
				
				<div class="col-md-12">
				<form >

<div class="container-fluid">
	<div class="card ">
		<div class="card-header ">
			<!-- <span class="pull-right text-danger">Amounts in Rs. only</span> -->
			<h4 class="card-title" style="text-align: center;" >
				
				   <span> District Wise Shelter Report, State Name :<span style="color: green"> Karnataka</span> </span>
				   
				   
				    
				   
					<span style="font-size: 15px;" class="pull-left mb-2 ">
						<a class="site-btn" style="padding-top: 8px; width: 150px;" href="javascript:history.back(-1)"> <i class="fa fa-chevron-left "></i>&nbsp;Back</a> 
					</span> 
				
				
			</h4>
		</div>
		<div class="table-responsive">
			<!-- Report Part -->
				<div class="row"  style=" margin-top: 12px;">
					 <div class="col-md-12 table-responsive">
						<table class="table table-bordered">
						
						<!--  District Wise Report -->
						
							<tr>
								<td colspan="12">
									<table id="districtWiseSheltersReport" class="example table table-bordered table-condensed table-hover"   >
									  <thead>
											<tr>
												<th style="text-align: center; width: 1%;">Sl.No.</th>
												<th style="text-align: center;">District Name</th>
												<th style="text-align: center;">No.of Shelters</th> 
												<th style="text-align: center;">No.of Persons</th>
												
												<th style="text-align: center;">Total Capacity</th>
											</tr>
									   </thead>
									   
										<tbody>
											<?php
	$sno=0;
	
											$sql_data=mysqli_query($connection,"select * from m_district where stateid='$_GET[id]'");
											while($get_data=mysqli_fetch_array($sql_data)){
												$sno++;
												$d_capacity=$cmn->getvalfield($connection,"m_shelter","max(design_capacity)","districtid='$get_data[districtid]'");
												$c_shelter=$cmn->getvalfield($connection,"m_shelter","count(shelter_id)","districtid='$get_data[districtid]'");
											 $men=$cmn->getvalfield($connection,"m_shelter","sum(men)","districtid='$get_data[districtid]'");
												$women=$cmn->getvalfield($connection,"m_shelter","sum(women)","districtid='$get_data[districtid]'");
												$children=$cmn->getvalfield($connection,"m_shelter","sum(children)","districtid='$get_data[districtid]'");
												
												
											?>
												<tr>
													<td style="text-align: center;  width: 1%;"><?php echo $sno; ?></td>
													<td><?php echo $get_data['districtname'] ?> </td>
											    	<td style="text-align: right;">
									
											    		<a href="all_shelter_details_report.php?distid=<?php echo $get_data['districtid'] ?> & tot=<?php echo $men+$women+$children; ?>"><?php echo $c_shelter ?></a>
											    	</td>
													
											    	<td style="text-align: right;">
											    		<a href="inmate_details_report.php?distid=<?php echo $get_data['districtid'] ?>" class="comma sum" ><?php
												echo $men+$women+$children;;
												?></a>
											    	</td>
											    	<td align="right" class="comma  sum"><?php echo $d_capacity ?></td>
												
												</tr>
											
												<?php } ?>
											
										</tbody>
										<tfoot >
											<tr style="font-weight: bold;" >
												<td></td>
												<td style="text-align: center;">Total</td>
												<td align="right" class="total"></td>
												<td align="right" class="total"></td>
												<td align="right" class="total"></td>
											</tr>
										</tfoot>
									
									
									
								</table>
									
							</td>
						</tr>
						
						<!--  Corporation Wise Report -->
						
					</table>
					</div>
				</div>
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		</div> <!-- End of card-body div -->
	</div> <!-- End of card div -->
</div><!--  End of container-fluid div -->
</form>					
						
					</div>
				</div>
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		</div> <!-- End of card-body div -->
	



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
<!-- Mirrored from themesbrand.com/lexa/html/horizontal/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Aug 2019 07:19:42 GMT -->
</html>