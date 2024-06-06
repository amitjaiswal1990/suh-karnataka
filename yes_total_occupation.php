<?php
error_reporting(0);
include("adminsession.php");
 $currentdate = date('Y-m-d',strtotime("-1 days"));
	
	//$currentdate=date('Y-m-d');
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
				<form  method="get" action="" enctype="multipart/form-data"><div><input type="hidden" ></div>
		<input type="hidden" name="key">
		<input type="hidden" name="service_id" value="" id="service_id">
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
						<h4 class="card-title">Yesterday Occupancy</h4>
		</div>
		
		</div>
		</div>
			</div>
			
	</form>
          <a href="yesexcel_occupy.php" class="btn btn-info" style="float:right">Export Excel</a>
          
          <table class="table table-bordered">
						
					 <?php 
					
				//echo "select * from  attendance_details  $condata and atten_date='$currentdate' group by ulbid asc";
				 $ulbdetail=mysqli_query($connection,"select * from  attendance_details  $condata and atten_date='$currentdate' group by ulbid asc");
				  while($get_u=mysqli_fetch_array($ulbdetail)){ 
				   $districtname=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_u[districtid]'");
				     $ulbname=$cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_u[ulbid]'");
					   $totshelter=$cmn->getvalfield($connection,"attendance_details","count(aid)","atten_date='$currentdate' and ulbid='$get_u[ulbid]'");
				 
				  
				  ?>
                <tr>
            
                    <th  colspan="8">District : <?php echo $districtname;?> &nbsp;&nbsp;&nbsp;&nbsp; ULB : <?php echo $ulbname;?>&nbsp;&nbsp;&nbsp;&nbsp; Persons : <?php echo $totshelter;?></th>
                 
                  
                </tr>
                  <tr>
                  <th>SN</th>
                   <th>Shelter Name</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Age</th>
                    <th>Gender</th>

                        <th colspan="2">Attendance</th>
                  </tr>              
									 
											   <?php
				  $sno=1;
				//  echo "select * from personal_details $crit";
				//echo "select * from attendance_details $crit";
		//	echo "select * from attendance_details where atten_date = '$currentdate' and  districtid= '$get_u[districtid]' order by ngoid asc";
				  $shelterdetail=mysqli_query($connection,"select * from attendance_details where atten_date = '$currentdate' and  ulbid= '$get_u[ulbid]' order by ngoid asc");
				  while($get_data=mysqli_fetch_array($shelterdetail)){
				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");
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
                   
                    
                    <td><?php echo $ngo; ?></td>
                    
                    <td>
                   
                    <?php echo $per_name;?></td>
                    <td><?php echo dateformatindia($date_of_birth);?></td>
                    <td><?php echo $age;?></td>
                    <td><?php echo $gender;?></td>
                    <td>
                    <?php if($get_data['attendance']=='Present'){ ?> <span style="color:#390"><strong>Present</strong></span> <?php } else { ?> <span style="color:#F00"><strong>Absent</strong></span> <?php } ?>        
                    </td>
                    
                    </tr>
		 	    <?php } } ?>
		 	   
						
					</table>
    

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
  function getshelter(){      
//alert('hello');
 var districtid = jQuery("#districtid").val();
  var ulbid = jQuery("#ulbid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getngoreport.php',
		  data: "districtid="+districtid+'&ulbid='+ulbid,
		  dataType: 'html',
		  success: function(data){				  
	//	alert(data);
					
				
		
		jQuery('#ngoid').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
	
	function getulb(){      
//alert('hello');
 var districtid = jQuery("#districtid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getulbreport.php',
		  data: "districtid="+districtid,
		  dataType: 'html',
		  success: function(data){	
		  jQuery('#ulbid').html(data);
		
		
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
  </script>

</body>
<!-- Mirrored from themesbrand.com/lexa/html/horizontal/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Aug 2019 07:19:42 GMT -->
</html>