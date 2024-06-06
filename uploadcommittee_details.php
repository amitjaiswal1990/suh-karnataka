<?php
include("adminsession.php");
$pagename = "uploadcommittee_details.php";
$module = "Upload Committee Details";
$submodule = "District Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "committee_details";



	 if(isset($_POST['submit'])){
 $committee_type=$_POST['committee_type'];
	$enable = 'enable';
	if(isset($_FILES['csv']['tmp_name']))
	{
	$file = $_FILES['csv']['tmp_name'];
	$handle = fopen($file,"r");
	if ($handle) {
	$c=1;
		while($data = fgetcsv($handle,1024))
		{		$designation=$data[0]; 			     	
			$position=$data[1];
		$dup="";
		$ins="";
		$c="";

	
		if($c!=1)
			{
								  $form_data = array(
													 'designation'=>$designation,
													 'position'=>$position,
													  'committee_type'=>$committee_type
													
													
													 );
								   dbRowInsert($connection,$tblname,$form_data);
								  
			  $action=1;
			  $process = "insert";
							
								$ins++;
					
				}
			
		
			$c++;
		}// end while
		
	}

	else {
    die("Unable to open file");
}
		
		echo "<script>location='entrycommittee_details.php?action=$action&dup=$dup&ins=$ins'</script>";
	}//end csv if
		
	
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
				

<div class="container-fluid">
	<div class="card ">
		<div class="card-header">
			<!-- <span class="pull-right text-danger">Amounts in Rs. only</span> -->
			<h4 class="card-title" style="text-align: center;" >
				
				<span>Upload Committee Details</span>
                  <a  href="sample_ulb_level_commette.csv" style="float:right; margin:12px;"><button class="btn btn-info">Download Sample File</button></a>
                <a href="entrycommittee_details.php" style="float:right; margin:12px;"><button class="btn btn-danger">CLICK FOR SINGLE ENTRY</button></a>

			</h4>
		</div>
		<div class="table-responsive">
			<!-- Report Part -->
						<form method="post" action="" enctype="multipart/form-data">	
                         
                         
                         				<table class="table table-bordered">
                                        <tr>
						<th>Committee Type</th>
						<td>
                        <select required name="committee_type" id="committee_type" style="width:50%"  class="form-control"><option value="">-- Select Committee Type--</option>
							  <option value="STATE">STATE LEVEL</option>
                              <option value="ULB">ULB LEVEL</option>
                              <option value="SHELTER">SHELTER LEVEL</option>
						
                     </select>
						</td>
						 </tr>
						   
							 <tr>
					<td style="vertical-align: middle;">Upload CSV<span class="text-error">*</span></td>	
						<td style="text-align: center;">  <input type="file" name="csv" accept=".csv" id="csv"> </td>
						   </tr>
							 <tr>
							 <td>
							</td>
								<td style="text-align: center;"><input type="submit" name="submit" value="Submit" class="btn btn-danger" style="float:none;" class="site-btn"> </td>
							 </tr>
                             </table>
						 </form>
		</div>
        
        
        
        
         <!-- End of card-body div -->
	</div> <!-- End of card div -->
</div><!--  End of container-fluid div -->

				</div>
				<!-- end col -->
		
			<!-- end row -->
		</div>





		<!-- end col -->
	</div>
	<!-- end row -->
	


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