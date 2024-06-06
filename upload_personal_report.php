<?php
include("adminsession.php");
$pagename = "upload_personal_report.php";
$module = "Upload Personal Report";
$submodule = "Personal Report Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "personal_details";


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
				
				<span>Upload Personal Report</span>
			</h4>
		</div>
		<div class="table-responsive">
			<!-- Report Part -->
			
				<div class="row"  style=" margin-top: 12px;">
					 <div class="col-md-12 table-responsive">
						 <form action="" method="get">						<table class="table table-bordered">
						   <tr>
						      <td style="vertical-align: middle;">State Name</td>
						<td><select name="stateid"  class="form-control required"><option value="0">--Select--</option>
							
<option value="1">Tamil Nadu</option></select>
						
						</td>
						</tr>	
							<tr>
							<td style="vertical-align: middle;">District Name</td>	
						<td><select name="districtid"  class="form-control required"><option value="0">--Select--</option>
						<?php
							$dist=mysqli_query($connection,"select * from m_district");
							while($dist_data=mysqli_fetch_array($dist)){
							?>
							
<option value="<?php echo $dist_data['districtid'] ?>"><?php echo $dist_data['districtname'] ?></option>
						<?php } ?>
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
								<td style="text-align: center;"><input type="submit" name="submit" value="Get Details" style="float:none;" class="site-btn"> </td>
							 </tr>
						 </form>
							<?php if(isset($_POST['submit'])){
				
	
 $district=$_POST['districtid'];
$state=$_POST['stateid'];
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
						     	
			$per_name=$data[0];
			$date_of_birth=$data[1]; 
			$age=$data[2]; 
			$gender=$data[3]; 
			$profile_photo=$data[4]; 
			$place_individual_identified=$data[5]; 
			$stateid=$state; 
			$districtid=$district; 
			$phone_no=$data[8]; 
			$alternative_phone_no=$data[9]; 
			$address=$data[10]; 
			$percondition=$data[11]; 
			$status=$data[12]; 
			$domicile_state=$data[13]; 
			$domicile_district=$data[14]; 
			$domicile_village=$data[15]; 
			$marital_status=$data[16]; 
			$last_stayed_place=$data[17]; 
			$period_stayed_place=$data[18]; 
			$connon_language=$data[19]; 
			$language_read=$data[20]; 
			$language_write=$data[21]; 
			$language_speak=$data[22]; 
			$qualification=$data[23]; 
			$study_place=$data[24]; 
			$health_condition=$data[25]; 
			$physical_ailment=$data[26]; 
			$fir_copy=$data[27];
		

		$dup="";
		$ins="";
		$c="";

	
		if($c!=1)
			{
				
				
						
						/* $sql="select studentid from data where fname='$fname' and lname = '$lname' and f_mobile = '$f_mobile' ";
						$getsql = mysqli_query($connection,$sql);
						$cnt= mysqli_num_rows($getsql);*/
				//	echo "select * from $tblname where student_name = '$student_name' and $tblpkey  <> 0";die;
						//$getsqlchk = mysqli_query($connection,"select * from data where mobile = '$mobile' and id  <> 0");
						//$cntchk = mysqli_num_rows($getsqlchk);	
						//if($cntchk != 0)
						//{
						//	$dup++;
					//	}
						//else 
					//	{
							
								  $form_data = array(
													'per_name'=>$per_name, 'date_of_birth'=>$date_of_birth, 'age'=>$age, 'gender'=>$gender, 'profile_photo'=>$profile_photo, 'place_individual_identified'=>$place_individual_identified, 'stateid'=>$stateid, 'districtid'=>$districtid, 'phone_no'=>$phone_no, 'alternative_phone_no'=>$alternative_phone_no, 'address'=>$address, 'percondition'=>$percondition, 'status'=>$status, 'domicile_state'=>$domicile_state, 'domicile_district'=>$domicile_district, 'domicile_village'=>$domicile_village, 'marital_status'=>$marital_status, 'last_stayed_place'=>$last_stayed_place, 'period_stayed_place'=>$period_stayed_place, 'connon_language'=>$connon_language, 'language_read'=>$language_read, 'language_write'=>$language_write, 'language_speak'=>$language_speak, 'qualification'=>$qualification, 'study_place'=>$study_place, 'health_condition'=>$health_condition, 'physical_ailment'=>$physical_ailment, 'fir_copy'=>$fir_copy
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