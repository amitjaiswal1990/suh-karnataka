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
				<form name="" method="post" action="">

<div class="container-fluid">
	<div class="card ">
		<div class="card-header ">
			<!-- <span class="pull-right text-danger">Amounts in Rs. only</span> -->
			<h4 class="card-title" style="text-align: center;" >
				
				   
				   <span> Shelter Details, District Name :<span style="color: green"> 
					   <?php
					   echo $getdist=$cmn->getvalfield($connection,"m_state","statename","stateid='$_GET[id]'");
					   ?>
					   
					   </span> </span>
					<span style="font-size: 15px;" class="pull-left mb-2 ">
						<a class="site-btn" style="padding-top: 8px; width: 150px;" href="javascript:history.back(-1)"> <i class="fa fa-chevron-left "></i>&nbsp;Back</a> 
					</span> 
				
				
			</h4>
		</div>
		<div class="table-responsive">
			<!-- Report Part -->
			
				
		 	
		 	
		 	
		 	
		 	<table class="table table-bordered table-striped">
		 	  <thead>
		 	     <tr>
		 	       <th>Sl.No</th>
		 	       <th>Shelter Type</th>
		 	       <th>Shelter Extent(in Sq.Mt)</th>
		 	       <th>Shelter Location</th>
		 	       <th>Shelter Start Date</th>
		 	       <th>NGO Name</th>
		 	       <th>No.Of Residents</th>
		 	       <th>Action</th>
		 	     </tr>
		 	  </thead>
		 	  <tbody>
		 	  
		 	      <?php
				  $sno=1;
				  $shelterdetail=mysqli_query($connection,"select * from m_shelter where stateid='$_GET[id]'");
				  while($get_data=mysqli_fetch_array($shelterdetail)){
					   $male_aged_no=$cmn->getvalfield($connection,"m_shelter","sum(male_aged_people_no)","shelter_id='$get_data[shelter_id]'");
												$male_children_no=$cmn->getvalfield($connection,"m_shelter","sum(male_children_no)","shelter_id='$get_data[shelter_id]'");
												$male_others_no=$cmn->getvalfield($connection,"m_shelter","sum(male_others_no)","shelter_id='$get_data[shelter_id]'");
												$male_differently_abled=$cmn->getvalfield($connection,"m_shelter","sum(male_differently_abled)","shelter_id='$get_data[shelter_id]'");
												
												$female_aged_no=$cmn->getvalfield($connection,"m_shelter","sum(female_aged_people_no)","shelter_id='$get_data[shelter_id]'");
												$female_children_no=$cmn->getvalfield($connection,"m_shelter","sum(female_children_no)","shelter_id='$get_data[shelter_id]'");
												$female_others_no=$cmn->getvalfield($connection,"m_shelter","sum(female_others_no)","shelter_id='$get_data[shelter_id]'");
												$female_differently_abled=$cmn->getvalfield($connection,"m_shelter","sum(female_differently_abled)","shelter_id='$get_data[shelter_id]'");
				  ?>
		 	      <tr>
		 	      <td><?php echo $sno++; ?></td>
		 	      <td><?php echo $get_data['s_type']; ?></td>
		 	      <td><?php echo $get_data['extent_of_shelter']; ?></td>
				  <td><?php echo $get_data['location_of_shelter']; ?></td>
				  <td><?php echo $get_data['date_of_operation']; ?></td>
				  <td><?php echo $cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'"); ?></td>
				  <td><?php echo $male_aged_no+$male_children_no+$male_others_no+$male_differently_abled+$female_aged_no+$female_others_no+$female_children_no+$female_differently_abled; ?></td>
					  
		 	      <td><a href="shelter_details_report.php?id=<?php echo $get_data['shelter_id'].' & districtid='.$_GET['id'].' & tot='.$_GET['tot']?>" >View Details</a></td>
		 	    </tr>
		 	    <?php } ?>
		 	   
		 	    
		 	  </tbody>
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