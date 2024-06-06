<?php
include("adminsession.php");
 if($_GET['fromdate']) {
	 $fromdate = $_GET['fromdate'];
	}
	else
	{
	$fromdate='';
	}

if($_GET['districtid']) {
	 $districtid = $_GET['districtid'];
	}
	else
	{
	$districtid='';
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
				
				   
				   <span> Inmate Details, District Name :<span style="color: green"> 
					   <?php
					   echo $getdist=$cmn->getvalfield($connection,"m_district","districtname","districtid='$_GET[districtid]'");
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
                     <th>Photo</th>
                                    <th>District</th>
                    <th>ULB</th>
                    <th>Shelter Name</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Age</th>
                    <th>Gender</th>

                      
					
		 	     </tr>
		 	  </thead>
		 	  <tbody>
		 	  
		 	      <?php
				  $sno=1;
				//  echo "select * from personal_details $crit";
				//echo "select * from attendance_details $crit";
				//echo "select * from attendance_details where atten_date='$fromdate' and districtid='$districtid' order by districtid asc";
				  $shelterdetail=mysqli_query($connection,"select * from attendance_details where atten_date='$fromdate' and districtid='$districtid' order by districtid asc");
				  while($get_data=mysqli_fetch_array($shelterdetail)){
				       //$state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");
					    $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");
					  $ngo=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");
					   $id=$cmn->getvalfield($connection,"personal_details","id","id='$get_data[pid]'");
						$per_name=$cmn->getvalfield($connection,"personal_details","per_name","id='$id'");
						$profile_photo=$cmn->getvalfield($connection,"personal_details","profile_photo","id='$id'");
						$date_of_birth=$cmn->getvalfield($connection,"personal_details","date_of_birth","id='$id'");
						$age=$cmn->getvalfield($connection,"personal_details","age","id='$id'");
						$gender=$cmn->getvalfield($connection,"personal_details","gender","id='$id'");
						
						
				  ?>
		 	      <tr>
		 	      <td><?php echo $sno++; ?></td>
		 	     <td> <?php if($profile_photo!=''){?>  <img src="uploaded//personal/inmate/<?php echo $profile_photo;?>"   style=" height:30px; width:30px;" id="imgprvw" /> <?php } ?></td> 
		 	    <td><?php echo ucfirst(strtolower($district));?></td>
                          <td><?php echo ucfirst(strtolower($ulbname));?></td>
				  <td><?php echo $ngo; ?></td>
				
				  <td>
				  <input type="hidden" id="pid" name="pid[]" value=" <?php echo $get_data['id']?>">
				  <?php echo $per_name;?></td>
                    <td><?php echo dateformatindia($date_of_birth);?></td>
                      <td><?php echo $age;?></td>
		 	       <td><?php echo $gender;?></td>
                            
			
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