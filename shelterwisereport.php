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
				
				   <span>  Shelter  Wise Today Report, State Name :<span style="color: green"> Karnataka</span> </span>
				   
				   
				    
				   
					<span style="font-size: 15px;" class="pull-left mb-2 ">
						<a class="site-btn" style="padding-top: 8px; width: 150px;" href="javascript:history.back(-1)"> <i class="fa fa-chevron-left "></i>&nbsp;Back</a> 
					</span> 
				
				
			</h4>
		</div>
		<div class="table-responsive">
			<!-- Report Part -->
				<div class="row"  style=" margin-top: 12px;">
                
					 <div class="col-md-12 table-responsive">
                     <a href="excel_shelterwisereport.php" class="btn btn-info" style="float:right">Export Excel</a>
						<table class="table table-bordered">
						
		<?php 
		//echo "select * from  m_ngo $condata group by districtid asc";
        $shelterdetail=mysqli_query($connection,"select * from  m_ngo $condata group by districtid asc");
        while($get_row=mysqli_fetch_array($shelterdetail)){ 
        $countshelter=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","ngoid='$get_row[ngoid]'");
		 $districtname=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_row[districtid]'");
        if($countshelter > 0){
        
        ?>
                <tr>
                
                 
                    <th colspan="6">District : <?php echo $districtname;?></th>
                    <th colspan="5"><center>Occupancy</center></th>
                  
                </tr> 
            
                <tr>
                <th style="text-align: center; width: 1%;">SN</th>
                <th style="text-align: center;">ULB</th>
                <th style="text-align: center;">Shelter</th>
                
                <th>SMA Name</th>
                 <th style="text-align: center;">Report Updated</th>
                <th>Capacity</th>
                 <th>Child</th>
                <th>Men</th>
                <th>Women</th>
                <th>Third Gender</th>
                
                <th style="text-align: center;">Today </th>
            </tr>
									  
										
											<?php
	$sno=0;
	//$occupied=0;
	$curdate=date("Y-m-d");
	$countdistrict=1;
	 if($usertype=='SHELTER'){
		$datashel = "ngoid = '$get_row[ngoid]'";
	 }else{
		 $datashel = "districtid = '$get_row[districtid]'";
	 }
	
											$sql_data=mysqli_query($connection,"select * from m_ngo where $datashel order by districtid");
											while($get_data=mysqli_fetch_array($sql_data)){
												
												$sno++;
												$totmale=0;
												$totfemale=0;
												$totother=0;
												$totchild=0;
											
													$sql_occu=mysqli_query($connection,"select * from attendance_details where ngoid = '$get_data[ngoid]' and atten_date='$curdate'");
													while($get_oc=mysqli_fetch_array($sql_occu)){
													$totmale +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and gender='Male' and age > 14 ");
													$totfemale +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and gender='FeMale' and age > 14");
													$totother +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and gender='Other' and age > 14");
													$totchild +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and age < 14");
													
													}
											 $totoccupied=$cmn->getvalfield($connection,"attendance_details","count(aid)","ngoid='$get_data[ngoid]' and attendance='Present' and atten_date='$curdate'");
											 $status=$cmn->getvalfield($connection,"attendance_details","count(aid)","ngoid='$get_data[ngoid]' and atten_date='$curdate'");
										$ulbname=$cmn->getvalfield($connection,"ulb_master","ulbname","districtid='$get_data[districtid]' and ulbid='$get_data[ulbid]'");
											$design_capacity=$cmn->getvalfield($connection,"m_ngo","design_capacity","districtid='$get_data[districtid]' and ulbid='$get_data[ulbid]'");
											?>
                                            
												<tr>
                                                    <td style="text-align: center;  width: 1%;"><?php echo $sno; ?></td>
                                                    <td><?php echo $ulbname; ?> </td>
                                                    <td><?php echo $get_data['ngoname']?></td>
                                                    <td><?php echo $get_data['smaname']?></td>
                                                    <td><?php 
													  
													 if( $get_data['ngoname']!=''){
													if($status=='0')
													echo 'No';
													else 
													echo 'Yes';
													 }?> </td>
                                                    <td align="right" class="comma  sum"><?php echo $design_capacity; ?></td>
                                                      <td><?php echo $totchild;?></td>
                                                    <td><?php echo $totmale;?></td>
                                                    <td><?php echo $totfemale;?></td>
                                                    <td><?php echo $totother;?></td>
                                                    
                                                    <td style="text-align: right;">  <?php   echo $totoccupied; ?></td>


											    	
												
												</tr>
											
												<?php // $countdistrict++;
												//if($countdistrict > $countdist) { $countdistrict=1; }
												 } ?>
									
                        
                        
					<?php  } } ?>	
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