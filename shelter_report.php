<?php
error_reporting(0);
include("adminsession.php");
 if($usertype=='ADMIN')
		{
				$crit = "  1 = 1 ";
				$con = "  1 = 1 ";
				$conulb = "  1 = 1 ";
		
		}
		else
		{
			$crit=" userid='$loginid' ";
		$con=" districtid='$districtid' ";
			$conulb=" districtid='$districtid' ";
		}

if($_GET['fromdate']!="" && $_GET['todate']!="")
{
	$fromdate = addslashes(trim($_GET['fromdate']));
	$todate = addslashes(trim($_GET['todate']));
}
else
{
	$fromdate = date("Y-m-d"); 
	$todate = date('Y-m-d');
}

if($_GET['districtid']) {
	 $districtid = trim(addslashes($_GET['districtid']));
	}
	else
	{
	$districtid='';
	}
	if($_GET['ulbid']) {
	$ulbid = trim(addslashes($_GET['ulbid']));
	}
	else
	{
	$ulbid='';
	}
	if($_GET['ngoid']) {
	$ngoid = trim(addslashes($_GET['ngoid']));
	}
	else
	{
	$ngoid='';
	}
 
 if($_GET['design_capacity']) {
	$design_capacity = trim(addslashes($_GET['design_capacity']));
	}
	else
	{
	$design_capacity='';
	}
	
	
	if($_GET['s_type']) {
	$s_type = trim(addslashes($_GET['s_type']));
	}
	else
	{
	$s_type='';
	}

 
 

if($fromdate!="" && $todate!="")
{
	//$fromdate = $cmn->dateformatusa($fromdate);
	//$todate = $cmn->dateformatusa($todate);
	$crit .= " and  date(createdate) between '$fromdate' and '$todate'";
}


	
if($districtid !='') {
		 $crit .= " and districtid= '$districtid'";
		  $con .= " and districtid= '$districtid'";
		    $conulb .= " and districtid= '$districtid'";
	}	
	
	if($ulbid !='') {
		$crit .= " and ulbid= '$ulbid'";
		$con .= " and ulbid= '$ulbid'";
	}
	
	if($ngoid !='') {
		$crit .= " and ngoid= '$ngoid'";
		$con .= " and ngoid= '$ngoid'";
	}
	
	if($design_capacity !='') {
		$crit .= " and design_capacity= '$design_capacity'";
		$con .= " and design_capacity= '$design_capacity'";
	}
	
	if($s_type !='') {
		$crit .= " and s_type= '$s_type'";
		$con .= " and s_type= '$s_type'";
	}
