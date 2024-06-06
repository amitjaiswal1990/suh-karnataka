<?php
include("adminsession.php");
$_GET['stateid']=2;
if ( isset( $_GET[ 'stateid' ] ) )
	$stateid = $_GET[ 'stateid' ];
else
	$stateid = 0;

$con1 = "where 1=1";

	
	if($_GET['stateid']!=''){
		$con1 .=" and stateid = '$_GET[stateid]'";
		$con ="stateid = '$_GET[stateid]'";
	}
	if($_GET['ngoid']!=''){
	   $con1 .=" and ngoid = '$_GET[ngoid]'";
		$con .=" and ngoid = '$_GET[ngoid]'";
	}
		if($_GET['districtid']!=''){
		$con1 .=" and districtid = '$_GET[districtid]'";
		$con .=" and districtid = '$_GET[districtid]'";
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
		<div class="card-header ">
			<!-- <span class="pull-right text-danger">Amounts in Rs. only</span> -->
			<h4 class="card-title" style="text-align: center;" >
				
				<span>Shelter wise Medical Camp Report</span>
			</h4>
		</div>
		<div class="table-responsive">
			
				<div class="row"  style="margin-top: 12px;">
					 <div class="col-md-12 table-responsive">
						 <form action="" method="get">	
                         
                         					<table class="table table-bordered">
						   <tr>
						      <td style="vertical-align: middle;">State Name</td>
						<td><label style="color:green;font-size:16px;">Karnataka</label>
						</td>
					
							<td style="vertical-align: middle;">District Name</td>	
							<td><select name="districtid" id="districtid" class="form-control" onChange="getshelter();">
								<option value="">--Select District--</option>
							
<?php $sql2=mysqli_query($connection,"select * from m_district");
	 while($get_data2=mysqli_fetch_array($sql2)){?>						
<option value="<?php echo $get_data2['districtid'] ?>"><?php echo $get_data2['districtname'] ?></option>
						<?php } ?>
								</select>
								<script>document.getElementById('districtid').value='<?php echo $_GET['districtid'] ?>';</script>
						</td>
							<td style="widtd: 20%;">
						 <select  name="ulbid" id="ulbid" onChange="getshelter();"  style="width:150px;" class="form-control">
                         <option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from ulb_master where districtid='$districtid' order by ulbname asc");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
						<?php } ?>
                     </select>
						 <script>  document.getElementById('ulbid').value=('<?php echo $ulbid;?>'); </script>
						</td>
						
								
							<td style="vertical-align: middle;">Shelter Name</td>	
							<td><select name="ngoid" id="ngoid"  class="form-control"><option value="">--Select--</option>
							
<?php $sql2=mysqli_query($connection,"select * from m_ngo");
	 while($get_data2=mysqli_fetch_array($sql2)){?>						
<option value="<?php echo $get_data2['ngoid'] ?>"><?php echo $get_data2['ngoname'] ?></option>
						<?php } ?>
						</select>
						<script>document.getElementById('ngoid').value='<?php echo $_GET['ngoid'] ?>';</script>
						</td>
															
						
								
							<td style="text-align: center;"><input type="submit" name="submit" value="Get Details" style="float:none;" class="site-btn"> </td></tr>
                            </table>
						 </form>
                         
							<?php if($stateid!=''){?>
								<table class="table table-bordered"> 
							<tr>
								<td colspan="12">
									<table  class="example table table-bordered table-condensed table-hover"   >
									  <thead>
											<tr>
												<th style="text-align: center; width: 1%;">Sl.No.</th>
												<th style="text-align: center;">District Name</th>
												<th style="text-align: center;">Shelter Name</th> 
												<th style="text-align: center;">Medical Camps</th> 
												<th style="text-align: center;">No.of Persons Checked</th>
												
												<th style="text-align: center;">No.of Persons Treated</th>
											</tr>
									   </thead>
									   
										<tbody>
											<?php
	$sno=1;
	
	
											$sql_data=mysqli_query($connection,"select * from m_ngo $con1");
											while($get_data=mysqli_fetch_array($sql_data)){
										 
									
												
												$c_medical=$cmn->getvalfield($connection,"medical_camp","count(medid)","1=1 and ngoid = '$get_data[ngoid]'");
											 $tot_checked=$cmn->getvalfield($connection,"medical_camp","sum(no_persons_checked)","1=1 and ngoid = '$get_data[ngoid]'");
											$tot_treated=$cmn->getvalfield($connection,"medical_camp","sum(no_persons_treated)","1=1 and ngoid = '$get_data[ngoid]'");	         $districtname=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
											?>
												<tr>
													<td style="text-align: center;  width: 1%;"><?php echo $sno; ?></td>
													<td><?php echo $districtname ?> </td>
													<td><?php echo $get_data['ngoname'] ?> </td>
											    	<td style="text-align: right;"><?php echo $c_medical ?></td>
													<td style="text-align: right;"><?php echo $tot_checked ?></td>

											    	<td align="right" class="comma  sum"><?php echo $tot_treated ?></td>
												
												</tr>
											
												<?php 		$sno++; } ?>
											
										</tbody>
										<tfoot >
											<?php
	$tot_c_medical=$cmn->getvalfield($connection,"medical_camp","count(medid)","1=1 and $con");
	$tot_tot_checked=$cmn->getvalfield($connection,"medical_camp","sum(no_persons_checked)","1=1 and $con");
	$tot_tot_treated=$cmn->getvalfield($connection,"medical_camp","sum(no_persons_treated)","1=1 and $con");
											?>
											<tr style="font-weight: bold;" >
												<td></td>
												
												<td style="text-align: center;">Total</td>
												<td align="right" class="total"><?php echo $tot_c_medical ?></td>
												<td align="right" class="total"><?php echo $tot_tot_checked ?></td>
												<td align="right" class="total"><?php echo $tot_tot_treated ?></td>
											</tr>
										</tfoot>
									
									
									
								</table>
							</td>
						</tr>
                        </table>
							<?php } ?>


					</div>
                    </div>
				 	
		</div> <!-- End of card-body div -->
	</div> <!-- End of card div -->
</div><!--  End of container-fluid div -->

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
  <script>
	  function getshelter(){      
//alert('hello');
 var districtid = jQuery("#districtid").val();
  var ulbid = jQuery("#ulbid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getngo.php',
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
		  url: 'getulb.php',
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