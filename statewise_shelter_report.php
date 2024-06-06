<?php
include("adminsession.php");

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
					
					<form name="addServiceForm" id="stateWiseShelterReport" method="post" action="/stateWiseShelterReport.do">
<input type="hidden" id="key" name="key" />
<input type="hidden" name="property(state_id)" value="" id="state_id">
<input type="hidden" name="property(district_id)" value="" id="district_id">
<input type="hidden" name="property(corp_id)" value="" id="corp_id">
<input type="hidden" name="property(shelter_id)" value="" id="shelter_id">
<div class="container-fluid">
	<div class="card ">
		<div class="card-header ">
			<!-- <span class="pull-right text-danger">Amounts in Rs. only</span> -->
			<h4 class="card-title" style="text-align: center;" >
				
				<span>State wise Shelters Report</span>
			</h4>
		</div>
		<div class="table-responsive">
			<!-- Report Part -->
				<div class="row"  style=" margin-top: 12px;">
					 <div class="col-md-12 table-responsive">
                      <a href="excel_statewise_shelter_report.php" class="btn btn-info" style="float:right">Export Excel</a>
						<table class="table table-bordered">
						
							<tr>
								<td colspan="12">
									<table id="districtWiseSheltersReport" class="example table table-bordered table-condensed table-hover"   >
									  <thead>
											<tr>
												<th style="text-align: center; width: 1%;">Sl.No.</th>
												<th style="text-align: center;">State Name</th>
												<th style="text-align: center;">No.of Districts</th>
												<th style="text-align: center;">No.of Shelters</th> 
											</tr>
									   </thead>
									   
										<tbody>
											<?php 
											$sno=1;
											$totdist=0;
											$totshelter=0;
											$sql=mysqli_query($connection,"select * from m_state"); 
											while($data=mysqli_fetch_array($sql)){
												$distid=$cmn->getvalfield($connection,"m_district","districtid","stateid='$data[stateid]'");
												$district=$cmn->getvalfield($connection,"m_district","count(districtname)","stateid='$data[stateid]'");
												$shelter=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","1=1");
												
												
												
												$male_aged_no=$cmn->getvalfield($connection,"m_shelter","sum(male_aged_people_no)","districtid='$distid'");
												$male_children_no=$cmn->getvalfield($connection,"m_shelter","sum(male_children_no)","districtid='$distid'");
												$male_others_no=$cmn->getvalfield($connection,"m_shelter","sum(male_others_no)","districtid='$distid'");
												$male_differently_abled=$cmn->getvalfield($connection,"m_shelter","sum(male_differently_abled)","districtid='$distid'");
												
												$female_aged_no=$cmn->getvalfield($connection,"m_shelter","sum(female_aged_people_no)","districtid='$distid'");
												$female_children_no=$cmn->getvalfield($connection,"m_shelter","sum(female_children_no)","districtid='$distid'");
												$female_others_no=$cmn->getvalfield($connection,"m_shelter","sum(female_others_no)","districtid='$distid'");
												$female_differently_abled=$cmn->getvalfield($connection,"m_shelter","sum(female_differently_abled)","districtid='$distid'");
											$totdist +=$district;
											$totshelter +=$shelter;
											?>
												<tr>
													
													<td style="text-align: center;  width: 1%;"><?php echo $sno++; ?></td>
													<td><a href="districtwise_shelter_report.php?id=<?php echo $data['stateid']; ?>" ><?php echo $data['statename']; ?></a></td>
											    	<td style="text-align: right;" class="comma sum"> <?php echo $district; ?> </td>
											    	<td style="text-align: right;">
										<?php echo $shelter; ?>
											    	</td>
												</tr>
											<?php } ?>
											
										</tbody>
										<tfoot >
											<tr style="font-weight: bold;" >
												<td></td>
												<td style="text-align: center;">Total</td>
												<td align="right" class="total"><?php echo $totdist; ?></td>
												<td align="right" class="total"><?php echo $totshelter; ?></td>
											</tr>
										</tfoot>
									
									
									
								</table>
							</td>
						</tr>
						
						<!--  District Wise Report -->
						
						<!--  Corporation Wise Report -->
						
					</table>
					</div>
				</div>
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		 	
		</div> <!-- End of card-body div -->
	</div> <!-- End of card div -->
</div><!--  End of container-fluid div -->
</form>
				</div>
				<!-- end col -->
		
			<!-- end row -->
		</div>





		<!-- end col -->
	</div>
	<!-- end row -->
	





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
<!-- Mirrored from themesbrand.com/lexa/html/horizontal/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Aug 2019 07:19:42 GMT -->
</html>