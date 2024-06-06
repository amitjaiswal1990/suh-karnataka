<?php
include("adminsession.php");
//echo "select * from m_shelter where shelter_id='$_GET[id]'";die;


//echo $data['date_of_operation'];die;
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
				<form method="post" action="">

<div class="container-fluid">
	<div class="card ">
		<div class="card-header ">
			<!-- <span class="pull-right text-danger">Amounts in Rs. only</span> -->
			<h4 class="card-title" style="text-align: center;" >
				
				   <span> Shelters Details, District Name :<span style="color: green"> <?php
					   echo $getdist=$cmn->getvalfield($connection,"m_district","districtname","districtid='$_GET[districtid]'");
					   ?></span> </span>
                       <br>
                          <span style="float:right"> Date:<span style="color: green"> <?php
					   echo dateformatindia($_GET['fromdate']);
					   ?></span> </span>
				   
					<span style="font-size: 15px;" class="pull-left mb-2 ">
						<a class="site-btn" style="padding-top: 8px; width: 150px;" href="javascript:history.back(-1)"> <i class="fa fa-chevron-left "></i>&nbsp;Back</a> 
					</span> 
				
				
			</h4>
		</div>
		<div class="table-responsive">
			<!-- Report Part -->

		 	
		 	  <table class="table table-bordered table-striped">
              
		 	      <?php 
				  
				  $totmale=0;
												$totfemale=0;
												$totother=0;
												$totchild=0;
				  $sql12=mysqli_query($connection,"select * from m_shelter where ngoid='$_GET[id]'");
                        $data12=mysqli_fetch_array($sql12); 
						//echo "select * from attendance_details where ngoid = '$_GET[id]' and atten_date='$_GET[fromdate]'";
						$sql_occu=mysqli_query($connection,"select * from attendance_details where ngoid = '$_GET[id]' and atten_date='$_GET[fromdate]'");
													while($get_oc=mysqli_fetch_array($sql_occu)){
													$totmale +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and gender='Male' and age > 14 ");
													$totfemale +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and gender='FeMale' and age > 14");
													$totother +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and gender='Other' and age > 14");
													$totchild +=$cmn->getvalfield($connection,"personal_details","count(id)","id='$get_oc[pid]' and age < 14");
													
													}
						
						?>
					<tr>
						<th>State Name</th>
						<td> <?php echo $cmn->getvalfield($connection,"m_state","statename","stateid='$data12[stateid]'"); ?>                 
						</td>
                       <th style="width: 25%;">District Name</th>
						<td style="width: 25%;"><?php echo $cmn->getvalfield($connection,"m_district","districtname","districtid='$data12[districtid]'"); ?></td>
						
					</tr>
					
					<tr>
                    <th style="width: 25%;">ULB Name</th>
						<td style="width: 25%;"><?php echo $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$data12[ulbid]'"); ?></td>
                        
						<th style="width: 25%;">Shelter Type </th>
						<td style="width: 25%;"><?php echo $data12['s_type']; ?></td>
					
						
					</tr>
					
					<tr>
						
						
						<th style="width: 25%;">Shelter Name</th>
						<td style="width: 25%;"><?php echo $cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$data12[ngoid]'"); ?></td>
                        <th style="width: 25%;">SMA Name</th>
						<td style="width: 25%;"><?php echo $data12['smaname']; ?></td>
					</tr>
					
				  <tr>
						<th style="width: 25%;">Contact Person</th>
						<td style="width: 25%;"><?php echo $data12['contatct_person']; ?></td>
						
							
						<th style="width: 25%;">Capacity</th>
						<td style="width: 25%;"><?php echo  $cmn->getvalfield($connection,"m_ngo","design_capacity","ngoid='$data12[ngoid]'"); ?></td>
					</tr>
				 
					<tr>
						<th colspan="4">No of Residents Now Occupied</th>
					</tr>
					<tr>	
						<td colspan="4">
						   <table style="width: 100%">
						     <tr>
						        
						        <th>Men</th>
						        <th>Women</th>
						        <th>Third Gender</th>
                                 <th>Child</th>
                                <th>Total</th>
						     </tr>
						     
						     
							      <tr>
							              <td><?php echo $totmale; ?></td>
							        <td><?php echo $totfemale; ?></td>
							        <td><?php echo $totother; ?></td>
                                    <td><?php echo $totchild; ?></td>
                                    <td><?php echo $totmale+$totfemale+$totother+$totchild; ?></td>
							     </tr>
						     
						     
							   
						     
						     
						   </table>
						</td>
					</tr>
					    <tr><th colspan="4">Register</th></tr>
						<tr>
						<td colspan="4">   
						     <table style="width:100%">
						     <tr>
						        <th>Sl.No</th>
						        <th>Register Type</th>
						        <th style="text-align: center;">Yes / No</th>
						       
						     </tr>
						     
						     <?php 
								 $rno=1;
								// echo "select * from save_register_type where shelter_id='$_GET[id]'";
								 $reg=mysqli_query($connection,"select * from save_register_type where shelter_id='$_GET[id]'"); 
								 while($reg_data=mysqli_fetch_array($reg)){
								 ?>
							      <tr>
							        <td><?php echo $rno++ ?>.</td>
							        <td><?php echo $reg_data['registername'] ?></td>
							        <td class="text-center"><?php echo $reg_data['register_type'] ?></td>
							     </tr>
						     
							    <?php } ?>
							     
						     </table></td>
						     </tr>
						   
						   
						     <tr>
						     <th colspan="4">Basic Amenities</th>
						     </tr>
						     <tr>
						     <td colspan="4">
						     <table style="width: 100%;">
								  
							     <tr>
							        <th>Sl.No</th>
							        <th>Item</th>
							        <th style="text-align: center;">Yes /No</th>
							     </tr>
							     <?php 
								 $ano=1;
								 $amenties=mysqli_query($connection,"select * from save_amenities where shelter_id='$_GET[id]'"); 
								 while($amenties_data=mysqli_fetch_array($amenties)){
								 ?>
								      <tr>
								        <td><?php echo $ano++ ?></td>
								        <td><?php echo $amenties_data['amenitiename'] ?></td>
								        <td class="text-center"><?php echo $amenties_data['ameniti_type'] ?></td>
								     </tr>
							     <?php } ?>
								     
						   </table>
						   </td>
					   </tr>
					   
					    
						     
				</table>
		 	
		 	
		 	
		 	
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