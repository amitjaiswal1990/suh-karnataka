<?php
include("adminsession.php");
//$getid=$_GET['id'];
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
				
				   <span>  ULB Wise Today Report, State Name :<span style="color: green"> Karnataka</span> </span>
				   
				   
				    
				   
					<span style="font-size: 15px;" class="pull-left mb-2 ">
						<a class="site-btn" style="padding-top: 8px; width: 150px;" href="javascript:history.back(-1)"> <i class="fa fa-chevron-left "></i>&nbsp;Back</a> 
					</span> 
				
				
			</h4>
		</div>
		<div class="table-responsive">
			<!-- Report Part -->
				<div class="row"  style=" margin-top: 12px;">
					 <div class="col-md-12 table-responsive">
                       <a href="excel_ulbrwisereport.php" class="btn btn-info" style="float:right">Export Excel</a>
						<table class="table table-bordered">
						
					 <?php 
					 $totcapacity=0;
				 $shelterdetail=mysqli_query($connection,"select * from  m_district $condata order by districtname asc");
				  while($get_row=mysqli_fetch_array($shelterdetail)){ 
				  $totulb=$cmn->getvalfield($connection,"ulb_master","count(ulbid)","districtid='$get_row[districtid]'");
				   $totngo=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","districtid='$get_row[districtid]'");
				    $totcapacity=$cmn->getvalfield($connection,"m_ngo","sum(design_capacity)","districtid='$get_row[districtid]'");
				  
				  
				  ?>
                <tr>
            
                    <th  colspan="5">District : <?php echo $get_row['districtname'];?> &nbsp;&nbsp;&nbsp;&nbsp; Total ULBs : <?php echo $totulb;?>&nbsp;&nbsp;&nbsp;&nbsp; Total Shelters : <?php echo $totngo;?>&nbsp;&nbsp;&nbsp;&nbsp; Total Capacity : <?php echo $totcapacity;?></th>
                 
                  
                </tr>
								<tr>
												<th style="text-align: center; width: 1%;">Sl.No.</th>
											
                                                <th style="text-align: center;">ULB</th>
                                                
												<th style="text-align: center;">Shelter</th>
                                                
                                                <th style="text-align: center;">Total Capacity</th>
												<th style="text-align: center;">Today Occupancy</th>
												
												
											</tr>
									 
											<?php
	$sno=0;
	//$occupied=0;
	$curdate=date("Y-m-d");
	$countdistrict=1;
	
	
											$sql_data=mysqli_query($connection,"select * from ulb_master where districtid = '$get_row[districtid]' order by districtid,ulbname");
											while($get_data=mysqli_fetch_array($sql_data)){
												
												$sno++;
												
												
											 $totoccupied=$cmn->getvalfield($connection,"attendance_details","count(aid)","ulbid='$get_data[ulbid]' and attendance='Present' and atten_date='$curdate'");
										
										$shelter=$cmn->getvalfield($connection,"m_ngo","ngoname","ulbid='$get_data[ulbid]'");
											$design_capacity=$cmn->getvalfield($connection,"m_ngo","sum(design_capacity)","ulbid='$get_data[ulbid]'");
											?>
                                            
												<tr>
													<td style="text-align: center;  width: 1%;"><?php echo $sno; ?></td>
												
                                                    <td><?php echo $get_data['ulbname'] ?> </td>
                                                    <td style="text-align: left;">
                                                    <?php if($shelter!=''){ ?>	
													<table border="1" width="100%">
                                                    <tr><td><strong>SN</strong></td><td><strong>Shelter</strong></td><td><strong>Report Updated</strong></td></tr>
                                                  <?php 
												  $count=1;
												  $sql=mysqli_query($connection,"select * from m_ngo where ulbid = '$get_data[ulbid]'");
											while($getn=mysqli_fetch_array($sql)){
												 $status=$cmn->getvalfield($connection,"attendance_details","count(aid)","ngoid='$getn[ngoid]' and atten_date='$curdate'");
												?>
                                                    <tr>
                                                    <td><?php echo $count++;?></td>
                                                    <td><?php echo $getn['ngoname'];?></td>
                                                    <td><?php 
													  
													 if($shelter!=''){
													if($status=='0')
													echo 'No';
													else 
													echo 'Yes';
													 }?> </td>
                                                    </tr>
                                                    <?php } ?>
                                                    </table>
                                                    <?php } ?>
													</td>
											    	  
													<td align="right" class="comma  sum"><?php echo $design_capacity; ?></td>
											    	<td style="text-align: right;">  <?php  if($shelter!=''){ echo $totoccupied; }?></td>
											  
											    	
											    	
												
												</tr>
											
												<?php // $countdistrict++;
												//if($countdistrict > $countdist) { $countdistrict=1; }
												 } ?>
											
										
						</tr>
                        
                        
					<?php } ?>	
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