<?php
error_reporting(0);
include("adminsession.php");
$pagename = "financial_audit_report.php";
$module = "Add Counseling Details";
$submodule = "Add findate Details";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "counseling_details";
$tblpkey = "counsid";
$imgpath = "uploaded/counseling/";
$action='';
if($usertype=='ADMIN')
		{
			$crit = " where 1 = 1 ";
			$con = " where 1 = 1 ";
			$conulb = " where 1 = 1 ";
		
		}
		elseif($usertype=='DISTRICT')
		{
			$crit = " where districtid='$districtid' ";
			$con = " where districtid='$districtid' ";
			$conulb = " where districtid='$districtid' ";
		
		}
		
		elseif($usertype=='ULB')
		{
			$crit = " where ulbid='$ulbid' ";
			$con = " where ulbid='$ulbid' ";
			$conulb = " where ulbid='$ulbid' ";
		
		}
			elseif($usertype=='SHELTER')
		{
			$crit=" where userid='$loginid' ";
			$con=" where districtid='$districtid' ";
			$conulb=" where districtid='$districtid' ";
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
 
if($fromdate!="" && $todate!="")
{
	//$fromdate = $cmn->dateformatusa($fromdate);
	//$todate = $cmn->dateformatusa($todate);
	$crit .= " and  findate between '$fromdate' and '$todate'";
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
	//echo "select * from ulb_master $con order by ulbname asc";die;
	
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

	<div class="wrapper">
      <?php if($action==1){?> <div class="col-md-12"><h1><span style="color:#F00;">Record Inserted Successfully</span></h1></div>  <?php } ?>
		<form  method="get" action="" enctype="multipart/form-data"><div><input type="hidden" ></div>
		<input type="hidden" name="key">
		<input type="hidden" name="service_id" value="" id="service_id">
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
						<h4 class="card-title">Financial Audit Report</h4>
		</div>
		<div class="table-responsive">
				<table class="table table-bordered table-striped">
                
                	<tr>
						<td style="widtd: 20%;">From Date</td>
                        <td style="widtd: 20%;">To Date</td>
                        <td style="widtd: 20%;">District Name</td>
                        <td style="widtd: 20%;">ULB Name </td>
                          <td style="widtd: 20%;">Shelter Name</td>
						</tr>
                        <tr>
                             <td style="widtd: 20%;"><input type="date" name="fromdate" id="fromdate" class="input-small"  placeholder='dd-mm-yyyy'
                     value="<?php echo $fromdate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> </td>
                   
                    
                    <td style="widtd: 20%;"><input type="date" name="todate" id="todate" class="input-small" 
                    placeholder='dd-mm-yyyy' value="<?php echo $todate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /></td>
                       
						     <td style="widtd: 20%;">
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
						
						<td style="widtd: 20%;">
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
						
						<td style="widtd: 20%;">
                      	<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="ngoid" value="<?php echo $ngoid; ?>"  id="ngoid" class="form-control" autocomplete="off">
                           <input  type="text"  name="ngo" value="<?php echo $ngo; ?>"  id="ngo"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
						        <select name="ngoid" id="ngoid"  class="form-control" style="width:150px;" onChange="getdetails(this.value);">
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
						
						
						
                       <td >
                       
						     <input type="submit" name="submit" value="Submit"  style="width:100px; float:none;" class="site-btn">
                            <button ><a href="financial_audit_report.php"> Clear </a></button>  
						</td>
					
                    </tr>
                  
				</table>
		
		</div>
		</div>
		</div>
			</div>
			
	</form>
		
        
		
        
        <div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
			<h4 class="card-title">Financial Audit Details</h4>
		</div>
		<div class="table-responsive">
        <a href="excel_financial_audit_report.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&districtid=<?php echo $districtid;?>&ulbid=<?php echo $ulbid;?>&ngoid=<?php echo $ngoid;?>" class="btn btn-info" style="float:right">Export Excel</a>
				<table class="table table-bordered table-striped">
				
					<tr>
					    <th>Sl.No</th>
                         <th>District</th>
						<th>ULB</th>
                        <th>Shelter</th>
						<th>Document Photo/PDF</th>
						<th>Date</th>						
						<th>Financial Year</th>
                        
						
					</tr>
					
					    <?php 
						$sn=1;
						$dist=mysqli_query($connection,"select * from financial_audit $crit");
							while($data=mysqli_fetch_array($dist)){
							$ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$data[ulbid]'");
							$ngoname = $cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$data[ngoid]'");
							$districtname = $cmn->getvalfield($connection,"m_district","districtname","districtid='$data[districtid]'");
								?>
					    <tr>
					      <td><?php echo $sn++;?></td>
                           <td><?php echo ucfirst(strtolower($districtname));?></td>
                          <td><?php echo ucfirst(strtolower($ulbname));?></td>
                            <td><?php echo ucfirst(strtolower($ngoname));?></td>
                       <td> <?php if($data['imgname']!=''){?>  <img src="uploaded/financial/<?php echo $data['imgname'];?>"   style=" height:30px; width:30px;" id="imgprvw" title="Auditor Photo"/> <?php } ?></td> 
					      <td><?php echo $cmn->dateformatindia($data['findate']);?></td>                          
                           <td><?php echo $data['financial_year'];?></td>
                             
                          
					    </tr>
					<?php } ?>  
					
					

				</table>
		</div>
		</div>
		</div>
		</div>
        </div>
		<!-- end container -->
	</div>



	<?php include("inc/footer.php"); ?>
<script>
	function funDel(id)
	{  //alert(id);   
		tblname = '<?php echo $tblname; ?>';
		tblpkey = '<?php echo $tblpkey; ?>';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		imgpath = '<?php echo $imgpath; ?>';
		 //alert(module); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_image_master.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module+'&imgpath='+imgpath,
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

</html>