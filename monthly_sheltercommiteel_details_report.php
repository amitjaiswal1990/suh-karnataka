<?phperror_reporting(0);include("adminsession.php");if($usertype=='ADMIN')		{			$crit = " 1 = 1 ";			$con = " 1 = 1 ";			$conulb = " where 1 = 1 ";				}		elseif($usertype=='DISTRICT')		{			$crit = " where districtid='$districtid' ";			$con = " where districtid='$districtid' ";			$conulb = " where districtid='$districtid' ";				}				elseif($usertype=='ULB')		{			$crit = " where ulbid='$ulbid' ";			$con = " where ulbid='$ulbid' ";			$conulb = " where ulbid='$ulbid' ";				}			elseif($usertype=='SHELTER')		{			$crit=" where userid='$loginid' ";			$con=" where districtid='$districtid' ";			$conulb=" where districtid='$districtid' ";		}if($_GET['districtid']) {	 $districtid = trim(addslashes($_GET['districtid']));	}	else	{	$districtid='';	}	if($_GET['ulbid']) {	$ulbid = trim(addslashes($_GET['ulbid']));	}	else	{	$ulbid='';	}	if($_GET['ngoid']) {	$ngoid = trim(addslashes($_GET['ngoid']));	}	else	{	$ngoid='';	}		if($_GET['commi_type']) {	$commi_type = trim(addslashes($_GET['commi_type']));	}	else	{	$commi_type='';	} if($commi_type !='') {		$crit .= " and commi_type= '$commi_type'";		$con .= " and commi_type= '$commi_type'";	} if($_GET['fromdate']!=""){	$fromdate = date("Y-m",strtotime($_GET['fromdate']));	$todate = date("Y-m",strtotime('+1 month',strtotime($_GET['fromdate'])));}else{	$fromdate = date("Y-m"); 	$todate = date('Y-m');}if($fromdate!="" && $todate!=""){//	$fromdate = $cmn->dateformatusa($fromdate);//	$todate = $cmn->dateformatusa($todate);	$con .= " and  execommmeeting_date between '$fromdate' and '$todate'";}	if($districtid !='') {		 $crit .= " and districtid= '$districtid'";		  $con .= " and districtid= '$districtid'";		    $conulb .= " and districtid= '$districtid'";	}			if($ulbid !='') {		$crit .= " and ulbid= '$ulbid'";		$con .= " and ulbid= '$ulbid'";	}		if($ngoid !='') {		$crit .= " and ngoid= '$ngoid'";		$con .= " and ngoid= '$ngoid'";	}?><!DOCTYPE html><html lang="en"><head>		<meta charset="utf-8">	<meta http-equiv="X-UA-Compatible" content="IE=edge">	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">		<title>SAVIOUR</title>	<meta content="Admin Dashboard" name="description">	<meta content="Themesbrand" name="author">	<link rel="shortcut icon" href="image/suhlogo.png">	<link rel="stylesheet" href="../plugins/morris/morris.css">	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">	<link href="assets/css/style.css" rel="stylesheet" type="text/css"></head><body>	<?php include("inc/header.php");?>	<!-- End Navigation Bar-->	<div class="wrapper">							<div class="row">								<div class="col-md-12">				<form  method="get" action="" enctype="multipart/form-data"><div><input type="hidden" ></div>		<input type="hidden" name="key">		<input type="hidden" name="service_id" value="" id="service_id">		<div class="container-fluid">		<div class="row">		<div class="col-md-12">		<div class="card mt-12">		<div class="card-header">						<h4 class="card-title">Monthly Shelter Committee Report</h4>		</div>		<div class="table-responsive">				<table class="table table-bordered table-striped">                                	<tr>                   						<td style="widtd: 20%;"> Month</td>						<!--<td style="widtd: 20%;">To </td>-->                       <td style="widtd: 20%;">District </td>                        <td style="widtd: 20%;">ULB Name </td>                       						</tr>                        <tr>                                                 <td style="widtd: 20%;"><input type="month" name="fromdate" id="fromdate" class="input-small form-control"  placeholder='dd-mm-yyyy'                     value="<?php echo $fromdate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> </td>                                                         	                       <td style="widtd: 30%;">                      	<?php if($usertype=='SHELTER')                        { ?>                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="districtid" class="form-control" autocomplete="off">                           <input  type="text"  name="district" value="<?php echo $district; ?>"  id="district"  readonly class="form-control" autocomplete="off">                                                <?php } else { ?>														 <select  name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control"><option value="">-- Select District--</option>                        <?php $dist=mysqli_query($connection,"SELECT * FROM m_district $condata order by districtname asc");							while($data=mysqli_fetch_array($dist)){															?>							  <option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>						<?php } ?>                     </select>                         <script>document.getElementById('districtid').value='<?php echo $districtid; ?>'; </script>														<?php }?>						</td>												<td style="widtd: 30%;">							<?php if($usertype=='SHELTER')                        { ?>                        <input  type="hidden"  name="ulbid" value="<?php echo $ulbid; ?>"  id="ulbid" class="form-control" autocomplete="off">                           <input  type="text"  name="ulbname" value="<?php echo $ulbname; ?>"  id="ulbname"  readonly class="form-control" autocomplete="off">                                                <?php } else { ?>													 <select  name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control"><option value="">-- Select --</option>                        <?php $dist=mysqli_query($connection,"select * from ulb_master $conulb order by ulbname asc");							while($data=mysqli_fetch_array($dist)){?>							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>						<?php } ?>                     </select>                       <script>document.getElementById('ulbid').value='<?php echo $ulbid; ?>'; </script>														<?php }?>						</td>																                       <td >                       						     <input type="submit" name="submit" value="Submit"  style="width:100px; float:none;" class="site-btn">                            <button ><a href="monthly_sheltercommiteel_details_report.php"> Clear </a></button>  						</td>					                    </tr>                  				</table>				</div>		</div>		</div>			</div>				</form>      <a href="excel_monthly_shelter_commitee.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&districtid=<?php echo $districtid;?>&ulbid=<?php echo $ulbid;?>&ngoid=<?php echo $ngoid;?>" class="btn btn-info" style="float:right">Export Excel</a>            		<table class="table table-bordered table-striped">									<tr>					      <th>Sl.No</th>                            <th>District</th>                            <th>ULB</th>          <th>Shelter Name</th>                         <th>Shelter Managing Committee Meeting</th>                                       <th>Date of Shelter Managing Committee Meeting</th>                    <th>No. Of Members Participated</th>                    <th>Upload Minutes Of Meeting</th>                    <th>Meeting Photo </th><th>Updated Status </th>                        <th>Action</th>					</tr>										    <?php				  $sno=1;				//   echo "select * from  monthlysheltercommittee_entry where $con  order by centryid desc";				 $sqql=mysqli_query($connection,"select * from m_ngo where $crit order by districtid,ulbid,ngoname");				  while($row=mysqli_fetch_array($sqql)){				  $shelterdetail=mysqli_query($connection,"select * from  monthlysheltercommittee_entry where $con and ngoid='$row[ngoid]'  order by centryid desc");				  $get_data=mysqli_fetch_array($shelterdetail);                  $count=mysqli_num_rows($shelterdetail);				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$row[stateid]'");					   $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$row[districtid]'");					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$row[ulbid]'");				// 	  $ngo = $cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");				  ?>		 	      <tr>		 	      <td><?php echo $sno++; ?></td>		 	   <td><?php echo $district?></td>		 	     <td><?php echo $ulbname;?></td>                <td><?php echo $row['ngoname'];?></td>								  <td><?php echo $get_data['executive_commitee']?></td>                                       <td><?php echo dateformatindia($get_data['execommmeeting_date'])?></td>                     <td><?php echo $get_data['members_participated'];?></td><?php if($get_data['pdfmeeting']!=''){ ?>                      <td><a href="uploaded/committee/<?php echo $get_data['pdfmeeting']; ?>" target="_blank">Download</a></td>                      <?php } else{?>                     <td>N/A</td><?php }?><?php if($get_data['meetingphoto']!=''){ ?>                     <td><a href="uploaded/committee/<?php echo $get_data['meetingphoto']; ?>" target="_blank">Download</a></td><?php } else{?>                     <td>N/A</td><?php }?><td><?php if($count<1){?><span style="color:red">No</span><?php } else{?><span style="color:green">Yes</span><?php } ?></td>                              <td> <a class="fa fa-remove" style="font-size:20px;color:red" onclick='funDel(<?php echo  $get_data['centryid'] ; ?>);'></a></td>					    </tr>					<?php } ?>  														</table>		</div>				<!-- end col -->					<!-- end row -->		</div>		<!-- end col -->	</div>	<!-- end row -->		<!-- end container-fluid -->	</div>	<!-- end wrapper -->	<?php include("inc/footer.php"); ?><script>	function funDel(id)	{  //alert(id);   		tblname = '<?php echo $tblname; ?>';		tblpkey = '<?php echo $tblpkey; ?>';		pagename = '<?php echo $pagename; ?>';		submodule = '<?php echo $submodule; ?>';		module = '<?php echo $module; ?>';		 //alert(module); 		if(confirm("Are you sure! You want to delete this record."))		{			jQuery.ajax({			  type: 'POST',			  url: 'ajax/delete_master.php',			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,			  dataType: 'html',			  success: function(data){				//alert(data);				   location='<?php echo $pagename."?action=3" ; ?>';				}							  });//ajax close		}//confirm close	} //fun close  function getshelter(){      //alert('hello'); var districtid = jQuery("#districtid").val();  var ulbid = jQuery("#ulbid").val();//alert(districtid);   		  jQuery.ajax({		  type: 'POST',		  url: 'getngoreport.php',		  data: "districtid="+districtid+'&ulbid='+ulbid,		  dataType: 'html',		  success: function(data){				  	//	alert(data);													jQuery('#ngoid').html(data);//				//jQuery('#showdatarecord').html(data);												}		  });//ajax close}		function getulb(){      //alert('hello'); var districtid = jQuery("#districtid").val();//alert(districtid);   		  jQuery.ajax({		  type: 'POST',		  url: 'getulbreport.php',		  data: "districtid="+districtid,		  dataType: 'html',		  success: function(data){			  jQuery('#ulbid').html(data);								//jQuery('#showdatarecord').html(data);												}		  });//ajax close}  </script></body><!-- Mirrored from themesbrand.com/lexa/html/horizontal/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Aug 2019 07:19:42 GMT --></html>