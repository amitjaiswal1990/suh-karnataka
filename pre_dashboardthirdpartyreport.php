<?php
include("adminsession.php");
$getid=$_GET['id'];
 $currentdate=date('Y-m-d');
  $firstdate=date('Y-m-1');
$firstdate=date('Y-m-1');
  $lastmonth = date('Y-m-1',strtotime("-30 days"));
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
				
				   <span> <?php if($getid==1){ 
				   $con="where $conuser1 and conductdate BETWEEN '$lastmonth' AND '$firstdate' and (men>0 || women>0 || children>0 || PWP>0) ";
				   echo "Rapid Survey(Shelter)";}
				   else if($getid==2){
					    $con="where $conuser1 and conductdate BETWEEN '$lastmonth' AND '$firstdate' and (men1>0 || women1>0 || children1>0 || PWP1>0) ";
					   echo "Third Party ULB";}
				   ?> Report, State Name :<span style="color: green"> Karnataka</span> </span>
				   
				   
				    
				   
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
												<th style="text-align: center; width: 1%;vertical-align: middle;">Sl.No.</th>
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;vertical-align: middle;">District</th> 
                                                <th style="text-align: center;vertical-align: middle;">ULB</th> 
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;">Shelter</th> 
                                                <th style="text-align: center;vertical-align: middle;">conductdate</th> 
                                                <th style="text-align: center;vertical-align: middle;">Men</th> 
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;">Women</th> 
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;">Children</th> 
                                                <th style="text-align: center;vertical-align: middle;">PWP</th> 
                                                <th style="text-align: center;vertical-align: middle;">Total</th> 
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;vertical-align: middle;">Date of formation of Executive Committee</th> 
                                                <th style="text-align: center;vertical-align: middle;vertical-align: middle;">No of Executive Committee meetings conducted</th> 
                                                <th style="text-align: center;vertical-align: middle;">Date of Formation of Shelter Management committee </th> 
                                                <th style="text-align: center;vertical-align: middle;">No of Shelter Management committee meetings conducted</th> 
                                                <th style="text-align: center;vertical-align: middle;">No of Urban Homeless rescued and accommadate in the shelter (Jan to Nov 2020)</th>

												
												
											</tr>
									   </thead>
									   
										<tbody>
											<?php
	$sno=0;
	$occupied=0;
	$curdate=date("Y-m-d");
	//echo "select * from thirdpartysurey $con";
											$sql_data=mysqli_query($connection,"select * from thirdpartysurey $con");
											while($get_data=mysqli_fetch_array($sql_data)){
												$sno++;
												$districtid=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
												$ulbid=$cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'"); 
											//	$ngoid=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");
												$conductdate=$get_data['conductdate']; 
												$men=$get_data['men']; 
												$women=$get_data['women']; 
												$children=$get_data['children']; 
												$PWP=$get_data['PWP']; 
												$total=$get_data['total']; 
												$men1=$get_data['men1']; 
												$women1=$get_data['women1']; 
												$children1=$get_data['children1']; 
												$PWP1=$get_data['PWP1']; 
												$ecformationdate=$get_data['ecformationdate']; 
												$ecmeetingconduct=$get_data['ecmeetingconduct']; 
												$smformationdate=$get_data['smformationdate']; 
												$smmeetingconduct=$get_data['smmeetingconduct']; 
												$nohsc=$get_data['nohsc'];
													$ngoid=$get_data['ngoid'];
												
												
												 
												
											?>
                                            
												<tr>
													<td  ><?php echo $sno; ?></td>
													<td><?php echo $districtid ?></td> 
                                                    <td><?php echo $ulbid ?></td> 
                                                    <td><?php echo $ngoid ?></td> 
                                                    <td><?php echo $conductdate ?></td> 
                                                    <?php if($getid==1){ ?>
                                                    <td><?php echo $men ?></td> 
                                                    <td><?php echo $women ?></td> 
                                                    <td><?php echo $children ?></td> 
                                                    <td><?php echo $PWP ?></td> 
                                                    <td><?php echo $total ?></td> 
                                                    <?php } else if($getid==2){ ?>
                                                    <td><?php echo $men1 ?></td> 
                                                    <td><?php echo $women1 ?></td> 
                                                    <td><?php echo $children1 ?></td> 
                                                    <td><?php echo $PWP1 ?></td>
                                                    <td><?php echo $PWP1+$men1+$women1+$children1 ?></td> <?php } ?>
                                                    <td><?php echo $ecformationdate ?></td> 
                                                    <td><?php echo $ecmeetingconduct ?></td>
                                                     <td><?php echo $smformationdate ?></td>
                                                     <td><?php echo $smmeetingconduct ?></td> 
                                                     <td><?php echo $nohsc ?></td>
												
												</tr>
											
												<?php } ?>
											
										</tbody>
										<tfoot >
											<!--<tr style="font-weight: bold;" >
												<td></td>
												<td style="text-align: center;">Total</td>
												<td align="right" class="total"></td>
												<td align="right" class="total"></td>
												<td align="right" class="total"></td>
											</tr>-->
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