// echo "SELECT *
// FROM attendance_details
// LEFT JOIN m_ngo
// ON attendance_details.ngoid = m_ngo.ngoid $crit";die;
	
	//echo "select * from ulb_master $conulb order by ulbname asc";die;
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
						<h4 class="card-title">Datewise Shelter  Report</h4>
		</div>
		<div class="table-responsive">
				<table class="table table-bordered table-striped">
                
                	<tr>
						<td style="widtd: 20%;">From Date</td>
                        <td style="widtd: 20%;">To Date</td>
                        <td style="widtd: 20%;display:none">District Name</td>
                        <td style="widtd: 20%;display:none">ULB Name </td>
                          <!--<td style="widtd: 20%;">Shelter Name</td>-->
                         <td style="widtd: 20%;display:none">Capacity</td>
                        <td style="widtd: 20%;display:none">Shelter Type</td>
						</tr>
                        <tr>
                             <td style="widtd: 20%;"><input type="date" name="fromdate" id="fromdate" class="input-small"  placeholder='dd-mm-yyyy'
                     value="<?php echo $fromdate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> </td>
                   
                    
                    <td style="widtd: 20%;"><input type="date" name="todate" id="todate" class="input-small" 
                    placeholder='dd-mm-yyyy' value="<?php echo $todate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /></td>
                       
						
						
                       <td style="widtd: 20%;display:none">
                      	<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="districtid" class="form-control" autocomplete="off">
                           <input  type="text"  name="district" value="<?php echo $district; ?>"  id="district"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
							 <select  name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control"><option value="">-- Select District--</option>
                        <?php $dist=mysqli_query($connection,"SELECT * FROM m_district $condata order by districtname asc");
							while($data=mysqli_fetch_array($dist)){
							
								?>
							  <option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>
						<?php } ?>
                     </select>
                         <script>document.getElementById('districtid').value='<?php echo $districtid; ?>'; </script>
							
							<?php }?>
						</td>
						
						<td style="widtd: 20%;display:none">
							<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="ulbid" value="<?php echo $ulbid; ?>"  id="ulbid" class="form-control" autocomplete="off">
                           <input  type="text"  name="ulbname" value="<?php echo $ulbname; ?>"  id="ulbname"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
						 <select  name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from ulb_master $conulb order by ulbname asc");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
						<?php } ?>
                     </select>
                       <script>document.getElementById('ulbid').value='<?php echo $ulbid; ?>'; </script>
							
							<?php }?>
						</td>
						
						<td style="widtd: 20%;display:none">
                      	<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="ngoid" value="<?php echo $ngoid; ?>"  id="ngoid" class="form-control" autocomplete="off">
                           <input  type="text"  name="ngo" value="<?php echo $ngo; ?>"  id="ngo"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
						        <select name="ngoid" id="ngoid"  class="form-control" style="width:150px;" >
                       <option value="">-Select Shelter Name-</option>
                                            <?php 
											$sql1 = "select distinct ngoname,ngoid from m_ngo $con order by ngoname asc";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
													
											?>
                                          			<option value="<?php echo $row1['ngoid']; ?>"><?php echo $row1['ngoname']; ?></option>
                                            <?php
												}
												
												?>
                                      </select>  
                                         <script>document.getElementById('ngoid').value='<?php echo $ngoid; ?>'; </script>
							
							<?php }?>
                       </td>
						
						  <td style="widtd: 5%;display:none"><input type="text" name="design_capacity" id="design_capacity" class="input-small" value="<?php echo $design_capacity; ?>" style="width:50px;"  /> </td>                  
                    
                    <td style="widtd: 20%;display:none"><select  id="s_type" name="s_type" onChange="getstype(this.value);" value="<?php echo $s_type; ?>" <?php if($keyvalue!=0){ ?> disabled <?php } ?> class="form-control" style="width:200px;" ><option value="">-- Select --</option>
							
								<option value="Men">Men shelters </option>
								<option value="Women">Women shelters: For the needs of women and their dependent children. </option>
                                <option value="Men and Women">Family Shelters: For families living on the streets </option>
                                <option value="Special Shelters">Special Shelters: old persons without care, mentally ill, recovering patients and their families</option>
                                <option value="Third Gender">Transgender Shelter</option>
							</select>
                              <script>document.getElementById('s_type').value='<?php echo $s_type; ?>'; </script> </td>
                      
					 <td >
                       
						    <div style="display: inline-flex;">
                           <a href="shelter_report.php" class="btn btn-danger" style="width:100px; float:none; float:right"> Clear </a> 
                           <input type="submit" name="submit" value="Submit"   style="width:100px; float:none; float:right" class="btn btn-success">
					</div> 	</td>
                    </tr>
                    
                    	
                      
                  
				</table>
		
		</div>
		</div>
		</div>
			</div>
			
	</form>
      <a href="excel_shelter_report.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&districtid=<?php echo $districtid;?>&ulbid=<?php echo $ulbid;?>&ngoid=<?php echo $ngoid;?>" class="btn btn-info" style="float:right">Export Excel</a>
    <table class="table table-bordered table-striped">
		 	  <thead>
		 	     <tr>
		 	       <th>Sl.No</th>
					 
					 <th>District</th>
					<th>ULB</th>
					 <th>Shelter Name</th>
		 	     
		 	       <th>SMA Details</th>
                   <th>Capacity</th>
                   <th>Status</th>
                   
				
		 	     </tr>
		 	  </thead>
		 	  <tbody>
		 	  
		 	      <?php
				  $sno=1;
				  $shelterdetail=mysqli_query($connection,"SELECT * from m_ngo order by districtid");
				  while($get_data=mysqli_fetch_array($shelterdetail)){
				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");
					   $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");
					 
					  $status=$cmn->getvalfield($connection,"attendance_details","count(ngoid)","$crit and ngoid=$get_data[ngoid]");
				  ?>
		 	      <tr>
		 	      <td><?php echo $sno++; ?></td>
		 	     <td><?php echo ucfirst(strtolower($district));?></td>
                          <td><?php echo ucfirst(strtolower($ulbname));?></td>
				  <td><?php echo $get_data['ngoname']; ?></td>
				  
				 <td><?php if($get_data['smaname']!=''){echo $get_data['smaname']; }
				 else{ echo "-"; }?></td>
                  <td><?php echo $get_data['design_capacity']?></td>
                  <td><?php if($status>0){?><span style="color:green">Updated</span><?php }else{ ?><span style="color:red">Not Updated</span><?php } ?></td>
		 	      
		 	    </tr>
		 	    <?php } ?>
		 	   
		 	    
		 	  </tbody>
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