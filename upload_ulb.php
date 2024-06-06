<?php
include("adminsession.php");
$pagename = "upload_ulb.php";
$module = "Upload ULB Report";
$submodule = "Personal ULB Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "ulb_master";


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
				<form method="post" action="" enctype="multipart/form-data">

<div class="container-fluid">
	<div class="card ">
		<div class="card-header ">
			<!-- <span class="pull-right text-danger">Amounts in Rs. only</span> -->
			<h4 class="card-title" style="text-align: center;" >
				
				<span>Upload ULB List</span>
			</h4>
		</div>
		<div class="table-responsive">
			<!-- Report Part -->
			
				<div class="row"  style=" margin-top: 12px;">
					 <div class="col-md-12 table-responsive">
						 <form action="" method="get">						<table class="table table-bordered">
						   <tr>
						   
							 <tr>
					<td style="vertical-align: middle;">Upload CSV<span class="text-error">*</span></td>	
						<td style="text-align: center;">  <input type="file" name="csv" accept=".csv" id="csv"> </td>
						   </tr>
							 <tr>
							 <td>
							</td>
								<td style="text-align: center;"><input type="submit" name="submit" value="Get Details" style="float:none;" class="site-btn"> </td>
							 </tr>
						 </form>
							<?php if(isset($_POST['submit'])){
				
	
// $district=$_POST['districtid'];
//$state=$_POST['stateid'];
    //$keyvalue = trim(addslashes($_POST['id']));
	
	$enable = 'enable';
	
	
	if(isset($_FILES['csv']['tmp_name']))
	{
		
	$file = $_FILES['csv']['tmp_name'];
//	print_r($_FILES);die;
	$handle = fopen($file,"r");
	if ($handle) {
	$c=1;
		while($data = fgetcsv($handle,1024))
		{
						     	
			$stateid=$data[0];
				$districtid=$data[1]; 
				$ulbname=$data[2]; 
				$type=$data[3]; 
		

		$dup="";
		$ins="";
		$c="";

	
		if($c!=1)
			{

								  $form_data = array(
													 'stateid'=>$stateid,
													 'districtid'=>$districtid,
													
													 'ulbname'=>$ulbname,
													 'type'=>$type,
													 
													
													 );
								   dbRowInsert($connection,$tblname,$form_data);
								  
			  $action=1;
			  $process = "insert";
							
								$ins++;
												
					//	}
						
				}
			
		
			$c++;
		}// end while
		
	}

	else {
    die("Unable to open file");
}
		
		// echo "<script>location='upload_data.php?action=$action&dup=$dup&ins=$ins'</script>";
	}//end csv if
		
	
}
						 ?>
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