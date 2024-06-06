<?php
include("adminsession.php");
$con1 = "where 1=1";
	$con='1=1';
	$crit=' 1=1';
	
	if($_GET['fromdate']!="" && $_GET['todate']!="")
{
	$fromdate = addslashes(trim($_GET['fromdate']));
	$todate = addslashes(trim($_GET['todate']));
}

if($_GET['districtid']!=0){
		 $con1 .=" and districtid = '$_GET[districtid]'";
		 $con .=" and districtid = '$_GET[districtid]'";
	}
	
	if($fromdate!="" && $todate!="")
{
	//$fromdate = $cmn->dateformatusa($fromdate);
	//$todate = $cmn->dateformatusa($todate);
	$crit .= " and  createdate between '$fromdate' and '$todate'";
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
					   
					    echo $getdist=$cmn->getvalfield($connection,"m_district","districtname","districtid='$_GET[distid]'");
					    $getstateid=$cmn->getvalfield($connection,"m_district","stateid","districtid='$_GET[distid]'");
					   //$getstate=$cmn->getvalfield($connection,"m_state","statename","stateid='$getstateid'");
					   ?>
					   
					   </span> </span>
                       
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
		 	  <thead>
		 	     <tr>
		 	       <th>Sl.No</th>
                   <th>ULB</th>
		 	       <th>Shelter Type</th>
		 	      <th>Contact Person</th>
                  <th>SMA Contact</th>
		 	       <th>Shelter Name</th>
                    <th>Capacity</th>
		 	       <th>No.Of Occupancy</th>
                   <th>View Details</th>
		 	     
		 	     </tr>
		 	  </thead>
		 	  <tbody>
		 	  
		 	      <?php
				  $sno=1;
				  $shelterdetail=mysqli_query($connection,"select * from m_ngo where districtid='$_GET[distid]'");
				  while($get_data=mysqli_fetch_array($shelterdetail)){
					 
													$ulbname=$cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");
													$totperson=$cmn->getvalfield($connection,"attendance_details","count(aid)","ngoid='$get_data[ngoid]' and atten_date='$_GET[fromdate]'");
												
				  ?>
		 	      <tr>
		 	      <td><?php echo $sno++; ?></td>
                    <td><?php echo $ulbname; ?></td>
		 	      <td><?php echo $get_data['s_type']; ?></td>
		 	     
				  <td><?php echo $get_data['contatct_person']; ?></td>
				  <td><?php echo $get_data['smaname']; ?></td>
				 <td><?php echo $get_data['ngoname']; ?></td>
                 <td><?php echo $get_data['design_capacity']; ?></td>
					  <td><a href="inmate_details_shelterwise_report.php?ngoid=<?php echo $get_data['ngoid']; ?>&fromdate=<?php echo $_GET['fromdate']; ?>"><?php	echo $totperson ?></a></td>
			<td><a href="shelter_details_report.php?id=<?php echo $get_data['ngoid']; ?>&districtid=<?php echo $_GET['distid']; ?>&fromdate=<?php echo $_GET['fromdate'];?>" >View Details</a></td>		  
		 	     
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